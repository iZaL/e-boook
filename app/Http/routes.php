<?php


Route::get('/home',['as'=>'home','uses'=>'BookController@index']);
Route::get('/',['as'=>'home','uses'=>'BookController@index']);

Route::get('contactus','HomeController@contactus');

//Route::resource('user','UserController');
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
 * Book
 ***************************************************************************************************/

//Route::resource('book','BookController');

/***************************************************************************************************
 * Category
 ***************************************************************************************************/

Route::resource('category','CategoryController',['only'=>'index','show']);


/***************************************************************************************************
 *
 ***************************************************************************************************/




/***************************************************************************************************
  *                                          CMS
 *
 ***************************************************************************************************/


Route::group(['prefix'=>'admin','middleware'=>'auth'],function () {

    /***************************************************************************************************
     * Book
     ***************************************************************************************************/

    Route::get('/','Admin\AdminBookController@index');

    Route::resource('book','Admin\AdminBookController');

    /***************************************************************************************************
     * Category
     ***************************************************************************************************/
    Route::resource('category','Admin\AdminCategoryController');

    /***************************************************************************************************
     * Contact Us
     ***************************************************************************************************/
    Route::get('contactus/edit','Admin\AdminContactUsController@edit');
    Route::post('contactus','Admin\AdminContactUsController@update');

    /***************************************************************************************************
     * User
     ***************************************************************************************************/
    Route::resource('user','Admin\AdminUserController');
    Route::get('user/role/{id}','Admin\AdminUserController@getEditUser');
});





/***************************************************************************************************
 *
 ***************************************************************************************************/


/***************************************************************************************************
 *
 ***************************************************************************************************/


/***************************************************************************************************
 * lessons learnt & hints + Reminders
 *
 * 1- Conflict - AbstractRepository with (ModelRepository)
 * when you start working within the controller for example UserController
 * you start your code with the constructor saying $this->user = $userRepository
 * don't i repeat don't use $userRepository->model because of the following
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
 * you have to end up the methods within the Repository or the Model(User) like so :
 * return $this->get(['body'])->take(2); / $this->where('id','=','1')->get(['body']);
 * within the controller call a method that returns a query
 * then to reach to the value of the element
 * == if single element
 * $this->modelRepository->methodCalled()->body/name/whatever
 * == if array you have to use foreach ()
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
 *
 ***************************************************************************************************/


