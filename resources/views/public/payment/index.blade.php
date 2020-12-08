@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header row">@lang('Kinds of payments')</div>
                <div class="card-body row p-0 justify-content-center">
                    @if($payments->count() > 0 )
                        <form method="post" action="{{ route('payment.create') }}">
                        @csrf
                        <table class="table table-striped">
                            <tr>
                                <th>Zahlungsart</th>
                                <th>Icon</th>
                                <th>Aktion</th>
                            </tr>
                        @foreach ($payments as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td><input class="form-control" type="radio" name="payment" value /></td>
                            </tr>
                        @endforeach
                        </table>
                        <div>
                            <button role="button" class="btn btn-block btn-primary">@lang('Order now')</button>
                        </div>
                        </form>
                    @else
                       <h3>Keine Daten vorhanden!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
