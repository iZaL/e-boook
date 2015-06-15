<?php namespace App\Http\Controllers;

use App\Src\Contactus\Contactus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}

	public function contactus() {
		//$contactusInfo = $this->contactus->all()->first();
		return view('pages.contactus');
	}

	public function sendContactUs(Request $request) {

		$this->validate($request, [
			'name' => 'required|max:255',
			'email' => 'required|email',
			'subject' => 'required',
			'content' => 'required'
		]);

		$data = $request->except('_token');

		Mail::later(2,'emails.contactus', ['data'=>$data], function ($message) {

			$message->from('test@test.com', 'Contact Us');

			$message->subject('Contact Us');

			$message->to('uusa35@gmail.com');
			/*->cc();*/
		});

		return redirect()->back()->with('success',trans('success-contactus'));
	}

}
