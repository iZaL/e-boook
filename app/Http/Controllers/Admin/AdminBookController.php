<?php namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Core\Category\CategoryRepository;
use App\Core\Book\BookRepository;
use Illuminate\Support\Facades\Session;

class AdminBookController extends Controller
{

    public $category;
    public $book;

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
