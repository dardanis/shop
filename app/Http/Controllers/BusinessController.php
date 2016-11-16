<?php namespace App\Http\Controllers;
use App\Product;
use App\Category;
use App\Subcategory;
use Auth;
use App\User;
use Validator;
use Input;
use Hash;
use Redirect;
use Str;
use Image;
use DB;
use File;
use Activity;
use Lang;
use App\Picture;
class BusinessController extends Controller {


	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		return view('business.dashboard.index');
	}
	public function business_products(){
		$products=Product::with('category','translations')->where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->paginate(10);
		return view('business.products.index')->with('products',$products);
	}
	public function add_product(){
		$category=array();
		$cat=Category::all();
		foreach($cat as $c){
			$category[$c->id]=$c->name;
		}
		return view('business.products.add')->with('categories',$category);
	}
	public function store_product(){
		$locale=Lang::locale();
		$languages=$this->languages();
		foreach($languages as $key=>$l){
			if($l['lang']===$locale){
				unset($languages[$key]);
			}
		}
		$category_id=Input::get('category_id');
		$subcategory_id=Input::get('subcategory_id');
		$input=Input::all();
		$v=Validator::make($input,Product::$rules);

		if ($v->passes()) {
			$product=new Product;
			$product->title=Input::get('title');
			$randomnumber=mt_rand(1,1000);
			$slug=Str::slug(Input::get('title')).'-'.$randomnumber;
			$product->slug=$slug;
			$product->category_id=$category_id;
			$product->subcategory_id=$subcategory_id;
			$product->description=Input::get('description');
			$product->price=Input::get('price');
			$product->user_id=Auth::user()->id;
			$product->sponsored=1;
			$image = Input::file('image');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('img/products/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $product->thumbnail='img/products/'.$filename;

            $thumbnail = Input::file('thumbnail');
            $thumbnail_back  = time() . '.' . $thumbnail->getClientOriginalExtension();
            $path_thumbnail = public_path('img/products/' . $thumbnail_back);
            Image::make($thumbnail->getRealPath())->save($path_thumbnail);
            $product->thumbnail_back='img/products/'.$thumbnail_back;

            $product->lat=Input::get('lat');
            $product->lng=Input::get('lng');
            $product->address=Input::get('address');
			$product->save();

			foreach($languages as $l){
				$langid=$l['id']+1;
				DB::table('product_translations')->insert(array(
				    array(
				    	'title' => Input::get('title'),
				    	'slug' =>$slug,
				    	'description'=>Input::get('description'),
				    	'product_id'=>$product->id,
				    	'locale_id'=>$langid,
				    	'created_at'=>\Carbon\Carbon::now(),
				    	'updated_at'=>\Carbon\Carbon::now()
				    )
				));
			}

			if(Input::hasFile('pics')){
				$pics = Input::file('pics');
	            foreach($pics as $pic) {
		            
		            $filename2 =$pic->getClientOriginalName();
		            $path2 = public_path('img/products/' . $filename2);
		            Image::make($pic->getRealPath())->save($path2);
		            $picture = new Picture;
		            $picture->image='img/products/' . $filename2;
		            $picture->save();
		            $product->images()->attach($picture->id);
	            }
			}
			Activity::log('added new product',Auth::user()->id,'add');

			return Redirect::route('business_products');
		}

		return Redirect::back()->withErrors($v)->withInput(Input::flash());
	}
	public function edit_prod($slug){
	$product=Product::with('images')->whereHas('translations', function($q) use ($slug)
		{
		   $q->where('slug', 'like', '%'.$slug.'%');

		})->get()->first();
		$user_id=$product->user_id;
		if($user_id===Auth::user()->id){
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
			return view('business.products.edit')->with('product',$product)->with('categories',$category)->with('subcategories',$subcategory);
		}else{
			return Redirect::back();
		}
	}
	public function update($id){
		$product=Product::find($id);
		if ($product) {
			$product->title=Input::get('title');
			$product->slug=Str::slug(Input::get('title'));
			$product->category_id=Input::get('category_id');
			$product->subcategory_id=Input::get('subcategory_id');
			$product->description=Input::get('description');
			$product->price=Input::get('price');
			$product->user_id=Auth::user()->id;
			$product->lat=Input::get('lat');
			$product->lng=Input::get('lng');
			$product->address=Input::get('address');
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
			Activity::log('edited product',Auth::user()->id,'edit');
			return Redirect::route('business_products');
    	}
    	return Redirect::back();
	}
	public function delete_product($id){
		$product=Product::with('images')->find($id);
		$thumbnail=$product->thumbnail;
		$images=$product->images;
		if(File::exists(public_path().'/'.$thumbnail)){
			File::Delete(public_path().'/'.$thumbnail);
		}
		
		foreach($images as $im){
			$image=$im->image;
			if(File::exists(public_path().'/'.$image)){
				File::Delete(public_path().'/'.$image);
			}
		}
		Product::find($id)->delete();
		Activity::log('deleted product',Auth::user()->id,'edit');
		return Redirect::route('business_products');
	}

	public function languages(){
		$languages=array();
		$locales=DB::table('locales')->get();
		foreach($locales as $key=>$l){
			$languages[]=array('id'=>$key,'lang'=>$l->language);
		}
		return $languages;
	}
}
