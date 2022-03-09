<?php

namespace App\Http\Controllers\v1;

use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Services\AuthService;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
	protected $userRepository;

	public function __construct()
	{
		$this->userRepository = new UserRepository();
	}

    public function register(Request $request)
	{
		$validatedData = $request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:8',
		]);

		try {
			
			$token = $this->userRepository->save($validatedData);
            
            return response()->json([
            	'status' => true,
            	'message' => 'User successfully created.',
            	'access_token' => $token,
            	'token_type' => 'Bearer'
            ]);

		} catch (\Exception $e) {
			
			return response()->json([
				'status' => false,
				'message' => $e->getMessage()
			],$e->getCode());
		}
	}

	public function login(Request $request)
	{
		$login = AuthService::login($request);

		return response()->json([
			'status' => true,
			'message' => 'Auth successfull.',
			'access_token' => $token,
        	'token_type' => 'Bearer'
		]);
	}

	public function logout(Request $request)
	{
		AuthService::logout($request);

		return response()->json([
			'status' => true,
			'message' => 'User successfully logout.'
		]);
	}

	public function me(Request $request)
	{
        return response()->json([
        	'status' => true,
        	'message' => 'User info successfully retrieved.',
        	'user' => $request->user()
        ]);
	}
}
