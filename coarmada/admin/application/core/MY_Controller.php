<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );


class MY_Controller extends CI_Controller {
    
    public $level;
    public $user_id;
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
				redirect(base_url("login"));
		}
		$this->level  = $this->session->userdata('level');
		$this->user_id = $this->session->userdata('user_id');
	}

    function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){

        $this->load->view('_includes/header', $headerInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('_includes/footer', $footerInfo);
    }
   	
}