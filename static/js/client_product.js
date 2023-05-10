function base_url() {
	var pathparts = location.pathname.split('/');
	var url;

	if (location.host == 'localhost') {
		url = location.origin+'/'+pathparts[1].trim('/')+'/'; // http://localhost/myproject/
	}else{
		url = location.origin + "/"; // http://stackoverflow.com/
	}
	return url;
}

// Get API Key
let STRIPE_PUBLISHABLE_KEY = document.currentScript.getAttribute('STRIPE_PUBLISHABLE_KEY');

// Create an instance of the Stripe object and set your publishable API key
const stripe = Stripe(STRIPE_PUBLISHABLE_KEY);

let elements; // Define card elements
const frmBuyProduct = document.querySelector("#frmBuyProduct"); // Select payment form element

// Get payment_intent_client_secret param from URL
const clientSecretParam = new URLSearchParams(window.location.search).get(
    "payment_intent_client_secret"
);

// Fetch a payment intent and capture the client secret
let payment_intent_id;

async function initialize(amount) {
    const { id, clientSecret } = await fetch("api/product_payment/process", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ 
            request_type:'create_payment_intent',
            amount
        }),
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
            let name = $('input[name=checkout_fullname]').val();
            let email = $('input[name=checkout_email]').val();

            const { id, customer_id } = await fetch("api/product_payment/process", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ 
                    request_type:'create_customer', 
                    payment_intent_id: payment_intent_id, 
                    name: name, 
                    email: email,
                    user_id: $('input[name=checkout_user_id').val(),
                    product_id: $('input[name=checkout_product_id').val(),
                    amount: $('input[name=checkout_product_amount').val(),
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
                fetch("api/product_payment/process", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ 
                        request_type:'payment_insert', 
                        payment_intent: paymentIntent, 
                        customer_id: customerID,
                        user_id: $('input[name=checkout_user_id]').val(),
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.payment_id) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'You have successfully purchased this product. Thank you.',
                            icon: 'success',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showCancelButton: false,
                            confirmButtonText: 'Ok, Got It!'
                        }).then((result) => {
                            if (result.value) {
                                location.replace(base_url() + 'products');
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
        document.querySelector("#btnProceedBuyProduct").style.display = "none";
    } else {
        document.querySelector("#frmProcess").style.display = "none";
        document.querySelector("#btnProceedBuyProduct").style.display = "block";
    }
}

$( document ).ready(function() {
    $('.btnBuyProduct').click(function(){
        var checkoutProductId = $(this).data("id");
        var productDetailsUrl = base_url() + 'api/products/get_product_by_id?product_id=' + checkoutProductId;
        $.getJSON(productDetailsUrl, function(response) {
            $('input[name=checkout_product_id]').val(response.id);
            $('input[name=checkout_product_amount]').val(response.amount);
    
            if(response.file_name === null){
                $('.checkout_product_image').attr('src', base_url() +  'static/images/logo.png');
            }else{
                $('.checkout_product_image').attr('src', response.file_name);
            }
      
            $(".checkout_product_name").text(response.name);
            $(".checkout_product_short_desc").text(response.short_desc);
            $(".checkout_product_long_desc").text(response.long_desc);
            $(".checkout_product_amount").text(response.amount);
            $(".checkout_product_quantity").text(response.quantity);
    
            // Check whether the payment_intent_client_secret is already exist in the URL
            setProcessing(true);
            if(!clientSecretParam){
                setProcessing(false);
                // Create an instance of the Elements UI library and attach the client secret
                initialize($('input[name=checkout_product_amount]').val());
            }
        });
    });

    // Check the PaymentIntent creation status
	checkStatus();

	// Attach an event handler to payment form
	frmBuyProduct.addEventListener("submit", handleSubmit);
});

