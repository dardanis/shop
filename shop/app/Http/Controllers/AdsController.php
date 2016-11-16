<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdRequest;
use Illuminate\Http\Request;
use App\Advertisment;
use App\AdvertismentTypes;
use App\AdvertismentPosition;
use App\Product;
use Image;
use File;

class AdsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$ads=Advertisment::with('advertisment_types','advertisment_position','user')->where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
		
		return view('new_template.client.pages.ads',compact('ads'));
	}

	public function admin_index(){
		$ads=Advertisment::with('advertisment_types','advertisment_position')->orderBy('id','desc')->get();
		
		return view('admin.ads.index',compact('ads'));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$adtypes=['' => 'Select an Option']+AdvertismentTypes::where('active',1)->lists('name','id');
		$adpositions=['' => 'Select an Option']+AdvertismentPosition::where('active',1)->lists('name','id','image_size');
		$myproducts=Product::with('translations')->where('user_id',auth()->user()->id)->get();
		$products=[''=>'Select an Option'];
		foreach($myproducts as $product){
			$products[$product->id]=$product->title;
		}

		return view('new_template.client.pages.ad_add',compact(['adtypes','adpositions','products']));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateAdRequest $request)
	{
		$type=$request->get('types');
		if($type==1){
			$ad=new Advertisment();
			$ad->name=$request->get('name');
			$ad->type=$request->get('types');
			$ad->product_id=$request->get('product');
			$ad->save();
			return redirect()->action('AdsController@index')->with('success','Ad created');
		}elseif($type==2){
			$ad=new Advertisment();
			$ad->name=$request->get('name');
			$ad->type=$request->get('types');
			$ad->position=$request->get('position');

			$image =$request->file('image');
            $imagename  = time() . '.' . $image->getClientOriginalExtension();
            $path_image = public_path('img/ads/' . $imagename);
            Image::make($image->getRealPath())->save($path_image);
            $ad->image='img/ads/'.$imagename;
			$ad->save();
			return redirect()->action('AdsController@index')->with('success','Ad created');
		}

		return redirect()->action('AdsController@index');
	}

	public function activate($id){
		$ad=Advertisment::find($id);
		if($ad){
			$ad->status=1;
			$ad->save();
			return redirect()->action('AdsController@admin_index')->with('success','Ad activated');
		}
		return redirect()->action('AdsController@admin_index')->with('error','Ad not found');
	}

	public function deactivate($id){
		$ad=Advertisment::find($id);
		if($ad){
			$ad->status=0;
			$ad->save();
			return redirect()->action('AdsController@admin_index')->with('success','Ad deactivated');
		}
		return redirect()->action('AdsController@admin_index')->with('error','Ad not found');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
		$ad=Advertisment::find($id);
		if($ad->type==2){
			if(File::exists(public_path().'/'.$ad->image)){
				File::Delete(public_path().'/'.$ad->image);
			}
		}
		$ad->delete();
		return redirect()->action('AdsController@index')->with('success','Ad deleted');
	}

}
