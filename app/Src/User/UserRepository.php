<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 5/31/15
 * Time: 9:18 PM
 */

namespace App\Src\User;

use App\Core\AbstractRepository;


class UserRepository extends AbstractRepository {


    public function __construct(User $user) {
        $this->model = $user;
    }



}