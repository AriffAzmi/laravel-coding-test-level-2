<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	protected $userRepository;

	public function FunctionName($value='')
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

			$response = collect(config('api-response.200'));
            $response->put('message','User successfully created.');
            $response->put('access_token',$token);
            $response->put('token_type','Bearer');
			
		} catch (\Exception $e) {
			
			$response = collect(config('api-response.500'));
			$response->put('message','User failed to create.');	
		}

		return response()->json($response->all());
	}
}
