<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:restaurant');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('restaurant.home');
    }

    public function lang($locale)
    {
        if (! in_array($locale, ['en', 'ar'])) {
           abort(400);
        }
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
