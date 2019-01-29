<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sintel extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		$data['pageTitle']	= 'Koarmada - Staff Intelijen';
		$this->loadViews('Admin/sintel',$data, null, null);
	}
	
}

/* End of file Sintel.php */
/* Location: ./application/controllers/Sintel.php */