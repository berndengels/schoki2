@extends('layouts.public')

@section('content')
    <div id="app" class="col-12">
        <Shop :products='@json($data)' />
    </div>
@endsection
