<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 5/31/15
 * Time: 9:15 PM
 */
namespace App\Core;


class AbstractRepository {

    public $model;

    public function getAll() {
        return $this->model->all();
    }

    public function getById($id) {
        return $this->model->findOrFail($id);
    }
}