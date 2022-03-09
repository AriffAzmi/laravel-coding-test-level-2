<?php

namespace App\Services;

use App\Models\User;
use Auth;
/**
 * 
 */
class AuthService
{
	public function login($request,$token_name) : array
	{
		if (!Auth::attempt($request->only('email', 'password'))) {
			return response()->json([
				'message' => 'Invalid login details'
           	], 401);
       	}

		$user = User::where('email', $request['email'])->firstOrFail();

		$token = $user->createToken($token_name)->plainTextToken;

		return [
			'access_token' => $token,
           	'token_type' => 'Bearer',
		];
	}

	public function logout($request)
	{
		return $request->user()->currentAccessToken()->delete();
	}

	public static function createToken($user,$token_name)
	{
		return $user->createToken($token_name)->plainTextToken
	}
}