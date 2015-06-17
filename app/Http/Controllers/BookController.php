<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Jobs\CreatePreviewBook;
use App\Src\Book\BookHelpers;
use App\Src\Book\BookRepository;
use App\Src\Favorite\FavoriteRepository;
use App\Src\Purchase\Purchase;
use App\Src\Purchase\PurchaseRepository;
use App\Src\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class BookController extends Controller
{


    public $bookRepository;
    public $favoriteRepository;
    public $userRepository;
    public $purchaseRepository;
    public $authUser;

    public function __construct(BookRepository $book,FavoriteRepository $favoriteRepository, UserRepository $userRepository, PurchaseRepository $purchaseRepository)
    {
        $this->bookRepository = $book;
        $this->favoriteRepository = $favoriteRepository;
        $this->userRepository = $userRepository;
        $this->purchaseRepository = $purchaseRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($all = '4')
    {
        // get 4 published books for index
        $books = $this->bookRepository->model->where('status','=','published')->with('meta')->orderBy('created_at','desc')->paginate($all);
        // get 4 published and most favorite books for index
        $mostFavoriteBooks = $this->favoriteRepository->getMostFavorited();

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
        $book = $this->bookRepository->model->where(['id'=>$id,'status'=>'published'])->first();

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


    public function getCreateNewFavoriteList($userId,$bookId) {

        $checkFavorite = $this->favoriteRepository->model->where(['book_id'=> $bookId,'user_id'=>$userId])->get();

        if(count($checkFavorite) <= 0) {

            $favorited = $this->favoriteRepository->model->create([
                'book_id' => $bookId,
                'user_id' => $userId
            ]);

            if ($favorited) {
                return redirect()->back()->with(['success' => trans('word.success-book-favorites')]);
            }

        }

        return redirect()->back()->with(['error' => trans('word.error-book-favorites')]);
    }

    /**
     * @param $userId
     * @param $bookId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getRemoveBookFromUserFavoriteList($userId,$bookId) {

        $this->favoriteRepository->model->where(['book_id'=> $bookId,'user_id'=>$userId])->delete();

        return redirect()->back();
    }

    /**
     * @param $userId
     * @param $bookId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getRemoveBookFromUserOrderList($userId,$bookId) {

        $this->purchaseRepository->model->where(['book_id'=> $bookId,'user_id'=>$userId,'stage'=>'order'])->delete();

        return redirect()->back()->with(['success'=>trans('word.order-removed')]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getAllBooks() {
        $books = $this->bookRepository->model->where('status','=','published')->with('meta')->orderBy('created_at','desc')->paginate(10);
        $render = true;
        return view('modules.book.index',compact('books','render'));
    }

    /**
     * @param Request $request
     * @return search function responsible to search all books title , descriptions and even content of each book
     */
    public function getShowSearchResults(Request $request) {

        $searchItem = $request->input('search');

        $searchResults = $this->bookRepository->SearchBooks($searchItem);

        if(count($searchResults) > 0) {

            return view('modules.book.index', ['books' => $searchResults]);

        }

        else {

            return redirect()->back()->with(['error' => trans('word.no-results')]);

        }
    }

    /**
     * @param $bookUrl
     * @return full link of the free book
     */
    public function getFreePdfFile($bookUrl) {

        if($book = $this->bookRepository->model->where('url','=',$bookUrl)->first()) {

            // every request on preview .. View will be increased
            $this->bookRepository->increaseBookViewById($book->id);

            $link = storage_path('app/pdfs/').$bookUrl;

            return Response::make(file_get_contents($link), 200, [

                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; '.$bookUrl,

            ]);
        }

        return redirect()->back()->with(['error'=>trans('word.no-file')]);
    }



    /**
     * @param $bookUrl
     * @return creating on the fly a link with 10 pages of a pdf file of a book
     */
    public function getCreateNewPreview($bookUrl) {

        // every request on preview .. View will be increased
        $this->bookRepository->increaseBookViewByUrl($bookUrl);

        return $this->dispatch(new CreatePreviewBook($bookUrl));

    }

    /**
     * @param Create New Order
     */
    public function getCreateNewOrder($bookId,$authId) {

        if($this->purchaseRepository->model->where('book_id','=',$bookId)->where('user_id','=',$authId)->first()) {
            return redirect()->back()->with(['error'=>trans('word.error-order-repeated')]);
        }
        else {
            if($this->purchaseRepository->model->create([
                'book_id' => $bookId,
                'user_id' => $authId,
                'stage' => 'order'
            ])) {
                return redirect()->back()->with(['success'=>trans('word.success-order-created')]);
            }
            else {
                return redirect()->back()->with(['error'=>trans('word.error-order-created')]);
            }
        }
        return redirect()->back()->with(['error'=>trans('word.error-order-created')]);
    }

}
