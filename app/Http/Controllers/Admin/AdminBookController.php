<?php namespace App\Http\Controllers\Admin;


use App\Events\BookPublished;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\CreateBookCover;
use App\Src\Book\BookMeta;
use App\Src\Category\CategoryRepository;
use App\Src\Book\BookRepository;
use App\Http\Requests\CreateBook;
use App\Src\Book\BookHelpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Class AdminBookController
 * @package App\Http\Controllers\Admin
 */
class AdminBookController extends Controller
{

    public $categoryRepository;
    public $bookRepository;
    public $bookMeta;

    use BookHelpers;

    /**
     * @param BookRepository $book
     * @param CategoryRepository $category
     */
    public function __construct(BookRepository $book,CategoryRepository $category, BookMeta $bookMeta)
    {
        $this->bookRepository = $book;

        $this->categoryRepository = $category;

        $this->bookMeta = $bookMeta;

        $this->middleware('App\Http\Middleware\BeforeAdminZone:Admin');
        /*
         * Middleware CreateBook only for Admin and Editor
         * $this->middleware('before.create.book:Admin,Editor',['only'=>'create','store']);
         * */
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $books = $this->bookRepository->model->paginate(15);

        return view('admin.modules.book.index',['books' => $books]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $categories = $this->categoryRepository->model->all();

        $getLang = App()->getLocale();

        $categories = $categories->lists('name'.'_'.$getLang,'id');

        return view('admin.modules.book.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *  CreateBook Request Checks for the Rules of Create Book Form
     * @return Response
     */
    public function store(CreateBook $request)
    {
        /*
        - Job will handle the Storing the Book in the DB + Firing an event for PDF creation
        */

        $request->merge(['url' => $this->generateFileName(),'user_id'=> Auth::id()]);

        // create a book meta
        // create a book
        // create a pdf
        // create images
        // pass the book and images to update the book with cover url

        // create a book record
        $book = $this->bookRepository->model->create($request->except('_token','price','cover_ar','cover_en'));

        // check if the
        $price = ($request->input('price') > 0) ? $request->input('price') : '00.0';


        // create a pdf
        event(new BookPublished($book));

        // create images wit a job


        // create meta for a book
        $this->bookMeta->create([
            'book_id' => $book->id,
            'total_pages' => Session::get('total_pages'),
            'price' => $price,
        ]);

        $this->dispatch(new CreateBookCover($book, $request));

        if($book) {

            Session::forget('total_pages');

            return redirect()->back()->with(['success' => trans('word.book-created')]);
        }
        return redirect()->back()->with(['error' => trans('word.book-not-created')]);
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
