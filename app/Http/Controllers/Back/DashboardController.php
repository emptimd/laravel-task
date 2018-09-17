<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('orderProduct')->get();

        return view('back.orders.index', compact('orders'));
    }
}
