<?php namespace App\Http\Controllers;

use App\Src\Book\BookRepository;
use App\Src\Category\CategoryRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public $categoryRepository;
    public $bookRepository;

    public function __construct(CategoryRepository $categoryRepository, BookRepository $bookRepository)
    {
        $this->categoryRepository = $categoryRepository;
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
        $categories = $this->categoryRepository->getAll();

        $books = $this->bookRepository->model->with('meta')->where('status', '=', 'published')->paginate(5);

        return view('modules.category.index', ['categories' => $categories, 'books' => $books]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $categories = $this->categoryRepository->getAll();

        $books = $this->bookRepository->model->where(['category_id' => $id, 'status' => 'published'])->paginate(9);

        return view('modules.category.show', compact('categories', 'books'));
    }

}
