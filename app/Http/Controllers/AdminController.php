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
use File;
use App\Picture;
use App\Online;
use App\Slider;
use App\Review;
use App\Activity;
use Str;
use Illuminate\Http\Request;
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
		$latestActivities = Activity::with('user')->latest()->limit(20)->get();
		$users=Online::Registered()->get();
		return view('admin.index')->with('users',$users)->with('weekly',$weekly)->with('activities',$latestActivities)->with('productsweekly',$productsweekly);
	}
	public function profile(){
		$user=User::where('id','=',Auth::user()->id)->get()->first();
		return view('admin.profile')->with('user',$user);
	}
	public function users(){
		$users=User::with('role')->where('id','!=',Auth::user()->id)->orderBy('created_at','DESC')->paginate(5);
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
					'profile'=>'img/users/profile.png',
					'avatar'=>'img/users/avatar-mini.png',
					'password'	=>Hash::make($password),
					'active'	=>1,

			));

			if($user){
				return Redirect::route('users')->with('success','User has been created successfully');
			}
			return Redirect::route('users')->with('error','User cannot be created');
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
			return Redirect::route('users')->with('success','User updated successfully');
    	}
    	return Redirect::route('users')->with('error','User cannot be updated');
	}
	public function delete_users($id){
		$user=User::find($id);
		if($user){
			$user->delete();
			return Redirect::route('users')->with('success','User has been deleted');
		}
		return Redirect::route('users')->with('error','User cannot be deleted');
	}
	public function products(){
		$products=Product::with('user','category','translations')->get()->all();
		return view('admin.products.index')->with('products',$products);
	}
	public function product_edit($slug){


		$product=Product::with('images')->whereHas('translations', function($q) use ($slug)
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
	public function add_product(){
		$category=array();
		$cat=Category::all();
		foreach($cat as $c){
			$category[$c->id]=$c->name;
		}
		return view('admin.products.add')->with('categories',$category);
	}

	public function update_product($id){
		$product=Product::find($id);

			if ($product) {
				
				$product->title = Input::get('title');
				$product->slug = Str::slug(Input::get('title'));
				$product->category_id = Input::get('category_id');
				$product->subcategory_id = Input::get('subcategory_id');
				$product->description = Input::get('description');
				$product->price = Input::get('price');
				$product->user_id = Auth::user()->id;
				$product->lat = Input::get('lat');
				$product->lng = Input::get('lng');
				$product->address = Input::get('address');
				$input = Input::all();
				$v = Validator::make($input, Product::$rules);
				if ($v->fails()) {
					return Redirect::back()->withErrors($v)->withInput(Input::flash());
				}
				if (Input::has('image')) {
					File::delete($product->image);
					$image = Input::file('image');
					$filename = time() . '.' . $image->getClientOriginalExtension();
					$path = public_path('img/products/' . $filename);
					Image::make($image->getRealPath())->resize(784, 438)->save($path);
					Image::make($image->getRealPath())->resize(270, 270)->save($path);
					$product->image = 'img/products/' . $filename;
					$product->thumbnail = 'img/products/' . $filename;

				}

				$product->update();
				return Redirect::route('admin_products')->with('succes', 'Product has been updated successfully');
			}

		return Redirect::back()->withErrors($v)->withInput(Input::flash());
	}
	public function delete_product($id){
		$product=Product::with('pictures')->find($id);
		
		if($product){
			$thumbnail=$product->thumbnail;
		  $images=$product->pictures;
			if(File::exists(public_path().'/'.$thumbnail)){
				File::Delete(public_path().'/'.$thumbnail);
			}
			
			foreach($images as $im){
				$image=$im->image;
				if(File::exists(public_path().'/'.$image)){
					File::Delete(public_path().'/'.$image);
				}
			}

			$product->delete();
			return Redirect::route('admin_products')->with('success','Product has been deleted');
		}
		return Redirect::route('admin_products')->with('error','Product cannot be deleted');
	}
	public function spam($id){
		$product=Product::with('user')->find($id);
		if($product){
			$email=$product->user->email;
			$product->status=0;
			$product->save();
			$subject='Malicious Product';
			\Mail::send('emails.malicious',
		        array(
		            'email' => $email,
		            'product'=>$product
		        ), function($message)use($email,$subject)
			    {
			        $message->from('laravel@shop.ferizajpress.com');
			        $message->to($email)->subject($subject);
			    });
			
			return Redirect::route('admin_products')->with('success','Product has been marked as warning');
		}
		return Redirect::route('admin_products')->with('error','Product not found');
	}
	public function approve($id){
		$product=Product::find($id);
		if($product){
			$product->status=1;
			$product->save();
			return Redirect::route('admin_products')->with('success','Product has been approved');
		}
		return Redirect::route('admin_products')->with('error','Product not found');
	}
	public function approvedetails($slug,$id){
		$product=Product::find($id);
		if($product){
			$product->status=1;
			$product->save();
			return Redirect::route('product_show',array($slug,$id))->withSuccess('The Item is approved successfully','The Item is not approved successfully');
		}
		return Redirect::route('product_show',array($slug,$id))->withSuccess('The Item is not approved successfully','The Item is not approved successfully');
	}

	public function clients_users(){
		$users=User::with('role')->where('id','!=',Auth::user()->id)->orderBy('created_at','DESC')->paginate(10);
		return view('admin.users.clients',compact('users'));
	}
	public function business_users(){
		$users=User::with('role')->where('id','!=',Auth::user()->id)->where('role_id','=','3')->orderBy('created_at','DESC')->paginate(10);
		return view('admin.users.business',compact('users'));
	}

	public function filemanager()
	{
		$url = config('medias.url') . '?langCode=' . config('app.locale');

		return view('common.filemanager', compact('url'));

	}
	public function makeadmin($id){
		$user=User::find($id);
		$user->role_id=1;
		$user->save();
		return Redirect::route('client_users')->withSuccess('The User is admin now','The User is admin now');
	}
	public function removeadmin($id){
		$user=User::find($id);
		$user->role_id=2;
		$user->save();
		return Redirect::route('client_users')->withSuccess('The User is removed as admin now','The User is removed as admin now');
	}
	public function receiveemails($id){
		$user=User::find($id);
		$user->receive_emails=1;
		$user->save();
		return Redirect::route('client_users')->withSuccess('The User is assigned to receive emails','The User is assigned to receive emails');
	}

	public function rmvreceiveemails($id){
		$user=User::find($id);
		$user->receive_emails=0;
		$user->save();
		return Redirect::route('client_users')->withSuccess('The User is removed to receive emails','The User is removed to receive emails');
	}
}