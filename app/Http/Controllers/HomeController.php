<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreContact;
use App\Models\ContactUs;
use App\Models\Faq;
use App\Models\Section;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $header   = Section::where('type','header')->first();
        $sliders  = Section::where('type','slider')->first();
        $features = Section::where('type','features')->first();
        $services = Section::where('type','services')->first();
        $partners = Section::where('type','partners')->first();
        $devices  = Section::where('type','devices')->first();
        $video    = Section::where('type','video')->first();
        $vibe     = Section::where('type','vibe')->first();
        return view('home', compact('header','sliders','features','services','partners','devices','video','vibe'));
    }

    function faqs()
    {
        $faqs  = Faq::all();
        return view('faqs', compact('faqs'));
    }

    function contactUs()
    {
        return view('contact');
    }

    public function storeContact(StoreContact $request)
    {
           ContactUs::create([
            'phone' => '+966'.$request->phone,
            'description' => $request->description,
        ]);
  
        return redirect()->back()->with('success', 'Your message has been sent successfully');
     }
    
     public function langHome($locale)
     {
         if (! in_array($locale, ['en', 'ar'])) {
            abort(400);
         }
         session()->put('locale', $locale);
         return redirect()->back();
     }

}
