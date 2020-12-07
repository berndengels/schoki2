@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.message.actions.show', ['name' => $message->name]))
@section('body')
    <div class="container-xl">
        <div class="card">
            <div class="card-header"><h3>Message from {{ $message->name }}</h3>
            </div>
            <div class="card-body">
                <h5>Vom: {{ $message->created_at->format('d.m.Y H:i') }}</h5>
                <h5>Email: <a href="mailto:{{ $message->email }}" target="_blank">{{ $message->email }}</a></h5>
                <h5>Music Style: {{ $message->musicStyle->name }}</h5>
                <h5>Message</h5>
                <p>{!! nl2br($message->message) !!}</p>
            </div>
            <div class="card-footer">
            </div>
        </div>
</div>
@endsection
