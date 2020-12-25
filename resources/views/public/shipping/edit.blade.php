@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10">
                <div class="row card-header">
                    <h3>Adressen von {{ auth('web')->user()->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form
                              action="{{ route('shipping.update', ['shipping' => $data]) }}"
                              method="post">
                            @csrf
                            <x-inp.select name="country_id" label="Land"
                                :value="$data->country_id"
                                :options="$countries"
                                optionsKey="id"
                                optionsLabel="name"
                            />
                            <x-inp.text name="postcode" :value="$data->postcode"/>
                            <x-inp.text name="city" :value="$data->city"/>
                            <x-inp.text name="street" :value="$data->street"/>
                            <x-inp.checkbox name="is_default" label="Standard Adresse" :value="$data->is_default"/>
                            <x-inp.submit name="submit" value="speichern"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

