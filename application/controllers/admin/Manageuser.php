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
        // $this->load->library('form_validation');
	}

    public function index()
    {
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

        if (empty($result)) {
            $this->session->flashdata('error', 'Data gagal dihapus!');
        }

        $this->session->flashdata('success', 'Data berhasil dihapus!');

        $this->loadView();
    }

    public function loadView()
    {
        $this->profile();

        $this->metadata->pageView = "dashboard/admin/data_user";

        $this->loadViews("includes/dashboard/main", $this->global);
    }
}