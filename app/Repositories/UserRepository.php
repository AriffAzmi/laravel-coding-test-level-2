<?php

namespace App\Repositories;

use App\Models\User;
/**
 * 
 */
class UserRepository extends Repository
{
	/**
	 *	@var App\Models\Task 
	 */
	protected $model;

	function __construct()
	{
		$this->model = new User();
	}

	public function save($data) : string
	{
		$user = User::create([
      		'name' => $data['name'],
           	'email' => $data['email'],
           	'password' => Hash::make($data['password']),
       	]);

       	$token = $user->createToken('auth_token')->plainTextToken;

       	return $token;
	}
}