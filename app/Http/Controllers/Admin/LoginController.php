<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::ADMINHOME;


    public function __construct()
    {
      $this->middleware('guest:admin')->except('logout');;
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {

      $v = Validator::make($request->all(), [
            'email' => 'required|email', 
            'password' => 'required|min:8',
        ]);

        if ($v->fails()) {
          session()->flash('error', __('admin.validerrors'));
          return back();
        }

        if (Auth::guard('admin')->validate(['email' => $request->email, 'password' => $request->password, 'active' => 0])) {

         session()->flash('error', __('admin.notActive'));
          return back();
        }

        $credentials  = array(
          'email' => $request->email, 
          'password' => $request->password
        );

        if (Auth::guard('admin')->attempt($credentials,$request->has('remember')))
        {
          session()->flash('success', __('admin.loginsuccessfully'));
           return redirect()->intended($this->redirectPath());
        }

          session()->flash('error', __('admin.notbase'));
           return back();
    }


    protected function guard()
    {
       return Auth::guard('admin');
    }
}