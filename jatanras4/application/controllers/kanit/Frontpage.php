<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontpage extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/summary_model');
		if($this->usertype != 3){
			redirect('user');
		}
	}

	public function index()
	{
		if($this->session->userdata('admin_loggedin')) 
		//if ($this->auth->loggedin())    
		{	
			$data['page'] = 'kanit/frontpage';					
		} 
		else 
		{
			$data['page'] = 'admin/login';
		}	
		$data['document_baru'] = $this->summary_model->document_baru();
		$data['document_proses'] = $this->summary_model->document_proses();
		$data['document_selesai'] = $this->summary_model->document_selesai();

		$this->load->view('admin/frontpage_dashboard',$data);
	}

}

/* End of file Frontpage.php */
/* Location: ./application/controllers/Frontpage.php */