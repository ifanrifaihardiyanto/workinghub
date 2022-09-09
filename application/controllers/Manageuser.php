<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Manageuser extends BaseController {
    
    public function __construct()
    {
		  parent::__construct();
          $this->load->model('Manageuser_model','manage_user');
    }
    
    public function index()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if (!isset($isLoggedIn) || $isLoggedIn != true) {
            $this->load->view('auth/booking/login');
        } else {
            redirect('/index.php/home');
        }

        $user = $this->session->userdata('user');
        $role = $user[0]->role;

        if ($role == 'Pemesan') {
            redirect('/index.php/home');
        } else {
            redirect('/index.php/dashboard');
        }
    }

    public function edit()
    {
        $user = $this->session->userdata('user');

        $user_id  = $user[0]->id_user;
        $role     = strtolower($user[0]->role);
        $load = "booking";
        if ($user[0]->role !== 'Pemesan') {
            $load = "dashboard";
        }

        $getData    = $this->manage_user->getDataAll($user_id, $role);
        print_r($getData);

        $this->form_validation->set_rules('nama','Nama','required|trim');
        $this->form_validation->set_rules('nik','NIK','required|trim');
        $this->form_validation->set_rules('noTelp','Nomor Telepon','required|trim');
        $this->form_validation->set_rules('nama','Nama','required|trim');
        $this->form_validation->set_rules('tmptLahir','Tempat Lahir','required|trim');
        $this->form_validation->set_rules('tglLahir','Tanggal Lahir','required');
        $this->form_validation->set_rules('alamat','Alamat','required|trim');
        $this->form_validation->set_rules('rekBNI','Rekening BNI','required|trim');
        $this->form_validation->set_rules('rekBRI','Rekening BRI','required|trim');
        $this->form_validation->set_rules('rekMandiri','Rekening Mandiri','required|trim');
        $this->form_validation->set_rules('rekBCA','Rekening BCA','required|trim');

        if ($this->form_validation->run() == false) {
            $this->metadata->pageView = "profile";

            $this->loadViews("includes/".$load."/main", NULL, $this->global, NULL);
          } else {
            $nama       = $this->input->post('nama');
            $nik        = $this->input->post('nik');
            $noTelp     = $this->input->post('noTelp');
            $tmptLahir  = $this->input->post('tmptLahir');
            $tglLahir   = $this->input->post('tglLahir');
            $alamat     = $this->input->post('alamat');
            $rekBNI     = $this->input->post('rekBNI');
            $rekBRI     = $this->input->post('rekBRI');
            $rekMandiri = $this->input->post('rekMandiri');
            $rekBCA     = $this->input->post('rekBCA');
            
            $this->manage_user->edit($user_id, $nama, $tmptLahir, $tglLahir, $alamat, $nik, $noTelp, $rekBNI, $rekBRI, $rekMandiri, $rekBCA, $role);
      
            $this->session->set_flashdata('success', 'Berhasil mengubah data!');
      
            $this->metadata->pageView = "profile";

            $this->loadViews("includes/".$load."/main", NULL, $this->global, NULL);
          }
    }

    public function delete()
    {
        
    }
}