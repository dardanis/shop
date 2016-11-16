<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Config;
use App\User;
use Stripe\Error\ApiConnection;
use Stripe\Error\Authentication;
use Stripe\Error\Base;
use Stripe\Error\Card;
use Stripe\Error\InvalidRequest;
use Exception;


class PaymentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){
        return view('client.charge')->with('id',$id);
    }

    public function store(Request $request)
    {
        $type=$request->get('type');
        $token=$request->input('stripeToken');
        try {
           
            auth()->user()->subscription($type)->create($token);
        } catch(Card $e) {
            return $e->getMessage();
        } catch (InvalidRequest $e) {
            return "An error occurred while processing your payment. Please try again.";
        } catch (Authentication $e) {
            return "An error occurred while processing your payment. Please try again.";
        } catch (ApiConnection $e) {
        } catch (Base $e) {
            return "An error occurred while processing your payment. Please try again.";
        } catch (Exception $e) {
            return "An error occurred while processing your payment. Please try again.";
        }
        

        if(auth()->user()->subscribed()){
            $user=User::find(auth()->user()->id);
            $user->subscription_ends_at=$user->getSubscriptionEndDate();
            $user->role_id=3;
            $user->save();
            return redirect('client/dashboard')->with('success','Your account is upgraded');
        }
    }
   

}