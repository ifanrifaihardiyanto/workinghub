<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Manageuser extends BaseController {
    
    public function __construct()
	{
		parent::__construct();
		//Do your magic here
        // $this->load->model('Auth_model', 'auth');
        // $this->load->model('admin/manageuser_model', 'test');
        // $this->load->library('form_validation');
	}

    public function index()
    {
        // $result = $this->test->getDataAllUser();
        // var_dump($result);

        // print_r($result);

        $this->profile();

        $this->metadata->pageView = "dashboard/admin/data_user";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    public function get_data_by_ajax()
    {
        
    }
}