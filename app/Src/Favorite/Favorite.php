<?php

namespace App\Src\Favorite;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Favorite extends Model
{
    //
    protected $table = "book_user";

    protected $fillable = ['book_id', 'user_id'];

    public $timestamps = false;

}
