<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Order extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Search_model', 'search');
        $this->load->model('Order_model', 'order');
    }

    public function index()
    {
        $this->list();
    }

    public function list()
    {
        $user           = $this->session->userdata('user');
        $id_pemesan     = $user[0]->id_pemesan;

        $list_tagihan = $this->order->data_tagihan($id_pemesan);

        $this->global['result'] = (object) [
            'tagihan' => $list_tagihan,
        ];

        $this->profile();

        $this->metadata->pageView = "booking/pesanan_saya";

        $this->loadViews("includes/booking/main", $this->global);
    }

    public function detail_tagihan($kode_pemesanan)
    {
        $detail_tagihan = $this->order->detail_tagihan($kode_pemesanan);

        $this->global['result'] = (object) [
            'tagihan' => $detail_tagihan,
        ];

        $this->profile();

        $this->metadata->pageView = "booking/detail_tagihan";

        $this->loadViews("includes/booking/main", $this->global);
    }
}