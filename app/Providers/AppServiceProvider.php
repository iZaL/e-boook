<?php namespace App\Providers;

use App\Src\User\User;
use App\Src\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // create cache from contact us for 20 minutes
        // this cache will be cleared if the admin only clicked AdminContactUsController@edit
        /*$contactusInfo = Cache::remember('contactusInfo', 20, function() {

            return DB::table('contactus')->first();

        });*/




        // share the contact us information all over the views from the cache
        //view()->share('contactusInfo', $contactusInfo);



    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }

    }
}
