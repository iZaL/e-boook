<?php namespace App\Src\Category;

use App\Core\AbstractModel;
use App\Core\LocaleTrait;

class Category extends AbstractModel
{
    //
    use LocaleTrait;

    protected $localeStrings = ['name'];

}
