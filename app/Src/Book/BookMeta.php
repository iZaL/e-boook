<?php

namespace App\Src\Book;

use Illuminate\Database\Eloquent\Model;

class BookMeta extends Model
{
    //
    protected $table = 'book_metas';
    public $fillable = ['book_id', 'total_pages', 'price'];

}
