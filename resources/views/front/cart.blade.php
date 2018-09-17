@extends('front._layouts.layout')

@section('content')
    <div class="raw">
        <div class="col-md-12">
            <a href="{{ route('checkout') }}" class="btn btn-default pull-right">Checkout</a>
        </div>
    </div>

    <h1>Cart</h1>
    <table class="table">
        <thead>
        <tr>
            <th width="*">Product</th>
            <th width="10%">Price</th>
            <th width="10%">Qty</th>
            <th width="20%">Action</th>
        </tr>
        </thead>

        @if(session()->exists('cart'))
            @foreach(session('cart') as $item)
                <tr data-product="{{ $item['id'] }}">
                    <td>{{ $item['name'] }}</td>
                    <td>${{ $item['price'] }}</td>
                    <td>
                        <div class="form-group">
                            <input name="qty" value="{{ $item['qty'] }}" class="form-control qty" readonly>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-danger order-btn">Remove</button>
                    </td>
                </tr>
            @endforeach
        @endif

    </table>

@endsection

@push('scripts')
    <script>
        $(function() {
            $('.order-btn').on('click',function(){
                let $this = $(this);
                let $parent = $this.parents('tr');

                $.ajax({
                    type: 'POST',
                    url: location.protocol+'//'+location.host+'/cart',
                    data: { _method: 'DELETE', product_id: $parent.data('product') }
                }).done(function( data ) {
                    $parent.remove();
                });
            });

        });
    </script>
@endpush