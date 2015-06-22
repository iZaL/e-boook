<?php

namespace App\Src\Purchase;

use App\Core\AbstractModel;
use App\Core\LocaleTrait;
use Illuminate\Database\Eloquent\Model;

class Purchase extends AbstractModel
{
    protected $table = 'purchases';
    protected  $fillable = ['book_id','user_id','stage'];

    use LocaleTrait;

    protected $localeStrings = ['title','name','body','cover'];

    public function book() {
        return $this->belongsTo('App\Src\Book\Book');
    }

    public function user() {
        return $this->belongsTo('App\Src\User\User');
    }

}
