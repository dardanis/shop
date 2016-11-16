<?php namespace App\Providers;

use App\Advertisment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		view()->composer('new_template.client.includes.banner',function($view)
        {
            $ad=Advertisment::latest()->where('status',1)->first();
            $view->with('ad',$ad);
		});
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
