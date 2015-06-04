<?php

namespace App\Http\Controllers\Admin;

use App\Src\User\UserRepository;
use App\Http\Controllers\Controller;


class AdminUserController extends Controller
{


    public $user;


    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /*
     * return all users
     * */

    public function index() {
        return $allUsers = $this->user->getAll();
        return view('admin.modules.user.index',['allUsers' => $allUsers]);
    }

    public function getRole($id) {
        return $this->user->getRole($id);
    }
}
