@extends('layouts.public')

@section('extra-headers')
    <script src="{{ asset('js/payment-stripe.js') }}" async></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-12">
                <div class="card-header row">
                    <h3>Online Bezahlen</h3>
                </div>
                <div class="card-body row mt-3 p-0 justify-content-center">
                    <div class="col-auto">
                        <form method="post">
                            @csrf
                            <button id="submit" role="button"
                                    class="btn btn-primary btnPay align-middle"><i class="fab fa-cc-stripe mr-1"></i>
                                Summe {{ $cart->priceTotal() }} € jetzt bezahlen
                            </button>
                        </form>
                        <div id="error-message"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

