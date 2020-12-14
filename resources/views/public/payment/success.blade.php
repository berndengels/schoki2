@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-12">
                <div class="card-header row"><h3>@lang('Der Einkauf war erfolgreich')</h3></div>
                <div class="card-body row mt-3 p-0 justify-content-center">
                    <pre id="stripMsg">
                        <p>Alles OK</p>
                    </pre>
                </div>
            </div>
        </div>
    </div>
@endsection
