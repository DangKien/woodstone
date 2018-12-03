<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class AppProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('Language', function ($app) {
            return new \App\Libs\Providers\Language();
        });

        $this->app->singleton('Category', function ($app) {
            return new \App\Libs\Providers\Category();
        });

	    $this->app->singleton('Setting', function ($app) {
		    return new \App\Libs\Providers\SettingProvider();
	    });

	    $this->app->singleton('Home', function ($app) {
		    return new \App\Libs\Providers\HomeProvider();
	    });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        return ['Category', 'Setting', 'Language'];
    }
}
