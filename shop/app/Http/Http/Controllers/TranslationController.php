<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\product_type;
use App\Translation;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Validator;
use Str;
use DB;
use Lang;



class TranslationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$translation=Translation::all();
		return view('translation.index')->with('translation',$translation);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('translation.form');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$input = Input::all();
		$v = Validator::make($input, Translation::$rules);
		if ($v->passes()) {
			$translation = new Translation();
			$translation->label = $_POST['label'];
			$translation->description = $_POST['description'];
			$translation->de = $_POST['de'];
			$translation->en = $_POST['en'];
			$translation->fr = $_POST['fr'];
			if ($translation->save()) {

				return Redirect::route('translation_add')->with('success', 'The translation Created successfully');
			}
		}
		else {

			return Redirect::route("translation_add")->with('error', 'The translations already exists!!!');
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
	public function edit($id)
	{
		$translation = \Illuminate\Support\Facades\DB::table('translations')->where('id', '=',$id)->get();
		return view('translation.formupdate')->with('translation',$translation);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		\Illuminate\Support\Facades\DB::table('translations')->where('id', '=', $id)->delete();
		$translation=new Translation();
		$translation->label=$_POST['label'];
		$translation->description=$_POST['description'];
		$translation->de=$_POST['de'];
		$translation->en=$_POST['en'];
		$translation->fr=$_POST['fr'];
		if($translation->save()) {

			return Redirect::route('translationindex')->with('success','Translation updated successfully');
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
	public function delete_translation($id)
	{

		Translation::find($id)->delete();
		return Redirect::route('translationindex')->with('success','Translation row  deleted successfully');
	}

}
