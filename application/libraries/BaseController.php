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
