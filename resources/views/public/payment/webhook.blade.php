@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header row"><h3>Stripe Webhook</h3>h3></div>
                <div class="card-body row p-0 justify-content-center">
                    {!! $payload !!}
                </div>
            </div>
        </div>
    </div>
@endsection

