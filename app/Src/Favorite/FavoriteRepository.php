<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 6/6/15
 * Time: 10:37 PM
 */

namespace App\Src\Favorite;

use App\Core\AbstractRepository;
use App\Src\Book\BookRepository;


class FavoriteRepository extends AbstractRepository {


    public $bookRepository;

    public function __construct(Favorite $favorite, BookRepository $bookRepository) {

        $this->model = $favorite;
        $this->bookRepository = $bookRepository;
    }

    /**
     * @return most favorite books from all users
     */
    public function getMostFavorited() {
        return ($this->generateGetMostFavorited($this->model->MostFavorited()));
    }

    public function generateGetMostFavorited($mostFavorites) {


        $mostFavoriteArray = $this->bookRepository->model
            ->whereIn('id',[$mostFavorites[0]->book_id,$mostFavorites[1]->book_id,$mostFavorites[2]->book_id,$mostFavorites[3]->book_id])
            ->with('meta')->get();


        return $mostFavoriteArray;


    }


}