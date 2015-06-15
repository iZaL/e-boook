<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Src\Book\BookHelpers;
use App\Src\Book\BookRepository;
use App\Src\Favorite\FavoriteRepository;
use App\Src\User\UserRepository;
use Illuminate\Http\Request;

class BookController extends Controller
{


    public $bookRepository;
    public $favoriteRepository;
    public $userRepository;
    public function __construct(BookRepository $book,FavoriteRepository $favoriteRepository, UserRepository $userRepository)
    {
        $this->bookRepository = $book;
        $this->favoriteRepository = $favoriteRepository;
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($all = '4')
    {
        $books = $this->bookRepository->model->with('meta')->orderBy('created_at','desc')->paginate($all);


        $mostFavoriteBooks = $this->favoriteRepository->getMostFavorited();

        //$mostFavoriteBooks = $this->userRepository->getFavorites();


        //$mostFavorites = $this->favoriteRepository->MostFavorites();

        return view('modules.book.index',compact('books','mostFavoriteBooks','bookMeta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //

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
        // get all books by book ID
        $book = $this->bookRepository->getById($id);

        // get the author of the book
        $author = $book->user()->first();

        // book info
        $bookMeta = $book->meta()->first();


        return view('modules.book.show',['book'=> $book,'author'=> $author,'bookMeta' => $bookMeta]);
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


    public function addFavorite($userId,$bookId) {

        $checkFavorite = $this->favoriteRepository->model->where(['book_id'=> $bookId,'user_id'=>$userId])->get();

        if(count($checkFavorite) <= 0) {

            $favorited = $this->favoriteRepository->model->create([
                'book_id' => $bookId,
                'user_id' => $userId
            ]);

            if ($favorited) {
                return redirect()->back()->with(['success' => trans('word.book-added-to-favorites')]);
            }

        }

        return redirect()->back()->with(['error' => trans('word.book-not-added-to-favorites')]);
    }

    public function removeBookFromUserFavoriteList($userId,$bookId) {

        $this->favoriteRepository->model->where(['book_id'=> $bookId,'user_id'=>$userId])->delete();

        return redirect()->back();
    }


    public function getAllBooks() {
        $books = $this->bookRepository->model->with('meta')->orderBy('created_at','desc')->paginate(10);
        $render = true;
        return view('modules.book.index',compact('books','render'));
    }

    public function showSearchResults(Request $request) {
        $searchItem = $request->input('search');
        $searchResults = $this->bookRepository->model
            ->orWhere('description_ar','like','%'.$searchItem.'%')
            ->orWhere('description_en','like','%'.$searchItem.'%')
            ->orWhere('title_ar','like','%'.$searchItem.'%')
            ->orWhere('title_en','like','%'.$searchItem.'%')
            ->orWhere('body','like','%'.$searchItem.'%')->with('meta')->get();
        return view('modules.book.index',['books'=> $searchResults]);
    }
}
