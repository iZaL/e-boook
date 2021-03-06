<?php

namespace App\Http\Controllers\Admin;

use App\Events\BookPublished;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CreateBook;
use App\Http\Requests\EditBook;
use App\Jobs\CreateBookCover;
use App\Jobs\CreateCustomizedPreview;
use App\Src\Book\BookHelpers;
use App\Src\Book\BookRepository;
use App\Src\Category\CategoryRepository;
use App\Src\Purchase\PurchaseRepository;
use App\Src\Role\RoleRepository;
use App\Src\User\UserRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Class AdminBookController
 * @package App\Http\Controllers\Admin
 */
class AdminBookController extends Controller
{

    public $bookRepository;
    public $purchaseRepository;
    public $userRepository;
    public $roleRepository;
    public $categoryRepository;

    use BookHelpers;

    /**
     * @param BookRepository $book
     * @param CategoryRepository $categoryRepository
     * @param PurchaseRepository $purchaseRepository
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(
        BookRepository $book,
        CategoryRepository $categoryRepository,
        PurchaseRepository $purchaseRepository,
        UserRepository $userRepository,
        RoleRepository $roleRepository
    ) {
        $this->bookRepository = $book;
        $this->categoryRepository = $categoryRepository;
        $this->purchaseRepository = $purchaseRepository;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        if (Session::get('role.admin')) {

            $books = $this->bookRepository->model->with('meta')->orderBy('created_at', 'desc')->paginate(15);

            $allCustomizedPreviews = $this->bookRepository->getCustomizedPreviews();

        } elseif (Session::get('role.editor')) {

            $books = $this->bookRepository->model
                ->where('user_id', '=', Session::get('auth.id'))->with('meta')
                ->orderBy('created_at', 'desc')->paginate(15);

            $allCustomizedPreviews = $this->bookRepository->getCustomizedPreviews(Session::get('auth.id'));
        }

        $orders = $this->purchaseRepository->model->orderBy('created_at', 'desc')->with('book')->with('user')->get();

        if ($books) {
            return view('admin.modules.book.index',
                ['books' => $books, 'orders' => $orders, 'allCustomizedPreviews' => $allCustomizedPreviews]);
        }

        return redirect()->back()->with(['error' => trans('word.no-books')]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->model->all();

        $getLang = App()->getLocale();

        $categories = $categories->lists('name_' . $getLang, 'id');

        return view('admin.modules.book.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *  CreateBook Request Checks for the Rules of Create Book Form
     * @param CreateBook $request
     * @return Response
     */
    public function store(CreateBook $request)
    {
        /*
        - Job will handle the Storing the Book in the DB + Firing an event for PDF creation
        */

        $request->merge(['url' => $this->generateFileName(), 'user_id' => Auth::id()]);

        // create a book
        // create a book meta
        // create a pdf
        // create images
        // pass the book and images to update the book with cover url

        // create a book record
        $book = $this->bookRepository->model->create($request->except('_token', 'price', 'cover_ar', 'cover_en'));

        // create a pdf
        $price = ($request->input('price') > 0) ? $request->input('price') : '00.0';

        // Create Meta
        $book->meta()->create(['price' => $price]);

        event(new BookPublished($book));
        // create images wit a job
        // create meta for a book

        $this->dispatch(new CreateBookCover($book, $request));

        if ($book) {
            return redirect()->back()->with(['success' => trans('word.book-created')]);
        }

        return redirect()->back()->with(['error' => trans('word.book-not-created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

        if (Session::get('role.admin')) {

            $book = $this->bookRepository->model->where('id', '=', $id)->with('meta')->first();

        } elseif (Session::get('role.editor')) {

            $book = $this->bookRepository->model->where([
                'id'      => $id,
                'user_id' => Session::get('auth.id')
            ])->with('meta')->first();
        }

        $getLang = App()->getLocale();

        $categories = $this->categoryRepository->model->first();

        $categories = $categories->lists('name_' . $getLang, 'id');

        $status = ['draft' => 'draft', 'published' => 'published'];

        return view('admin.modules.book.edit', ['book' => $book, 'categories' => $categories, 'status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditBook $request
     * @return Response * check if new covers
     * check if new covers
     * get all data in the request
     * create new covers if added
     * create new pdf file
     * get the url of the new file and add to the request
     */
    public function update(EditBook $request, $id)
    {
        $book = $this->bookRepository->model->find($id);

        // check if cover_ar changed
        if (!$request->hasFile('cover_ar')) {
            $request->except('cover_ar');
        }

        // check if the cover_en changed
        if (!$request->hasFile('cover_en')) {
            $request->except('cover_en');
        }

        $request->merge(['url' => $this->generateFileName()]);


        // update the book table
        $book->fill($request->except('_token', '_method', 'price',
            'total_pages'));

        $hasBodyChanged = $book->isDirty('body') ? true : false;

        try {
            $book->update($request->except('_token', '_method', 'price',
                'total_pages'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('word.error-update'));
        }

        // Update Meta Table
        if ($hasBodyChanged) {
            event(new BookPublished($book));
        }
        $price = ($request->input('price') > 0) ? $request->input('price') : '00.0';
        $book->meta->price = $price;
        $book->meta->save();

        $this->dispatch(new CreateBookCover($book, $request));

        return redirect()->back()->with('success', trans('word.success-update'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->bookRepository->getById($id)->delete()) {

            return redirect()->back()->with('success', trans('word.success-delete'));
        }

        return redirect()->back()->with('error', trans('word.error-delete'));
    }


    /**
     * @param $buyerId
     * @param $bookId
     * @param $buyerEmail
     * @param $stage
     * @return \Illuminate\Http\RedirectResponse
     * @internal param to $Admin accept order (change status to [order/under_process/purchased£])
     */
    public function getAcceptOrder($buyerId, $bookId, $buyerEmail, $stage)
    {

        if ($order = $this->purchaseRepository->model->where(['user_id' => $buyerId, 'book_id' => $bookId])->update([
            'stage' => $stage
        ])
        ) {
            // create an email to notify the buyer that his order stage has been changed
            // from us to buyeremail .. this book with the title bla bla has been accepted by adminstration ..
            // we will contact u soon on your mobile number plesae get ready for payment and fulfil your order.

            $book = $this->bookRepository->getById($bookId)->with('meta')->first();

            $buyerUserName = Auth::user()->name;

            $buyerMobile = Auth::user()->mobile;

            $this->NotifyChangeStageOrder([
                'stage'    => $stage,
                'email'    => $buyerEmail,
                'book'     => $book,
                'username' => $buyerUserName,
                'mobile'   => $buyerMobile
            ]);

            return redirect()->back()->with(['success' => trans('success.order')]);
        }

        return redirect()->back()->with(['error' => trans('error.order')]);
    }

    /**
     * @param $buyerId
     * @param $bookId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDeleteOrder($buyerId, $bookId)
    {
        if ($this->purchaseRepository->deleteOrder($buyerId, $bookId)) {

            return redirect()->back()->with(['success' => trans('success.delete-order')]);
        }
    }

    /**
     * @param $bookId
     * @param $autherId
     * @param $total_pages
     * @return \Illuminate\View\View
     */
    public function getCreateNewCustomizedPreview($bookId, $autherId, $total_pages)
    {

        $isFree = $this->bookRepository->model->where('id', $bookId)->first()->free;

        if ($isFree != 1) {

            $users = $this->userRepository->getAllUsersWithoutAdmins($autherId);

            $usersList = $users->pluck('name_' . App::getlocale(), 'id');

            return view('admin.modules.book._create_preview_form',
                compact('bookId', 'autherId', 'total_pages', 'usersList'));
        }

        return redirect()->back()->with(['error' => trans('word.error-preview-not-created')]);


    }

    /**
     * @param Requests\CreateNewCustomizedPreviewRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateNewCustomizedPreview(Requests\CreateNewCustomizedPreviewRequest $request)
    {

        $users = $request->input('usersList');

        foreach ($users as $userId) {

            $request->merge(['user_id' => $userId]);

            if (!$this->userRepository->CreateNewCustomizedPreview($request->all())) {

                return redirect()->back()->with(['error' => trans('word.error-preview-not-created')]);
            }
        }

        return redirect()->back()->with(['success' => 'success-preview-created']);
    }

    public function getDeleteNewCustomizedPreview($bookId, $authorId)
    {
        $previewDeleted = $this->bookRepository->deleteNewCustomizedPreview($bookId, $authorId);

        if ($previewDeleted) {

            return redirect()->back()->with(['success' => 'success-preview-deleted']);

        }

        return redirect()->back()->with(['error' => trans('word.error-preview-not-deleted')]);
    }

    public function getShowNewCustomizedPreviewForAdmin($bookId, $authorId)
    {

        $book = $this->bookRepository->ShowNewCustomizedPreviewForAdmin($bookId, $authorId);

        return $this->dispatch(new CreateCustomizedPreview($book));
    }

    public function getShowNewCustomizedPreviewForUsers($bookId, $authorId)
    {

        $book = $this->bookRepository->ShowNewCustomizedPreviewForUsers($bookId, $authorId);

        return $this->dispatch(new CreateCustomizedPreview($book));
    }

    public function getUpdateBookStatus($bookId)
    {
        $book = $this->bookRepository->getById($bookId)->update([
            'status' => 'published'
        ]);

        if ($book) {

            return redirect()->back()->with(['success' => trans('word.success-status-updated')]);
        }

        return redirect()->back()->with(['error' => 'error-status-updated']);
    }

    /*    public function getBookByType ($type = 'book') {

        if(Session::get('role.admin') || Session::get('role.editor')) {
            $books = $this->bookRepository->model->where('type','=',$type)->with('meta')->orderBy('created_at','desc')->paginate(15);
        }
        else {
            $books = $this->bookRepository->model
                ->where('user_id','=',Auth::user()->id)->with('meta')
                ->where('type','=',$type)
                ->orderBy('created_at', 'ASC')->paginate(15);
        }

        return view('admin.modules.book.index',['books' => $books]);
    }*/

}
