@extends('back._layouts.layout')

@section('content')
    <div class="raw">
        <div class="col-md-12">
            <a href="{{ route('logout') }}" class="btn btn-default pull-right" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
        </div>
    </div>

<h1>Orders</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Name</th>
            <th>Address</th>
            <th>Items</th>
            <th>Grand Total</th>
            <th>Status</th>
        </tr>
        </thead>


        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                <td><a href="mailto:{{ $order->user_email }}">{{ $order->user_name }}</a></td>
                <td>{{ $order->address }}</td>
                <td>
                    <table class="table table-condensed">
                        @php $amout = 0; @endphp
                        @foreach($order->orderProduct as $item)
                            @php $amout+=$item->product_price*$item->qty; @endphp
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->qty }} pcs</td>
                                <td>$ {{ $item->product_price }}</td>
                            </tr>
                        @endforeach

                    </table>
                </td>
                <td>
                    <strong>${{ $amout }}</strong>
                </td>
                <td>
                    <span class="{{ App\Models\Order::order_status_label_class($order->payment_status) }}">{{ App\Models\Order::$order_status[$order->payment_status] }}</span>
                </td>
            </tr>
        @endforeach

    </table>

@endsection