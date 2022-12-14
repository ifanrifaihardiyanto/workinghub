<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Home extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'auth');
        $this->load->model('Search_model', 'search');
    }

    public function index()
    {
        $this->metadata->pageView = "booking/index";

        $lokasi = $this->search->find_lokasi();

        $this->global['search'] = (object) [
            'lokasi' => $lokasi
        ];

        $user = $this->session->userdata('user');
        $load = "booking";

        $profil = [];

        if (!empty($user)) {
            $user_id  = $user[0]->id_user;
            $role     = strtolower($user[0]->role);

            if (strtolower($user[0]->role) !== 'customer') {
                redirect('dashboard/dash');
            }

            $profil = $this->auth->getDataAll($user_id, $role);
        }

        $this->global['data'] = (object) [
            'profile' => $profil
        ];

        $this->loadViews("includes/" . $load . "/main", $this->global);
    }
}