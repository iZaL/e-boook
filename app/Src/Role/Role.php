<?php namespace App\Src\Role;



use App\Core\AbstractModel;

class Role extends AbstractModel
{
    //

    /*
     * Relations
     *
     * Many to many relation
     * role has many users
     * */
    public function users() {
        return $this->belongsToMany('App\Src\User\User','user_roles');
    }
}
