<?php

namespace App\Billing;

use Stripe\Charge;
use Stripe\Customer;
use Stripe\Error\Card;
use Stripe\Error\InvalidRequest;
use Stripe\Stripe;

class StripeBilling
{

    public function __construct($secret_key)
    {
        Stripe::setApiKey($secret_key);
    }

    public function charge(array $data)
    {
        try {
//            $customer = Customer::create(array(
//                'email' => $data['user_email'],
//                'shipping'  => [
//                    'address' => [
//                        "line1" => $data['address']
//                    ],
//                    'name' => $data['user_name']
//                ],
//                'source' => $data['stripeSource']
//            ));

            Charge::create(array(
//                'customer' => $customer->id,
                'amount'   => $data['amount'],
                'currency' => 'usd',
                'receipt_email' => $data['user_email'],
                'shipping'  => [
                    'address' => [
                        "line1" => $data['address']
                    ],
                    'name' => $data['user_name']
                ],
                'source' => $data['stripeSource']
            ));
        }

        catch (Card | InvalidRequest $e)
        {
            return ['status' => 0, 'msg' => $e->getMessage()];
        }

        return ['status' => 1, 'msg' => 'Success'];

    }
}