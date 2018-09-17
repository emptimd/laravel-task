@extends('front._layouts.layout')

@section('content')
    <h1>Payment failed!</h1>
    <p class="alert alert-danger">
        {{ session('alert') }}
    </p>
@endsection