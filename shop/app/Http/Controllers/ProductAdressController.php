<?php namespace App\Http\Controllers;

use App\ContactInfo;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ProductUserAdress;
use App\User;
use Darryldecode\Cart\Validators\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Auth;
use Redirect;
use App\Product;
use App\ProductAdress;
use Illuminate\Http\Request;
use App\Category;

class ProductAdressController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user=User::find(Auth::user()->id);

		$adress = ProductAdress::where('user_id','=',$user['id'])->get();

		return view('adress.index')->with('adress',$adress);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($slug,$id)
	{
		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();
		$product=Product::find($id);
		return view('adress.create')->with('id',$id)->with('slug',$slug)->with('product',$product)->with('categories',$categories);
	}
	public function createuseradress()
	{
		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();

		return view('adress.useradress')->with('categories',$categories);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($slug,$id)
	{

		$user_id = User::find(Auth::user()->id);
		$input = Input::all();
		if(isset($_POST['name'])){

			$name=$_POST['name'];
		}else {
			$name="";
		}
		if(isset($_POST['gender'])){

			$gender=$_POST['gender'];
		}else {
			$gender="";
		}
		if(isset($_POST['last_name'])){

			$last_name=$_POST['last_name'];
		}else {
			$last_name="";
		}
		if(isset($_POST['activity_site'])){

			$activity_site=$_POST['activity_site'];
		}else {
			$activity_site="";
		}
		if(isset($_POST['profession'])){

			$profession=$_POST['profession'];
		}else {
			$profession="";
		}
		if(isset($_POST['username'])){

			$username=$_POST['username'];
		}else {
			$username="";
		}

		if(isset($_POST['activity_society'])){

			$activity_society=$_POST['activity_society'];
		}else {
			$activity_society="";

		}
		if(isset($_POST['phone'])){
			$phone=$_POST['phone'];
		}else {
			$phone="";
		}
		if(isset($_POST['email'])){
			$email=$_POST['email'];
		}else {
			$email="";
		}

		if(isset($_POST['street'])){
			$street=$_POST['street'];
		}else {
			$street="";
		}
		if(isset($_POST['optional_street'])){
			$optional_street=$_POST['optional_street'];
		}else {
			$optional_street="";
		}
		if(isset($_POST['zip'])){
			$zip=$_POST['zip'];
		}else {
			$zip="";
		}
		if(isset($_POST['location'])){
			$location=$_POST['location'];
		}else {
			$location="";
		}
		if(isset($_POST['payment'])){
			$payment=$_POST['payment'];
		}else {
			$payment="";
		}

		$v = Validator::make($input, ContactInfo::$rules);
		if ($v->passes()) {
			$contactinfo = new ContactInfo();
			$contactinfo->name =$name;
			$contactinfo->gender = $gender;
			$contactinfo->last_name = $last_name;
			$contactinfo->activity_site =$activity_site;
			$contactinfo->profession = $profession;
			$contactinfo->username =$username;
			$contactinfo->activity_society = $activity_society;
			$contactinfo->phone = $phone;
			$contactinfo->email = $email;
			$contactinfo->street = $street;
			$contactinfo->optional_street = $optional_street;
			$contactinfo->zip =$zip;
			$contactinfo->location = $location;
			$contactinfo->payment =$payment;
			$contactinfo->user_id = $user_id['id'];
			$contactinfo->in_products = 1;

			if($contactinfo->save()){
				$adressproduct=Product::find($id);

				if($adressproduct) {
					$adressproduct->adress_id=$contactinfo->id;
					$adressproduct->save();

					return redirect()->back();
				}
			}
		}
	}
	public function storeuseradress()
	{
		$user_id=User::find(Auth::user()->id);
		$adress=new ProductAdress();
		$adress->lat=$_POST['lat'];
		$adress->lon=$_POST['lon'];
		$adress->adress_line=$_POST['adress_line'];
		$adress->web=$_POST['web'];
		$adress->name=$_POST['Name'];
		$adress->mobile=$_POST['mobile'];
		$adress->email=$_POST['email'];
		$adress->tel=$_POST['tel'];
		$adress->user_id=$user_id['id'];
		$findadress = ProductAdress::where('user_id','=',$user_id['id'])->get();
		$adress->default_adress="";
		if(sizeof($findadress)>=1){

			$adress->default_adress=0;
		}else{
			$adress->default_adress=1;
		}


		//$product = Product::find($id);

		if($adress->save()) {
				return Redirect::route('alladresess')->with('success','The Adress is saved successfully');
		}
	}
	public function edit_adress($id){
		$categories=Category::with('translations','subcategories')->whereHas('products', function($q){
			$q->where('status','!=',0);
		})->get();

		return view('adress.edituseradress')->with('categories',$categories)->with('id',$id);
	}

	public function defaultadress($id){
		$user_id=User::find(Auth::user()->id);
		$finduseradress = ProductAdress::where('user_id','=',$user_id['id'])->get();
		foreach($finduseradress as $fua){
			$adress = ProductAdress::find($fua->id);
			$adress->default_adress=0;
			$adress->save();
		}
		$adressdefault=ProductAdress::find($id);
		$adressdefault->default_adress=1;
		$adressdefault->save();
		return Redirect::route('alladresess')->with('success','The Adress is saved successfully');
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
		return view('adress.create')->with('id',$id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		ProductAdress::find($id)->delete();
		return Redirect::route('alladresess')->with('success','The Adress is deleted successfully');
	}

}
