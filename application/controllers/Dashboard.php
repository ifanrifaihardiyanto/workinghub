<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Dashboard extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'auth');
    }

    public function index()
    {
        $this->metadata->pageView = "errors/maintenance";

        $user = $this->session->userdata('user');

        $user_id  = $user[0]->id_user;
        $role     = strtolower($user[0]->role);

        $profil = $this->auth->getDataAll($user_id, $role);
        print_r($profil);

        $this->global['data'] = (object) [
            'profile' => $profil
        ];

        $this->loadViews("includes/dashboard/main", NULL, $this->global, NULL);
    }
}
