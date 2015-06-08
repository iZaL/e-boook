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
use App\Src\Favorite\Favorite;
use Illuminate\Support\Facades\DB;

class FavoriteRepository extends AbstractRepository{

    public $bookRepository;
    public function __construct(Favorite $favorite, BookRepository $bookRepository) {

        $this->model = $favorite;
        $this->bookRepository = $bookRepository;
    }


    /**
     * @return most favorite books from all users
     */
    public function getMostFavorited() {
        dd($this->model->MostFavorited());
        return ($this->generateGetMostFavorited($this->model->MostFavorited()));
    }

    public function generateGetMostFavorited($mostFavorites) {
        $mostFavoriteArray = [];
        for($i=0;$i <=4 ;$i++) {
            $mostFavoriteArray = array_add($mostFavoriteArray,$i,$this->bookRepository->model->where('id','=',$mostFavorites[$i]->book_id)->first());
        }
        return $mostFavoriteArray;
    }

    /*public function getFavoritesByUser() {
        return $this->model->books()->get();
    }*/



}