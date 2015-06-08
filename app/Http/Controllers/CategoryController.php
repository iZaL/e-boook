<?php namespace App\Http\Controllers;

use App\Src\Book\BookRepository;
use App\Src\Category\CategoryRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public $category;
    public $bookRepository;
    public function __construct(CategoryRepository $category, BookRepository $bookRepository) {
        $this->category = $category;
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
        $categories = $this->category->getAll();
        $books = $this->bookRepository->model->paginate(9);
        return view('modules.category.index',compact('categories','books'));
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
        //
        $categories = $this->category->getAll();
        $books = $this->bookRepository->model->where('category_id','=',$id)->paginate(9);
        return view('modules.category.show',compact('categories','books'));
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
