@extends('front._layouts.layout')

@section('content')
    <div class="raw">
        <div class="col-md-12">
            <a href="{{ route('cart') }}" class="btn btn-default pull-right">Cart</a>
        </div>
    </div>

    <h1>Store</h1>
    <table class="table">
        <thead>
        <tr>
            <th width="*">Product</th>
            <th width="10%">Price</th>
            <th width="10%">Qty</th>
            <th width="20%">Action</th>
        </tr>
        </thead>

        @foreach($products as $product)
            <tr data-product="{{ $product->id }}">
                <td>{{ $product->name }}</td>
                <td>${{ $product->price }}</td>
                <td>
                    <div class="form-group">
                        <input type="number" name="qty" value="1" min="1" class="form-control qty"/>
                    </div>
                </td>
                <td>
                    <button class="btn btn-success order-btn">Order</button>
                </td>
            </tr>
        @endforeach

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
            	    data: {
            	        _method: 'post', product_id: $parent.data('product'), qty: $parent.find('.qty').val()
            	    }
            	}).done(function( data ) {
            	    console.log(data);
            	});
            });

        });
    </script>
@endpush