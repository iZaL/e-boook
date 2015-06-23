<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 5/31/15
 * Time: 9:18 PM
 */

namespace App\Src\User;

use App\Core\AbstractRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserRepository extends AbstractRepository
{


    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * One To Many Relation
     * a user has many  books
     * a book belongs to one user
     * @return mixed
     */
    public function getFavoritedBooks($id)
    {
        /**
         * Many To Many Relation = Favorite Relationship
         * a user has many  books
         * a book belongs to Many users
         */

        /*
         * 1- a has Many relation has been made inside the 2 models
         * 2-  inside the Repository
         *     ex. a user has many books - a book belongs to one user
         *     2.1 - you have to create a new method over the Eloquent relation inside the repository
         *     2.2 the query within the method  as the following :
         *        - theModelInstance -> findOrNew -> book Method relation -> get()
         *        - inside the controller you can fetch all this as the following
         *          - $books = $this->userRepository->getBooks($id);
         *
         * */
        return $this->model->books()->paginate(10);
    }

    /**
     * @return all books related to one user - for profile of each user
     */
    public function getAllBooksForUser($id)
    {
        return $this->model->findOrNew($id)->book()->with('meta')->paginate(10);
    }

    /**
     * @param $id
     * @param $status
     * @return all books that has type book or poem / admin control panel
     */
    public function getStatusBooks($id, $status)
    {
        return $this->model->firstOrNew(['id' => $id])->book()->where('books.status', '=', $status)->paginate(10);
    }

    /**
     * @param $id
     * @return return all books that has been favorited by a user / profile
     */
    public function getFavoritedBooksForUser($id)
    {
        return $this->model->findOrNew($id)->books()->with('meta')->paginate(10);
    }

    public function getActiveStatusForUser($id)
    {
        return $this->model->findOrNew($id)->first();
    }

    public function getAllOrdersByUser($id)
    {
        return $this->model->findOrNew($id)->books_orders()->where('stage', '=', 'order')->with('meta')->paginate(10);
    }


    public function getAllUsersWithoutAdmins($authId)
    {
        return $this->model
            ->selectRaw('users.*')
            ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
            ->where('users.id', '!=', $authId)
            ->where('user_roles.role_id', '!=', 1)->get();
    }


    public function CreateNewCustomizedPreview($request)
    {
        // if there is no such preview
        if (DB::table('book_previews')->select('*')->where([
            'book_id' => $request['book_id'],
            'user_id' => $request['user_id'],
            'author_id' => $request['author_id'],
        ])
        ) {
            // create new preview
            return DB::table('book_previews')->insert([
                'book_id' => $request['book_id'],
                'user_id' => $request['user_id'],
                'author_id' => $request['author_id'],
                'preview_start' => $request['preview_start'],
                'preview_end' => $request['preview_end'],
                'total_pages' => $request['total_pages']
            ]);
        }
        return false;
    }


}