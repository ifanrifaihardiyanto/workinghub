<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Home extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'auth');
    }

    public function index()
    {
        $this->metadata->pageView = "booking/index";

        $user = $this->session->userdata('user');

        $user_id  = $user[0]->id_user;
        $role     = strtolower($user[0]->role);

        $load = "booking";
        if ($user[0]->role !== 'Pemesan') {
            $load = "dashboard";
            $this->metadata->pageView = "errors/maintenance";
        }

        $profil = $this->auth->getDataAll($user_id, $role);

        $this->global['data'] = (object) [
            'profile' => $profil
        ];

        $this->loadViews("includes/" . $load . "/main", $this->global);
    }
}
