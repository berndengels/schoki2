@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header row">@lang('Order Products')</div>
                <div class="card-body row p-0 justify-content-center">
                <table class="table">
                    @foreach($data as $item)
                    <tr>
                        <td>
                            @if($item->thumb)
                            <img src="{{ asset($item->thumb)}}" height="60"/>
                            @else
                            <br>
                            @endif
                        </td>
                        <td><a href="{{ route('product.show', ['product' => $item]) }}">{{ $item->name }}</a></td>
                        <td>{{ $item->price }}</td>
                        <td>
                            <form class="d-inline"
                                  action="{{ route('scard.add', ['product' => $item]) }}"
                                  method="post"
                            >
                                @csrf
                                <button class="form-control btn btn-primary d-inline-block" type="submit">
                                    <i class="d-inline-block float-left fas fa-shopping-cart mr-2"></i>
                                    @lang('Add') @if($item->cartItem)({{ $item->cartItem->qty }})@endif</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection

