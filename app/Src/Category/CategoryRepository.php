<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 5/31/15
 * Time: 9:18 PM
 */
namespace App\Src\Category;


use App\Core\AbstractRepository;
use App\Src\Book\BookRepository;

class CategoryRepository extends AbstractRepository
{

    public $category;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }


}