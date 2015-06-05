<?php namespace App\Src\Book;

use App\Core\AbstractModel;
use App\Core\LocaleTrait;

class Book extends AbstractModel
{
    //
    use LocaleTrait;

    protected $guarded = ['id'];


    protected $localeStrings = ['title'];

    /**
     * One To Many Relation
     * a user has many  books
     * a book belongs to one user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user () {
        return $this->belongsTo('App\Src\User\User');
    }

}
