<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Managepenyewaan extends BaseController {
    
    public function __construct()
	{
		parent::__construct();
		//Do your magic here
        $this->load->model('user_model', 'user');
        $this->load->model('partner/Managepenyewaan_model', 'manage_penyewaan');
	}

    public function index()
    {
        $this->data_penyewaan();
    }

    public function data_penyewaan()
    {
        $user           = $this->session->userdata('user');
        $id_penyedia    = $user[0]->id_penyedia;

        $data_penyewaan = $this->manage_penyewaan->data_penyewaan_on_dashboard($id_penyedia);

        $this->global['penyewaan_on_partner'] = [
            'data_penyewaan' => $data_penyewaan
        ];

        $this->profile();

        $this->metadata->pageView = "dashboard/partner/riwayat_penyewaan";

        $this->loadViews("includes/dashboard/main", $this->global);
    }
}