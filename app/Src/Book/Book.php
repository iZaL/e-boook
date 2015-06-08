<?php namespace App\Src\Book;

use App\Core\AbstractModel;
use App\Core\LocaleTrait;

class Book extends AbstractModel
{
    //
    use LocaleTrait;

    protected $guarded = ['id'];


    protected $localeStrings = ['title','cover','description'];


    /**
     * one to Many Relation
     * a user has many books
     * a book belongs to one user
     * get the author of the book
     * Table : Book
     */
    public function user() {
        return $this->belongsTo('App\Src\User\User','user_id');
    }
    /**
     * Many To Many Relation - Favorite Relation
     * a user has many  books
     * a book belongs to many users
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Table : book_user : Favorite Relation
     */
    public function users () {
        return $this->belongsToMany('App\Src\User\User','book_user');
    }

    public function meta() {
        return $this->hasOne('App\Src\Book\BookMeta');
    }

}
