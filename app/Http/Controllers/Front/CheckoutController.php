<?php

namespace App\Http\Controllers\Front;

use App\Billing\StripeBilling;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderCompleted;
use App\Mail\OrderFailed;
use App\Models\Order;

class CheckoutController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(!session()->exists('cart'))
            return redirect('/');

        return view('front.checkout');
    }

    /**
     * @param StripeBilling $stripe
     * @param OrderRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function checkout(StripeBilling $stripe, OrderRequest $request)
    {
        /** @var Order $order */
        $order = Order::create($request->all());

        $order_product = [];
        $amout = 0;
        foreach(session('cart') as $product) {
            $order_product[] = [
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'product_name' => $product['name'],
                'product_price' => $product['price'],
                'qty' => $product['qty'],
            ];

            $amout+=$product['price']*$product['qty'];
        }

        \DB::table('order_product')->insert($order_product);

        session()->forget('cart');

        // Stripe charge. amount * 100 because we send "cents".
        $charge = $stripe->charge(array_merge($request->all(), ['amount' => $amout*100]));


        if($charge['status'] == 0) // if charge failed
            return $this->checkoutFailed($order, $charge['msg']);

        return $this->checkoutComplete($order);
    }

    public function checkoutComplete(Order $order)
    {
        $order->update(['payment_status'=>1]);

//        \Mail::to(auth()->user()->email)->send(new OrderCompleted($order)); // dosen't work on local server.

        return redirect(route('success'));

    }

    public function checkoutFailed(Order $order, $msg)
    {
        $order->update(['payment_status'=>2]);

        session()->flash('alert','There was a problem processing your request: ' . $msg);

//        \Mail::to(auth()->user()->email)->send(new OrderFailed($order)); // dosen't work on local server.

        return redirect(route('fail'));

    }
}
