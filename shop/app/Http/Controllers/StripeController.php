<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Config;
use Validator;

class StripeController extends Controller {


	public function __construct()
	{
		\Stripe\Stripe::setApiKey(Config::get('stripe.secret'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function plans()
	{
		$plans=\Stripe\Plan::all();
		return view('admin.plans.index',compact('plans'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function add()
	{
		$interval=[
			'day'=>'Daily',
			'week'=>'Wekly',
			'month'=>'Monthly',
			'year'=>'Yearly',
		];
		return view('admin.plans.add',compact('interval'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$v = Validator::make($request->all(), [
        	'id' => 'required',
	        'name' => 'required',
	        'amount'=>'required',
	        'interval'=>'required'
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }else{
	    	\Stripe\Plan::create(array(
			  "amount" => round($request->get('amount') * 100),
			  "interval" => $request->get('interval'),
			  "name" => $request->get('name'),
			  "currency"=>"chf",
			  "id" => $request->get('id'))
			);
			return redirect('admin/plans')->with('success', 'Plan Added!');
	    }
		
	}

	public function invoices(){
		dd($customers=\Stripe\Customer::all());
		$invoices=\Stripe\Invoice::all();
		return view('admin.invoices.invoices',compact('invoices'));
	}


	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$plan = \Stripe\Plan::retrieve($id);
		return view('admin.plans.edit',compact(['plan']));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$p = \Stripe\Plan::retrieve($id);
		$p->name = $request->get('name');
		$p->save();
		return redirect('admin/plans')->with('success', 'Plan updated!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$plan = \Stripe\Plan::retrieve($id);
		$plan->delete();

		if($plan->deleted==true){
			return redirect('admin/plans')->with('success', 'Plan deleted!');
		}
		return redirect('admin/plans')->with('error', 'Plan not found!');
	}

}
