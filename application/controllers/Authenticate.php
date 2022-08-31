<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller {
    
  public function __construct()
	{
		parent::__construct();
		//Do your magic here
		// $this->load->model('Auth_model');
    $this->load->model('Login_model', 'loggedIn');
	}

  public function index()
  {
    $this->load->view('auth/booking/login');
  }

  public function logging_in()
  {
    $this->load->view('includes/booking/main');
  }

  public function register()
  {
		$this->load->view('auth/booking/register');
  }

  public function completed_data()
  {
		$this->load->view('auth/booking/completed_data');
  }
}