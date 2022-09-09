<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Managepembayaran extends BaseController {
    
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

        $this->metadata->pageView = "dashboard/admin/data_pembayaran";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    public function validasi()
    {
        $this->profile();

        $this->metadata->pageView = "dashboard/admin/validasi_pembayaran";

        $this->loadViews("includes/dashboard/main", $this->global);
    }
}