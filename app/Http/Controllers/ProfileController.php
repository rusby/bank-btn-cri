<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\File;
use Illuminate\Http\Request;
use ZipArchive;
use App\Models\User;
use DB;

class ProfileController extends Controller
{
    public function getProfile($id, $username)
    {
        $data = User::where([
            ['id', $id],
            ['username', $username]
        ])->first();
        if ($data) {
            return view('profile', compact('data'));
        }
        abort(404);
    }

    
    public function saveProfile(Request $request)
    {
        $userId = $request->id;
        $validator = \Validator::make($request->all(), 
            [ 
                'name'      => ['required', 'string', 'max:255'],
                'username'  => ['required', 'string', 'unique:users,username,'.$userId],
                'email'     => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$userId],
            ]);

        if($validator->fails()) {
            return response()->json([
                'status'    => "fail",
                'messages'  => $validator->errors()->first(),
            ],422);
        }

        DB::beginTransaction();
        try {
            $selUser = User::findOrFail($userId);
            $selUser->password    = $request->password ? \Hash::make($request->password) : \Hash::make($selUser->password);

            $selUser->name = $request->name;
            $selUser->username = $request->username;
            $selUser->email = $request->email;
            $selUser->no_hp = $request->no_hp;
            $selUser->save();          

            DB::commit();

            return response()->json([
                'status'       => "ok",
                'messages'     => "Berhasil mengubah profile",
                'data'         =>  $request->all()
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status'    => "fail",
                'messages'  => "Ada kesalahan dalam input data",
            ],422);
        }
    }
}
