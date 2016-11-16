<?php namespace App\Http\Controllers;
use App\Category;
use App\Subcategory;
use Input;
use Redirect; 
use Validator;
use Str;
use DB;
class CategoriesController extends Controller {
	public function index(){
		$categories=Category::with('subcategories')->orderBy('created_at','DESC')->paginate(10);
		return view('categories.index')->with('categories',$categories);
	}
	public function add(){
		return view('categories.add');
	}
	public function store(){
		$validator=Validator::make(Input::all(),Category::$rules);

		if($validator->passes()){
			$category=new Category;
			$category->name=Input::get('name');
			$category->slug=Str::slug(Input::get('name'));
			$category->save();

			DB::table('category_translations')->insert(array(
			    array(
			    	'name' => Input::get('name'),
			    	'slug' => Str::slug(Input::get('name')),
			    	'category_id'=>$category->id,
			    	'locale_id'=>'2',
			    	'created_at'=>\Carbon\Carbon::now(),
			    	'updated_at'=>\Carbon\Carbon::now()
			    ),
			    array(
			    	'name' => Input::get('name'),
			    	'slug' => Str::slug(Input::get('name')),
			    	'category_id'=>$category->id,
			    	'locale_id'=>'3',
			    	'created_at'=>\Carbon\Carbon::now(),
			    	'updated_at'=>\Carbon\Carbon::now()
			    ),
			));
			$sub=new Subcategory;
			$sub->name='General';
			$sub->slug=Str::slug('General');
			$sub->category_id=$category->id;
			$sub->save();

			DB::table('subcategory_translations')->insert(array(
			    array(
			    	'name' => 'General',
			    	'slug' => Str::slug('General'),
			    	'subcategory_id'=>$sub->id,
			    	'locale_id'=>'2',
			    	'created_at'=>\Carbon\Carbon::now(),
			    	'updated_at'=>\Carbon\Carbon::now()
			    ),
			    array(
			    	'name' => 'General',
			    	'slug' => Str::slug('General'),
			    	'subcategory_id'=>$sub->id,
			    	'locale_id'=>'3',
			    	'created_at'=>\Carbon\Carbon::now(),
			    	'updated_at'=>\Carbon\Carbon::now()
			    ),
			));

			return Redirect::route('categoriesindex');
		}
		return Redirect::back()->withErrors($validator)->withInput(Input::flash());
	}
	public function edit($slug){
		$cat=Category::whereHas('translations', function($q) use ($slug)
		{
		   $q->where('slug', 'like', '%'.$slug.'%');

		})->get()->first();
		return view('categories.edit')->with('category',$cat)->withInput(Input::flash());	
	}
	public function update($id){
		$cat=Category::find($id);
		if ($cat) {
			$cat->name=Input::get('name');
	        $cat->update();
        	return Redirect::route('categoriesindex');
    	}
    	return Redirect::back();
	}
	public function add_subcategory($slug){
		$cat=Category::whereHas('translations', function($q) use ($slug)
		{
		   $q->where('slug', 'like', '%'.$slug.'%');

		})->get();
		$id=$cat->lists('id');
		return view('categories.subcategories')->with('category',$cat);
	}
	public function store_sub(){
		$validator=Validator::make(Input::all(),Subcategory::$rules);

		if($validator->passes()){
			$sub=new Subcategory;
			$sub->name=Input::get('name');
			$sub->slug=Str::slug(Input::get('name'));
			$sub->category_id=Input::get('cat_id');
			$sub->save();

			DB::table('subcategory_translations')->insert(array(
			    array(
			    	'name' => Input::get('name'),
			    	'slug' => Str::slug(Input::get('name')),
			    	'subcategory_id'=>$sub->id,
			    	'locale_id'=>'2',
			    	'created_at'=>\Carbon\Carbon::now(),
			    	'updated_at'=>\Carbon\Carbon::now()
			    ),
			    array(
			    	'name' => Input::get('name'),
			    	'slug' => Str::slug(Input::get('name')),
			    	'subcategory_id'=>$sub->id,
			    	'locale_id'=>'3',
			    	'created_at'=>\Carbon\Carbon::now(),
			    	'updated_at'=>\Carbon\Carbon::now()
			    ),
			));

			return Redirect::route('categoriesindex');
		}
		return Redirect::back()->withErrors($validator)->withInput(Input::flash());
	}
	public function edit_sub($slug){
		$sub=Subcategory::whereHas('translations', function($q) use ($slug)
		{
		   $q->where('slug', 'like', '%'.$slug.'%');

		})->get()->first();
		return view('categories.sub_edit')->with('sub',$sub)->withInput(Input::flash());
	}
	public function update_sub($id){
		$sub=Subcategory::find($id);
		if ($sub) {
			$sub->name=Input::get('name');
	        $sub->update();
        	return Redirect::route('categoriesindex');
    	}
    	return Redirect::back();
	}
	public function destroy($id){
		$cat=Category::find($id);
		if($cat)
		{
			$cat->delete();
		}
		return Redirect::route('categoriesindex');	
	}
	public function destroy_sub($id){
		$sub=Subcategory::find($id);
		if($sub)
		{
			$sub->delete();
		}
		return Redirect::route('categoriesindex');	
	}
}
