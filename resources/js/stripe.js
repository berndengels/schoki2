
window.loadPaymentForm = function(form, payment, options) {
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            },
            ':-webkit-autofill': {
                color: '#32325d',
            },
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a',
            ':-webkit-autofill': {
                color: '#fa755a',
            },
        }
    };
    const stripe = Stripe('pk_test_51Hpsv5BFmNHaPuJ0pUoOtGHTJVhuu8cBPE17gdPfLUjoWm26n96BOD755eMnpWRdyyJ73lAtJ5AVORrlJKb36Kf200tx4I74M9');
    const elements = stripe.elements();

    // Create an instance of the iban Element.
    var obj = elements.create(payment, {
        style: style,
        supportedCountries: options.supportedCountries,
        placeholderCountry: options.placeholderCountry,
    });

    // Add an instance of the iban Element into the `iban-element` <div>.
    obj.mount('#' + payment + '-element');

    var errorMessage = document.getElementById('error-message');
    var bankName = document.getElementById('bank-name');

    obj.on('change', function(event) {
        // Handle real-time validation errors from the iban Element.
        if (event.error) {
            errorMessage.textContent = event.error.message;
            errorMessage.classList.add('visible');
        } else {
            errorMessage.classList.remove('visible');
        }

        // Display bank name corresponding to IBAN, if available.
        if (event.bankName) {
            bankName.textContent = event.bankName;
            bankName.classList.add('visible');
        } else {
            bankName.classList.remove('visible');
        }
    });
    // Handle form submission.
    form.addEventListener('submit', function(event) {
        event.preventDefault();
//        showLoading();

        var sourceData = {
            type: options.type,
            currency: 'eur',
            owner: {
                name: document.querySelector('input[name="name"]').value,
                email: document.querySelector('input[name="email"]').value,
            },
            mandate: {
                // Automatically send a mandate notification email to your customer
                // once the source is charged.
                notification_method: 'email',
            }
        };
        // Call `stripe.createSource` with the iban Element and additional options.
        stripe.createSource(obj, sourceData)
            .then(result => {
                console.info('result');
                console.info(result);
                if (result.error) {
                    // Inform the customer that there was an error.
                    errorMessage.textContent = result.error.message;
                    errorMessage.classList.add('visible');
                    console.info(result.error.message);
        //                stopLoading();
                } else {
                    // Send the Source to your server to create a charge.
                    errorMessage.classList.remove('visible');
                    console.info(form);
                    stripeSourceHandler(form, result.source);
                }
            })
            .then(res => {
                console.info('res');
                console.info(res);
            })
            .catch(err => {
                console.info('err');
                console.info(err);
            });
    });
}
function stripeSourceHandler(form, source) {
    // Insert the Source ID into the form so it gets submitted to the server.
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeSource');
    hiddenInput.setAttribute('value', source.id);
    form.appendChild(hiddenInput);
    // Submit the form.
    form.submit();
}
