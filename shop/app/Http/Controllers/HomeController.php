<?php namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\product_type;
use App\ProductAttribute;
use App\Subcategory;
use App\Translation;
use App\User;
use App\Slider;
use Auth;
use ClassPreloader\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Redirect;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Validator;
use Input;
use LaravelGettext;
use Illuminate\Http\Request;
use App\Events\ProductViewCount;
use Event;
class HomeController extends Controller {


	public function shopSearch()
	{
		return view('new_template.client.pages.shopsearch');
	}

	public function travelSearch()
	{
		return view('new_template.client.pages.travelsearch');
	}
	public function myProfile()
	{
		return view('profile.myProfile');
	}

	public function index(Request $request)
	{

	/*	//$bundle = Bundle::name('app');
		$array=Lang::get('app');
		$segments=array();
		foreach($array as $a=>$key){
			$segments = explode('.',Lang::get($key));
			$translationstore = new Translation();


		}

		foreach($segments as $a=>$key){
			echo $a;

			$translationstore->label=$a;
			$translationstore->description=$a
			$translationstore->de=$a;
			$translationstore->fr=$a;
			$translationstore->en=$a;
			$translationstore->save();
		}*/
		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();

		if($request->has('search')){

			$search=$request->get('search');
			$category=$request->get('category');



			$products=Product::whereHas('translations', function($q) use ($search,$category)
			{
				$q->where('title', 'like', '%'.$search.'%');
				$q->where('category_id', '=', $category);

			})->get();


			return view('new_template.client.pages.search',compact(['products','categories','category']));

		}

		$sort="desc";
		$typesshop=product_type::where('alias','=','shop')->get()->first();

		$products=Product::with('user')->take(2)->where('sponsored','!=',1)->where('availability','!=',0)->where('status','!=',0)->where('type_id','=',$typesshop->id)->orderBy('created_at',$sort)->simplePaginate(4);

		$typesevent=product_type::where('alias','=',"event")->get()->first();

		$productsevent=Product::with('user')->take(2)->where('sponsored','!=',1)->where('availability','!=',0)->where('status','!=',0)->where('type_id','=',$typesevent->id)->orderBy('created_at',$sort)->simplePaginate(4);

		$typestravle=product_type::where('alias','=',"travel")->first();

		$productstravel=Product::with('user')->take(2)->where('sponsored','!=',1)->where('availability','!=',0)->where('status','!=',0)->where('type_id','=',$typestravle->id)->orderBy('created_at',$sort)->simplePaginate(4);

		$featured_products=Product::with('user')->take(10)->where('sponsored','!=',0)->where('availability','!=',0)->where('status','!=',0)->orderBy('created_at',$sort)->get();
		$most_viewed_products=Product::with('user')->take(10)->where('status','!=',0)->orderBy('views','desc')->get();

		return view('new_template.client.pages.home',compact([
			'categories',
			'products',
			'productsevent',
			'productstravel',
			'featured_products',
			'slider_products',
			'most_viewed_products']));
	}

	public function shophome(){

		$sort="desc";
		$typesshop=product_type::where('alias','=','shop')->get()->first();
		$products=Product::with('user')->where('sponsored','!=',1)->where('availability','!=',0)->where('status','!=',0)->where('type_id','=',$typesshop->id)->orderBy('created_at',$sort)->simplePaginate(4);

		return view('new_template.client.pages.shophome')->with('products',$products);
	}

	public function travelhome(){
		$sort="desc";
		$typesshop=product_type::where('alias','=','travel')->get()->first();
		$products=Product::with('user')->where('sponsored','!=',1)->where('availability','!=',0)->where('status','!=',0)->where('type_id','=',$typesshop->id)->orderBy('created_at',$sort)->simplePaginate(4);

		return view('new_template.client.pages.travelhome')->with('products',$products);
	}
	public function eventshome(){

		$sort="desc";
		$typesshop=product_type::where('alias','=','event')->get()->first();
		$products=Product::with('user')->where('sponsored','!=',1)->where('availability','!=',0)->where('status','!=',0)->where('type_id','=',$typesshop->id)->orderBy('created_at',$sort)->simplePaginate(4);

		return view('new_template.client.pages.eventshome')->with('products',$products);
	}
	public function magazinehome(){

		$sort="desc";
		$typesshop=product_type::where('alias','=','magazine')->get()->first();
		$products=Product::with('user')->where('sponsored','!=',1)->where('availability','!=',0)->where('status','!=',0)->where('type_id','=',$typesshop->id)->orderBy('created_at',$sort)->simplePaginate(4);

		return view('new_template.client.pages.magazinehome')->with('products',$products);
	}


	public function date_difference(){
		$datetime1 = new DateTime(($variables->dateFrom));
	    $datetime2 = new DateTime(($variables->dateTo));
	    $interval = $datetime1->diff($datetime2);
	    $interval->format('%R%a days');
	}
	public function signup(){
		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();
		return view('new_template.client.pages.signup')->with('categories',$categories);
	}
	public function category($slug){
		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();

		$cat=Category::whereHas('translations', function($q) use ($slug)
		{
		    $q->where('slug', 'like', '%'.$slug.'%');

		})->first();
		$cat_id=$cat->id;
		$products=Product::where('category_id','=',$cat_id)->where('status','!=',0)->paginate(6);
		return view('new_template.client.pages.category')->with('category',$cat)->with('categories',$categories)->with('products',$products);
	}

	public function category_static(){
		return view('home.erotique',compact('cart'));
	}
	public function subcategory($cat_slug,$slug){
		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();

		$cat=Category::whereHas('translations',function($q) use ($cat_slug){
			$q->where('slug','like','%'.$cat_slug.'%');
		})->first();
		$cat_id=$cat->id;
		$sub=Subcategory::whereHas('translations', function($q) use ($slug,$cat_id)
		{
			$q->where('category_id', '=', $cat_id);
		    $q->where('slug', 'like', '%'.$slug.'%');

		})->first();
		$sub_id=$sub->id;
		$products=Product::where('subcategory_id','=',$sub_id)->where('status','!=',0)->paginate(6);
		return view('new_template.client.pages.subcategory')->with('subcategory',$sub)->with('categories',$categories)->with('products',$products);
	}
	public function showproduct($slug,$id){

		$user_id=User::find(Auth::user()->id);

		$user_role = $user_id['role']['name'];

		$productsuser=Product::where('id','=',$id)->where('user_id','=',$user_id['id'])->get();

		if(sizeof($productsuser)>0 || $user_role=="admin") {

			$product = Product::whereHas('translations', function ($q) use ($slug) {
				$q->where('slug', 'like', '%' . $slug . '%');


			})->get()->first();
		}else{
			$product = Product::whereHas('translations', function ($q) use ($slug) {
				$q->where('slug', 'like', '%' . $slug . '%');
				$q->where('status','=',1);

			})->get()->first();
		}
		$user_id="";
		$category=array();
		if(isset($_GET['user_id'])){
			$user_id=$_GET['user_id'];
			$category=Category::with('translations','subcategories')->whereHas('products', function($q) use($user_id){
				$q->where('user_id','=',$user_id);
			})->get();
		}else{
			$user=\App\User::find(Auth::user()->id);
			$user_id=$user['id'];
			$category=Category::with('translations','subcategories')->whereHas('products', function($q){
				$q->where('user_id','=',Auth::user()->id);
			})->get();
		}


		if($product!=null){
			\Event::fire(new ProductViewCount($product));
			$category_id=$product->category_id;
			$productid=$product->product_id;
			$type_id=$product->type_id;

			$related=Product::with('user')->whereHas('category', function($q) use ($slug,$category_id,$productid)
			{
			    $q->where('category_id', 'like', '%'.$category_id.'%');
			    $q->where('status','!=',0);

			})->whereNotIn('id',[$productid] )->get();

			$reviews = \Illuminate\Support\Facades\DB::table('reviews')->where('product_id', '=', $id)->get();

			//$reviews = $product->reviews()->get();

			 //$images=$product->images()->get();
			$images = \Illuminate\Support\Facades\DB::table('images')->where('product_id', '=',$id)->get();
			$categories=Category::with('translations','subcategories')->whereHas('products', function($q){
				$q->where('status','!=',0);
			})->get();
			$product_attributes=ProductAttribute::with('attribute')->whereHas('product', function($q) use ($id)
			{
				$q->where('product_id', '=',$id);

			})->get();

			$product_type = \Illuminate\Support\Facades\DB::table('product_types')->where('id', '=',$type_id)->get();
			foreach($product_type as $pt){
				$type_alias=$pt->alias;
			}

			if($type_alias=="magazine" || $type_alias=="travel" || $type_alias=="event"){
				return view('new_template.client.pages.view_other_types')->with('reviews', $reviews)->with('related',$related)->with('product',$product)->with('id',$id)->with('slug',$slug)->with('images',$images)->with('product_attributes',$product_attributes)->with('categories',$categories)->with('category_id',$category_id)->with('user_role',$user_role)->with('user_id',$user_id);
			}else {
				return view('new_template.client.pages.view_product')->with('reviews', $reviews)->with('related', $related)->with('product', $product)->with('id', $id)->with('slug', $slug)->with('images', $images)->with('product_attributes', $product_attributes)->with('categories', $categories)->with('user_role',$user_role)->with('user_id',$user_id)->with('category',$category);

			}
			}else{
			return view('errors.404');
		}

	}

	public function contact(){
		return view('new_template.client.pages.contact');
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
	public function shop(Request $request){

		$categories=Category::with('translations')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();

		$sort=$request->has('sort')?$request->get('sort'):"desc";
		$max_perpage=30;
		$perpage=$request->has('perpage')?$request->get('perpage'):6;
		if($perpage>30){
			$perpage=6;
		}

		$products=Product::orderBy('created_at',$sort)->where('status','!=',0)->paginate($perpage);

		if($request->has('sort')){
			$products=Product::orderBy('created_at',$request->get('sort'))->where('status','!=',0)->paginate($perpage);
		}else if($request->has('sale')){
			$products=Product::orderBy('price',$request->get('sale'))->where('status','!=',0)->paginate($perpage);
		}

		return view('new_template.client.pages.shop')->with('products',$products)->with('categories',$categories);
	}
	public function echange(){
		$categories=Category::with('translations')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();
		$sort="desc";
		$products=Product::orderBy('created_at',$sort)->where('status','!=',0)->paginate(6);
		if(Input::get('sort')){
			$sort=Input::get('sort');
			$products=Product::orderBy('created_at',$sort)->where('status','!=',0)->paginate(6);
		}else if(Input::get('sale')){
			$sale=Input::get('sale');
			$products=Product::orderBy('price',$sale)->where('status','!=',0)->paginate(6);
		}

		return view('new_template.client.pages.echange')->with('products',$products)->with('categories',$categories);
	}

	public function encheres(){
		$categories=Category::with('translations')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();
		$sort="desc";
		$products=Product::orderBy('created_at',$sort)->where('status','!=',0)->paginate(6);
		if(Input::get('sort')){
			$sort=Input::get('sort');
			$products=Product::orderBy('created_at',$sort)->where('status','!=',0)->paginate(6);
		}else if(Input::get('sale')){
			$sale=Input::get('sale');
			$products=Product::orderBy('price',$sale)->where('status','!=',0)->paginate(6);
		}

		return view('new_template.client.pages.encheres')->with('products',$products)->with('categories',$categories);
	}

	public function user_products($user){
		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();
		$user=User::where('username', 'like', '%'.$user.'%')->whereHas('products',function($q){
		})->get()->first();
		if($user!=null){
			return view('new_template.client.pages.user_products',compact('user','categories'));
		}else{
			return view('errors.404');
		}
	}
	public function userdashboard(){
		$categories=Category::with('translations')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();
		return view('common.dashboard')->with('categories',$categories);
	}


	public function pagetype($alias){

        $type_id="";
		$category_id="";
		$type_alias="";
		$sub=array();
		foreach(Lang::get("app") as $label){
			$translation= \Illuminate\Support\Facades\DB::table('translations')->where('label', '!=',$label)->get();
		}

			$categories = Category::whereHas('translations', function ($q) use ($alias) {
				$q->where('slug', 'like', '%' . $alias . '%');

			})->get();
			foreach($categories as $c){
				$type_id=$c->type_id;
				$category_id=$c->category_id;
			}
			$product_type=$images = \Illuminate\Support\Facades\DB::table('product_types')->where('id', '=',$type_id)->get();
		foreach($product_type as $pt){
			$type_alias=$pt->alias;
		}

			$sort = "desc";

			foreach ($categories as $tn) {
				$tname = $tn->name;
				$category_id = $tn->id;

				$sub = Subcategory::whereHas('translations', function ($q) use ($category_id) {
					$q->where('category_id', 'like', '%' . $category_id . '%');

				})->get();

			}

			$products = Product::orderBy('created_at', $sort)->where('category_id', '=', $category_id)->paginate(6);

		if($type_alias=="magazine" ||$type_alias=="travel" || $type_alias=="event"){
			return view('new_template.client.pages.magazine',compact('alias','categories','category_id'));
		}
		else{
			$products1 = Product::orderBy('created_at', $sort)->where('category_id', '=', $category_id)->get();
			return view('new_template.client.pages.pagetype',compact('alias','products1','sub','tname','partition'));
		}

	}

	public function pageSubcategories($category,$alias){


		$categories=Subcategory::whereHas('translations', function($q) use ($alias)
		{
			$q->where('slug', 'like', '%'.$alias.'%');

		})->get();


		$sort="desc";
		$products=array();
		foreach($categories as $tn){
			 $tname=$tn->name;
			 $category_id=$tn->id;
			$products=Product::orderBy('created_at',$sort)->where('subcategory_id','=',$category_id)->paginate(6);
		}


		return view('new_template.client.pages.subcategories',compact('alias','products','categories','tname'));
	}
	public function pagenocategories($no,$category,$alias){


		$types = \Illuminate\Support\Facades\DB::table('product_types')->where('alias', '=',$alias)->get();


		$sort="desc";
		$products=array();
		foreach($types as $tn){
			$tname=$tn->name;
			$type_id=$tn->id;
			$products=Product::orderBy('created_at',$sort)->where('type_id','=',$type_id)->paginate(6);
		}


		return view('new_template.client.pages.pagenocategories',compact('alias','products','types','tname'));
	}
}
