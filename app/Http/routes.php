<?php

/***************************************************************************************************
 * Book
 ***************************************************************************************************/

Route::get('/home',['as'=>'home','uses'=>'BookController@index']);
Route::get('/',['as'=>'home','uses'=>'BookController@index']);
Route::get('/books',['uses'=>'BookController@getAllBooks']);
Route::resource('book','BookController',['only'=>['index','show']]);
Route::get('search',['uses'=>'BookController@getShowSearchResults']);


/***************************************************************************************************
 * Contactus
 ***************************************************************************************************/
Route::get('/contactus','HomeController@contactus');
Route::post('/contactus','HomeController@sendContactUs');


/***************************************************************************************************
 * Authentication
 ***************************************************************************************************/
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


/***************************************************************************************************
 * Localization
 * 1- middle ware created Locale
 *      - check Session::get('local') - if not - enforce the app to en - if true switch the app()->
 * 2- register the middleware globally
 * 3- LanguageController@changelang($lang) to switch the Session::put('locale')
 *
 ***************************************************************************************************/

Route::get('/lang/{lang}',['uses'=>'LanguageController@changeLocale']);


/***************************************************************************************************
 * Category
 ***************************************************************************************************/

Route::get('category',['uses'=>'CategoryController@index']);
Route::get('category/{id}',['uses'=>'CategoryController@show']);

/***************************************************************************************************
 *                                          Guests
 *
 ***************************************************************************************************/
//Route::get('/profile/{id}/{status?}',['uses'=>'UserController@show']);
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


/***************************************************************************************************
 *                                          Profile Page
 *
 ***************************************************************************************************/
Route::get('/profile/user/{id}',['uses'=>'UserController@showSingleProfile']);

/***************************************************************************************************
  *                                          Users Zone
 *
 ***************************************************************************************************/



Route::group(['prefix'=>'app'],function () {





    /***************************************************************************************************
     *                                          Auth Zone
     *
     ***************************************************************************************************/

    Route::group(['middleware'=>'auth'],function () {

        // Subscriber Zone here : ONLY AUTH MIDDLEWARE IS REQUIRED

        /***************************************************************************************************
         *                                          Profile
         *
         ***************************************************************************************************/
        Route::get('/profile/{id}/{status?}',['uses'=>'UserController@show']);


        /***************************************************************************************************
         *                                          Favorite
         *
         ***************************************************************************************************/
        Route::get('/favorite/{user}/{book}',['uses'=>'BookController@getCreateNewFavoriteList']);
        Route::get('/favorite/remove/{user}/{book}',['uses'=>'BookController@getRemoveBookFromUserFavoriteList']);
        Route::get('/orders/remove/{user}/{book}',['uses'=>'BookController@getRemoveBookFromUserOrderList']);



        /***************************************************************************************************
         *                                          Favorite
         *
         ***************************************************************************************************/
        Route::get('user/{user}',['uses'=>'UserController@edit']);
        Route::post('user/{user}',['uses'=>'UserController@update']);


        /***************************************************************************************************
         *                                          Books Routes for Auth
         *
         ***************************************************************************************************/

        Route::get('/book/pdf/{url}',['uses'=>'BookController@getFreePdfFile']);
        Route::get('/book/pdf/preview/{url}',['uses' => 'BookController@getCreateNewPreview']);
        Route::get('/book/order/{bookId}/{userId}',['uses'=>'BookController@getCreateNewOrder']);


        /***************************************************************************************************
         *                                          Editor Zone
         *
         ***************************************************************************************************/
        Route::group(['prefix'=>'editor','middleware'=>'editor.zone:Editor'], function () {

            /***************************************************************************************************
             * Book Routes for Editor
             ***************************************************************************************************/

            Route::resource('book','Admin\AdminBookController', ['except'=>['destroy']]);
            Route::get('book/type/{type?}','Admin\AdminBookController@getBookByType');


        }); // end of editor middlware*/


        /***************************************************************************************************
         *                                          Admin & Editor Zone
         * an admin can write + read + delete books
         * an admin can assign roles for other users (Author [write,edit,read] + Subscriber [read])
         ***************************************************************************************************/

        Route::group(['prefix'=>'admin','middleware'=>'admin.zone:Admin'], function () {

            /***************************************************************************************************
             * User
             ***************************************************************************************************/
            Route::resource('user','Admin\AdminUserController');
            //Route::get('user/role/{id}','Admin\AdminUserController@getEditUser');



            /***************************************************************************************************
             * Category
             ***************************************************************************************************/
            Route::resource('category','Admin\AdminCategoryController',['except'=>'delete']);


            /***************************************************************************************************
             * Book
             ***************************************************************************************************/

            // route to fetch books only
            Route::get('/','Admin\AdminBookController@index');

            // route to fetch peoms only
            Route::get('/book/type/{type?}','Admin\AdminBookController@getBookByType');

            // resource route for book & poem
            Route::resource('book','Admin\AdminBookController');
            Route::get('/orders/accept/{userId}/{bookId}/{stage}','Admin\AdminBookController@getAcceptOrder');
            Route::get('/orders/delete/{userId}/{bookId}','Admin\AdminBookController@getDeleteOrder');

            /***************************************************************************************************
             *                                          Profile
             *
             ***************************************************************************************************/
            Route::get('/profile/{id}/{status?}',['uses'=>'Admin\AdminUserController@show']);


            /***************************************************************************************************
             * Contact Us
             ***************************************************************************************************/
            Route::get('contactus/edit','Admin\AdminContactUsController@edit');
            Route::post('contactus','Admin\AdminContactUsController@update');


        });


    }); // end of auth middlware




}); // end of prefix app





/***************************************************************************************************
 *
 ***************************************************************************************************/


/***************************************************************************************************
 *
 ***************************************************************************************************/


/***************************************************************************************************
 * lessons learnt & hints + Reminders
 *
 * 1- Conflict - AbstractRepository with (ModelRepository) [Design Pattern]
 * when you start working within the controller for example UserController
 * you start your code with the constructor saying $this->user = $userRepository
 * don't i repeat don't use $userRepository->model in the constructor only use it within the methods $this->user->model
 * - the query build must be in one line or one function in the case of return
 * so you have to use within the UserRepository itself $this->model->whatever the query will then return to the controller
 * then in the controller you may use $this->user->then any function within the UserRepository
 *
 * ***** 1-1 Afdal Practice implemented
 * - One Abstract Class has been created above the Eloquent Model
 *    ex. AbstractModel extends the Model Eloquent
 *          User extends AbstractModel
 *        AbstractRepository
 *
 * 2- localization
 * A. create route with /lange/{lang}
 * B. locale middleware created then register this globally within the kernal
 * C. create LanguageController@chooser then create Session with locale key modify the value then redirect back
 * D. from the locale middleware change the app::setLocale with the new value of the session locale
 *
 * 3- Query Builder
 * - you have to end up the methods within the Repository or the Model(User) like so :
 * return $this->get(['body'])->take(2); / $this->where('id','=','1')->get(['body']);
 * within the controller call a method that returns a query from the Repository or the model
 * - you have to assign this value with in the view('whatever',[assign it here]);
 * then to reach to the value of the element inside the view itself
 * == if single element
 * $this->modelRepository->methodCalled()->body/name/whatever
 * == if array you have to use foreach ()
 *
 *  4 - Query Building for [Relations Model+RepositoryModel+Controller]
 * 1- a has Many relation has been made inside the 2 models
 * 2-  inside the Repository
 *     ex. a user has many books - a book belongs to one user
 *     2.1 - you have to create a new method over the Eloquant relation inside the repository
 *     2.2 the query within the method  as the following :
 *        - theModelInstance -> findOrNew -> book Method relation -> get()
 *        - please notice that you have specified the user through FindOrNew
 *        - inside the controller you can fetch all this as the following
 *          - $books = $this->userRepository->getBooks($id);
 *          - also note that you can get all relation related to a model as the following :
 *              in the BookController you wrote $book = $this->bookRepo->model->paginate()
 *              now you can get the relation between a book and a user as the following :
 *              $user = $book->user()->first();
 *      2.3 if you reached an instance of a book like so $book = $this->bookRepo->getById($id)
 *          then you can continue chaining the other relations of the same Model.
 *
 * 5- also note the following important point :
 *  in the controller you made this :
 *  $book = $this->bookRepo->model->paginate()
 *  and also you made this in another method
 *  $book = $this->bookRepo->customizedMethod()
 *
 *
 * 4- HomeStead
 * a. you have install vagrant with VB
 * b. to add laravel image within the VB :: vagrant box add laravel/homestead
 * d. create code folder then clone the repository : git clone https://github.com/laravel/homestead.git Homestead
 * e. after customizing the homestead.yaml with the folders + map ( Each Change you have to make bash init.sh )
 * f. then within the command line bash init.sh
 * g. then within the command line to rebuild the application : vagrant destroy && vagrant up
 * h. vagrant up
 *
 * 5- ServicesProvider
 * - simply this is the IOC container of the whole application
 *
 * 6- {{}} vs {!! !!}}
 * {!! $books->render(); !!} - to echo HTML
 * {{ Auth::user() }} to write php within the blade
 *
 *
 *
 * 7- FORMS HINTS
 * 7.1 - for select drop down menu you do the following :
 *      - $categories array should be sent with the view = list(key,$value);
 *      {!! Form::select('category_id', $categories ,null, ['class' => 'form-control','style'=>'text-align:left !important;']) !!}
 * 7.2 notice how you used trans() within the inputs
 *      {!! Form::textarea('description_en', null, ['class' => 'form-control','placeholder'=> trans('word.descrption-en')]) !!}
 * 7.3 notice how you wrote the whole form
 *  - Form::open([array includes action/route and post/get/put method],[array includes attributes])
 *  - <div class="form-group col-md-4 col-lg-4">
    {!! Form::label('title_en', 'Title In English', ['class' => 'control-label']) !!}
    {!! Form::text('title_en', null, ['class' => 'form-control','placeholder'=>'Book Title in English']) !!}
    </div>
 *
 *
 * 7- Middleware
 * - create a middleware php artisan make:middlesware Whatever
 * - register the name of the middleware in the kernal
 * - after doing this --> you assign the middleware to the route or to route::group() as the following :
 *  Route::group(['middleware'=>'auth'],function () {
*      //// code
            Route::group(['middleware'=>'app.admin.zon:Admin'],function () {});
 *          /// code
 * });
 * - that means that the middleware still didn't work you have to assign the middleware within each controller (still not sure about this line)
 *
 *8- elixir
 *
/*
 * 1- elixir(function (mix){
 * mix.sass(["name of the file within the resources/assets/ then create a folder sass if you will use sass or create less folder"]);
 * mix.scripts([list of files that will be cloned in the public/js],'path to the file in public','base path for cloned files','./');
 * mix.version(['public/css/app.css','public/js/app.js']);
 * });
 *
 * 2- within the app.sass you will import all files needed
 * @import url (whatever)
 ***************************************************************************************************/


/*
 * Pending ::
 * 1- make order system
 * 2- make rating system
 * 3- make abstraction to the whole application
 * */


