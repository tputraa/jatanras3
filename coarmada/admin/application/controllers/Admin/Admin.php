<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		 $this->global['pageTitle'] = 'Koarmada - Dashboard';
        
        $this->loadViews("Admin/dashboard", $this->global, NULL , NULL);
	}



}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */