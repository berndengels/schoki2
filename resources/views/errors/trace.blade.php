@extends('errors.illustrated-layout')

@section('title', $title)
@section('code', $code)
@section('message', $message)

@section('trace')
    {!! nl2br($trace) !!}
@endsection
