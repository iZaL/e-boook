<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 5/31/15
 * Time: 9:14 PM
 */
namespace App\Core\Book;

use App\Book;
use App\Core\AbstractRepository;

class BookRepository extends AbstractRepository {

    public function __construct(Book $book) {
        $this->model = $book;
    }
}