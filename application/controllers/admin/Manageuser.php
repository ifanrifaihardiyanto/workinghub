<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Manageuser extends BaseController {
    
    public function __construct()
	{
		parent::__construct();
		//Do your magic here
        // $this->load->model('Auth_model', 'auth');
        $this->load->model('admin/manageuser_model', 'manage_user');
        $this->load->model('user_model', 'user');
        $this->load->model('Manageprofile_model', 'manage_profile');
        $this->load->library('form_validation');
	}

    public function index()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if (!isset($isLoggedIn) || $isLoggedIn != true) {
            $this->get_data();
        }

        $this->get_data();
    }

    public function get_data()
    {
        $result = $this->manage_user->getDataAllUser();

        $this->global['hasil']['data_user'] = $result;

        $this->profile();

        $this->metadata->pageView = "dashboard/admin/data_user";

        $this->loadViews("includes/dashboard/main", $this->global);
    }

    // public function get_data_by_ajax()
    // {
    //     $result = $this->manage_user->getDataAllUser();
    //     // var_dump($result);

    //     print_r($result);

    //     return $this->response(200, [
    //         "message"           => "Successfully get data.",
    //         "data"              => $result
    //     ]);
    // }

    public function hapus($id)
    {
        $user = $this->user->getUser($id);
        $role = $user[0]->role;

        $result = $this->manage_user->hapus($id, $role);

        $this->session->set_flashdata('success', 'Data berhasil dihapus!');

        redirect('index.php/admin/manageuser');
    }

    public function edit($id)
    {
        $user = $this->user->getUser($id);
        $role = $user[0]->role;

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim');
        $this->form_validation->set_rules('noTelp', 'Nomor Telepon', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('tmptLahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('tglLahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('rekBNI', 'Rekening BNI', 'required|trim');
        $this->form_validation->set_rules('rekBRI', 'Rekening BRI', 'required|trim');
        $this->form_validation->set_rules('rekMandiri', 'Rekening Mandiri', 'required|trim');
        $this->form_validation->set_rules('rekBCA', 'Rekening BCA', 'required|trim');

        // print_r($role);
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

            $this->manage_profile->edit($id, $nama, $tmptLahir, $tglLahir, $alamat, $nik, $noTelp, $rekBNI, $rekBRI, $rekMandiri, $rekBCA, $role);

            $this->profile();

            $this->session->set_flashdata('success', 'Berhasil mengubah data!');

            redirect('index.php/admin/manageuser');

        // if ($this->form_validation->run() == false) {
        //     // redirect('index.php/admin/manageuser');
        //     print_r($role);
        // } else {
            
        // }
    }
}