<?php namespace App\Http\Controllers;
use Validator;
use Input;
use Redirect;
use App\User;
use App\Role;
use Hash;
use Auth;
use Carbon;
use App\Product;
use App\Category;
use App\Subcategory;
use Str;
class AdminController extends Controller {
	public function index(){
		$now = Carbon::now();
		$users=User::all();
		$products=Product::all();
		$weekly=0;
		$productsweekly=0;
		foreach($users as $u){
			$created=$u->created_at;
			$difference=$created->diff($now)->days;
			if($difference<=7){
				$weekly++;
			}
		}
		foreach($products as $p){
			$created2=$p->created_at;
			$difference2=$created2->diff($now)->days;
			if($difference2<=7){
				$productsweekly++;
			}
		}
		$users=User::where('status','=',1)->where('id','!=',Auth::user()->id)->get();
		return view('admin.index')->with('users',$users)->with('weekly',$weekly)->with('productsweekly',$productsweekly);
	}
	public function profile(){
		return view('admin.profile');
	}
	public function users(){
		$users=User::with('role')->where('id','!=',Auth::user()->id)->orderBy('created_at','DESC')->paginate(10);
		return view('admin.users.index')->with('users',$users);
	}
	public function create_users(){
		$roles=array();
		$roles[1]="admin";
		$roles[2]="client";
		$roles[3]="business";
		return view('admin.users.add')->with('roles',$roles);
	}
	public function post_users(){
		$validator=Validator::make(Input::all(),
			array(
				'email'				=>'required|max:50|email|unique:users',
				'name'			=>'required|max:20|min:3|unique:users',
				'password' 			=>'required|min:6',
				'password_confirmation'	=>'required|same:password',
				'role'=>'required'
			)
		);

		if($validator-> fails()){
			return Redirect::route('create_users')
				->withErrors($validator)
				->withInput(Input::flash());
		}else{
			$email		=Input::get('email');
			$username	=Input::get('username');
			$password   =Input::get('password');
			$role_id	=Input::get('role');
			$name=Input::get('name');
			$lastname=Input::get('lastname');
				$user     	=User::create(array(
					'role_id' 	=>$role_id,
					'name'	=>$name,
					'username'=>$username,
					'lastname'=>$lastname,
					'email' 	=>$email,
					'password'	=>Hash::make($password),
					'active'	=>1,

			));

			if($user){
				return Redirect::route('users');
			}

		}
	}
	public function edit_users($username){
		$r=array();
		$roles=Role::all();
		foreach($roles as $r1){
			$r[$r1->id]=$r1->name;
		}
		$user=User::with('role')->where('name','like','%'.$username.'%')->get()->first();
		return view('admin.users.edit')->with('user',$user)->with('roles',$r);
	}
	public function update_user($id){
		$user=User::find($id);
		if ($user) {
			$user->name=Input::get('name');
			$user->lastname=Input::get('lastname');
			$user->email=Input::get('email');
			$user->username=Input::get('username');
			$user->role_id=Input::get('role_id');
			$user->save();
			return Redirect::route('users');
    	}
    	return Redirect::back();
	}
	public function delete_users($id){
		User::find($id)->delete();
		return Redirect::route('users');
	}
	public function products(){
		 $products=Product::with('user','category','translations')->orderBy('created_at','DESC')->paginate(10);
		return view('admin.products.index')->with('products',$products);
	}
	public function product_edit($slug){
		$product=Product::whereHas('translations', function($q) use ($slug)
		{
		   $q->where('slug', 'like', '%'.$slug.'%');

		})->get()->first();
		$category=array();
		$subcategory=array();
		$cat=Category::all();
		foreach($cat as $c){
			$category[$c->id]=$c->name;
		}
		$sub=Subcategory::all();
		foreach($sub as $s){
			$subcategory[$s->id]=$s->name;
		}
		return view('admin.products.edit')->with('product',$product)->with('categories',$category)->with('subcategories',$subcategory);
		
	}
	public function update_product($id){
		$product=Product::find($id);
		if ($product) {
			$product->title=Input::get('title');
			$product->slug=Str::slug(Input::get('title'));
			$product->category_id=Input::get('category_id');
			$product->subcategory_id=Input::get('subcategory_id');
			$product->description=Input::get('description');
			$product->price=Input::get('price');
			$product->user_id=Auth::user()->id;
			if(Input::file('image')){
				File::delete($product->image);
				$image = Input::file('image');
	            $filename  = time() . '.' . $image->getClientOriginalExtension();
	            $path = public_path('img/products/' . $filename);
	            Image::make($image->getRealPath())->resize(784, 438)->save($path);
	            Image::make($image->getRealPath())->resize(270,270)->save($path);
	            $product->image = 'img/products/'.$filename;
	            $product->thumbnail='img/products/'.$filename;
        	}
			$product->save();
			return Redirect::route('admin_products');
    	}
    	return Redirect::back();
	}
	public function clients_users(){
		$users=User::with('role')->where('id','!=',Auth::user()->id)->where('role_id','=','2')->orderBy('created_at','DESC')->paginate(10);
		return view('admin.users.clients')->with('users',$users);
	}
	public function business_users(){
		$users=User::with('role')->where('id','!=',Auth::user()->id)->where('role_id','=','3')->orderBy('created_at','DESC')->paginate(10);
		return view('admin.users.business')->with('users',$users);
	}
}