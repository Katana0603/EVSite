<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Event\event;
use App\Models\News\News;
use App\Models\Partner\Partner;
use App\Models\Sponsoren\Sponsoren;
use App\Models\PM\pm_follow;
use App\Models\Event\event_sponsors;
use App\Models\StartUpNews\startUpNews;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //


        // Using view composer to set following variables globally
    	view()->composer('*',function($view) {
    		$view->with('activeEvents', event::where('active','=', 1)->get());
    		$view->with('sitebarnews', News::orderBy('updated_at','desc')->paginate(3)); 
            $view->with('sitebarPartner', Partner::where('activ', 1)->get()); 
            $view->with('sitebarSponsors', event_sponsors::get());
            $view->with('startUpNewsDisplay', startUpNews::first());
            if (Auth::check()) {
                $view->with('unreadMessages', pm_follow::where('toUser',Auth::user()->id)->where('read',0)->count());
            }


        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
