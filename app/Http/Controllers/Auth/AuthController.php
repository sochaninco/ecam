<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Session;
use Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Redirect;


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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */

    protected $redirectTo = '/';


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'first_name'=>'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $data=$request->all();
        $this->create($data);
//        flash()->error('Please wait approval from admin.');
        flash()->success('Register successfully , you can logIN now!!');
        return redirect('login');
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
            'first_name'=>$data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'activated' => 1,
        ]) ;
        $user->attachRole(2);
        return $user;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        //$credentials = $this->getCredentials($request);
        $data=$request->all();
        $credentials = ['email'=>$data['email'],'password'=>$data['password'],'activated'=>1];

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            $user=Auth::user();
            $user->save();
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        $email = $data['email'];
        $get_email = User::where('email',$email)->first();
        $get_activate = User::where([['email',$email],['activated',1]])->first();
        if(!$get_email){
            $errors = new MessageBag(['email' =>['Email is not registered with our system']]); // if Auth::attempt fails (wrong credentials) create a new message bag instance.
        }
        else if(!$get_activate){
            $errors = new MessageBag(['email' =>['Please wait till your account is activate.']]);
        }
        else {
            $errors = new MessageBag(['password'=>['Invalid password match with registered email.']]);
        }

        return Redirect::back()->withErrors($errors);
    }
}
