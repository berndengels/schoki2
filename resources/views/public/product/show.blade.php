@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card-header row">
                    <h3>{{ $product->name }}</h3>
                </div>
                <div class="card-body row">
                    <div class="col-md-5">
                        <form class="d-block"
                              action="{{ route('public.scard.add', ['product' => $product]) }}"
                              method="post">
                            @csrf
                            @if($product->hasSize)
                                <div class="d-inline-block">
                                    Größe wählen: &nbsp;
                                    <select
                                        name="size"
                                        class="size-select no-scroll"
                                        size="{{ $product->sizes->count() }}"
                                        data-object-id="{{ $product->id }}"
                                        multiple
                                        required
                                    >
                                        @foreach($product->sizes as $size)
                                            <option value="{{ $size }}"
                                                    @if($size == $activeSize)
                                                    selected
                                                @endif
                                            >{{ $size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <br>
                            @endif

                            <button class="btn btn-primary d-inline-block ml-2" type="submit">
                                <i class="d-inline-block float-left fas fa-shopping-cart mr-2"></i>
                                @lang('Add')
                                @if($product->activeCartItem)
                                    ({{ $product->activeCartItem->qty }})
                                @endif
                            </button>
                        </form>
                    </div>
                    @if($product->images)
                    <div class="col-md-5 text-right">
                        <img class="" src="{{ asset($product->images->first()) }}" width="300">
                    </div>
                    @endif
                    <div class="col-md-5">
                        <h3>Preis: {{ $product->price }} €</h3>
                        <p>{!! $product->description !!}</p>
                        @if($cartItem)
                            <h5>Preis Total: @round($cartItem->total()) €</h5>
                        @endif
                    </div>
                </div>
            </div>
            <div class="align-content-center">
                <a role="button" class="btn btn-block btn-primary px-5 align-self-center"
                   href="{{ route('public.scard.index') }}">
                    <i class="d-inline-block payIcon fas fa-shopping-cart mr-2"></i>
                    @lang('zum Warenkorb')</a>
            </div>
        </div>
    </div>
@endsection

@section('inline-scripts')
    <script>
        const productID = {{ $product->id }};
        $('.size-select').change(e => {
            location.href = "/product/show/" + productID + "/" + e.target.value;
        })
    </script>
@endsection

@section('extra-headers')
    <style type="text/css">
        .size-select {
            display: inline;
            overflow: hidden;
            overflow-y: auto;
            border: none;
            width: auto;
            height: 1.6rem;
            background-color: transparent;
            margin: auto;
            padding: 0;
            scrollbar-width: none; /*For Firefox*/;
            -ms-overflow-style: none; /*For Internet Explorer 10+*/;
        }

        .size-select option {
            display: inline-block !important;
            width: 1.6rem;
            height: 1.6rem;
            float: left !important;
            clear: none !important;
            color: #fff !important;
            margin: 0 0.2rem;
            line-height: 1.5rem;
            background-color: transparent;
            border: 1px solid #fff;
            border-radius: 0.8rem;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
        }

        .size-select option:hover,
        .size-select option:selected {
            font-weight: bold;
            background-color: #3490dc !important;
            color: #fff !important;
        }
    </style>
@endsection
