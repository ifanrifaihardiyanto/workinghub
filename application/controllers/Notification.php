<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-uTWYi5R1GwV2G5wP-UfOUjfv', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
		$this->load->model('Payment_model', 'payment');
	}

	public function index()
	{
		echo 'test notification handler';
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);
		$status_code = $result->status_code;
		$status_message = $result->status_message;
		$order_code = $result->order_id;
		$total = $result->payment_amounts[0]->amount;
		$paid_at = $result->payment_amounts[0]->paid_at;
		$transaction_status = $result->transaction_status;

		$this->payment->updateStatus($order_code, $status_code, $status_message, $transaction_status, $paid_at, $total);
	}
}