<?php namespace App\Http\Controllers\Admin;


use App\Events\BookPublished;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Src\Category\CategoryRepository;
use App\Src\Book\BookRepository;
use App\Http\Requests\CreateBook;
use App\Src\Book\traitBook;

class AdminBookController extends Controller
{

    public $category;
    public $book;

    use traitBook;

    public function __construct(BookRepository $book,CategoryRepository $category)
    {
        $this->book = $book->model;
        $this->category = $category->model;

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $books = $this->book->paginate(3);
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
        $categories = $this->category->all();
        $getLang = App()->getLocale();
        $categories = $categories->lists('name'.'_'.$getLang,'id');
        return view('admin.modules.book.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *  CreateBook Request Checks for the Rules of Create Book Form
     * @return Response
     */
    public function store(CreateBook $request)
    {
        // Job will handle the Storing the Book in the DB + Firing an event for PDF creation
        $request->merge(['url' => $this->generateFileName()]);

        $book = $this->book->create($request->except('_token'));


        event(new BookPublished($book));

        //$book = $this->dispatch(new BookPublished($request));
        if($book) {
            // redirecting user with sucess
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
