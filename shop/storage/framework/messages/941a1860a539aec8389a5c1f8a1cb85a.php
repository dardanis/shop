<?php namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\User;
use Input;
use Session;
use Redirect; 
use Validator;
use Image;
use Illuminate\Support\Str;
use Auth;
use App\Subcategory;
use File;
use App\Picture;
use App\Review;
use App;
use DB;
class ProductsController extends Controller {
	public function add(){
		$category=array();
		$cat=Category::all();
		foreach($cat as $c){
			$category[$c->id]=$c->name;
		}
		return view('products.add')->with('categories',$category);
	}
	public function store(){
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
			$image = Input::file('image');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('img/products/' . $filename);
            Image::make($image->getRealPath())->resize(270,270)->save($path);
            $product->thumbnail='img/products/'.$filename;

            $product->lat=Input::get('lat');
            $product->lng=Input::get('lng');
            $product->address=Input::get('address');
			$product->save();

			DB::table('product_translations')->insert(array(
			    array(
			    	'title' => Input::get('title'),
			    	'slug' =>$slug,
			    	'description'=>Input::get('description'),
			    	'product_id'=>$product->id,
			    	'locale_id'=>'2',
			    	'created_at'=>\Carbon\Carbon::now(),
			    	'updated_at'=>\Carbon\Carbon::now()
			    ),
			    array(
			    	'title' => Input::get('title'),
			    	'slug' => $slug,
			    	'description'=>Input::get('description'),
			    	'product_id'=>$product->id,
			    	'locale_id'=>'3',
			    	'created_at'=>\Carbon\Carbon::now(),
			    	'updated_at'=>\Carbon\Carbon::now()
			    ),
			));

			if(Input::hasFile('pics')){
				$pics = Input::file('pics');
	            foreach($pics as $pic) {
		            
		            $filename2 =$pic->getClientOriginalName();
		            $path2 = public_path('img/products/' . $filename2);
		            Image::make($pic->getRealPath())->resize(784, 438)->save($path2);
		            $picture = new Picture;
		            $picture->image='img/products/' . $filename2;
		            $picture->save();
		            $product->images()->attach($picture->id);
	            }
			}
			
			return Redirect::route('client_products');
		}

		return Redirect::back()->withErrors($v)->withInput(Input::flash());
	}
	public function reviews($pid){
		$product=Product::find($pid);
		$slug=$product->slug;
		$user=User::find($product->user_id);
		$username=$user->username;
		$input = array(
		'comment' => Input::get('comment'),
		'rating'  => Input::get('rating')
  		);
  		$validator = Validator::make( $input, Review::$rules);

  		if ($validator->passes()) {
  			$review=new Review;
			$review->storeReviewForPost($id, $input['comment'], $input['rating'],$fotoja);
			return Redirect::to('posts/'.$id.'#reviews-anchor')->with('review_posted',true);
  		}

  		return Redirect::to($username.'/products/'.$slug.'#reviews-anchor')->withErrors($validator)->withInput(Input::flash());
	}

	public function getSecond(){
		$result=array();
		$first = Input::get('first');
	    $sub=Subcategory::where('category_id','=',$first)->get();

	     foreach ($sub as $s) {
	         $result[$s->id] = $s->name ;           
	     }

	     return $result;
	}
	public function edit($slug){
		$product=Product::whereHas('translations', function($q) use ($slug)
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
			return view('products.edit')->with('product',$product)->with('categories',$category)->with('subcategories',$subcategory);
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
			return Redirect::route('client_products');
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
		return Redirect::route('client_products');
	}
}