<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Slider;
use App\SliderProducts;
use Redirect;
use Illuminate\Http\Request;

class SliderProductsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$slider=\App\SliderProducts::all();
		return view('sliderproduct.index')->with('slider',$slider);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$products = array();
		$prod = Product::all();
		$prod=Product::with('translations')->get();
		foreach ($prod as $p) {
			$products[$p->id] = $p->title;
		}
		return view('sliderproduct.form')->with('products',$products);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$slider=new \App\SliderProducts();
		$slider->product_id=$_POST['product_id'];
		//$slider->priority==$_POST['priority'];
		if($slider->save()) {

			return Redirect::route('sliderindex')->with('success', 'Slider has been added successfully');
		}else{
			return Redirect::route('sliderindex')->with('error', 'Slider has not been saved successfully');
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
		/*$slider=\App\SliderProducts::where('id','=',$id)->get()->first();
		print_r($slider);
		exit;
		return view('sliderproduct.form')->with('products',$products);*/
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
		SliderProducts::find($id)->delete();

			return Redirect::route('sliderindex')->with('success','Slider deleted successfully');

	}

}
