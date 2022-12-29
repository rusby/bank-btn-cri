<?php

namespace App\Http\Controllers\Auth;

use Auth, Session, View;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Vendors;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return View::make('auth.login');
    }

    public function login(Request $request){
        $data = $request->all();

        $validator = Validator::make($data, array(
            'email' => "required",
            'password' => "required"
        ));

        if ($validator->fails()) {
            return response()->json([
                'status'    => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($fieldType, $data['email'])->first();

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

        if (auth()->attempt(array($fieldType => $data['email'], 'password' => $data['password']))){
            return response()->json([
                'status'    => "ok",
                'messages' => "Sukses login",
            ], 200);
        }else{
            return response()->json([
                'status'    => "fail",
                'messages' => "Email dan password tidak cocok",
            ], 422);
        }               
    }
    
    
    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect('auth/login');
    }

    public function resendEmail(Request $request) {
        $data = $request->all();

        $validator = Validator::make($data, array(
            'email' => "required|email"
        ));

        if ($validator->fails()) {
            return response()->json([
                'status'    => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }

        $user = User::where('email', $data['email'])->first();

        if($user->hasVerifiedEmail()){
            return response()->json([
                'status'    => "ok",
                'messages' => "Email anda sudah terverifikasi sebelumnya",
            ], 200);
        }else{
            $user->sendEmailVerificationNotification();
            return response()->json([
                'status'    => "ok",
                'messages' => "Silahkan check kembali email anda.",
            ], 200);
        }
    }
}
