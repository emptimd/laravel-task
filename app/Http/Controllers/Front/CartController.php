<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('front.cart');
    }

    /**
     * @param Request $request
     */
    public function add(Request $request)
    {
        /** @var Product $product */
        $product = Product::findOrFail($request->product_id);

        session([
            "cart.$product->id" => [
                 'id' => $product->id, 'qty' => $request->qty, 'name' => $product->name, 'price' => $product->price
            ]
        ]);

    }

    public function remove(Request $request)
    {
        session()->forget("cart.$request->product_id");
    }
}
