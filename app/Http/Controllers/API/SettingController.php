<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResource;
use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\Privecy;
use App\Models\Setting;
use App\Models\Term;
use App\Models\Usage;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $settingData = [];
        $settingData['about_us'] = AboutUs::first()->{'description_'.app()->getLocale()};
        $settingData['terms'] = Term::first()->{'description_'.app()->getLocale()};
        $settingData['usage'] = Usage::first()->{'description_'.app()->getLocale()};
        $settingData['faq'] = FaqResource::collection(Faq::all());
        $settingData['privacy'] = Privecy::first()->{'description_'.app()->getLocale()};
        $setting = Setting::first();
        $settingData['contact_us'] = [
            'phone' =>$setting->phone,
            'email' =>$setting->email,
            'facebook'=>$setting->facebook,
            'twitter'=>$setting->twitter,
            'instagram'=>$setting->instagram,
        ];
        return self::successResponse('' , $settingData);
    }
}
