<?php

namespace App\Traits;

use Carbon\Carbon;

trait ApiResponser {

	protected function token($personalAccessToken, $message = null, $code = 200, $user = null)
	{
		$tokenData = [
			'access_token' => $personalAccessToken->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($personalAccessToken->token->expires_at)->toDateTimeString()
		];

		return $this->success($tokenData, $message, $code, $user, true);
	}
	
    protected function success($data, $message = null, $code = 200, $user = null, $isLogin = false)
	{   
        $response = [
            'status'=> 'ok', 
            'message' => $message, 
            'data' => $data,
        ];

        if($isLogin) {
            $response['user'] = $user;
            $response['roles'] = isset($user) && isset($user->roles) ?  $user->roles->pluck('name') : "";
        }

		return response()->json($response, $code);
	}

	protected function error($message = null, $code)
	{
		return response()->json([
			'status'=>'fail',
			'message' => $message,
			'data' => null
		], $code);
	}

}