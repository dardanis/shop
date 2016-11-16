<?php namespace App\Http\Controllers;
use App\Product;
use Cart;
use Redirect;
class CartController extends Controller {


	public function __construct()
	{
		$this->middleware('auth');
	}

	public function add($id){
		$product=Product::find($id);
		Cart::add($product->id, $product->title, 1, $product->price);
		return Redirect::back();
	}

}
