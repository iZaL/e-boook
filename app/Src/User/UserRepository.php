<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 5/31/15
 * Time: 9:18 PM
 */

namespace App\Src\User;

use App\Core\AbstractRepository;


class UserRepository extends AbstractRepository {


    public function __construct(User $user) {
        $this->model = $user;
    }

    /**
     * One To Many Relation
     * a user has many  books
     * a book belongs to one user
     * @return mixed
     */
    public function getBooks($id) {
        /**
         * One To Many Relation
         * a user has many  books
         * a book belongs to one use
         */

        /*
         * 1- a has Many relation has been made inside the 2 models
         * 2-  inside the Repository
         *     ex. a user has many books - a book belongs to one user
         *     2.1 - you have to create a new method oveer the Eloquant relation inside the repository
         *     2.2 the query within the method  as the following :
         *        - theModelInstance -> findOrNew -> book Method relation -> get()
         *        - inside the controller you can fetch all this as the following
         *          - $books = $this->userRepository->getBooks($id);
         *
         * */
        return $this->model->firstOrNew(['id'=>$id])->books()->paginate(3);
    }



}