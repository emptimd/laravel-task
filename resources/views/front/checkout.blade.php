@extends('front._layouts.layout')

@section('content')

    <h1>Checkout</h1>
    <div id="checkout-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}"></div>
    <form action="{{ route('checkout') }}" method="post" id="payment-form">
        {{ csrf_field() }}

        <div class="form-group {{ $errors->has('user_name') ? 'has-error' : ''}}">
            <input id="user_name" class="form-control" placeholder="Name" name="user_name" minlength="3" maxlength="255" required>
            {!! $errors->first('user_name', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('user_email') ? 'has-error' : ''}}">
            <input type="email" id="user_email" class="form-control" placeholder="Email" name="user_email" minlength="3" maxlength="255" required>
            {!! $errors->first('user_email', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
            <input id="address" class="form-control" placeholder="Address" name="address" minlength="3" maxlength="255" required>
            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('card') ? 'has-error' : ''}}">
            <input id="card" class="form-control" placeholder="Credit card #" name="card" required value="4242424242424242">
            {!! $errors->first('card', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('month') ? 'has-error' : ''}}">
            <input id="month" class="form-control" placeholder="Month" name="month" pattern="[0-9]*" minlength="2" maxlength="2" required>
            {!! $errors->first('month', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('year') ? 'has-error' : ''}}">
            <input id="year" class="form-control" placeholder="Year" name="year" pattern="[0-9]*" minlength="2" maxlength="2" required>
            {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('cvv') ? 'has-error' : ''}}">
            <input type="number" id="cvv" class="form-control" placeholder="CVV" name="cvv" required>
            {!! $errors->first('cvv', '<p class="help-block">:message</p>') !!}
        </div>



        <button class="btn btn-success pull-right" style="margin-top: 15px;">Checkout</button>


    </form>
@endsection

@push('scripts')
    <script src="https://js.stripe.com/v2/"></script>
    <script src="{{ mix('/js/stripe.js') }}"></script>

@endpush