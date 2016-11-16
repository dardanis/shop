<?php namespace App\Http\Controllers;

use App\attributes_translations;
use App\Attribute;
use App\AttributesList;
use App\Category;
use App\GroupFormNaming;
use App\Http\Requests;
use App\Product;
use App\ProductAttribute;
use App\Subcategory;
use Input;
use Redirect;
use Validator;
use Str;
use DB;
use Lang;

class AttributesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($slug,$id)
	{

		$attributes=Attribute::where('category_id','=',$id)->get();
		$cat=Category::find($id);
		return view('attributes.index')->with('attributes',$attributes)->with('category',$cat);
	}
	public function indexsub($slug,$id)
	{

		$attributes=Attribute::where('sub_category_id','=',$id)->get();
		$sub=Subcategory::whereHas('translations', function($q) use ($id)
		{
			$q->where('subcategory_id', '=', $id);

		})->get()->first();
		return view('attributes.indexsubcat')->with('attributes',$attributes)->with('sub',$sub);
	}

	public function languages(){
		$languages=array();
		$locales=DB::table('locales')->get();
		foreach($locales as $key=>$l){
			$languages[]=array('id'=>$key,'lang'=>$l->language);
		}
		return $languages;
	}
	public function create($slug,$id)
	{
		$cat=Category::find($id);
		$sub= Subcategory::where('category_id', '=', $id)->get();
		$subcategories = array();
		foreach ($sub as $c) {
			$subcategories[$c->id] = $c->name;
		}
		$subcategory=Subcategory::whereHas('translations', function($q) use ($slug)
		{
			$q->where('slug', 'like', '%'.$slug.'%');

		})->get()->first();
		$group = GroupFormNaming::where('category_id', '=', $id)->get();

		$groupname=array();
		foreach ($group as $c) {
			$groupname[$c->id] = $c->group_name;
		}

		return view('attributes.create')->with('category',$cat)->with('subcategories',$subcategories)->with('subcategory',$subcategory)->with('group_name',$groupname);
	}
	public function createsubcat($slug,$id)
	{


		$sub=Subcategory::whereHas('translations', function($q) use ($id)
		{
			$q->where('subcategory_id', '=', $id);

		})->get()->first();

		echo $category_id=$sub->category_id;

		$group = GroupFormNaming::where('category_id','=',$category_id)->get();

		$groupname=array();
		foreach ($group as $c) {
			$groupname[$c->id] = $c->group_name;
		}
		return view('attributes.createsubcat')->with('sub',$sub)->with('id',$id)->with('group_name',$groupname);
	}
	public function createrelated($slug,$id)
	{
		$cat=Category::find($id);
		$sub= Subcategory::where('category_id', '=', $id)->get();
		$subcategories = array();
		foreach ($sub as $c) {
			$subcategories[$c->id] = $c->name;
		}
		return view('attributes.createrelated')->with('category',$cat)->with('subcategories',$subcategories);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

	public function storesubcat($slug,$id)
	{

		$sub=Subcategory::whereHas('translations', function($q) use ($id)
		{
			$q->where('subcategory_id', '=', $id);

		})->get()->first();
		$category_id= $sub->category_id;

		if (Input::has('edit_add_item'))
		{
			$EdittAttributesAdd=Attribute::find($_POST['edit_add_item']);

			foreach($EdittAttributesAdd as $ea) {
				foreach ($_POST["attribute_item_$ea->id"] as $a=>$key) {
					$EdittAttributesAdd1 = new AttributesList();
					$EdittAttributesAdd1->item_value = $key;
					$EdittAttributesAdd1->parent_attribute_id = $ea->id;
					$EdittAttributesAdd1->save();
				}
			}

		}

		$validator=Validator::make(Input::all(),Attribute::$rules);

		if(Input::has('attribute_item')){
			$itemlist=$_POST['attribute_item'];
			$EdittAttributesList=AttributesList::find($_POST['attribute_item']);

			foreach($EdittAttributesList as $eal){
				$EdittAttributesList1=AttributesList::find($eal->id);
				$EdittAttributesList1->item_value=$_POST["attribute_item_edit_$eal->id"];
				$EdittAttributesList1->update();
			}
		}
		if (Input::has('id'))
		{

			$EdittAttributes=Attribute::find($_POST['id']);
			foreach($EdittAttributes as $ea){
				$sub1=Attribute::find($ea->id);
				$sub1->name=$_POST["edit_attribute_name_$ea->id"];
				$sub1->data_type=$_POST["data_type_$ea->id"];
				$sub1->gui_type=$_POST["gui_type_$ea->id"];

				$sub1->update();
			}

		}
		if(Input::get('name')!="") {

			$attributes = new attribute();
			$attributes->category_id = $category_id;
			$attributes->name = Input::get('name');
			$attributes->data_type = Input::get('data_type');
			$attributes->gui_type = Input::get('gui_type');
			$attributes->group_id = Input::get('group_id');
			$attributes->sub_category_id = $id;
			$attributes->related=Input::get('related');
			$attributes->save();
			if(count($itemlist)>1) {
				foreach ($itemlist as $il => $key) {
					$attribute_item = new AttributesList();
					$attribute_item->parent_attribute_id = $attributes->id;
					$attribute_item->item_value = $key;
					$attribute_item->save();
				}
			}

		}
		return Redirect::route('indexsubattributes',array($slug,$id))->with('success', 'Atrributes has edited successfully');

	}

	public function store($slug,$id)
	{
		if (Input::has('edit_add_item'))
		{
			$EdittAttributesAdd=Attribute::find($_POST['edit_add_item']);

			foreach($EdittAttributesAdd as $ea) {
				foreach ($_POST["attribute_item_$ea->id"] as $a=>$key) {
					$EdittAttributesAdd1 = new AttributesList();
					$EdittAttributesAdd1->item_value = $key;
					$EdittAttributesAdd1->parent_attribute_id = $ea->id;
					$EdittAttributesAdd1->save();
				}
			}

		}

		$validator=Validator::make(Input::all(),Attribute::$rules);

		if(Input::has('attribute_item')){
			$itemlist=$_POST['attribute_item'];
			$EdittAttributesList=AttributesList::find($_POST['attribute_item']);

		    foreach($EdittAttributesList as $eal){
				$EdittAttributesList1=AttributesList::find($eal->id);
				$EdittAttributesList1->item_value=$_POST["attribute_item_edit_$eal->id"];
				$EdittAttributesList1->update();
			}
		}
		if (Input::has('id'))
	{

		$EdittAttributes=Attribute::find($_POST['id']);
		foreach($EdittAttributes as $ea){
			$sub1=Attribute::find($ea->id);
			$sub1->name=$_POST["edit_attribute_name_$ea->id"];
			$sub1->data_type=$_POST["data_type_$ea->id"];
			$sub1->gui_type=$_POST["gui_type_$ea->id"];
			$sub1->update();
		}

	}
			if(Input::get('name')!="") {

				$attributes = new attribute();
				$attributes->category_id = $id;
				$attributes->name = Input::get('name');
				$attributes->data_type = Input::get('data_type');
				$attributes->gui_type = Input::get('gui_type');
				$attributes->group_id = Input::get('group_id');
				$attributes->sub_category_id = Input::get('sub_category_id');
				$attributes->related=Input::get('related');
				$attributes->save();
					if(count($itemlist)>1) {
						foreach ($itemlist as $il => $key) {
							$attribute_item = new AttributesList();
							$attribute_item->parent_attribute_id = $attributes->id;
							$attribute_item->item_value = $key;
							$attribute_item->save();
						}
					}

			}
		return Redirect::route('indexattributes',array($slug,$id))->with('success', 'Atrributes has edited successfully');

	}
	public function editattributes($slug,$id)
	{
		if (Input::has('edit_add_item'))
		{
			$EdittAttributesAdd=Attribute::find($_POST['edit_add_item']);

			foreach($EdittAttributesAdd as $ea) {
				foreach ($_POST["attribute_item_$ea->id"] as $a=>$key) {
					$EdittAttributesAdd1 = new AttributesList();
					$EdittAttributesAdd1->item_value = $key;
					$EdittAttributesAdd1->parent_attribute_id = $ea->id;
					$EdittAttributesAdd1->save();
				}
			}
		}
		$validator=Validator::make(Input::all(),Attribute::$rules);

		if(Input::has('attribute_item')){
			$EdittAttributesList=AttributesList::find($_POST['attribute_item']);

			foreach($EdittAttributesList as $eal){
				$EdittAttributesList1=AttributesList::find($eal->id);
				$EdittAttributesList1->item_value=$_POST["attribute_item_edit_$eal->id"];
				$EdittAttributesList1->update();
			}
		}
		if (Input::has('id'))
		{

			$EdittAttributes=Attribute::find($_POST['id']);
			foreach($EdittAttributes as $ea){
				$sub1=Attribute::find($ea->id);
				$sub1->name=$_POST["edit_attribute_name_$ea->id"];
				$sub1->data_type=$_POST["data_type_$ea->id"];
				$sub1->gui_type=$_POST["gui_type_$ea->id"];
				$sub1->update();
			}

		}
		if(Input::get('name')!="") {

			$attributes = new attribute();
			$attributes->category_id = $id;
			$attributes->name = Input::get('name');
			$attributes->data_type = Input::get('data_type');
			$attributes->gui_type = Input::get('gui_type');
			$attributes->sub_category_id = Input::get('sub_category_id');
			$attributes->save();
			if(count($itemlist)>1) {
				foreach ($itemlist as $il => $key) {
					$attribute_item = new AttributesList();
					$attribute_item->parent_attribute_id = $attributes->id;
					$attribute_item->item_value = $key;
					$attribute_item->save();
				}
			}

		}
		return Redirect::route('addattributes',array($slug,$id))->with('success', 'Atrributes has been added successfully');

	}

	public function relate($slug,$id){
	$mainid= Input::get('mainattribute');
		//echo (count(Input::get('relateditem')));
		foreach(Input::get('relateditem') as $pi=>$key){
			$attributerelate = AttributesList::find($key);
			$attributerelate->related_item_id=$mainid;
			$attributerelate->save();
		}
		return Redirect::route('addrelatedattributes',array($slug,$id))->with('success', 'Atrributes has been related successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}

	public function edit($id)
	{
		$cat=array();
		$attr1= Attribute::where('id', '=', $id)->get();
		foreach($attr1 as $att1){
			$cat=Category::find($att1->category_id);
		}

		$sub= Subcategory::where('category_id', '=', $id)->get();
		$subcategories = array();
		foreach ($sub as $c) {
			$subcategories[$c->id] = $c->name;
		}
		return view('attributes.edit')->with('category',$cat)->with('subcategories',$subcategories)->with('id',$id);
	}
	public function editsub($id)
	{

		$cat=array();
		$attr1= Attribute::where('id', '=', $id)->get();

		foreach($attr1 as $att1){
			$subcategoryid=$att1->sub_category_id;
		}

		$sub=Subcategory::whereHas('translations', function($q) use ($subcategoryid)
		{
			$q->where('subcategory_id', '=', $subcategoryid);

		})->get()->first();
		return view('attributes.editsubcat')->with('sub',$sub)->with('id',$id);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function product_attributes($slug,$id){


		$product = Product::with('category')->find($id);
		$attributes = \Illuminate\Support\Facades\DB::table('attributes')->where('category_id', '=', $product->category_id)->get();
		$attributes_lists=array();
		foreach($attributes as $a){
			$attributes_lists = \Illuminate\Support\Facades\DB::table('attributes_lists')->where('parent_attribute_id', '=', $a->id)->get();

		}
		$product_attributes = \Illuminate\Support\Facades\DB::table('product_attributes')->where('product_id', '=',$id)->get();
		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();
		return view('attributes.product_attributes')->with('attributes', $attributes)->with('attributes_lists',$attributes_lists)->with('product_attributes',$product_attributes)->with('id',$id)->with('slug',$slug)->with('product',$product)->with('categories',$categories);
	}


	public function add_p($slug,$id){
		\Illuminate\Support\Facades\DB::table('product_attributes')->where('product_id', '=', $id)->delete();
		$inputs = Input::get();
		$radio=Input::get('radio_attribute');
		$checkbox=Input::get('checkbox_attribute');


		$select_attribute=Input::get('select_attribute');
		$textbox=Input::get('text_attribute');
		$hidden_checkbox_attribute=Input::get('hidden_checkbox_attribute');
		if(count($radio)>0) {

			foreach ($inputs['radio_attribute'] as $attributeradio => $result) {
				$attributes = new ProductAttribute();
				$attributes->value = $result;
				$attributes->attribute_id = $attributeradio;
				$attributes->product_id = $id;
				$attributes->save();
			}
		}

		if(count($select_attribute)>0){
			foreach($inputs['select_attribute'] as $attributeselect=>$resultselect){
				$attributes=new ProductAttribute();
				$attributes->value=$resultselect;
				$attributes->attribute_id=$attributeselect;
				$attributes->product_id=$id;
				$attributes->save();
			}
		}
		if(count($textbox)>0) {
			foreach ($inputs['text_attribute'] as $attributetext => $result) {
				$attributes = new ProductAttribute();
				$attributes->value = $result;
				$attributes->attribute_id = $attributetext;
				$attributes->product_id = $id;
				$attributes->save();
			}
		}
		if(count($checkbox)>0){
		$rows=count($checkbox);
			foreach($checkbox as $chk=>$key) {
				if(!empty($key)) {
					foreach ($key as $a) {
						$attributes = new ProductAttribute();
						$attributes->value =$a;
						$attributes->attribute_id =$_POST["hidden_checkbox_attribute"][$chk]['attribute_id'];
						$attributes->product_id = $id;
						$attributes->save();
					}
				}
			}
		}
		if(isset($_GET['template'])){
			return Redirect::route('product_show',array($slug,$id."?template=secondsteptemplate#attributes_tabs"))->withSuccess('The Item is saved successfully','The Item is saved successfully');
		}
		else {
			return Redirect::route('getimages', array($slug, $id))->with('success', 'Atrributes has been added successfully');
		}
	}

	public function delete_attributes($attribute_id){

		$cat=array();

		$attr1= Attribute::where('id', '=', $attribute_id)->get();

		foreach($attr1 as $att1){

			$cat=Category::find($att1->category_id)->get();
		}
		foreach($cat as $c){
			$slug=$c['slug'];
			$id=$c['id'];
		}

		\Illuminate\Support\Facades\DB::table('attributes_lists')->where('parent_attribute_id', '=', $attribute_id)->delete();
		\Illuminate\Support\Facades\DB::table('attributes')->where('id', '=', $attribute_id)->delete();
		return Redirect::route('indexattributes',array($slug,$id))->with('category',$cat)->with('success', 'Atrributes has been added successfully');
	}
	public function delete_subattributes($slug,$id){
		$attribute_id=$_GET["attribute_id"];
		\Illuminate\Support\Facades\DB::table('attributes_lists')->where('id', '=', $attribute_id)->delete();
		return Redirect::route('indexattributes',array($slug,$id))->with('success', 'item from attribute has been removed successfully');

	}
	public function delete_relatedattribute($slug,$id){
		$attribute_id=$_GET["attribute_id"];
		$removerelated=AttributesList::find($attribute_id);
		$removerelated->related_item_id=0;
		$removerelated->save();
		return Redirect::route('indexattributes',array($slug,$id))->with('success', 'item from attribute has been removed successfully');
	}
	public function findattributeitem(){
		$attribute_id=$_GET['attributeitem'];

		$sub = AttributesList::where('item_value', '=', $attribute_id)->get();
		foreach($sub as $s){
			$sub1 = AttributesList::where('related_item_id', '=', $s->id)->get();
		}
		foreach ($sub1 as $s) {
			$result[$s->item_value] = $s->item_value;
		}

		return $result;
	}
	public function searchattributes()
	{

		$attributes = \Input::get('attributes');
		$fromprice="";
		$toprice="";
		if ($_GET['fromprice'] != "") {
			$fromprice=$_GET['fromprice'];
		}
		if ($_GET['toprice'] != "") {
			$toprice=$_GET['toprice'];
		}


		$category_id=$_GET['category'];
		$product=array();
		$subcategory="";
		$subsub="";
		$productattributes=array();
		if(sizeof($attributes)==0){
			if ($_GET['subcategory'] != "") {

				$subcategory = $_GET['subcategory'];

			}
			if ($_GET['subsub'] != "") {
				$subsub = $_GET['subsub'];
			}
			$product = \App\Product::whereHas('translations', function ($q) use ($fromprice,$category_id,$subcategory,$subsub,$toprice) {
				$q->where('category_id', '=', $category_id);
				if($subcategory!=""){
					$q->where('subcategory_id', '=', $subcategory);
				}
				if($subsub!=""){
					$q->where('sub_sub_category_id', '=', $subsub);
				}
				if($fromprice!="" && $toprice!=""){
					$q->whereBetween('price', [$fromprice, $toprice]);
				}	else if($fromprice!="" && $toprice==""){
					$q->where('price', '>=',$fromprice);
				}else if($fromprice=="" && $toprice!="") {
					$q->where('price', '<=',$toprice);
				}

			})->get();
		} else if(sizeof($attributes)>0){

			foreach($attributes as $a){
				$productattributes= ProductAttribute::where('value', '=', $a)->get();
			}

			if($_GET['subcategory']!="" && $_GET['subsub']!=""){
				$subcategory=$_GET['subcategory'];
				$subsub=$_GET['subsub'];
				foreach($productattributes as $pa){
					$product_id[]=$pa->product_id;

					$product= \App\Product::whereHas('translations', function ($q) use ($category_id,$subcategory,$product_id,$subsub,$fromprice,$toprice) {
						$q->where('category_id', '=', $category_id);
						$q->where('subcategory_id', '=', $subcategory);

						$q->where('sub_sub_category_id', '=', $subsub);
						if($fromprice!="" && $toprice!=""){
							$q->whereBetween('price', [$fromprice, $toprice]);
						}	else if($fromprice!="" && $toprice==""){
							$q->where('price', '>=',$fromprice);
						}else if($fromprice=="" && $toprice!="") {
							$q->where('price', '<=',$toprice);
						}
						$q->whereIn('product_id',$product_id);
					})->get();


				}

			}
			else if($_GET['subcategory']!="" && $_GET['subsub']==""){
				$subcategory=$_GET['subcategory'];
				$subsub=$_GET['subsub'];
				foreach($productattributes as $pa){
					$product_id[]=$pa->product_id;

					$product= \App\Product::whereHas('translations', function ($q) use ($category_id,$subcategory,$product_id,$subsub,$fromprice,$toprice) {
						$q->where('category_id', '=', $category_id);
						$q->where('subcategory_id', '=', $subcategory);

						$q->where('sub_sub_category_id', '=', $subsub);
						if($fromprice!="" && $toprice!=""){
							$q->whereBetween('price', [$fromprice, $toprice]);
						}	else if($fromprice!="" && $toprice==""){
							$q->where('price', '>=',$fromprice);
						}else if($fromprice=="" && $toprice!="") {
							$q->where('price', '<=',$toprice);
						}
						$q->whereIn('product_id',$product_id);
					})->get();


				}

			}
			else {
				foreach($productattributes as $pa){
					$product_id[]=$pa->product_id;
					$product = \App\Product::whereHas('translations', function ($q) use ($category_id,$product_id,$fromprice,$toprice) {
						$q->where('category_id', '=', $category_id);
						if($fromprice!="" && $toprice!=""){
							$q->whereBetween('price', [$fromprice, $toprice]);
						}	else if($fromprice!="" && $toprice==""){
							$q->where('price', '>=',$fromprice);
						}else if($fromprice=="" && $toprice!="") {
							$q->where('price', '<=',$toprice);
						}
						$q->whereIn('product_id',$product_id);
					})->get();
				}


			}
		}


		return view('profile.productlist')->with('product', $product);

	}

}
