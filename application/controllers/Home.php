<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Home extends BaseController {
    
    public function __construct()
    {
		parent::__construct();
    }
    
    public function index()
    {
        $this->metadata->pageView = "booking/index";

        $this->loadViews("includes/booking/main", NULL, $this->global, NULL);
    }
}