// Create a Checkout Session with the selected quantity

var createCheckoutSession = function (stripe) {
    return fetch("/payment/stripe/process", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            }
        })
        .then(result => result.json())
        .catch(err => console.error(err));
};

// Handle any errors returned from Checkout
var handleResult = function (result) {
    if (result.error) {
        var displayError = document.getElementById("error-message");
        displayError.textContent = result.error.message;
    }
};

// Get your Stripe publishable key to initialize Stripe.js
fetch("/payment/stripe/config")
    .then(function (result) {
        return result.json();
    })
    .then(function (json) {
        window.config = json;
        var stripe = Stripe(config.publicKey);
        // Setup event handler to create a Checkout Session on submit
        document.getElementById("submit").addEventListener("click", function (evt) {
            evt.preventDefault();
            createCheckoutSession()
                .then(function (data) {
                    console.info('data');
                    console.info(data);
                    stripe.redirectToCheckout({sessionId: data.sessionId}).then(handleResult);
                })
                .catch(err => console.error(err));
        });
    });

