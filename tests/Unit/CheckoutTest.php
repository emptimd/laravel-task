<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckoutTest extends TestCase
{

    public function test_stripe_checkout()
    {
        $stripe = resolve('App\Billing\StripeBilling');

        $data = ['address'=>'value','user_email'=>'asd@gmail.com','user_name'=>'bogdan', 'stripeSource' => 'tok_visa', 'amount' => 5000];

        $this->assertEquals(1, $stripe->charge($data)['status']);
    }
}
