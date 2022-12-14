<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Manageuser extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('url');
        $this->load->library('form_validation', 'upload');
        $this->load->model('Auth_model', 'auth');
        $this->load->model('admin/manageuser_model', 'manage_user');
        $this->load->model('Manageprofile_model', 'manage_profile');
        $this->load->model('user_model', 'user');
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

    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim');
        $this->form_validation->set_rules('noTelp', 'Nomor Telepon', 'required|trim');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[user.username]',
            ['is_unique' => 'Email sudah pernah digunakan!']
        );
        $this->form_validation->set_rules('tmptLahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('tglLahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        $email  = $this->input->post('email');

        if ($this->form_validation->run() == false) {
            if ($email == '') {
                $this->session->set_flashdata('error', 'Data input ada yang kosong!');
            } else {
                $this->session->set_flashdata('error', 'Data user gagal ditambahkan, email sudah pernah dipakai!');
            }

            redirect('admin/manageuser');
        } else {
            $isLoggedIn = $this->session->userdata('isLoggedIn');

            if (!isset($isLoggedIn) || $isLoggedIn != true) {
                $this->load->view('auth/booking/login');
            }

            $email      = $this->input->post('email');
            $role       = $this->input->post('role');
            $password   = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $nama       = $this->input->post('nama');
            $nik        = $this->input->post('nik');
            $noTelp     = $this->input->post('noTelp');
            $tmptLahir  = $this->input->post('tmptLahir');
            $tglLahir   = $this->input->post('tglLahir');
            $alamat     = $this->input->post('alamat');
            $activation = 1;
            $rekBNI     = 0;
            $rekBRI     = 0;
            $rekMandiri = 0;
            $rekBCA     = 0;

            $this->auth->insertUser($email, $password, $role, $activation);

            $user = $this->manage_user->get_id_user($email, $role);
            $user_id  = $user[0]->id;

            $this->auth->completedData($user_id, $nama, $tmptLahir, $tglLahir, $alamat, $nik, $email, $noTelp, $rekBNI, $rekBRI, $rekMandiri, $rekBCA, $role);

            $this->profile();

            $this->session->set_flashdata('success', 'Data user berhasil ditambahkan!');

            redirect('/admin/manageuser');
        }
    }

    public function aktif($id)
    {
        $this->manage_user->aktif($id);

        $this->session->set_flashdata('success', 'Data berhasil diaktifkan kembali!');

        redirect('admin/manageuser');
    }

    public function nonaktif($id)
    {
        $this->manage_user->nonaktif($id);

        $this->session->set_flashdata('success', 'Data berhasil dinonaktifkan!');

        redirect('admin/manageuser');
    }

    public function edit($id)
    {
        $user = $this->user->getUser($id);
        $role = $user[0]->role;

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim');
        $this->form_validation->set_rules('noTelp', 'Nomor Telepon', 'required|trim');
        $this->form_validation->set_rules('tmptLahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('tglLahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('rekBNI', 'Rekening BNI', 'required|trim');
        $this->form_validation->set_rules('rekBRI', 'Rekening BRI', 'required|trim');
        $this->form_validation->set_rules('rekMandiri', 'Rekening Mandiri', 'required|trim');
        $this->form_validation->set_rules('rekBCA', 'Rekening BCA', 'required|trim');

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

        if ($this->form_validation->run() == false) {
            $this->profile();

            $this->session->set_flashdata('error', 'Gagal mengubah data!');

            redirect('admin/manageuser');
        } else {

            $this->manage_profile->edit($id, $nama, $tmptLahir, $tglLahir, $alamat, $nik, $noTelp, $rekBNI, $rekBRI, $rekMandiri, $rekBCA, $role);

            $this->profile();

            $this->session->set_flashdata('success', 'Berhasil mengubah data!');

            redirect('admin/manageuser');
        }
    }
}