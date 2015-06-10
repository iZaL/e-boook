<?php namespace App\Http\Controllers\Auth;

use App\Jobs\AssignSubscriberForNewUser;
use App\Src\User\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name_en' => 'required|max:255',
            'name_ar' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'mobile' => 'numeric',
            'bank_number' => 'max:255',
            'bank_name' => 'max:255',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name_ar' => $data['name_ar'],
            'name_en' => $data['name_en'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'bank_name' => $data['bank_name'],
            'bank_number' => $data['bank_number'],
            'active' => '1',
            'password' => bcrypt($data['password']),
        ]);
        /*
         * When a user Registration is done . Assign Subscriber Role by Default to a user.
         * */
        $job = new AssignSubscriberForNewUser($user->id);
        $this->dispatch($job);
        return $user;
    }
}
