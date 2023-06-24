// Get API Key
let STRIPE_PUBLISHABLE_KEY = document.currentScript.getAttribute('STRIPE_PUBLISHABLE_KEY');

// Create an instance of the Stripe object and set your publishable API key
const stripe = Stripe(STRIPE_PUBLISHABLE_KEY);

let elements; // Define card elements
const paymentFrm = document.querySelector("#paymentFrm"); // Select payment form element

// Get payment_intent_client_secret param from URL
const clientSecretParam = new URLSearchParams(window.location.search).get(
    "payment_intent_client_secret"
);

// Check whether the payment_intent_client_secret is already exist in the URL
setProcessing(true);
if(!clientSecretParam){
    setProcessing(false);
	
    // Create an instance of the Elements UI library and attach the client secret
    initialize();
}

// Check the PaymentIntent creation status
checkStatus();

// Attach an event handler to payment form
paymentFrm.addEventListener("submit", handleSubmit);

// Fetch a payment intent and capture the client secret
let payment_intent_id;

async function initialize() {
    const { id, clientSecret } = await fetch("api/payment/process", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ request_type:'create_payment_intent' }),
    }).then((r) => r.json());
	
    const appearance = {
        theme: 'stripe',
        rules: {
            '.Label': {
                fontWeight: 'bold',
                textTransform: 'uppercase',
            }
        }
    };
	
    elements = stripe.elements({ clientSecret, appearance });
	
    const paymentElement = elements.create("payment");
    paymentElement.mount("#paymentElement");
	
    payment_intent_id = id;
}

// Card form submit handler
async function handleSubmit(e) {
    e.preventDefault();
    
    Swal.fire({
        title: 'Confirmation',
        text: "Are you sure you want to continue?",
        icon: 'warning',
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!',
        showLoaderOnConfirm: true,
        preConfirm: async(login) => {
            let name = $('#txtReservationName').val();
            let email = $('#txtReservationEmail').val();
            
            const { id, customer_id } = await fetch("api/payment/process", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ 
                    request_type:'create_customer', 
                    payment_intent_id: payment_intent_id, 
                    name: name, 
                    email: email,
                    pet_name: $('input[name=pet_name').val(),
                    schedule_date: $('input[name=schedule_date').val(),
                    schedule_time: $('input[name=schedule_time').val(),
                    address: $('input[name=address').val(),
                    service_type: $('select[name=service_type').val()
                }),
            }).then((r) => r.json());
            
            const { error } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    // Make sure to change this to your payment completion page
                    return_url: window.location.href+'?customer_id='+customer_id,
                },
            });
            
            // This point will only be reached if there is an immediate error when
            // confirming the payment. Otherwise, your customer will be redirected to
            // your `return_url`. For some payment methods like iDEAL, your customer will
            // be redirected to an intermediate site first to authorize the payment, then
            // redirected to the `return_url`.
            if (error.type === "card_error" || error.type === "validation_error") {
                showMessage(error.message);
            } else {
                showMessage("An unexpected error occured.");
            }
        }, 
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
        }
    });
}

// Fetch the PaymentIntent status after payment submission
async function checkStatus() {
    const clientSecret = new URLSearchParams(window.location.search).get(
        "payment_intent_client_secret"
    );
	
    const customerID = new URLSearchParams(window.location.search).get(
        "customer_id"
    );
	
    if (!clientSecret) {
        return;
    }
	
    const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);
	
    if (paymentIntent) {
        switch (paymentIntent.status) { 
            case "succeeded":
                // Post the transaction info to the server-side script and redirect to the payment status page
                fetch("api/payment/process", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ 
                        request_type:'payment_insert', 
                        payment_intent: paymentIntent, 
                        customer_id: customerID,
                        user_id: $('#txtReservationUserId').val(),
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.payment_id) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'You have successfully reserved slot. Thank you.',
                            icon: 'success',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showCancelButton: false,
                            confirmButtonText: 'Ok, Got It!'
                        }).then((result) => {
                            if (result.value) {
                                location.replace(base_url() + 'reservation');
                            }
                        });
                    } else {
                        showMessage(data.error);
                    }
                })
                .catch(console.error);
				
                break;
            case "processing":
                showMessage("Your payment is processing.");
                break;
            case "requires_payment_method":
                showMessage("Your payment was not successful, please try again.");
                break;
            default:
                showMessage("Something went wrong.");
                break;
        }
    } else {
        showMessage("Something went wrong.");
    }
}


// Display message
function showMessage(messageText) {
    Swal.fire({
        title: 'Error!',
        text: messageText,
        icon: 'error',
        confirmButtonText: 'Ok, Got It!'
    });
}

// Show a spinner on payment form processing
function setProcessing(isProcessing) {
    if (isProcessing) {
        document.querySelector("#frmProcess").style.display = "block";
    } else {
        document.querySelector("#frmProcess").style.display = "none";
    }
}