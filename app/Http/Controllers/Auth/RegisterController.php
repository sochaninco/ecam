<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
        $this->validator($request->all())->validate();


        event(new Registered($user = $this->create($request->all())));
//        flash()->error('Please wait approval from admin.');
        flash()->success('Register successfully , you can logIN now!!');
        return redirect('login');
    }

    public function showPhoneRegistrationForm()
    {
        return view('auth.register-phone');
    }

    public function register_phone(Request $request)
    {
        $this->validatorPhoneRegister($request->all())->validate();


        event(new Registered($user = $this->createFromPhone($request->all())));
//        flash()->error('Please wait approval from admin.');
        flash()->success('Register successfully , you can logIN now!!');
        return redirect('login');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
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

    protected function createFromPhone(array $data)
    {
        $user = User::create([
            'first_name'=>$data['first_name'],
            'last_name' => $data['last_name'],
            'email'=> $data['phone'].'@email.com',
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'activated' => 1,
        ]) ;
        $user->attachRole(2);
        return $user;
    }

    private function validatorPhoneRegister(array $data)
    {
        return Validator::make($data, [
            'first_name'=>'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required|string|max:15|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }
}
