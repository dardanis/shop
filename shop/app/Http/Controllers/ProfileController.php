<?php namespace App\Http\Controllers;

use App\Category;
use App\FollowUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Product;
use App\UserFollow;
use Auth;
use Illuminate\Http\Request;
use Input;
use Illuminate\Support\Facades\Redirect;
class ProfileController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user=User::where('id','=',Auth::user()->id)->get()->first();
		$product=Product::where('user_id','=',Auth::user()->id)->get();
		return view('profile.index')->with('user',$user)->with('product',$product);
	}
	public function followingprofile($userid)
	{
		$product=Product::where('user_id','=',$userid)->get();
		$user=User::where('id','=',$userid)->get()->first();
		return view('profile.followingprofile')->with('product',$product)->with('user',$user);
	}

	public function newsfeed(){
		$user=User::where('id','=',4)->get()->first();
		$following=UserFollow::where('follower_user_id','=',4)->get();
		$product = [];
		$sort="desc";
		foreach($following as $f){
			$product = Product::orderBy('created_at', $sort)->where('user_id', '=', $f->follow_user_id)->get();
		}
		return view('newsfeed.index')->with('user',$user)->with('following',$following)->with('product', $product);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	public function follow($userid){


		$follow = new UserFollow();
		$follow->follow_user_id= $userid;
		$follow->follower_user_id=Auth::user()->id;
		if($follow->save()){
			return Redirect::route('followingprofile', array($userid));
		}


	}

	public function myshop(){

		$id=Auth::user()->id;
		$category=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('user_id','=',Auth::user()->id);
		})->get();

           $user=\App\User::find(Auth::user()->id);
                $user_id=$user['id'];
            $typesshop=\App\product_type::where('alias','=',"Shop")->get();
                if(sizeof($typesshop)>0){

					foreach($typesshop as $tsh){
						$type_id=$tsh->id;

					}

			  }
		$toprice="";
		$fromprice="";
		if(isset($_GET['fromprice'])) {
			$fromprice = $_GET['fromprice'];
		}
		if(isset($_GET['toprice'])) {
			$toprice = $_GET['toprice'];
		}
		if(isset($_GET['fromprice']) || isset($_GET['toprice'])){


				$product = \App\Product::whereHas('translations', function ($q) use ($type_id,$fromprice,$toprice) {
					$q->where('type_id', '=', $type_id);
					if($fromprice!="" && $toprice!="") {
						$q->whereBetween('price', [$fromprice, $toprice]);
					}
					if($fromprice!="" && $toprice=="") {
						$q->where('price', '>=', $fromprice);;
					}
					if($fromprice=="" && $toprice!="") {
						$q->where('price', '<=', $fromprice);;
					}

				})->get();
				return view('profile.productlist')->with('category',$category)->with('product',$product);


		}else{
			$product = \App\Product::whereHas('translations', function ($q) use ($type_id,$user_id) {
				$q->where('type_id', '=', $type_id);
			})->get();
			return view('profile.shop')->with('category',$category)->with('product',$product);
		}



	}

	public function productscategory(){


		$category=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('user_id','=',Auth::user()->id);
		})->get();


		$category_id=$_GET['cat_id'];
		$subcategory="";
		if((isset($_GET['subcategory'])) && isset($_GET['subsub'])){
			$subcategory=$_GET['subcategory'];
			echo $subsubcategory=$_GET['subsub'];
			$product = \App\Product::whereHas('translations', function ($q) use ($category_id,$subcategory,$subsubcategory) {
				$q->where('category_id', '=', $category_id);
				$q->where('subcategory_id', '=', $subcategory);
				$q->where('sub_sub_category_id', '=', $subsubcategory);
			})->get();
		} else{
				$product = \App\Product::whereHas('translations', function ($q) use ($category_id) {
					$q->where('category_id', '=', $category_id);
				})->get();
			}
		return view('profile.products_category')->with('category',$category)->with('product',$product);
		}



}
