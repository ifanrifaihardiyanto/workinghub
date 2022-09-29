<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Managetransaksi extends BaseController {
    
    public function __construct()
	{
		parent::__construct();
		//Do your magic here
        $this->load->model('Auth_model', 'auth');
        $this->load->library('form_validation');
        $this->load->model('user_model', 'user');
        $this->load->model('admin/Managetransaksi_model', 'manage_transaksi');
	}

    public function data_penyewaan()
    {
        $data_penyewaan = $this->manage_transaksi->data_penyewaan_on_admin();

        $this->global['penyewaan'] = [
            'data_penyewaan' => $data_penyewaan
        ];

        $this->profile();

        $this->metadata->pageView = "dashboard/admin/data_penyewaan";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    public function validasi()
    {
        $data_penyewaan = $this->manage_transaksi->data_penyewaan_on_admin();

        $this->global['penyewaan'] = [
            'data_penyewaan' => $data_penyewaan
        ];
        
        $this->profile();

        $this->metadata->pageView = "dashboard/admin/validasi_pembayaran";

        $this->loadViews("includes/dashboard/main", $this->global);
    }
}