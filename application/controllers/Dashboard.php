<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Dashboard extends BaseController {
    
    public function __construct()
    {
		  parent::__construct();
    }
    
    public function index()
    {
        $this->metadata->pageView = "errors/maintenance";

        $this->loadViews("includes/dashboard/main", NULL, $this->global, NULL);
    }
}