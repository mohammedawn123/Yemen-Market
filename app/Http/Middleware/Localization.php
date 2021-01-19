<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;


class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $languages = Language::getList();
      //  $languagesKeyById=Language::where('status' , 1)->get()->keyBy('language_id')->toArray();
        Session(['languages'=>$languages->toArray()]);

        if (Session::has('locale'))
        {
                   $detectLocale = session('locale');
        } else{

                   $detectLocale ="en";
               }
        $currentLocale = array_key_exists($detectLocale, $languages->toArray()) ? $detectLocale : $languages->first()->code;
        session([
            'locale' => $currentLocale,
            'language_id' => $languages[$currentLocale]['language_id'] ,
            'image' => $languages[$currentLocale]['image'],
            'name' => $languages[$currentLocale]['name']
        ]);
        app::setLocale($currentLocale);


        return $next($request);
    }
}
