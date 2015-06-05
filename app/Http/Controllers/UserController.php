<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Src\Book\BookRepository;
use App\Src\User\User;
use App\Src\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userRepository;
    public $bookRepository;


    public function __construct(UserRepository $userRepository, BookRepository $bookRepository) {
        $this->userRepository = $userRepository;
        $this->bookRepository = $bookRepository;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        //$user = $this->userRepository->getById($id);
        $books = $this->userRepository->getBooks($id);
        $bookDrafted = $this->bookRepository->draftedBooks($id);



        return view('modules.user.profile',['books'=>$books]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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
