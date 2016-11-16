<?php

namespace App\Http\Controllers;

use App\OrderItem;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cart;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\CartItem;

class OrderController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function checkout(Request $request)
	{

		$token = $request->input('stripeToken');

		//Retriieve cart information
		$cart = Cart::getContent();

		$total=0;

		foreach($cart as $item){
			echo $total+=$item->price;
		}
		if(
		Auth::user()->charge($total*100, [
			'source' => $token,
			'receipt_email' => Auth::user()->email,
		])){
			foreach(Cart::getContent() as $product){
				 $quantity=$product->quantity;
				//$productdata = Product::find($product->id);
			}


			$order = new Order();
			$order->total_paid= $total;
			$order->user_id=Auth::user()->id;
			$order->save();

			foreach(Cart::getContent() as $item){
				$orderItem = new OrderItem();
				echo $orderItem->order_id=$order->id;
				echo $orderItem->product_id=$item->id;
				//$orderItem->file_id=$item->product->file->id;
				$orderItem->save();

				$product = Product::find($orderItem->product_id);

				$product->availability=$product->availability-$quantity;
				echo $product->availability;

				$product->save();
				Cart::clear($item->id);

			}
			return redirect('/order/myorder/order/'.$order->id);

		}else{
			return redirect('/cart');
		}

	}

	public function index(){
		$orders = \Illuminate\Support\Facades\DB::table('orders')->where('user_id', '=',Auth::user()->id)->get();
		//$orders = Order::where('user_id',Auth::user()->id)->get();
		return view('order.list',compact('orders'));
	}

	public function viewOrder($orderId){
		$orders = Order::find($orderId);

		return view('order.view',compact('orders'));
	}
}