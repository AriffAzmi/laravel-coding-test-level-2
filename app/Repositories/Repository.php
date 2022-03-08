<?php

namespace App\Repositories;

class Repository {

    const MODEL = '';

    protected $model;

    public function __call($method, $parameters) {
        return call_user_func_array(array($this->model, $method), $parameters);
    }

    public static function __callStatic($method, $parameters) {
        return call_user_func_array([static::MODEL, $method], $parameters);
    }

    public function query() {
        $model = $this->model;
        return $model::query();
    }

    public function model() {
        return $this->model;
    }

}
