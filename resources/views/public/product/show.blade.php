@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row card-header w-100">
                    <h3>{{ $product->name }}</h3>
                    <form class="position-absolute d-block" style="right:3.0rem"
                          action="{{ route('scard.add', ['product' => $product]) }}"
                          method="post"
                    >
                        @csrf
                        <button class="btn btn-primary d-inline-block" type="submit">
                            <i class="d-inline-block float-left fas fa-shopping-cart mr-2"></i>
                            @lang('Add to shopping cart') @if(isset($product->cartItem)) ({{ $product->cartItem->qty }})@endif</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row"><span>Preis: {{ $product->price }} €</span></div>
                    <div class="row"><span>Preis Total: {{-- $cart->priceTotal() --}} €</span></div>
                </div>
            </div>
        </div>
    </div>
@endsection

