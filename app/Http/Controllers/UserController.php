<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Src\Book\BookRepository;
use App\Src\Favorite\FavoriteRepository;
use App\Src\Role\RoleRepository;
use App\Src\User\User;
use App\Src\User\UserHelpers;
use App\Src\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public $userRepository;
    public $bookRepository;
    public $favoriteRepository;
    public $roleRepository;
    public $authUser;


    use UserHelpers;

    public function __construct(UserRepository $userRepository, BookRepository $bookRepository, FavoriteRepository $favoriteRepository, RoleRepository $roleRepository) {
        $this->userRepository = $userRepository;
        $this->bookRepository = $bookRepository;
        $this->favoriteRepository = $favoriteRepository;
        $this->roleRepository = $roleRepository;
        $this->authUser = Auth::user();

        $this->middleware('grant.access',['only'=>['show','edit','update']]);
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
     * Display the Profile of a user
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        /*
         * 1- a visitor is the owner
         * 2- a visitor is just a visitor
         * 3- a visitor is the administrator
         * */

        // checks if the authintecated user is the same user who is visiting the profile page

        $Allbooks = $this->userRepository->getAllBooksForUser($id);

        $favoriteBooks = $this->userRepository->getFavoritedBooksForUser($id);

        return view('modules.user.profile',['books'=>$Allbooks,'favoriteBooks'=>$favoriteBooks,'user'=>$this->authUser]);


        //return redirect()->back()->with('error', trans('word.error-no-auth'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $roles = $this->roleRepository->getAll()->lists('name','id');
        $user = $this->userRepository->model->where('id','=',$id)->with('roles')->first();
        return view('auth.edit',['user' => $user,'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {


        // check if authenticated in order to change the active & Role of a user
        if(Auth::user()->isAdmin()) {
            $user = $this->userRepository->model->where('id','=',$request->input('id'))->update($request->except('_token','id','role_name'));
            DB::table('user_roles')->where('user_id','=',$request->input('id'))->update([
                'role_id' => $request->input('role_name')
            ]);
            return redirect()->back()->with('success', trans('word.success-edit-user'));
        }
        // if normal user only change the normal data

        $user = $this->userRepository->model->where('id', '=', $request->input('id'))->update($request->except('_token', 'id', 'active', 'role_name'));

        if ($user) {
            return redirect()->back()->with('success', trans('word.success-edit-user'));
        }

        return redirect()->back()->with('error',trans('word.error-edit-user'));
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

    public function showSingleProfile($userId) {

        $user = $this->userRepository->getById($userId)->first();

        return view('modules.user._single_profile',['user'=>$user]);

    }

}
