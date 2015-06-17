<?php

namespace App\Src\Purchase;

use App\Core\AbstractModel;
use Illuminate\Database\Eloquent\Model;

class Purchase extends AbstractModel
{
    protected $table = 'purchases';
    protected  $fillable = ['book_id','user_id','stage'];

    public function book() {
        return $this->belongsTo('App\Src\Book\Book');
    }
}
