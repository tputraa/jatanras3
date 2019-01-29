<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard Class
 */
class Dashboard extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();

	    $this->load->model('renmin/summary_model');
	    
	}

	/**
	 * Default method of dashboard class
	 */
	public function index()
	{				

		if (!$this->auth->loggedin())
		{	
			
			redirect('user','refresh');				
		} 
		else 
		{
			$data['page'] = 'renmin/dashboard';
		}	
		
		$user_id = $this->session->userdata('kon_id');
		$data['record_count_media'] = $this->summary_model->record_count_media($user_id);   
		$data['record_count_kasubdit'] = $this->summary_model->record_count_kasubdit();   
		$data['record_count_kanit'] = $this->summary_model->record_count_kanit();   
		$data['record_count_penyidik'] = $this->summary_model->record_count_penyidik($user_id);   
		$data['record_count_pasal'] = $this->summary_model->record_count_pasal();   
		$data['record_count_visit'] = $this->summary_model->record_count_visit();
		
		$this->load->view('renmin/page',$data);
	}

	
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */
