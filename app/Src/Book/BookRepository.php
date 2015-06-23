<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 5/31/15
 * Time: 9:14 PM
 */
namespace App\Src\Book;


use App\Core\AbstractRepository;


class BookRepository extends AbstractRepository
{

    public function __construct(Book $book)
    {
        $this->model = $book;
    }

    /**
     * One To Many Relation
     * a user has many  books
     * a book belongs to one user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUser()
    {
        return $this->model->user();
    }

    /**
     * @return mixed
     * return All books that has a Draft Status
     */
    public function draftedBooks($id = '')
    {
        return $this->model->where(['status' => 'draft', 'user_id' => $id]);
    }

    /**
     * @return mixed
     * return All books that has a Published Status
     */
    public function publishedBooks()
    {
        return $this->model->where('status', 'published');
    }

    public function increaseBookViewById($bookId)
    {

        $this->model->where('id', '=', $bookId)->increment('views');

    }

    public function increaseBookViewByUrl($bookUrl)
    {

        $this->model->where('url', '=', $bookUrl)->increment('views');

    }

    public function SearchBooks($searchItem)
    {
        return $this->model
            // no results for drafts -- only for published
            ->having('status', '=', 'published')
            ->orWhere('description_ar', 'like', '%' . $searchItem . '%')
            ->orWhere('description_en', 'like', '%' . $searchItem . '%')
            ->orWhere('title_ar', 'like', '%' . $searchItem . '%')
            ->orWhere('title_en', 'like', '%' . $searchItem . '%')
            ->orWhere('body', 'like', '%' . $searchItem . '%')
            ->with('meta')->get();
    }

    /**
     * Admin Zone
     * @return return all books that has been ordered
     */
    public function getAllBookOrders()
    {
        return $this->model->users_orders()->with('meta')->get();
    }

    /**
     *
     * @param int $paginate
     * @return most favorite books from all users
     */
    public function getMostFavorited($paginate = 4)
    {
        $favorites = $this->model->mostFavorites($paginate);
        return $favorites;
    }

    public function getCustomizedPreviews($userId,$paginate='10') {

        return $this->model->customizedPreviews($userId,$paginate);

    }


}