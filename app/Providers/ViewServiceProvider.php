<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // create cache from contact us for 20 minutes
        // this cache will be cleared if the admin only clicked AdminContactUsController@edit
        $contactusInfo = App::make('App\Src\Contactus\Contactus');
        $contactusInfo = $contactusInfo->getContactInfo();



        /*$contactusInfo = Cache::remember('contactusInfo', 20, function () {

            return DB::table('contactus')->first();

        });*/

        // share the contact us information all over the views from the cache
        view()->share('contactusInfo', $contactusInfo);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
