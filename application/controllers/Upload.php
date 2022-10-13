<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Upload extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->metadata->pageView = "test";

        $this->profile();

        $this->loadViews("includes/dashboard/main", $this->global);
    }
}