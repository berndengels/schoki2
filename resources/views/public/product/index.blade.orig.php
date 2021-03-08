@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header row">@lang('Order Products')</div>
                <div class="card-body row p-0 m-0 mt-2 justify-content-center border-0">
                    <table class="table product-list border-0">
                        @foreach($data as $item)
                            <tr>
                                <form class="shop d-inline"
                                      action="{{ route('public.scard.add', ['product' => $item]) }}"
                                      method="post">
                                    @csrf
                                    @if($item->thumb)
                                    <td>
                                        <img
                                            src="{{ asset($item->thumb)}}"
                                            alt="{{ $item->name }}"
                                            title="{{ $item->name }}"
                                        />
                                    </td>
                                    @endif
                                    <td>
                                        <a href="{{ route('public.product.show', ['product' => $item]) }}">{{ $item->name }}</a>
                                    </td>
                                    <td>
                                        @if($item->hasSize)
                                            Größe wählen: &nbsp;
                                            <select
                                                name="size"
                                                class="size-select no-scroll"
                                                size="{{ $item->sizes->count() }}"
                                                data-object-id="{{ $item->id }}"
                                                multiple
                                                required
                                            >
                                                @foreach($item->sizes as $size)
                                                    <option value="{{ $size }}"
                                                        @if($size == $activeSize)
                                                            selected
                                                        @endif
                                                    >{{ $size }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <br>
                                        @endif
                                    </td>
                                    <td>{{ $item->price }} €</td>
                                    <td>
                                        <button class="form-control btn btn-primary d-inline-block" type="submit">
                                            <i class="d-inline-block float-left fas fa-shopping-cart mr-2"></i>
                                            @lang('Add')
                                            @if($item->activeCartItem)
                                                ({{ $item->activeCartItem->qty }})
                                            @endif
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </table>
                    <div class="align-content-center">
                        <a role="button" class="btn btn-block btn-primary px-5 align-self-center"
                           href="{{ route('public.scard.index') }}">
                            <i class="d-inline-block payIcon fas fa-shopping-cart mr-2"></i>
                            @lang('zum Warenkorb')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('inline-scripts')
    <script>
        $('.size-select').change(e => {
            location.href = "/product/" + e.target.value;
        })
    </script>
@endsection

@section('extra-headers')
    <style type="text/css">
        .product-list {
            border: none !important;
        }
        td {
            margin: 0 !important;
        }
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
