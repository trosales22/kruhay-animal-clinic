<?php
header('Access-Control-Allow-Origin: *');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/stripe-php-7.7.0/init.php';

class Payment extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Reservation_model', 'reservation_model');
	}

	public function process_post()
	{
		\Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

		// Retrieve JSON from POST body
		$jsonStr = file_get_contents('php://input');
		$jsonObj = json_decode($jsonStr);

		if ($jsonObj->request_type == 'create_payment_intent') {
			// Define item price and convert to cents
			$itemPriceCents = round(200 * 100);

			// Set content type to JSON
			header('Content-Type: application/json');

			try {
				// Create PaymentIntent with amount and currency
				$paymentIntent = \Stripe\PaymentIntent::create([
					'amount' => $itemPriceCents,
					'currency' => 'PHP',
					'description' => 'Reservation',
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
			$pet_name = !empty($jsonObj->pet_name) ? $jsonObj->pet_name : '';
			$schedule_date = !empty($jsonObj->schedule_date) ? $jsonObj->schedule_date : '';
			$schedule_time = !empty($jsonObj->schedule_time) ? $jsonObj->schedule_time : '';
			$address = !empty($jsonObj->address) ? $jsonObj->address : '';
			$service_type = !empty($jsonObj->service_type) ? $jsonObj->service_type : '';
			
			$_SESSION['pet_name'] = $pet_name;
			$_SESSION['schedule_date'] = $schedule_date;
			$_SESSION['schedule_time'] = $schedule_time;
			$_SESSION['address'] = $address;
			$_SESSION['service_type'] = $service_type;

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

				$payment_id = $this->reservation_model->submitReservation(array(
					'user_id' => $user_id,
					'pet_name' => $_SESSION['pet_name'],
					'schedule_date' => $_SESSION['schedule_date'],
					'schedule_time' => $_SESSION['schedule_time'],
					'payment_method' => 'E-Wallet',
					'service_type' => $_SESSION['service_type'],
					'address' => $_SESSION['address'],
					'payment_id' => $transactionID,
					'amount' => $paidAmount,
					'status' => 'PAID'
				));

				unset($_SESSION['pet_name']);
				unset($_SESSION['schedule_date']);
				unset($_SESSION['schedule_time']);
				unset($_SESSION['service_type']);
				unset($_SESSION['address']);

				echo json_encode([
					'payment_id' => base64_encode($payment_id)
				]);
			} else {
				unset($_SESSION['pet_name']);
				unset($_SESSION['schedule_date']);
				unset($_SESSION['schedule_time']);
				unset($_SESSION['service_type']);
				unset($_SESSION['address']);

				http_response_code(500);
				echo json_encode(['error' => 'Transaction has been failed!']);
			}
		}
	}
}
