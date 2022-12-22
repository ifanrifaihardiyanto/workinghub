<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . 'views/vendor/autoload.php';

class Order extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model', 'order');
        $this->load->model('Search_model', 'search');
    }

    public function index()
    {
        $this->list();
    }

    public function list()
    {
        $user           = $this->session->userdata('user');
        $id_pemesan     = 0;
        if (!empty($user)) {
            $id_pemesan     = $user[0]->id;
        }

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
        $cancel_date = $this->order->cancel_rent($kode_pemesanan);

        $this->global['result'] = (object) [
            'tagihan' => $detail_tagihan,
            'cancel_date' => $cancel_date,
            'startHour' => array_map(function ($item) {
                if ($item < 10) {
                    $startHour = "0$item";
                } else {
                    $startHour = "$item";
                }
                return $startHour;
            }, range(8, 22)),
            'endHour' => array_map(function ($item) {
                if ($item < 10) {
                    $endHour = "0$item";
                } else {
                    $endHour = "$item";
                }
                return $endHour;
            }, range(8, 22)),
        ];

        $this->profile();

        $this->metadata->pageView = "booking/detail_tagihan";

        $this->loadViews("includes/booking/main", $this->global);
    }

    public function cancelPenyewaan($order_code)
    {
        $id_ruangan     = $this->input->post('id_ruangan');
        $duration       = $this->input->post('durasi');
        $cancel_date    = $this->input->post('tglCancel');
        $cancel_date    = date('Ymd', strtotime($cancel_date));

        $startHour      = $this->input->post('startHour');
        $endHour        = $this->input->post('endHour');

        $this->order->insert_cancel_rent($cancel_date, $startHour, $endHour, $duration, $order_code, $id_ruangan);

        $this->session->set_flashdata('success', 'Tanggal cancel berhasil ditambahkan!');

        $isInvalidDate = $this->order->tersewa($id_ruangan, $duration);

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            'c14531a571ba79886871',
            'f16312d08704e9192095',
            '1515905',
            $options
        );

        $data['message'] = json_encode($isInvalidDate, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $pusher->trigger('my-channel', 'my-event', $data);

        redirect('order/detail_tagihan/' . $order_code);
    }

    public function isOrderDate()
    {
        $id_ruangan = $this->input->get('id_ruangan');
        $duration   = $this->input->get('durasi');

        $isInvalidHour = $this->order->rentHours($id_ruangan, $duration);
        $isInvalidDate = $this->order->rentDate($id_ruangan, $duration);

        if ($duration == 'Jam') {
            return $this->response(200, [
                "message" => "Successfully get witels.",
                "date" => $isInvalidDate,
                "hour" => $isInvalidHour,
            ]);
        } else {
            return $this->response(200, [
                "message" => "Successfully get witels.",
                "date" => $isInvalidDate,
                "hour" => "is not hour",
            ]);
        }
    }
}