<?php

namespace App\Repositories;

use App\Models\Project;
/**
 * 
 */
class ProjectRepository extends Repository
{
	/**
	 *	@var App\Models\Task 
	 */
	protected $model;

	function __construct()
	{
		$this->model = new Project();
	}
}