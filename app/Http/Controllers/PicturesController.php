<?php namespace App\Http\Controllers;


use App\Category;
use App\Product;
use App\User;

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
use Lang;
use App\ImageRepository;
use Illuminate\Support\Facades\Input;

class PicturesController extends Controller {

	protected $image;

	public function __construct(ImageRepository $imageRepository)
	{
		$this->image = $imageRepository;
	}

	public function getUpload($slug,$id)
	{

		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();
		$product = Product::with('pictures')->whereHas('translations', function ($q) use ($slug) {
			$q->where('slug', 'like', '%' . $slug . '%');
		})->get()->first();

		return view('pictures.pictures')->with('product', $product)->with('categories',$categories)->with('slug',$slug)->with('id',$id);
	}

	public function postUpload($id)
	{

		$photo = Input::all();
		$response = $this->image->upload($photo,$id);
		return $response;

	}

	public function deleteUpload()
	{

		$filename = Input::get('id');

		if(!$filename)
		{
			return 0;
		}
		$response = $this->image->delete( $filename );
		return $response;
	}

	public function edit($slug,$id){
		$product = Product::with('pictures')->whereHas('translations', function ($q) use ($slug) {
			$q->where('slug', 'like', '%' . $slug . '%');
		})->get()->first();
		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();
		return view('pictures.editpictures')->with('product', $product)->with('categories',$categories)->with('slug',$slug)->with('id',$id);
	}

}
