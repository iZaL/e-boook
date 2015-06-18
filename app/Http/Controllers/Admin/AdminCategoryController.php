<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategory;
use App\Src\Category\CategoryRepository;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public $categoryRepository;

    public function __construct (CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return view('admin.modules.category.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('admin.modules.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateCategory $request)
    {
        $this->categoryRepository->model->create($request->except('_token'));

        return redirect()->back()->with('success' , trans('word.create-success-category'));
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
        $category = $this->categoryRepository->getById($id);

        return view('admin.modules.category.edit',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,Request $request)
    {
        $this->categoryRepository->model->where('id','=',$id)->update([
            'name_ar' => $request->input('name_ar'),
            'name_en' => $request->input('name_en')
        ]);

        return redirect()->back()->with('success',trans('word.create-category-success'));
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
