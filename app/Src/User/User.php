<?php namespace App\Src\User;

use App\Core\AbstractModel;
use App\Core\LocaleTrait;
use App\Src\User\UserHelpers;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends AbstractModel implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, UserHelpers, LocaleTrait;

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
    protected $fillable = ['name_ar', 'name_en', 'active', 'email', 'mobile', 'bank_name', 'bank_number', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $localeStrings = ['name'];

    /*
     * Relations
     *
     * Many to many relation
     * user has many roles
     * */

    public function roles()
    {
        return $this->belongsToMany('App\Src\Role\Role', 'user_roles');
    }


    /**
     * @return all books for specific author
     * one to many relation
     * a user has many books
     * a book belongs to one user
     * TABLE : books
     */
    public function book()
    {

        return $this->hasMany('App\Src\Book\Book', 'user_id');
    }

    /**
     * Many To Many Relation Users + Books = Favorites
     * a user has many  books
     * a book belongs to Many
     * @return mixed
     * Table : favorites
     */
    public function books()
    {
        return $this->belongsToMany('App\Src\Book\Book', 'book_user');
    }

    /**
     * Many to Many Relation - Orders
     * a user has many books
     * a book belongs to many user
     * Table : Purchases
     */
    public function books_orders()
    {
        return $this->belongsToMany('App\Src\Book\Book', 'purchases');
    }

    public function purchases()
    {
        $this->hasMany('App\Src\Purchase\Purchase');
    }

}
