<?php namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\Subcategory;
use App\User;
use Auth;
use Validator;
use Input;
use LaravelGettext;
use Cart;
class HomeController extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}


	public function index()
	{		
		//$categories=Category::with('subcategories','products')->get();
		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){})->get();
		$sort="desc";
		$products=Product::with('user')->take(3)->orderBy('created_at',$sort)->get();
		if(Input::get('sort')){
			$sort=Input::get('sort');
			$products=Product::with('user')->take(3)->orderBy('created_at',$sort)->get();
		}else if(Input::get('sale')){
			$sale=Input::get('sale');
			$products=Product::with('user')->take(3)->orderBy('created_at',$sort)->get();
		}
		$cart=Cart::content();
		return view('home.home')->with('categories',$categories)->with('products',$products)->with('cart',$cart);
	}
	public function date_difference(){
		$datetime1 = new DateTime(($variables->dateFrom));
	    $datetime2 = new DateTime(($variables->dateTo));
	    $interval = $datetime1->diff($datetime2);
	    echo $interval->format('%R%a days');
	}
	public function signup(){
		return view('home.signup');
	}
	public function category($slug){
		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){})->get();
		$cart=Cart::content();
		$cat=Category::whereHas('translations', function($q) use ($slug)
		{
		    $q->where('slug', 'like', '%'.$slug.'%');

		})->get();
		$cat_id=$cat->lists('id');
		$products=Product::where('category_id','=',$cat_id)->get();
		return view('home.category')->with('category',$cat)->with('categories',$categories)->with('products',$products)->with('cart',$cart);
	}
	public function subcategory($slug){
		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){})->get();
		$cart=Cart::content();
		$sub=Subcategory::whereHas('translations', function($q) use ($slug)
		{
		    $q->where('slug', 'like', '%'.$slug.'%');

		})->get();
		$sub_id=$sub->lists('id');
		$products=Product::where('subcategory_id','=',$sub_id)->get();
		return view('home.subcategory')->with('subcategory',$sub)->with('categories',$categories)->with('products',$products)->with('cart',$cart);
	}
	public function showproduct($user,$slug){
		$cart=Cart::content();
	 $product=Product::whereHas('translations', function($q) use ($slug)
		{
		    $q->where('slug', 'like', '%'.$slug.'%');

		})->get()->first();
		$cat_id=$product->category_id;
		$productid=$product->id;
		$related=Product::with('user')->whereHas('category', function($q) use ($slug,$cat_id,$productid)
		{
		    $q->where('category_id', 'like', '%'.$cat_id.'%');

		})->whereNotIn('id',[$productid] )->get();
		 $images=$product->images()->get();
		$related=$related->shuffle()->take(4);
		return view('home.view_product')->with('product',$product)->with('related',$related)->with('images',$images)->with('cart',$cart);
	}

	public function contact(){
		$cart=Cart::content();
		return view('home.contact')->with('cart',$cart);
	}
	public function store_contact(){
		$validator=Validator::make(Input::all(),
			array(
				'name'		=>'required',
				'email'			=>'required|email',
				'subject'	=>'required',
				'message' =>'required'
			)
		);
		if($validator->fails())
		{
			return Redirect::route('contact')
				->withErrors($validator);
		}else{
			$name=Input::get('name');
			$email=Input::get('email');
			$subject=Input::get('subject');
			$message=Input::get('message');
			\Mail::send('emails.contact',
	        array(
	            'name' => $name,
	            'email' => $email,
	            'user_message' => $message
	        ), function($message)use($email,$subject)
		    {
		        $message->from($email);
		        $message->to('laravel@shop.ferizajpress.com')->subject($subject);
		    });

  			return \Redirect::route('contact')->with('message', 'Thanks for contacting us!');
		}
	}
	public function shop(){
		$categories=Category::with('translations')->whereHas('products', function($q){})->get();

		$cart=Cart::content();
		$sort="desc";
		$products=Product::orderBy('created_at',$sort)->paginate(6);
		if(Input::get('sort')){
			$sort=Input::get('sort');
			$products=Product::orderBy('created_at',$sort)->paginate(6);
		}else if(Input::get('sale')){
			$sale=Input::get('sale');
			$products=Product::orderBy('price',$sale)->paginate(6);
		}
		
		return view('home.shop')->with('products',$products)->with('categories',$categories)->with('cart',$cart);
	}
	public function user_products($user){
		$cart=Cart::content();
		$user=User::with('products')->where('username', 'like', '%'.$user.'%')->get()->first();
		return view('home.user_products')->with('user',$user)->with('cart',$cart);
	}
}
