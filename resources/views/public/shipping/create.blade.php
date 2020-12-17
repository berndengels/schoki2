@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10">
                <div class="row card-header">
                    <h3>Adresse von {{ auth('web')->user()->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="{{ route('shipping.store') }}" method="post">
                            @csrf
                            @if($redirectTo)
                                <input type="hidden" name="redirectTo" value="{{ $redirectTo }}"/>
                            @endif
                            <x-inp.select name="country_id" label="Land"
                              :options="$countries"
                              :value="$country->id"
                              optionsKey="id"
                              optionsLabel="name"
                            />
                            <x-inp.text name="postcode" />
                            <x-inp.text name="city" />
                            <x-inp.text name="street" />
                            <x-inp.checkbox name="is_default" label="Standard Adresse"/>
                            <x-inp.submit name="submit" value="speichern"/>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

