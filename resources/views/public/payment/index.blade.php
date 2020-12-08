@extends('layouts.public')

@section('extra-headers-top')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header row">@lang('Kinds of payments')</div>
                <div class="card-body row p-0 justify-content-center">
                    <input id="card-holder-name" type="text">

                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element"></div>

                    <button id="card-button">
                        Process Payment
                    </button>
                </div>
            @if($paymentMethods)
                <div></div>
            @endif
            </div>
        </div>
    </div>
@endsection

@section('inline-scripts')
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');

        cardButton.addEventListener('click', async (e) => {
            const { paymentMethod, error } = await stripe.createPaymentMethod(
                'card', cardElement, {
                    billing_details: { name: cardHolderName.value }
                }
            );

            if (error) {
                // Display "error.message" to the user...
                console.error(error)
            } else {
                // The card has been verified successfully...
                console.info('The card has been verified successfully')
            }
        });
    </script>
@endsection
