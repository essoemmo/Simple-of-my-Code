<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.home');
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
