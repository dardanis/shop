<?php namespace App\Http\Controllers;

use Exception;
use Stripe\Charge;
use Stripe\Error\ApiConnection;
use Stripe\Error\Authentication;
use Stripe\Error\Base;
use Stripe\Error\Card;
use Stripe\Error\InvalidRequest;
use Stripe\Stripe;
use Config;

class Stripe
{
    public function __construct()
    {
        Stripe::setApiKey(Config::get('stripe.secret'));
    }

    public function charge($amount, $description, $token, $receiptEmail = NULL)
    {
        try {
            $info = [
                'amount' => $amount * 100,
                'currency' => 'usd',
                'description' => $description,
                'card' => $token,
            ];

            if (!is_null($receiptEmail)) {
                $info['receipt_email'] = $receiptEmail;
            }

            Charge::create($info);

            return true;
        } catch(Card $e) {
            return $e->getMessage();
        } catch (InvalidRequest $e) {
            return "An error occurred while processing your payment. Please try again.";
            // Invalid parameters were supplied to Stripe's API
        } catch (Authentication $e) {
            return "An error occurred while processing your payment. Please try again.";
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
        } catch (ApiConnection $e) {
            // Network communication with Stripe failed
        } catch (Base $e) {
            return "An error occurred while processing your payment. Please try again.";
            // Display a very generic error to the user, and maybe send
            // yourself an email
        } catch (Exception $e) {
            return "An error occurred while processing your payment. Please try again.";
            // Something else happened, completely unrelated to Stripe
        }
    }
}