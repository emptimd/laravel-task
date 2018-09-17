<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('front.index', compact('products'));
    }


    public function success()
    {
        return view('front._partials.success');
    }

    public function fail()
    {
        return view('front._partials.fail');
    }
}
