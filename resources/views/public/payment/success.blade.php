@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-12">
                <div class="card-header row"><h3>Your payment succeeded</h3></div>
                <div class="card-body row mt-3 p-0 justify-content-center">
                    <pre id="stripMsg">
                        {{ dd($session) }}
                    </pre>
                </div>
            </div>
        </div>
    </div>
@endsection
