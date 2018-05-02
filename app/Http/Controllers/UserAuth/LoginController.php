<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;
use Exception;
use Illuminate\Http\Request;
use App\User;

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

    use AuthenticatesUsers, LogsoutGuard {
        LogsoutGuard::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/user/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('user.guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('user');
    }
    
    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        // Attempt to log the user in
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password, 'status'=>1], $request->remember)) {

        	/*echo Auth::guard('user')->user()->user_type;
        	die();*/
            // if successful, then redirect to their intended location            
            if (Auth::guard('user')->user()->user_type == 2 || Auth::guard('user')->user()->user_type == 3 )
            {
                return redirect()->route('bestideas',['type'=>1]);
            }
            else if (Auth::guard('user')->user()->user_type == 4)
            {
                return redirect()->route('userpost');
            }
            else if (Auth::guard('user')->user()->user_type == 5)
            {
                return redirect()->route('mltuserpost');
            }
            else if (Auth::guard('user')->user()->user_type == 6)
            {
                return redirect()->route('tools');
            }
            else 
            {
                return redirect()->intended('user/home');
            }
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('flash_error','Invalid username or password');      
    }
}
