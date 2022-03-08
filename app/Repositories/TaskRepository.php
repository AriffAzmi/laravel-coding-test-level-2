<?php

namespace App\Repositories;

use App\Models\Task;
/**
 * 
 */
class TaskRepository extends Repository
{
	/**
	 *	@var App\Models\Task 
	 */
	protected $model;

	function __construct()
	{
		$this->model = new Task();
	}
}