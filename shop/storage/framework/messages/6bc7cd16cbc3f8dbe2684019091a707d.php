<?php namespace App\Http\Controllers;
use App\Product;
use Auth;
use App\User;
use Validator;
use Input;
use Hash;
use Redirect;
class ClientController extends Controller {
	public function index(){
		return view('client.dashboard');
	}
	public function client_products(){
		$products=Product::with('category','translations')->where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->paginate(10);
		return view('client.index')->with('products',$products);
	}
    public function profile(){
       $user=User::where('id','=',Auth::user()->id)->get()->first();   
       return view('client.profile')->with('user',$user);
    }
    public function accounttype(){
    	return view('client.accounttype');
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
			$user=User::find(AUth::user()->id);
			$name=Input::get('name');
			$lastname=Input::get('lastname');
			$email=Input::get('email');
			$username=Input::get('username');
			$old_password=Input::get('old_password');
			$password=Input::get('password');
			if(Hash::check($old_password,$user->getAuthPassword()))
			{
				$user->name=$name;
				$user->lastname=$lastname;
				$user->email=$email;
				$user->username=$username;
				$user->password=Hash::make($password);
				if($user->save()){
					return Redirect::route('myprofile')
						->with('global', 'Your password has been  changed');
				}
			}else{
				return Redirect::route('myprofile')
					->with('global', 'Your old password is incorrect');
			}
		}
		return Redirect::route('myprofile')
			->with('global', 'Your password  could not be changed');
    }
}