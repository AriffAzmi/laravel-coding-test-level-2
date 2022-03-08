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
}