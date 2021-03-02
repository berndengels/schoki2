@extends('layouts.pdf')

@section('extra-headers')
<style>
    html, body {
        font-family: Arial;
        font-size: 1.2rem;
        color: #000;
        margin: 0;
        padding: 0;
    }
    div {
        margin: 50px;
        padding: 0;
        line-height: 1.5rem;
        letter-spacing: 0.1rem;
    }
    div span {
        text-decoration: underline;
    }
</style>

@endsection

@section('content')
    <div>
        {{ $shipping->customer->name }}<br/>
        {{ $shipping->street }}<br/>
        <span>{{ $shipping->postcode }} {{ $shipping->city }}</span><br/>
        {{ $shipping->country }}
    </div>
@endsection
