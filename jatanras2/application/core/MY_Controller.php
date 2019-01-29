<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $usertype;
	public $uname;
	public $userId;

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if (!$this->auth->loggedin()){
			redirect('user');	
		}
		$this->uname = $this->session->userdata('username');
		$this->usertype = $this->session->userdata('usertype');
		$this->userId = $this->session->userdata('admin_user_id');
	}

}