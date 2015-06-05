<?php namespace App\Src\User;

use App\Core\AbstractModel;
use App\Src\User\UserHelpers;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends AbstractModel implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, UserHelpers;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    /*
     * Relations
     *
     * Many to many relation
     * user has many roles
     * */

    public function roles () {
        return $this->belongsToMany('App\Src\Role\Role','user_roles');
    }

    /**
     * One To Many Relation
     * a user has many  books
     * a book belongs to one user
     * @return mixed
     */
    public function books() {
        return $this->hasMany('App\Src\Book\Book');
    }
}
