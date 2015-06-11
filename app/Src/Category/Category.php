<?php namespace App\Src\Category;

use App\Core\AbstractModel;
use App\Core\LocaleTrait;

class Category extends AbstractModel
{
    //

    public $table = 'categories';

    protected $fillable = ['name_ar','name_en'];

    protected $localeStrings = ['name'];

    use LocaleTrait;

}
