<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Src\Book\BookRepository;
use App\Src\Favorite\FavoriteRepository;
use App\Src\User\User;
use App\Src\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userRepository;
    public $bookRepository;
    public $favoriteRepository;


    public function __construct(UserRepository $userRepository, BookRepository $bookRepository, FavoriteRepository $favoriteRepository) {
        $this->userRepository = $userRepository;
        $this->bookRepository = $bookRepository;
        $this->favoriteRepository = $favoriteRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the Profile of a user
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //

        $Allbooks = $this->userRepository->getAllBooksForUser($id);

        $draftBooks = $this->userRepository->getStatusBooks($id,'draft');

        $publishedBooks = $this->userRepository->getStatusBooks($id,'published');

        // the problem is here .. Stopped here for favorite tab ?? we are unable to make favorite relation
        $favoriteBooks = $this->userRepository->getFavoritedBooksForUser($id);


        return view('modules.user.profile',['books'=>$Allbooks,'draftBooks'=>$draftBooks,'publishedBooks'=>$publishedBooks,'favoriteBooks'=>$favoriteBooks]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        return view('auth.edit',['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
