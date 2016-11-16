<?php namespace App\Handlers\Events;

use App\Events\ProductViewCount;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class ProductsViewsHandler {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  ProductViewCount  $event
	 * @return void
	 */
	public function handle(ProductViewCount $event)
	{
		$event->product->views=$event->product->increment('views');
	}

}
