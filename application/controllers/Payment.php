<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-uTWYi5R1GwV2G5wP-UfOUjfv', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
		$this->load->model('Payment_model', 'payment');
	}

	public function index()
	{
		$this->load->view('checkout_snap');
	}

	public function token()
	{
		$order_id = strtoupper("WH-" . random_string('alnum', 8));
		$harga = $this->input->post('harga');
		$id_ruangan = $this->input->post('id_ruangan');
		$name_ruangan = $this->input->post('name_ruangan');
		$name_gedung = $this->input->post('name_gedung');
		$name = $this->input->post('name');
		$no_tlp = $this->input->post('no_tlp');
		$email = $this->input->post('email');

		// Required
		$transaction_details = array(
			'order_id' => $order_id,
			'gross_amount' => $harga, // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
			'id' => $id_ruangan,
			'price' => $harga,
			'quantity' => 1,
			'name' => $name_gedung . ' - ' . $name_ruangan,
		);

		// Optional
		$item_details = array($item1_details);

		// Optional
		$customer_details = array(
			'first_name'    => $name,
			'last_name'     => "",
			'email'         => $email,
			'phone'         => $no_tlp,
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'hour',
			'duration'  => 2
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);

		error_log($snapToken);
		echo $snapToken;
	}

	public function finish()
	{
		$start_date = $this->input->post('tglPenyewaan');
		$end_date = $this->input->post('tglSelesai');
		$duration_type = $this->input->post('tipeDurasi');
		$duration_amount = $this->input->post('jmlDurasi');
		$building_id = $this->input->post('id_gedung');
		$room_id = $this->input->post('id_ruangan');
		$duration_id = $this->input->post('id_durasi');
		$partner_id = $this->input->post('id_penyedia');
		$customer_id = $this->input->post('id_user');
		$name_ruangan = $this->input->post('name_ruangan');
		$name_gedung = $this->input->post('name_gedung');
		$name = $this->input->post('name');
		$no_tlp = $this->input->post('no_tlp');
		$email = $this->input->post('email');
		$startHour = $this->input->post('startHour');
		$endHour = $this->input->post('endHour');

		$result = json_decode($this->input->post('result_data'));
		$status_code = $result->status_code;
		$status_message = $result->status_message;
		$transaction_id = $result->transaction_id;
		$order_code = $result->order_id;
		$total = $result->gross_amount;
		$payment_type = $result->payment_type;
		$order_date = $result->transaction_time;
		$transaction_status = $result->transaction_status;
		$pdf_instruction = $result->pdf_url;
		$bank = $result->va_numbers[0]->bank;
		$va_number = $result->va_numbers[0]->va_number;

		$this->payment->insertOrder($name, $no_tlp, $email, $name_gedung, $name_ruangan, $order_code, $order_date, $start_date, $end_date, $duration_type, $duration_amount, $building_id, $duration_id, $room_id, $partner_id, $customer_id, $startHour, $endHour);

		$getIdOrder = $this->payment->getOrder($order_code);
		$activation = 0;
		$this->payment->insertPayment($status_code, $status_message, $transaction_id, $total, $payment_type, $bank,	$va_number,	$transaction_status, $pdf_instruction, $activation, $getIdOrder->id, $customer_id, $order_code);

		redirect('order/list');
	}
}