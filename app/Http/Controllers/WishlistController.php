<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Wishlist;
class WishlistController extends Controller {

	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Wishlist::clear();
		$wishlist=Wishlist::getContent();
		return view('new_template.client.pages.wishlist',compact('wishlist'));
	}

	

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id)
	{
		$product=Product::find($id);
		Wishlist::add($product->id, $product->title,  $product->price,1,array('image'=>$product->thumbnail));
		return redirect('wishlist');
	}

	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Wishlist::remove($id);
		return redirect()->back();
	}



	public function clear(){
		Wishlist::clear();
		return redirect('wishlist');
	}
}
