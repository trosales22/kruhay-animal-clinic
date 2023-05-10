<?php
header('Access-Control-Allow-Origin: *');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/stripe-php-7.7.0/init.php';

class Product_payment extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Product_model', 'product_model');
	}

	public function process_post()
	{
		\Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

		// Retrieve JSON from POST body
		$jsonStr = file_get_contents('php://input');
		$jsonObj = json_decode($jsonStr);

		if ($jsonObj->request_type == 'create_payment_intent') {
            $amount = !empty($jsonObj->amount) ? $jsonObj->amount : 0;
            
			// Define item price and convert to cents
			$itemPriceCents = round($amount * 100);

			// Set content type to JSON
			header('Content-Type: application/json');

			try {
				// Create PaymentIntent with amount and currency
				$paymentIntent = \Stripe\PaymentIntent::create([
					'amount' => $itemPriceCents,
					'currency' => 'PHP',
					'description' => 'Product Checkout',
					'payment_method_types' => [
						'card'
					]
				]);

				echo json_encode([
					'id' => $paymentIntent->id,
					'clientSecret' => $paymentIntent->client_secret
				]);
			} catch (Error $e) {
				http_response_code(500);
				echo json_encode(['error' => $e->getMessage()]);
			}
		} elseif ($jsonObj->request_type == 'create_customer') {
            $payment_intent_id = !empty($jsonObj->payment_intent_id) ? $jsonObj->payment_intent_id : '';
			$name = !empty($jsonObj->name) ? $jsonObj->name : '';
			$email = !empty($jsonObj->email) ? $jsonObj->email : '';
			$user_id = !empty($jsonObj->user_id) ? $jsonObj->user_id : '';
			$product_id = !empty($jsonObj->product_id) ? $jsonObj->product_id : '';
			$address = !empty($jsonObj->address) ? $jsonObj->address : '';
			$amount = !empty($jsonObj->amount) ? $jsonObj->amount : 0;
			
			$_SESSION['user_id'] = $user_id;
			$_SESSION['product_id'] = $product_id;
			$_SESSION['address'] = $address;
			$_SESSION['amount'] = $amount;

			// Add customer to stripe
			try {
				$customer = \Stripe\Customer::create(array(
					'name' => $name,
					'email' => $email
				));
			} catch (Exception $e) {
				$api_error = $e->getMessage();
			}

			if (empty($api_error) && $customer) {
				try {
					// Update PaymentIntent with the customer ID
					$paymentIntent = \Stripe\PaymentIntent::update($payment_intent_id, [
						'customer' => $customer->id
					]);
				} catch (Exception $e) {
					// log or do what you want
				}

				echo json_encode([
					'id' => $payment_intent_id,
					'customer_id' => $customer->id
				]);
			} else {
				http_response_code(500);
				echo json_encode(['error' => $api_error]);
			}
		} elseif ($jsonObj->request_type == 'payment_insert') {
			$payment_intent = !empty($jsonObj->payment_intent) ? $jsonObj->payment_intent : '';
			$customer_id = !empty($jsonObj->customer_id) ? $jsonObj->customer_id : '';

			// Retrieve customer info
			try {
				$customer = \Stripe\Customer::retrieve($customer_id);
			} catch (Exception $e) {
				$api_error = $e->getMessage();
			}

			// Check whether the charge was successful
			if (!empty($payment_intent) && $payment_intent->status == 'succeeded') {
				// Transaction details
				$transactionID = $payment_intent->id;
				$paidAmount = $payment_intent->amount;
				$paidAmount = ($paidAmount / 100);

				$name = $email = '';
				if (!empty($customer)) {
					$name = !empty($customer->name) ? $customer->name : '';
					$email = !empty($customer->email) ? $customer->email : '';
				}

				$user_id = !empty($jsonObj->user_id) ? $jsonObj->user_id : '';

				$payment_id = $this->product_model->checkout(array(
					'user_id' => $user_id,
					'product_id' => $_SESSION['product_id'] ?? null,
                    'status' => 'PAID',
                    'payment_method' => 'E-Wallet',
                    'address' => $_SESSION['address'] ?? null,
                    'payment_id' => $transactionID,
                    'amount' => $paidAmount
				));

				unset($_SESSION['user_id']);
				unset($_SESSION['product_id']);
				unset($_SESSION['amount']);
				unset($_SESSION['address']);

				echo json_encode([
					'payment_id' => base64_encode($payment_id)
				]);
			} else {
				unset($_SESSION['user_id']);
				unset($_SESSION['product_id']);
				unset($_SESSION['amount']);
				unset($_SESSION['address']);

				http_response_code(500);
				echo json_encode(['error' => 'Transaction has been failed!']);
			}
		}
	}
}
