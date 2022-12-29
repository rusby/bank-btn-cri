<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection\CollectionFile;
use Illuminate\Support\Facades\Validator;
use App\Models\{
	User,
	UserFile
};
use Auth;
use DB;
class AuthController extends Controller
{
	public function register(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'name' 	   => 'required|string|max:255',
			'username' => 'required|string|max:255|unique:users',
			'email'	   => 'required|string|max:255|unique:users',
			'password' => 'required|string|min:8',
			'nama_role'=> 'required',
			'no_hp'    => 'required|numeric',
			'ktp'	   => 'required'
		]);

		if($validator->fails()) {
			return response()->json([
				'status'    => "fail",
				'messages'  => $validator->errors()->first(),
			],422);
		}

		if ($request->nama_role == "Sales Developer") {
			$validator = Validator::make($request->all(),[
				'kartu_nama'	   => 'required',
				'nama_developer'   => 'required',
				'nama_perumahan'   => 'required'
			]);

			if($validator->fails()) {
				return response()->json([
					'status'    => "fail",
					'messages'  => $validator->errors()->first(),
				],422);
			}
		}

		if ($request->nama_role == "sales lepas") {
			$validator = Validator::make($request->all(),[
				'nama_perumahan'   => 'required'
			]);

			if($validator->fails()) {
				return response()->json([
					'status'    => "fail",
					'messages'  => $validator->errors()->first(),
				],422);
			}
		}

		if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
			return response()->json([
				'status'    => "fail",
				'messages'  => "Format email salah",
			],422);
		}

		if($validator->fails()) {
			return response()->json([
				'status'    => "fail",
				'messages'  => $validator->errors()->first(),
			],422);
		}

		DB::beginTransaction();
		try {
			$request['password'] = \Hash::make($request->password);
			$user = User::create($request->except('nama_role', 'ktp'));
			$user->assignRole($request->nama_role);

			$file_ktp = null;
			$p_ktp    = null;
			if (base64_decode($request->ktp)) {
				$p_ktp    = 'users/ktp';
				$file_ktp = \Helper::storeBase64File($p_ktp, $request->ktp, \Helper::generateRandString());
			}

			$file_kartunama = null;
			$p_kartunama    = null;
			if (base64_decode($request->kartu_nama)) {
				$p_kartunama    = 'users/kartu_nama';
				$file_kartunama = \Helper::storeBase64File($p_kartunama, $request->kartu_nama, \Helper::generateRandString());
			}

			UserFile::updateOrCreate(
				['user_id' => $user->id],
				[
					'ktp'             => $file_ktp,
					'path_ktp'        => $p_ktp,
					'kartu_nama'      => $file_kartunama,
					'path_kartu_nama' => $p_kartunama
				]);

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			return response()->json([
				'status'    => "fail",
				'messages'  => "Ada kesalahan",
			],422);
		}

		return response()->json([
			'status'       => "ok",
			'messages'     => "Berhasil mendaftar, silakan menunggu untuk verifikasi akun anda.",
			'data'         =>  $user
		], 200);
	}

	public function login(Request $request){
		$validator = Validator::make($request->all(),[
			'email'    => 'required|string|max:255',
			'password' => 'required|string|max:255'
		]);

		if($validator->fails()) {
			return response()->json([
				'status'    => "fail",
				'messages'  => $validator->errors()->first(),
			],422);
		}
		if (!Auth::attempt($request->only('email', 'password')))
		{
			return response()->json([
				'status'    => "fail",
				'messages'  => "Email dan password tidak cocok.",
			],401);
		}

		$user = User::where('email', $request['email'])->With('files')->firstOrFail();
		if(!$user){
			return response()->json([
				'status'    => "fail",
				'messages' => "User tidak terdaftar.",
			], 422);
		}

		if($user->is_approved == 0){
			return response()->json([
				'status'    => "fail",
				'messages' => "User belum terverifikasi",
			], 422);
		}else if($user->is_approved == 2){
			return response()->json([
				'status'    => "fail",
				'messages' => "User ditolak verifikasi, silakan hubungi admin.",
			], 422);
		}

		$data = [
			'id' => $user->id,
			'name' => $user->name,
			'username' => $user->username,
			'email' => $user->email,
			'is_approved' => $user->is_approved,
			'ktp' => $user->files && $user->files->ktp ? $_SERVER['SERVER_NAME'].'/uploaded_files/'.$user->files->path_ktp.'/'.$user->files->ktp : null,
			'kartu_nama' => $user->files && $user->files->kartu_nama ? $_SERVER['SERVER_NAME'].'/uploaded_files/'.$user->files->path_kartu_nama.'/'.$user->files->kartu_nama : null
		];


		$token = $user->createToken('auth_token')->plainTextToken;

		return response()->json([
			'status'       => "ok",
			'messages'     => "Hi {$user->name}, welcome to home",
			'data'         =>  $data,
			'access_token' =>  $token,
			'token_type'   => 'Bearer'
		], 200);
	}

	public function logout()
	{
		auth()->user()->tokens()->delete();

		return response()->json([
			'status'       => "ok",
			'messages'     => "Berhasil logout"
		], 200);
	}

	public function getProfile(){
		return auth()->user();
	}
}