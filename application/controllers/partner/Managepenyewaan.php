<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Managepenyewaan extends BaseController
{

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
        $id_penyedia    = $user[0]->id;

        $data_penyewaan = $this->manage_penyewaan->data_penyewaan_on_dashboard($id_penyedia);

        $this->global['penyewaan_on_partner'] = [
            'data_penyewaan' => $data_penyewaan
        ];

        $this->profile();

        $this->metadata->pageView = "dashboard/partner/riwayat_penyewaan";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    public function pendapatan()
    {
        $user           = $this->session->userdata('user');
        $id_penyedia    = $user[0]->id;

        $data_pendapatan = $this->manage_penyewaan->pendapatan($id_penyedia);

        $this->global['pendapatan'] = [
            'data_activeSewa' => $data_pendapatan->activeSewa,
            'data_pendapatan' => $data_pendapatan->pendapatan,
            'total_pendapatan' => $data_pendapatan->total_pendapatan,
        ];

        $this->profile();

        $this->metadata->pageView = "dashboard/partner/data_pendapatan";

        $this->loadViews("includes/dashboard/main", $this->global);
    }
}