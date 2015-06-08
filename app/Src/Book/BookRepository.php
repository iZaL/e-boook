<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 5/31/15
 * Time: 9:14 PM
 */
namespace App\Src\Book;


use App\Core\AbstractRepository;


class BookRepository extends AbstractRepository {

    public function __construct(Book $book) {
        $this->model = $book;
    }

    /**
     * One To Many Relation
     * a user has many  books
     * a book belongs to one user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUser () {
        return $this->model->user();
    }

    /**
     * @return mixed
     * return All books that has a Draft Status
     */
    public function draftedBooks($id = '')
    {
        return $this->model->where(['status' => 'draft','user_id'=> $id]);
    }
    /**
     * @return mixed
     * return All books that has a Published Status
     */
    public function publishedBooks()
    {
        return $this->model->where('status', 'published');
    }

}