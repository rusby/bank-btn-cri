<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use View;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\{
    User,
    UserFile
};
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $data = (object) [
        ];
        $roles = Role::whereIn('name', ['sales developer', 'sales lepas'])->pluck('name');

        return View::make('auth.register',compact('data', 'roles'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function store(Request $request)
    {
        if ($request['ktp'] == "undefined") {
            $request['ktp'] = null;
        }

        $data = $request->all();

        $alert = [
            'address.required'   => 'Alamat belum terisi, Silakan isi terlebih dahulu',
            'role_id.required'   => 'Role belum terisi, Silakan isi terlebih dahulu',
            'ktp.required'       => 'KTP belum diupload, Silakan upload KTP terlebih dahulu',
            'phone.required'     => 'Phone Number belum terisi, Silakan isi terlebih dahulu',
            'name.required'      => 'Name belum terisi, Silakan isi terlebih dahulu ',
            'username.required'  => 'Username belum terisi, Silakan isi terlebih dahulu ',
            'username.unique'    => sprintf("Username %s sudah terdaftar",  $data['username']),
            'email.required'     => 'Email belum terisi, Silakan isi terlebih dahulu ',
            'email.unique'       => sprintf("Email sudah terdaftar %s",  $data['email']),
            'password.required'  => "Password belum terisi, Silakan isi terlebih dahulu",
            'password.max'       => "Password harus 8 karakter",
            'password.confirmed' => "Password Confirmation belum terisi, Silakan isi terlebih dahulu",
            'password.regex'     => "Password harus mengunakan angka dan terdatapat kapital",
            'toc.accepted'       => 'TOR belum dichecklist, Silakan dichecklist terlebih dahulu'
        ];

        if($data['password'] !== $data['password_confirmation']) {
            return response()->json([
                'status'   => "fail",
                'messages' => 'Password anda tidak sama',
            ], 422);
        }
        if ($data['role_id'] == "sales developer") {
            $validator = Validator::make($request->all(),[
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

        if ($data['role_id'] == "sales lepas") {
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

        $validator = Validator::make($data, [
            'name'     => "required",
            'username' => "required|unique:users",
            'email'    => "required|unique:users",
            'no_hp'    => ['required', 'numeric'],
            'role_id'  => "required",
            'ktp'      => "required|mimes:jpg,bmp,png",
            'password' => [
                'required',
                'confirmed',
                'string',
                'max:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
            ]
        ],$alert);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }

        $user_data = [
            "name" => $data["name"],
            "username" => $data["username"],
            "password" => Hash::make($data["password"]),
            "no_hp" => $data['no_hp'],
            'nama_developer' => $data['nama_developer'],
            'nama_perumahan' => $data['nama_perumahan']
        ];
        $user = User::firstOrCreate([
            "email" => $data["email"],
        ],$user_data);
        $user->assignRole($request->role_id);

        $file_ktp = null;
        $p_ktp    = null;
        if ($request->hasFile('ktp')) {
            $p_ktp    = 'users/ktp';
            $file_ktp = \Helper::storeFile($p_ktp, $request->file('ktp'), \Helper::generateRandString());
        }

        $file_kartunama = null;
        $p_kartunama    = null;
        if ($request->hasFile('kartu_nama')) {
            $p_kartunama    = 'users/kartu_nama';
            $file_kartunama = \Helper::storeFile($p_kartunama, $request->file('kartu_nama'), \Helper::generateRandString());
        }

        UserFile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'ktp'             => $file_ktp,
                'path_ktp'        => $p_ktp,
                'kartu_nama'      => $file_kartunama,
                'path_kartu_nama' => $p_kartunama
            ]);

        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil register, silakan ditunggu untuk verifikasi akun anda.",
        ], 200);

    }

}