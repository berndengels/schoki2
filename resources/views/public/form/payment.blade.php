@extends('layouts.public')

@section('extra-headers')
    <script src="{{ asset('js/stripe.js') }}" async></script>
@endsection

@section('title', 'Online Zahlung')

@section('sidebar-left')
    @parent
@endsection

@section('content')
    {!! form_start($form) !!}
    {!! form_until($form, 'email') !!}
    <!--label for="iban-element">IBAN</label>
    <div id="iban-element" class="w-50"-->
    <label id="lblStripeElement"></label>
    <div id="stripeElement" class="w-100">
        <!-- A Stripe Element will be inserted here. -->
    </div>
    <div id="bank-name" class="w-100 mt-2"></div>
    <div id="error-message" class="w-100 mt-2"></div>

    {!! form_end($form) !!}
    </form>
@endsection

@section('inline-scripts')
    <script>
        const form = document.getElementById('payment-form');
        const configPayments = {!! $configPayments->toJson() !!};

        $('#paymentMethods').change(function (e) {
            let val = $(this).val();
            $('#lblStripeElement').attr({'for': val + "-element"}).text(val.toUpperCase());
            $('#stripeElement').attr({'id': val + "-element"});
            $('#btnSubmit').show();
            loadPaymentForm(form, val, configPayments[val]);
        });
    </script>
@endsection

@section('sidebar-right')
    @parent
@endsection
