<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AreaDetails;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Validator;
use Str;
use DB;
use Lang;

class AreaDetailsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$area=AreaDetails::all();
		return view('areadetails.index')->with('type',$area);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('areadetails.form');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$type=new AreaDetails();
		$type->area_name=$_POST['area_name'];
		$type->area_alias=$_POST['area_alias'];
		$type->area_description=$_POST['area_description'];
		if($type->save()) {

			return Redirect::route('areaindex')->with('success','Area Created successfully');
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
		$area= \Illuminate\Support\Facades\DB::table('area_details')->where('area_id', '=',$id)->get();
		return view('areadetails.formupdate')->with('type',$area);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		\Illuminate\Support\Facades\DB::table('area_details')->where('area_id', '=', $id)->delete();
		$type=new AreaDetails();
		$type->area_name=$_POST['area_name'];
		$type->area_alias=$_POST['area_alias'];
		$type->area_description=$_POST['area_description'];
		if($type->save()) {

			return Redirect::route('areaindex')->with('success','Area updated successfully');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function delete_area($area_id)
	{

		DB::table('area_details')->where('area_id', $area_id)->delete();

		return Redirect::route('areaindex')->with('success','Type deleted successfully');
	}
	public function destroy($id)
	{
		//
	}

}
