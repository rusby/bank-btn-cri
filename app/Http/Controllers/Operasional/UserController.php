<?php

namespace App\Http\Controllers\Operasional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    UserFile,
    User
};
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use DB;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.operasional.user.index');
    }

    public function create()
    {
        $roles = Role::whereIn('name', ['sales developer', 'sales lepas'])->get();
        return view('pages.operasional.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), 
            [ 
                'name'      => ['required', 'string', 'max:255'],
                'username'  => ['required', 'string', 'unique:users'],
                'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password'  => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'],
                'nama_role' => ['required'],
            ]);

        if($validator->fails()) {
            return response()->json([
                'status'    => "fail",
                'messages'  => $validator->errors()->first(),
            ],422);
        }

        DB::beginTransaction();
        try {
            $request['password']    = \Hash::make($request->password);
            $request['is_approved'] = 1;

            $user = User::create($request->only(['name', 'username', 'email', 'password', 'is_approved']));
            $user->assignRole($request->nama_role);

            $file_ktp = null;
            $p_ktp    = null;
            if ($request->hasFile('ktp')) {
                $p_ktp    = 'users/ktp'; 
                $file_ktp = \Helper::storeFile($p_ktp, $request->file('ktp'));
            }

            $file_kartunama = null;
            $p_kartunama    = null;
            if ($request->hasFile('kartu_nama')) {
                $p_kartunama    = 'users/kartu_nama';
                $file_kartunama = \Helper::storeFile($p_kartunama, $request->file('kartu_nama'));
            }

            if ($request->nama_role != "Kantor Pusat" && $request->nama_role != "Kantor Wilayah" && $request->nama_role != "Kantor Cabang" && $request->nama_role != "operasional") {
                UserFile::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'ktp'             => $file_ktp,
                        'path_ktp'        => $p_ktp,                    
                        'kartu_nama'      => $file_kartunama,
                        'path_kartu_nama' => $p_kartunama
                    ]);
            }
            DB::commit();

            return response()->json([
                'status'       => "ok",
                'messages'     => "Berhasil mendaftarkan user",
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

    public function show($id)
    {
        $data = User::findOrFail($id);
        return view('pages.operasional.user.show', compact('data'));
    }

    public function edit($id)
    {
        $data['data']  = User::findOrFail($id);
        $data['roles'] = Role::whereIn('name', ['sales developer', 'sales lepas'])->get();
        return view('pages.operasional.user.edit')->with($data);
    }

    public function update(Request $request, $userId)
    {
        
    }
    
    public function destroy($id)
    {
        //
    }

    public function getDatatble(Request $request){
        if ($request->ajax()) {
            $data = User::whereHas('roles', function($q){
                $q->whereIn('name', ['sales developer', 'sales lepas']);
            })
            ->latest()->get();
            return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                return $row->badge_status;
            })
            ->addColumn('roles', function($row){
                return $row->roles->pluck('name')[0];
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('operasional.user.show', $row->id).'" class="edit btn btn-info btn-sm">Detail</a>';
                $actionBtn .= '<a href="'.route('operasional.user.edit', $row->id).'" class="edit btn btn-warning ml-1 btn-sm">Edit</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status', 'roles'])
            ->make(true);
        }
    }
}
