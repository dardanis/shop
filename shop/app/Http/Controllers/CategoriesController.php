<?php namespace App\Http\Controllers;
use App\Category;

use App\product_type;
use App\Subcategory;
use Input;
use Redirect; 
use Validator;
use Str;
use DB;
use Lang;
use Illuminate\Http\Request;
class CategoriesController extends Controller {
	public function index(Request $request){

		$categories=Category::all();
		return view('admin.categories.index')->with('categories',$categories);
	}

	public function add(){

		$type = array();
		$types = product_type::all();
		foreach ($types as $t) {
			$type[$t->id] = $t->name;
		}
		return view('admin.categories.add')->with('type',$type);;
	}
	public function store(){
		$locale=Lang::locale();
		$languages=$this->languages();

		foreach($languages as $key=>$l){
			if($l['lang']===$locale){
				unset($languages[$key]);
			}
		}

		$default_search_form=0;

		$validator=Validator::make(Input::all(),Category::$rules);

		if($validator->passes()){


			$category=new Category;
			$category->name=Input::get('name');
			$category->type_id=Input::get('type_id');
			$category->slug=Str::slug(Input::get('name'));
			if (isset($_POST['default_search_form'])=="on") {
				$category->default_search_form=1;
			}

			$category->save();

			foreach($languages as $l){
				$langid=$l['id']+1;
				DB::table('category_translations')->insert(array(
			    array(
			    	'name' => Input::get('name'),
			    	'slug' => Str::slug(Input::get('name')),
			    	'category_id'=>$category->id,
			    	'locale_id'=>$langid,
			    	'created_at'=>\Carbon\Carbon::now(),
			    	'updated_at'=>\Carbon\Carbon::now()
			    )
			));
			}
			
			$sub=new Subcategory;
			$sub->name='General';
			$sub->slug=Str::slug('General');
			$sub->category_id=$category->id;
			$sub->save();
			foreach($languages as $l){
				$langid=$l['id']+1;
				DB::table('subcategory_translations')->insert(array(
				    array(
				    	'name' => 'General',
				    	'slug' => Str::slug('General'),
				    	'subcategory_id'=>$sub->id,
				    	'locale_id'=>$langid,
				    	'created_at'=>\Carbon\Carbon::now(),
				    	'updated_at'=>\Carbon\Carbon::now()
				    )
				));
			}

			return Redirect::route('categoriesindex')->with('success','Category has been added successfully');
		}
		return Redirect::back()->withErrors($validator)->withInput(Input::flash());
	}
	public function edit($slug){
		$type = array();
		$types = product_type::all();
		foreach ($types as $t) {
			$type[$t->id] = $t->name;
		}
		$cat=Category::whereHas('translations', function($q) use ($slug)
		{
		   $q->where('slug', 'like', '%'.$slug.'%');

		})->get()->first();
		return view('admin.categories.edit')->with('type',$type)->with('category',$cat)->withInput(Input::flash());
	}
	public function update($id){
		$cat=Category::find($id);
		if ($cat) {
			$cat->name=Input::get('name');
			$cat->type_id=Input::get('type_id');
	        $cat->update();
        	return Redirect::route('categoriesindex')->with('success','Category updated successfully');
    	}
    	return Redirect::route('categoriesindex')->with('success','Category not found');
	}
	public function add_subcategory($slug){
		$category=Category::whereHas('translations', function($q) use ($slug)
		{
		   $q->where('slug', 'like', '%'.$slug.'%');

		})->get()->first();
		$id=$category->lists('id');
		return view('admin.categories.subcategories')->with('category',$category);
	}

	public function add_subsubcategory($categoryname,$subid){

		$category=Subcategory::whereHas('translations', function($q) use ($subid)
		{
			$q->where('subcategory_id', '=', $subid);

		})->get()->first();

		$main_category_id=$category->category_id;

		return view('admin.categories.subsubcategories')->with('category',$category)->with('subid',$subid)->with('subname',$category->name)->with('categoryname',$categoryname)->with('category_id',$main_category_id);
	}




	public function subs($category){
		$cat=Category::with('subcategories')->whereHas('translations', function($q) use ($category)
		{
		   $q->where('slug', 'like', '%'.$category.'%');


		})->get();

		$category_id="";
		$sub=array();
		foreach($cat as $c){
			$category_id= $c->id;
			$sub=Subcategory::whereHas('translations', function($q) use ($category_id)
			{
				$q->where('category_id', '=', $category_id);


			})->get();
		}
		$cname='';

		foreach($cat as $c){
			$cname=$c->name;
		}
		return view('admin.categories.sub_index')->with('cname',$cname)->with('cat',$cat)->with('slug',$category)->with('sub',$sub);
	}

	public function subsubs($category,$id){
		$sub=Subcategory::whereHas('translations', function($q) use ($id)
		{
			$q->where('parent_sub_category_id', '=', $id);

		})->get();
		$subname="";
		foreach($sub as $s){
				$subname=$s->name;
		}
		return view('admin.categories.subsub_index')->with('subid',$id)->with('sub',$sub)->with('subname',$subname)->with('category',$category);
	}

	public function store_sub(){
		$locale=Lang::locale();
		$languages=$this->languages();
		foreach($languages as $key=>$l){
			if($l['lang']===$locale){
				unset($languages[$key]);
			}
		}
		$validator=Validator::make(Input::all(),Subcategory::$rules);
		$sublist=$_POST['name'];

		$cat_slug="";
			if(count($sublist)>0) {
				foreach ($sublist as $il => $key) {
					$cat_id=Input::get('cat_id');
					$cat_s=Category::find($cat_id);
					$cat_slug=$cat_s->slug;
					$sub=new Subcategory;
					$sub->name=$key;
					$sub->slug=Str::slug($key);
					$sub->category_id=$cat_id;
					$sub->save();

					foreach($languages as $l){
						$langid=$l['id']+1;
						DB::table('subcategory_translations')->insert(array(
							array(
								'name' =>$key,
								'slug' => Str::slug($key),
								'subcategory_id'=>$sub->id,
								'locale_id'=>$langid,
								'created_at'=>\Carbon\Carbon::now(),
								'updated_at'=>\Carbon\Carbon::now()
							)
						));
					}
				}



			return Redirect::route('cat_sub',$cat_slug)->with('success','Subcategory added successfully');
		}
		return Redirect::route('cat_sub',$cat_slug)->with('success','Subcategory added successfully');
	}
	public function store_subsub(){
		$locale=Lang::locale();
		$languages=$this->languages();
		foreach($languages as $key=>$l){
			if($l['lang']===$locale){
				unset($languages[$key]);
			}
		}
		$validator=Validator::make(Input::all(),Subcategory::$rules);
		$sublist=$_POST['name'];
		$sub_id=$_POST['sub_id'];
		$category_id= $_POST['category_id'];


			if(count($sublist)>0) {
				foreach ($sublist as $il => $key) {
					$sub=new Subcategory;
					$sub->name=$key;
					$sub->slug=Str::slug($key);
					$sub->category_id=$category_id;
					$sub->parent_sub_category_id=$sub_id;

					if($sub->save()) {
						foreach ($languages as $l) {
							$langid = $l['id'] + 1;
							DB::table('subcategory_translations')->insert(array(
								array(
									'name' => $key,
									'slug' => Str::slug($key),
									'subcategory_id' => $sub->id,
									'parent_sub_category_id' => $sub_id,
									'locale_id' => $langid,
									'created_at' => \Carbon\Carbon::now(),
									'updated_at' => \Carbon\Carbon::now()
								)
							));
						}
					}
				}



			return Redirect::route("cat_subsub",array($category_id,$sub_id))->with('success','Subcategory added successfully');
		}
		return Redirect::back()->withErrors($validator)->withInput(Input::flash());
	}

	public function edit_sub($slug,$id){
		$sub=Subcategory::whereHas('translations', function($q) use ($slug)
		{
		   $q->where('slug', 'like', '%'.$slug.'%');

		})->get()->first();
		return view('admin.categories.sub_edit')->with('sub',$sub)->withInput(Input::flash());
	}
	public function update_sub($id){
		$sub=Subcategory::find($id);
		if ($sub) {
			$sub->name=Input::get('name');
	        $sub->update();
        	return Redirect::route('categoriesindex')->with('success','Subcategory updated successfully');
    	}
    	return Redirect::route('categoriesindex')->with('error','Subcategory not found');
	}
	public function destroy($id){
		$cat=Category::find($id);
		if($cat)
		{
			$cat->delete();
			return Redirect::route('categoriesindex')->with('success','Category deleted successfully');
		}
		return Redirect::route('categoriesindex')->with('error','Category not found');	
		
	}
	public function destroy_sub($id){
		$sub=Subcategory::find($id);
		if($sub)
		{
			$sub->delete();
			return Redirect::route('categoriesindex')->with('success','Subcategory deleted successfully');
		}
		return Redirect::route('categoriesindex')->with('error','Subcategory not found');
	}
	public function destroy_subsub($id){

		$sub=Subcategory::find($id);

		$category_id="";
		$parent_sub_category_id="";
		$category = Subcategory::where('id', '=', $id)->get();
		foreach($category as $c){
			$category_id=$c->category_id;
			$parent_sub_category_id=$c->parent_sub_category_id;
		}
		if(sizeof($sub))
		{
			$sub->delete();
			return Redirect::route("cat_subsub",array($category_id,$parent_sub_category_id))->with('success','Subcategory added successfully');

		}
		return Redirect::route('categoriesindex')->with('error','Subcategory not found');
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
