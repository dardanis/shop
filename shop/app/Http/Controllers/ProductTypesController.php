<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\product_type;
use App\TypeAreaDetails;

use Illuminate\Http\Request;
use Input;
use Redirect;
use Validator;
use Str;
use DB;
use Lang;

class ProductTypesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		$type=product_type::all();
		return view('producttypes.index')->with('type',$type);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('producttypes.form');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$type=new product_type();
		$type->name=$_POST['name'];
		$type->alias=$_POST['alias'];
		$type->sort_order=$_POST['sort_order'];
		$type->header_color=$_POST['header_color'];
		$type->background_color=$_POST['background_color'];
		$type->text_color=$_POST['text_color'];
		if($type->save()) {

			return Redirect::route('typeindex')->with('success','Type Created successfully');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($alias,$id)
	{
		$type = \Illuminate\Support\Facades\DB::table('product_types')->where('id', '=',$id)->get();
		return view('producttypes.formupdate')->with('type',$type);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($alias,$id)
	{
		\Illuminate\Support\Facades\DB::table('product_types')->where('id', '=', $id)->delete();
		$type=new product_type();
		$type->name=$_POST['name'];
		$type->alias=$_POST['alias'];
		$type->sort_order=$_POST['sort_order'];
		$type->header_color=$_POST['header_color'];
		$type->background_color=$_POST['background_color'];
		$type->text_color=$_POST['text_color'];
		if($type->save()) {

			return Redirect::route('typeindex')->with('success','Type updated successfully');
		}
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

	public function delete_type($id)
	{

		product_type::find($id)->delete();
		return Redirect::route('typeindex')->with('success','Type deleted successfully');
	}
	public function areas($alias,$id){

			$type = \Illuminate\Support\Facades\DB::table('product_types')->where('id', '=',$id)->get();
		$areas = \Illuminate\Support\Facades\DB::table('area_details')->get();
		return view('producttypes.areas')->with('areas',$areas)->with('type',$type);
	}
	public function savetypearea($alias,$id){

		foreach($_POST['areaname'] as $key=>$value){

			$typearea=new TypeAreaDetails();
			$typearea->type_id=$id;
			$typearea->area_details_id=$value;
			$typearea->save();


		}
		return Redirect::route('typeindex')->with('success','Type updated successfully');
	}
	public function areasedit($alias,$id){
		$type = \Illuminate\Support\Facades\DB::table('product_types')->where('id', '=',$id)->get();
		$areas = \Illuminate\Support\Facades\DB::table('area_details')->get();
		return view('producttypes.updatearea')->with('areas',$areas)->with('type',$type);
	}

	public function updatetypearea($alias,$id){
		\Illuminate\Support\Facades\DB::table('type_area_details')->where('type_id', '=', $id)->delete();
		foreach($_POST['areaname'] as $key=>$value){

			$typearea=new TypeAreaDetails();
			$typearea->type_id=$id;
			$typearea->area_details_id=$value;
			$typearea->save();


		}
		return Redirect::route('typeindex')->with('success','Type updated successfully');
	}

}
