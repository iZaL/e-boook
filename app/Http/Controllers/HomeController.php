<?php namespace App\Http\Controllers;

use App\Contactus;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public $contactus;
	public function __construct(Contactus $contactus)
	{
		$this->contactus = $contactus;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}

	public function contactus() {
		$contactusInfo = $this->contactus->all()->first();
		return view('pages.contactus',['contactusInfo'=> $contactusInfo]);
	}

}
