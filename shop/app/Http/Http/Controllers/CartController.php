<?php namespace App\Http\Controllers;
use App\Product;
use Cart;
use Wishlist;
use Illuminate\Http\Request;
class CartController extends Controller {

	

	public function index(){
		$cart=Cart::getContent();
		return view('new_template.client.pages.cart',compact('cart'));
	}
	public function add(Request $request,$id){
		if($request->has('qty')){
			$qty=$request->get('qty');
		}else{
			$qty=1;
		}
		$product=Product::find($id);
		Cart::add($product->id, $product->title,  $product->price,$qty,array('image'=>$product->thumbnail,'slug'=>$product->slug,'user'=>$product->user->username));
		return redirect('cart');
	}

	public function add_from_wishlist($id){
		$product=Product::find($id);
		Cart::add($product->id, $product->title,  $product->price,1,array('image'=>$product->thumbnail));
		Wishlist::remove($id);
		return redirect('cart');
	}
	public function remove_product($id){
		Cart::remove($id);
		return redirect()->back();
	}
	public function clear(){
		Cart::clear();
		return redirect()->back();
		
	}

	public function update_cart(Request $request,$id){
		$qty=$request->get('quantity');
		Cart::update($id, array(
		  'quantity' => array(
		      'relative' => false,
		      'value' => $qty
		  ),
		));
		return redirect()->back();
	}
}
