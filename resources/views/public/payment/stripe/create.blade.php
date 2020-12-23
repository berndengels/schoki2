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
                        <form id="frmSubmit" method="post" disabled="true">
                            @csrf
                            <button id="submit" role="button"
                                class="btn btn-primary btnPay align-middle"
                                type="button">
                                <span id="start">
                                    <i class="fab fa-cc-stripe mr-1"></i>Summe @round($cart->total()) € jetzt bezahlen
                                </span>
                                <span id="loading" class="align-content-center px-5" style="display:none">
                                    <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
                                    <span>Bitte warten ...</span>
                                </span>
                            </button>
                        </form>
                        <div id="error-message"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('inline-scripts')
<script>
$('#submit').click(function(e) {
    e.preventDefault();
    $('#start').hide();
    $('#loading').show();
    $(this).attr({disable:true});
    return true;
});
</script>
@endsection

