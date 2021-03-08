@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card w-75">
                <div class="card-header row">
                    <h3 class="col">@lang('Warenkorb')</h3>
                    @if($content)
                    <a role="button" class="btn btn-danger d-inline-block col-sm-auto col-md-3 float-right"
                       href="{{ route('public.scard.destroy') }}"
                    ><i class="fas fa-trash-alt"></i>
                        Warenkorb leeren</a>
                   @endif
                </div>
                <div class="card-body row p-0 m-0 justify-content-center">
                    @if($content)
                        <table class="table table-striped">
                            <tr>
                                <th>Artikel</th>
                                <th>Größe</th>
                                <th>Preis</th>
                                <th>Anzahl</th>
                                <th>Preis Total</th>
                                <th colspan="3">&nbsp</th>
                            </tr>
                        @foreach ($content as $index => $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ isset($item->options['size']) ? $item->options['size'] : null }}</td>
                                <td>@brutto($item->price) €</td>
                                <td>{{ $item->qty }}</td>
                                <td>Total {{ round(($item->total) * 10)/10 }} €</td>
                                <td><form class="d-inline m-0 p-0" action="{{ route( 'public.scard.increment', ['rawId' => $index]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-link m-0 p-0 small" role="link"><i class="fas fa-plus"></i></button>
                                    </form></td>
                                <td><form class="d-inline m-0 p-0" action="{{ route( 'public.scard.decrement', ['rawId' => $index]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-link m-0 p-0 small" role="link"><i class="fas fa-minus"></i></button>
                                    </form></td>
                                <td>
                                    <form class="d-inline m-0 p-0" action="{{ route( 'public.scard.delete', ['rawId' => $index]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-link m-0 p-0 small" role="link"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td class="text-center align-middle text-light font-weight-bold p-0" colspan="8">
                                    <h4 class="mt-3">Preise Total: @round($cart->total()) € + {{ $porto }} € Porto</h4>
                                </td>
                            </tr>
                        </table>
                        <div>
                            @guest
                                <h5>Um die Artikel zu bestellen, mußt Du Dich einloggen oder Registrieren</h5>
                                <div class="row justify-content-center">
                                    <a role="button" class="btn btn-primary btnPay align-middle"
                                        href="{{ route('login', ['redirectTo' => 'public.scard.index']) }}" ><i class="fas fa-user-alt mr-1"></i>
                                        @lang('Login')
                                    </a>
                                        &nbsp;
                                    <a role="button"class="btn btn-primary ml-2 btnPay align-middle"
                                            href="{{ route('register', ['redirectTo' => 'public.scard.index']) }}"><i class="fas fa-cash-register mr-1"></i>
                                        @lang('Register')
                                    </a>
                                </div>
                            @else
                                <a role="button" class="btn btn-block btn-primary px-5"
                                   href="{{ route('public.order.index') }}">@lang('Kaufen')</a>
                            @endguest
                        </div>
                    @else
                       <h3>Keine Daten vorhanden!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
