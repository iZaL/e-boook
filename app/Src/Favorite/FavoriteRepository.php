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


class FavoriteRepository extends AbstractRepository
{

    public $bookRepository;

    public function __construct(Favorite $favorite, BookRepository $bookRepository)
    {
        $this->model = $favorite;
        $this->bookRepository = $bookRepository;
    }

    /**
     * @return most favorite books from all users
     */
    public function getMostFavorited()
    {
        $favorites = $this->model->mostFavorited();

        $favoritesArray = $favorites->lists('book_id');

        if ($favoritesArray) {
            return $this->bookRepository->model
                ->with('meta')
                ->whereIn('id', $favoritesArray)
                ->get();
        }
    }

}