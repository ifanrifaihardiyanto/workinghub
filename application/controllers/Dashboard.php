<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Dashboard extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model', 'dashboard');
    }

    public function dash()
    {
        $this->profile();

        $this->metadata->pageView = "dashboard/index";

        $partner = $this->dashboard->dashboard_partner();
        $admin = $this->dashboard->dashboard_admin();

        $this->global['dashboard'] = (object) [
            'partner' => $partner,
            'admin' => $admin,
        ];

        $this->loadViews("includes/dashboard/main", $this->global);
    }
}