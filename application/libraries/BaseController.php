<?php defined('BASEPATH') or exit('No direct script access allowed');

class BaseController extends CI_Controller
{
	protected $global = array();
	protected $metadata = null;

	public function __construct()
	{
		parent::__construct();

		$this->metadata = (object) [
			'pageView' => NULL,
		];

		$this->load->model('Manageuser_model', 'manage_user');
	}

	function profile()
	{
		$user = $this->session->userdata('user');
        $role = $user[0]->role;
        $user_id  = $user[0]->id_user;

        $profil = $this->manage_user->getDataAll($user_id, $role);

        $this->metadata->pageView = "profile";

        $this->global['data'] = (object) [
            'profile' => $profil
        ];
	}
	/**
	 * This function used to load views
	 * @param {string} $viewName : This is view name
	 * @param {mixed} $headerInfo : This is array of header information
	 * @param {mixed} $pageInfo : This is array of page information
	 * @param {mixed} $footerInfo : This is array of footer information
	 * @return {null} $result : null
	 */
	function loadViews($viewName = "", $pageInfo = NULL)
	{
		$pageInfo['pageView']   = $this->metadata->pageView;

		$this->load->view($viewName, $pageInfo);
	}
}
