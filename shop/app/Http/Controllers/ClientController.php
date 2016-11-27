<?php namespace App\Http\Controllers;
use App\Product;
use Auth;
use App\User;
use Validator;
use Input;
use Hash;
use Redirect;
use Config;
use Image;
use App\Category;
class ClientController extends Controller {
	public function index(){
		$user=User::find(Auth::user()->id);
/*		\Stripe\Stripe::setApiKey(Config::get('stripe.secret'));

		\Stripe\Transfer::create(array(
		  "amount" => 400,
		  "currency" => "chf",
		  "destination" => "acct_1765DBEjezzw3b6J",
		  "description" => "Transfer from shop@ch.com"
		));*/
		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();
		return view('new_template.client.pages.dashboard')->with('categories',$categories);
	}
	public function client_products(){
		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();
		$products=Product::with('category','translations')->where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->paginate(2);
		return view('new_template.client.pages.all_products')->with('products',$products)->with('categories',$categories);
	}
    public function profile(){

		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();
       $user=User::where('id','=',Auth::user()->id)->get()->first();
       return view('client.profile')->with('user',$user)->with('categories',$categories);
    }

    public function accounttype(){
    	\Stripe\Stripe::setApiKey("sk_test_e51zYSRqg2Z57Idd1Vm4ujFl");
        $plans=\Stripe\Plan::all()->data;
    	return view('client.accounttype',compact('plans'));
    }
    public function updateaccount($id){
    	$user=User::find($id);
    	if($user){
    		$user->role_id=3;
	        $user->update();
        	return Redirect::route('account_type');
    	}
    	return Redirect::back();
    }
    public function editprofile(){

    	$validator=Validator::make(Input::all(),
			array(
				'name'	=>'required',
				'lastname'=>'required',
				'email'	=>'required|email',
				'username'=>'required'
			)
		);
		if($validator->fails())
		{
			return Redirect::route('myprofile')
				->withErrors($validator);
		}else{
			$user=User::find(AUth::user()->id);
			$username=Input::get('username');
			if(Input::file('profile')){

    			$image = Input::file('profile');
	            $filename  = $username. '-profile.' . $image->getClientOriginalExtension();
	            $path = public_path('img/users/' . $filename);
	            Image::make($image->getRealPath())->save($path);
	            $user->profile='img/users/'.$filename;

	            $avatar=$username.'-avatar.'.$image->getClientOriginalExtension();
	            $avatar_path=public_path('img/users/'.$avatar);
	            Image::make($image->getRealPath())->resize(35,35)->save($avatar_path);
	            $user->avatar='img/users/'.$avatar;
    		}
			$user->name=Input::get('name');
			$user->lastname=Input::get('lastname');
			$user->email=Input::get('email');
			$user->username=$username;
			$user->save();
			return redirect()->back()->with('success', 'Profile updated successfully.');


		}
		
    }
    public function change_password(){
    	$validator=Validator::make(Input::all(),
			array(
				'old_password'		=>'required',
				'password'			=>'required|min:6',
				'password_again'	=>'required|same:password'
			)
		);
		if($validator->fails())
		{
			return Redirect::route('myprofile')
				->withErrors($validator);
		}else{
			$user=User::find(Auth::user()->id);
			$old_password=Input::get('old_password');
			$password=Input::get('password');

			if(Hash::check($old_password,$user->getAuthPassword()))
			{
				$user->password=Hash::make($password);
				$user->save();
				return Redirect::route('myprofile')
					->with('success', 'Your password is changed');
			}else{
				return Redirect::route('myprofile')
					->with('error', 'Your old password is incorrect');
			}
		}
		return Redirect::route('myprofile')
			->with('error', 'Your password  could not be changed');
    }
	public function category_products(){

		return view('products.category_products');
	}

	public function basicdata(){
		return view ('client.basicdata');
	}
}