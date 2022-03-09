<?php

namespace App\Repositories;

use App\Models\User;
use App\Services\AuthService;

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
       	]);

		$token = AuthService::createToken($user,'auth_token');
		
       	return $token;
	}

	public function findByID($id)
	{
		return User::findOrFail($id);
	}

	public function put($id,$data)
	{
		$user = $this->findByID($id);
		return $user->update($data);
	}

	public function patch($id,$data)
	{
		$user = $this->findByID($id);
		return $user->update($data);
	}

	public function delete($id)
	{
		return User::delete($id);
	}
}