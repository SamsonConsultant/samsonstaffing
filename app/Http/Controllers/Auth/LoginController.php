<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo;

    protected function redirectTo( ) {
        if(Auth::check() && Auth::user()->role_id == 3){
            return route('user.dashboard');
        } else if (Auth::check() && Auth::user()->role_id == 2) {
            return route('employer.dashboard');
        } else{
            Session::flash('error', 'You are not authorized to access this page'); 
            Auth::logout();
            return route('login');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request){
        $field = $this->field($request);
        
        return [
            $field         => $request->get($this->username()),
            'password'     => $request->get('password'),
            'status'       => User::ACTIVE
        ];
    }

    /**
     * Determine if the request field is email or username.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function field(Request $request){
        $email = $this->username();

        return filter_var($request->get($email), FILTER_VALIDATE_EMAIL) ? $email : 'username';
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request){
        $field = $this->field($request);

        $messages = ["{$this->username()}.exists" => 'The account you are trying to login is not activated or it has been disabled.'];

        $this->validate($request, [
            $this->username() => "required|exists:users,{$field},status," . User::ACTIVE,
            'password'        => 'required',
        ], $messages);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request){
        $this->guard()->logout();        
        return redirect(route('login'));
    }
}
