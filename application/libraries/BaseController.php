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

		$this->load->model('Manageprofile_model', 'manage_profile');
	}

	function profile()
	{
		$user = $this->session->userdata('user');
		
		$profil = [];
		if (!empty($user)) {
			$role = $user[0]->role;
			$user_id  = $user[0]->id_user;

			$profil = $this->manage_profile->getDataAll($user_id, $role);
		}

        $this->metadata->pageView = "profile";

        $this->global['data'] = (object) [
            'profile' => $profil
        ];
	}

	public function response($status_code, $data = NULL)
	{
		$this->output
			->set_status_header($status_code)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
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

	function paginationCompress($link, $count, $perPage = 2)
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url() . $link;
		$config['total_rows'] = $count;
		$config['uri_segment'] = SEGMENT;
		$config['per_page'] = $perPage;
		$config['num_links'] = 5;
		$config['full_tag_open'] = '<nav><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['first_tag_open'] = '<li class="arrow">';
		$config['first_link'] = 'First';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="arrow">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="arrow">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="arrow">';
		$config['last_link'] = 'Last';
		$config['last_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$page = $config['per_page'];
		$segment = $this->uri->segment(SEGMENT);

		return array(
			"page" => $page,
			"segment" => $segment
		);
	}
}
