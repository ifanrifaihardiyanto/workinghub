<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Manageprofile extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Manageprofile_model', 'manage_profile');
    }

    public function index()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        $user = $this->session->userdata('user');

        $load = "booking";
        if (strtolower($user[0]->role) !== 'customer') {
            $load = "dashboard";
        }

        $this->profile();

        $this->metadata->pageView = "profile";

        $this->loadViews("includes/" . $load . "/main", $this->global);
    }

    public function edit()
    {
        $user = $this->session->userdata('user');

        $user_id    = $user[0]->id_user;
        $role       = strtolower($user[0]->role);
        $load       = "booking";
        if (strtolower($user[0]->role) !== 'customer') {
            $load = "dashboard";
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim');
        $this->form_validation->set_rules('noTelp', 'Nomor Telepon', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('tmptLahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('tglLahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        if (strtolower($user[0]->role) !== 'Admin') {
            $this->form_validation->set_rules('rekBNI', 'Rekening BNI', 'required|trim');
            $this->form_validation->set_rules('rekBRI', 'Rekening BRI', 'required|trim');
            $this->form_validation->set_rules('rekMandiri', 'Rekening Mandiri', 'required|trim');
            $this->form_validation->set_rules('rekBCA', 'Rekening BCA', 'required|trim');
        }

        if ($this->form_validation->run() == false) {
            $this->profile();

            $this->metadata->pageView = "profile";

            $this->loadViews("includes/" . $load . "/main", $this->global);
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

            $this->manage_profile->edit($user_id, $nama, $tmptLahir, $tglLahir, $alamat, $nik, $noTelp, $rekBNI, $rekBRI, $rekMandiri, $rekBCA, $role);

            $this->profile();

            $this->session->set_flashdata('success', 'Berhasil mengubah data!');

            redirect('/manageprofile');
        }
    }
}