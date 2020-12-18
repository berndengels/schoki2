@extends('layouts.public')

@section('title', $data->title)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10">
                <div class="row card-header">
                    <h3>{{ $data->title }}</h3>
                </div>
                <div class="card-body">
                    <div class="row page-body p-0 mbs">
                        {!! $data->body !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
