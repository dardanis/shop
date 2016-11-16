<?php namespace App\Http\Controllers;
use Redirect;
use App\User;
use App\Product;
use Carbon;
use DB;
use Auth;
class StatsController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function users(){
		$ids=array();
		$now = Carbon::now();
		$users=User::with('role')->get();
		$weeklyusers=0;
		foreach($users as $u){
			$created=$u->created_at;
			$difference=$created->diff($now)->days;
			if($difference<=7){
				$weeklyusers++;
				$ids[]=$u->id;
			}
		}
		$musers=User::with('role')->where('id','!=',Auth::user()->id)->where('created_at', '>=', Carbon::now()->startOfMonth())->orderBy('created_at','DESC')->paginate(10);
		$wusers =User::with('role')->whereIn('id', $ids)->orderBy('created_at','DESC')->paginate(10);
		$all=User::with('role')->whereNotIn('id', array(Auth::user()->id))->orderBy('created_at','DESC')->paginate(10);
		$all_no=$all->count();
		$monthlyusers=$musers->count();
		return view('admin.users.stats')
				->with('wusers',$wusers)
				->with('w_no',$weeklyusers)
				->with('musers',$musers)
				->with('m_no',$monthlyusers)
				->with('ausers',$all)
				->with('a_no',$all_no);
	}
	public function products(){
		$ids=array();
		$now = Carbon::now();
		$products=Product::with('translations')->get();
		$p_no=0;
		foreach($products as $p){
			$created=$p->created_at;
			$difference=$created->diff($now)->days;
			if($difference<=7){
				$p_no++;
				$ids[]=$p->id;
			}
		}
		$w_products=Product::with('user','translations','category')->whereIn('id',$ids)->orderBy('created_at','DESC')->paginate(10);
		$m_products=Product::with('user','translations','category')->where('created_at','>=',Carbon::now()->startOfMonth())->orderBy('created_at','DESC')->paginate(10);
		$monthlyproducts=$m_products->count();
		$allproducts=Product::with('user','translations','category')->orderBy('created_at','DESC')->paginate(10);
		$all=$allproducts->count();
		
		return view('admin.products.products_stats')
				->with('w_products',$w_products)
				->with('p_no',$p_no)
				->with('m_products',$m_products)
				->with('monthlyproducts',$monthlyproducts)
				->with('allproducts',$allproducts)
				->with('all',$all);
	}

}
