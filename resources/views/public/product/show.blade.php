@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10">
                <div class="row card-header">
                    <h3>{{ $product->name }}</h3>
                    <form class="position-absolute d-block" style="right:3.0rem"
                          action="{{ route('scard.add', ['product' => $product]) }}"
                          method="post"
                    >
                        @csrf
                        <button class="btn btn-primary d-inline-block" type="submit">
                            <i class="d-inline-block float-left fas fa-shopping-cart mr-2"></i>
                            @lang('Add to shopping cart') @if($cartItem) ({{ $cartItem->qty }})@endif</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <img src="{{ asset($product->getMedia('product_images')->first()->getUrl()) }}" width="300"></div>
                        </div>
                        <div class="col-auto">
                            <h3>Preis: {{ $product->price }} €</h3>
                            <p>{!! $product->description !!}</p>
                            @if($cartItem)
                                <h5>Preis Total: {{ $cartItem->priceTotal() }} €</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

