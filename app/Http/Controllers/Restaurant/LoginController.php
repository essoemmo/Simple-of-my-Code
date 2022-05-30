<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::RESTAURANTHOME;

    public function __construct()
    {
      $this->middleware('guest:restaurant')->except('logout');;
    }

    public function showLoginForm()
    {
        return view('restaurant.login');
    }

    public function login(Request $request)
    {

      $v = Validator::make($request->all(), [
            'email' => 'required|email', 
            'password' => 'required|min:8',
        ]);

        if ($v->fails()) {
          session()->flash('error', __('restaurant.validerrors'));
          return back();
        }

        if (Auth::guard('restaurant')->validate(['email' => $request->email, 'password' => $request->password, 'active' => 0])) {

         session()->flash('error', __('restaurant.notActive'));
          return back();
        }

        $credentials  = array(
          'email' => $request->email, 
          'password' => $request->password
        );

        if (Auth::guard('restaurant')->attempt($credentials,$request->has('remember')))
        {
          session()->flash('success', __('restaurant.loginsuccessfully'));
           return redirect()->intended($this->redirectPath());
        }

          session()->flash('error', __('restaurant.notbase'));
           return back();
    }


    protected function guard()
    {
       return Auth::guard('restaurant');
    }
}
