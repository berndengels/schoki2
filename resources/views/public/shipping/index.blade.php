@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header row-12">
                    <h3 class="d-inline-block float-left">
                        @lang('Liefer-Adressen')
                    </h3>
                    <a href="{{ route('shipping.create') }}"
                       role="button"
                       class="btn-sm btn-primary d-inline-block float-right">Neue Adresse</a>
                </div>
                <div class="card-body row p-3 justify-content-center">
                @if($data)
                <table class="table">
                    @foreach($data as $item)
                    <tr @if($item->is_default)class="font-weight-bold text-primary" @endif>
                        <td>{{ $item->country }}</td>
                        <td>{{ $item->postcode }} {{ $item->city }}</td>
                        <td>{{ $item->street }}</td>
                        <td>{{ $item->is_default ? 'default' : null }}</td>
                        <td><a href="{{ route('shipping.edit', ['shipping' => $item]) }}"
                               role="button" class="btn-sm btn-primary"
                            ><i class="fas fa-edit"></i> Edit
                            </a></td>
                        <td><a href="{{ route('shipping.destroy', ['shipping' => $item]) }}"
                               role="button" class="btn-sm btn-danger"
                            ><i class="fas fa-trash-alt"></i> Löschen
                            </a></td>
                    </tr>
                    @endforeach
                </table>
                @else
                    <h3>Keine Daten vorhanden</h3>
                @endif
                </div>
            </div>
        </div>
    </div>
@endsection

