<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Notif extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Notification_model', 'notif');
    }

    public function index()
    {
        $this->getNotif();
    }

    public function getNotif()
    {
        $user = $this->session->userdata('user');
        $id_pemesan     = 0;
        if (!empty($user)) {
            $id_pemesan     = $user[0]->id;
        }

        $this->global['result'] = (object) [
            'notif'  => $this->notif->getData($id_pemesan),
        ];

        $this->profile();

        $this->metadata->pageView = "booking/kotak_masuk";

        $this->loadViews("includes/booking/main", $this->global);
    }
}