<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Darryldecode\Cart\Cart;



class WishlistProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['wishlist'] = $this->app->share(function($app)
        {
            $storage = $app['session']; // laravel session storage
            $events = $app['events']; // laravel event handler
            $instanceName = 'wishlist'; // your cart instance name
            $session_key = 'AsASDMCks0ks1'; // your unique session key to hold cart items

            return new Cart(
                $storage,
                $events,
                $instanceName,
                $session_key
            );
        });
	}

}
