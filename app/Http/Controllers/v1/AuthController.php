<?php

namespace App\Http\Controllers\v1;

use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;

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
		try {
			
			$validation = Validator::make($request->all(),[
				'name' => 'required|string|max:255',
		   		'email' => 'required|string|email|max:255|unique:users',
		   		'password' => 'required|string|min:8',
			]);

			if ($validation->fails()) {
				
				$response = collect(config('api-response.500'));
				$response->put('message','Validation errors.');
				$response->put('errors',$validation->errors());

				return response()->json($response->all());
			}
			
			$user = $this->userRepository->save($request);

			$response = collect(config('api-response.200'));
            $response->put('message','User successfully created.');
            $response->put('user',$user);

            Auth::attempt($request->only(['email','password']));
            
            return response()->json($response->all());

		} catch (\Exception $e) {
			
			$response = collect(config('api-response.500'));
			$response->put('message',$e->getMessage());
			$response->put('errors',$e);

			// die($e->getMessage());
			return response()->json($response->all());
		}

	}

	public function me(Request $request)
	{
		$user = Auth::user();

		$response = collect(config('api-response.200'));
        $response->put('message','User info successfully retrieved.');
        $response->put('user',$user);

        return response()->json($response->all());
	}
}
