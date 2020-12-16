@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-12">
                <div class="card-header row"><h3>@lang('Dein Einkauf war erfolgreich')</h3></div>
                <div class="card-body row mt-3 p-0 justify-content-center">
                    <h5>Danke für den Einkauf</h5>
                    <p>Wir senden Deine von Dir bestellen Artikel sofort per Post an folgende Adresse</p>
                    <p>{{ $customer->shipping->name }}</p>
                    <p>
                        {{ $customer->shipping->address->line1 }},&nbsp;
                        {{ $customer->shipping->address->postal_code }} {{ $customer->shipping->address->city }},&nbsp;
                        {{ $customer->shipping->address->country }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
