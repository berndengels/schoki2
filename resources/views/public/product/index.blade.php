@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header row">@lang('Order Products')</div>
                <div class="card-body row p-0 justify-content-center">
                <table class="table product-list">
                    @foreach($data as $item)
                        <form class="d-inline"
                          action="{{ route('public.scard.add', ['product' => $item]) }}"
                          method="post"
                        >
                            @csrf
                        <tr>
                        <td>
                            @if($item->thumb)
                            <img
                                 src="{{ asset($item->thumb)}}"
                                 alt="{{ $item->name }}"
                                 title="{{ $item->name }}"
                            />
                            @else
                            <br>
                            @endif
                        </td>
                        <td><a href="{{ route('public.product.show', ['product' => $item]) }}">{{ $item->name }}</a></td>
                        <td>
                            @if($item->hasSize)
                            <select name="size" id="size" class="form-control" required>
                                <option value="">{{ __('Größe wählen') }}</option>
                                @foreach($item->stocks as $stock)
                                    <option value="{{ $stock->size->name }}"
                                        @if(isset($item->cartItem->options['size']) && $item->cartItem->options['size'] === $stock->size->name) selected @endif
                                    >{{ $stock->size->name }}</option>
                                @endforeach
                            </select>
                            @else
                            <br>
                            @endif
                        </td>
                        <td>{{ $item->price }}</td>
                        <td>
                            <button class="form-control btn btn-primary d-inline-block" type="submit">
                                <i class="d-inline-block float-left fas fa-shopping-cart mr-2"></i>
                                @lang('Add') @if($item->cartItem)({{ $item->cartItem->qty }})@endif</button>
                        </td>
                    </tr>
                    </form>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection

