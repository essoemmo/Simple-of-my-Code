<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreContact;
use App\Http\Resources\AboutResource;
use App\Http\Resources\BannerResource;
use App\Http\Resources\FaqsResource;
use App\Http\Resources\PrivecyResource;
use App\Http\Resources\SettingResource;
use App\Http\Resources\TermResource;
use App\Http\Resources\UsageResource;
use App\Models\AboutUs;
use App\Models\Banner;
use App\Models\ContactUs;
use App\Models\Faq;
use App\Models\Privecy;
use App\Models\Setting;
use App\Models\Term;
use App\Models\Usage;
use Illuminate\Http\Request;

class SettingController extends Controller
{

  public function AllSetting()
  {
      $about = AboutUs::where('id',1)->first();
      $usage = Usage::where('id',1)->first();
      $term = Term::where('id',1)->first();
      $privecy = Privecy::where('id',1)->first();
      $settings = Setting::where('id',1)->first();
      $banners = Banner::all();
      $faqs = Faq::all();
      
          return response()->json([
            'success' => 1,
            'aboutus' => $about ? AboutResource::make($about) : null,
            'usages'  =>  $usage ? UsageResource::make($usage) : null,
            'terms'   => $term ? TermResource::make($term) : null,
            'privecy' => $privecy ? PrivecyResource::make($privecy) : null,
            'settings' => $settings ? SettingResource::make($settings) : null,
            'faqs'     => FaqsResource::collection($faqs),
            'banners'  => BannerResource::collection($banners),
          ], 200);
        
  }

  public function ContactUs(StoreContact $request)
  {
        $contact_us = ContactUs::create([
          'phone' => '+966'.$request->phone,
          'description' => $request->description,
      ]);

      if ($contact_us) {
          return response()->json([
              'success' => 1,
              'message' => __('application.messagesend'),
          ], 200);
      }else{
          return response()->json([
              'success' => 0,
              'message' => __('application.errorhere')
          ], 400);
      }
  }
}
