<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    UserFile,
    UserBri,
    User
};
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use DB;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.admin.user.index');
    }

    public function create()
    {
        $role = \Auth::user()->getRoleNames()->first();
        if ($role == "admin bri") {
            $roles = Role::whereIn('name', ['Kantor Pusat', 'Kantor Wilayah', 'Kantor Cabang', 'Kantor Cabang Pembantu', 'Kantor Cabang Khusus'])->latest()->get();
        }elseif ($role == "admin cri" || $role == "operasional") {
            $roles = Role::whereIn('name', ['operasional', 'operasional verifikator', 'sales developer', 'sales lepas'])->latest()->get();
        }elseif ($role == "superadmin") {
            $roles = Role::latest()->get();
        }
        return view('pages.admin.user.create', compact('roles'));
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

        if ($request->nama_role == "Kantor Wilayah") {
            $validator = \Validator::make($request->only('kantor_wilayah'), 
                [ 
                    'kantor_wilayah' => ['required'],
                ]);
        }

        if ($request->nama_role == "Kantor Cabang") {
            $validator = \Validator::make($request->only(['kantor_wilayah', 'kantor_cabang']), 
                [ 
                    'kantor_wilayah' => ['required'],
                    'kantor_cabang'  => ['required'],
                ]);
        }
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

            UserBri::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'is_kantor_pusat' => $request->nama_role == "Kantor Pusat" ? 1 : 0,
                    'kanwil_id' => $request->nama_role == "Kantor Wilayah" || $request->nama_role == "Kantor Cabang" ? $request->kantor_wilayah : null,
                    'kanca_kode' => $request->nama_role == "Kantor Cabang" ? $request->kantor_cabang : null,
                    'kcp_kode' => $request->nama_role == "Kantor Cabang Pembantu" ? $request->kantor_cabang : null,
                    'is_kck' => $request->nama_role == "Kantor Cabang Khusus" ? true : false
                ]
            );
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
        return view('pages.admin.user.show', compact('data'));
    }

    public function edit($id)
    {
        $role = \Auth::user()->getRoleNames()->first();
        $data['data']  = User::findOrFail($id);
        if ($role == "admin bri") {
            $roles = Role::whereIn('name', ['Kantor Pusat', 'Kantor Wilayah', 'Kantor Cabang', 'Kantor Cabang Pembantu', 'Kantor Cabang Khusus'])->latest()->get();
        }elseif ($role == "admin cri" || $role == "operasional") {
            $roles = Role::whereIn('name', ['operasional', 'operasional verifikator', 'sales developer', 'sales lepas'])->latest()->get();
        }elseif ($role == "superadmin") {
            $roles = Role::latest()->get();
        }
        $data['roles'] = $roles;
        return view('pages.admin.user.edit')->with($data);
    }

    public function update(Request $request, $userId)
    {
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
            $request['password']    = $request->password ? bcrypt($request->password) : bcrypt($selUser->password);
            $request['is_approved'] = $request->status;

            $user = User::updateOrCreate(
                ['id' => $userId],
                $request->only(['name', 'username', 'email', 'is_approved', 'status', 'no_hp', 'password'])
            );
            $user->assignRole($request->nama_role);            

            if ($request->nama_role == "sales lepas" || $request->nama_role == "sales developer") {
                $file_ktp = $selUser->files->ktp;
                $p_ktp    = $selUser->files->path_ktp;
                if ($request->hasFile('ktp')) {
                    $p_ktp    = 'users/ktp'; 
                    $file_ktp = \Helper::storeFile($p_ktp, $request->file('ktp'));
                }

                $file_kartunama = $selUser->files->kartu_nama;
                $p_kartunama    = $selUser->files->path_kartu_nama;
                if ($request->hasFile('kartu_nama')) {
                    $p_kartunama    = 'users/kartu_nama';
                    $file_kartunama = \Helper::storeFile($p_kartunama, $request->file('kartu_nama'));
                }

                UserFile::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'ktp'             => $file_ktp,
                        'path_ktp'        => $p_ktp,                    
                        'kartu_nama'      => $file_kartunama,
                        'path_kartu_nama' => $p_kartunama
                    ]);
            }else{
                UserBri::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'user_id' => $user->id,
                        'is_kantor_pusat' => $request->nama_role == "Kantor Pusat" ? 1 : 0,
                        'kanwil_id' => $request->nama_role == "Kantor Wilayah" || $request->nama_role == "Kantor Cabang" ? $request->kantor_wilayah : null,
                        'kanca_kode' => $request->nama_role == "Kantor Cabang" ? $request->kantor_cabang : null,
                        'kcp_kode' => $request->nama_role == "Kantor Cabang Pembantu" ? $request->kantor_cabang : null,
                        'is_kck' => $request->nama_role == "Kantor Cabang Khusus" ? true : false
                    ]
                );
            }


            DB::commit();

            return response()->json([
                'status'       => "ok",
                'messages'     => "Berhasil mengubah data user",
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
    
    public function destroy($id)
    {
        //
    }
    
    public function custDelete($id){
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            if ($user->files()->exists()) {
                $user->files()->delete();
            }
            if ($user->userBri()->exists()) {
                $user->userBri()->delete();
            }
            $user->delete();

            DB::commit();

            return response()->json([
                'data' => $id,
                'status'    => "ok",
                'messages'  => "Berhasil menghapus data user"
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status'    => "fail",
                'messages'  => "Ada kesalahan dalam menghapus data",
            ],422);
        }
    }

    public function getDatatble(Request $request){
        if ($request->ajax()) {
            $role = \Auth::user()->getRoleNames()->first();
            if ($role == "admin bri") {
                $data = User::role(['Kantor Pusat', 'Kantor Wilayah', 'Kantor Cabang', 'Kantor Cabang Pembantu', 'Kantor Cabang Khusus'])->latest();
            }elseif ($role == "admin cri" || $role == "operasional") {
                $data = User::role(['operasional', 'operasional verifikator', 'sales developer', 'sales lepas'])->latest();
            }elseif ($role == "superadmin") {
                $data = User::latest();
            }
            return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                if ($row->is_approved == 1) {
                    return '<span class="btn-success btn-sm">Lolos Verifikasi</span>';
                }else if($row->is_approved == 0){
                    return '<span class="btn-warning btn-sm">Belum diverifikasi</span>';
                }else{
                    return '<span class="btn-danger btn-sm">Ditolak Verifikasi</span>';
                }
            })
            ->addColumn('roles', function($row){
                return $row->roles->pluck('name')[0];
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('admin.user.show', $row->id).'" class="edit btn btn-info btn-sm">Detail</a>';
                $actionBtn .= '<a href="'.route('admin.user.edit', $row->id).'" class="edit btn btn-warning ml-1 btn-sm">Edit</a>';
                $actionBtn .= '<a href="'.route('admin.user.cust_delete', $row->id).'" class="edit btn btn-danger btn-sm" id="btnHapusCollection">Hapus</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status', 'roles'])
            ->make(true);
        }
    }
}
