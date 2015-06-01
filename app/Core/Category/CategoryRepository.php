<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 5/31/15
 * Time: 9:18 PM
 */
namespace App\Core\Category;


use App\Category;
use App\Core\AbstractRepository;

class CategoryRepository extends AbstractRepository {

    public function __construct(Category $category) {
        $this->model = $category;
    }
}