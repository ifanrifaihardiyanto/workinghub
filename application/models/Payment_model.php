<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertOrder($name, $no_tlp, $email, $name_gedung, $name_ruangan, $order_code, $order_date, $start_date, $end_date, $duration_type, $duration_amount, $building_id, $duration_id, $room_id, $partner_id, $customer_id)
    {
        $sql = "insert into `order` (customer, no_tlp, email, building_name, room_name, order_code, order_date, start_date, end_date, duration_type, duration_amount, building_id, duration_id, room_id, partner_id, customer_id, created_at, updated_at) 
        values 
        ('$name', '$no_tlp', '$email', '$name_gedung', '$name_ruangan', '$order_code', '$order_date', '$start_date', '$end_date', '$duration_type', '$duration_amount', '$building_id', '$duration_id', '$room_id', '$partner_id', '$customer_id', now(), now())";

        $this->db->query($sql);
    }

    public function getOrder($order_code)
    {
        $sql = "select * from `order` where order_code='$order_code'";

        return $this->db->query($sql)->row();
    }

    public function insertInvoice($order_id, $room_id, $building_id, $payment_id)
    {
        $sql = "insert into invoice (order_id, room_id, building_id, payment_id) 
        values ('$order_id', '$room_id', '$building_id', '$payment_id')";

        $this->db->query($sql);
    }

    public function insertPayment($status_code, $status_message, $transaction_id, $total, $payment_type, $bank,	$va_number,	$transaction_status, $pdf_instruction, $activation, $order_id)
    {
        $sql = "insert into payment (status_code, status_message, transaction_id, total, payment_type, bank, va_number,	transaction_status, pdf_instruction, activation, order_id, created_at, updated_at)
        values ('$status_code', '$status_message', '$transaction_id', '$total', '$payment_type', '$bank', '$va_number',	'$transaction_status', '$pdf_instruction', '$activation', '$order_id', now(), now())";
        
        $this->db->query($sql);
    }
}