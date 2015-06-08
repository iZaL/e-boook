<?php

namespace App\Http\Controllers\Admin;

use App\Src\User\UserRepository;
use App\Http\Controllers\Controller;


class AdminUserController extends Controller
{



    public $userRepository;


    public function __construct(UserRepository $user)
    {
        $this->userRepository = $user;
    }

    /*
     * return all users
     * */

    public function index() {
        return $allUsers = $this->userRepository->getAll();
        return view('admin.modules.user.index',['allUsers' => $allUsers]);
    }
/*
    public function getRole($id) {
        return $this->userRepository->model->getUserRole
    }*/
}
