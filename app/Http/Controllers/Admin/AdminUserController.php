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

        $users = $this->userRepository->model->with('roles')->where('id','!=','1')->paginate(10);

        return view('admin.modules.user.index',['users' => $users]);
    }

}
