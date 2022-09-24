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
        $this->load->model('admin/Manageruangan_model', 'manage_ruangan');
	}

    public function index()
    {
        $this->profile();

        $this->metadata->pageView = "dashboard/admin/validasi_ruangan";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    public function manage_data_ruangan()
    {
        $ruangan = $this->manage_ruangan->find_data_ruangan();

        $this->global['gedung'] = [
            'ruangan' => $ruangan
        ];
        
        $this->profile();

        $this->metadata->pageView = "dashboard/admin/validasi_ruangan";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    public function activation($id)
    {
        $this->manage_ruangan->activation_ruangan($id);

        $this->session->set_flashdata('success', 'Aktivasi data ruangan berhasil!');

        redirect('index.php/admin/manageruangan/manage_data_ruangan');
    }

    public function nonActivation($id)
    {
        $user = $this->session->userdata('user');
        $user_id  = $user[0]->id_user;

        $penolakan = $this->input->post('penolakan');

        $this->manage_ruangan->non_activation_ruangan($penolakan, $id, $user_id);

        $this->session->set_flashdata('success', 'Penolakan penyewaan data ruangan berhasil!');

        redirect('index.php/admin/manageruangan/manage_data_ruangan');
    }
}