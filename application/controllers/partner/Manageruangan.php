<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Manageruangan extends BaseController {
    
    public function __construct()
	{
		parent::__construct();
		//Do your magic here
        // $this->load->model('Auth_model', 'auth');
        // $this->load->library('form_validation');
	}

    public function index()
    {
        $this->profile();

        $this->metadata->pageView = "dashboard/partner/data_ruangan";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    public function addGedung()
    {
        $this->profile();

        $this->metadata->pageView = "dashboard/partner/gedung";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    public function addRuangan()
    {
        $this->profile();

        $this->metadata->pageView = "dashboard/partner/tambah_ruangan";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    public function penyewaan()
    {
        $this->profile();

        $this->metadata->pageView = "dashboard/partner/riwayat_penyewaan";

        $this->loadViews("includes/dashboard/main", $this->global);
    }
}