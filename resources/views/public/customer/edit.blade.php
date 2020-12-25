@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10">
                <div class="row card-header">
                    <h3>{{ $customer->name }}</h3>
                </div>
                <div class="card-body row">
                    <div class="col-12">
                        <form
                              action="{{ route('customer.update', ['customer' => $customer]) }}"
                              method="post">
                            @csrf
                            <x-inp.text name="name" :value="$customer->name"/>
                            <x-inp.text name="email" :value="$customer->email"/>
                            <x-inp.password label="Passwort" name="password" :value="$customer->password"/>
                            <x-inp.password label="Passwort bestätigen" name="password_confirmation" :value="$customer->password"/>
                            <x-inp.submit name="submit" value="speichern"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

