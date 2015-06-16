<?php

namespace App\Src\Favorite;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Favorite extends Model
{
    //
    protected $table = "book_user";

    protected $fillable = ['book_id','user_id'];

    public $timestamps = false;


    /**
     * @return count how many times book_id repeated then get the max 4
     */
    public function MostFavorited() {
        $books = DB::table('book_user')
        ->select('user_id','book_id',DB::raw('count(book_id) as book_count'))
        ->groupBy('book_id')
        ->orderBy('book_id','asc')
        ->get();

        return $books;
    }

}
