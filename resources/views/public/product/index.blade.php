@extends('layouts.public')

@section('content')
    <div id="app" class="col-12">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Order Products</div>
                    <div class="card-body">
                        <Shop :products='@json($data)' />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
