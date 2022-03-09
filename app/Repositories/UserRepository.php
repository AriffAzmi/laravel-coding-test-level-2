<?php

namespace App\Repositories;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
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

	public function save($data)
	{
		$user = User::create([
      		'name' => $data->name,
           	'email' => $data->email,
           	'password' => Hash::make($data->password),
           	'api_key' => Hash::make($data->email),
       	]);

       	return $user;
	}
}