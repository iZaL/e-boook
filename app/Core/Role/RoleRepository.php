<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 5/31/15
 * Time: 9:18 PM
 */

namespace App\Core\Role;

use App\Role;
use App\Core\AbstractRepository;

class RoleRepository extends AbstractRepository {

    public function __construct(Role $role) {
        $this->model = $role;
    }
}