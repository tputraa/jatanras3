<?php
/**
 * Media Manager for Codeigniter
 *
 * @package    CodeIgniter
 * @author     Prashant Pareek
 * @link       http://codecanyon.net/item/media-manager-for-codeigniter/9517058
 * @version    2.3.0
 * yayasank_doc > xLWO~LCu=kzz > db yayasank_doc
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard Class
 */
class Dashboard extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();

	    $this->load->model('penyidik/summary_model');
	    
	}

	public function index()
	{				

		if (!$this->auth->loggedin())
		{	
			
			redirect('user','refresh');				
		} 
		else 
		{
			$data['page'] = 'penyidik/dashboard';
		}	
		
		$data['record_count_media'] = $this->summary_model->record_count_media();   
		$data['record_count_kasubdit'] = $this->summary_model->record_count_kasubdit();   
		$data['record_count_kanit'] = $this->summary_model->record_count_kanit();   
		$data['record_count_penyidik'] = $this->summary_model->record_count_penyidik();   
		$data['record_count_pasal'] = $this->summary_model->record_count_pasal();   
		$data['record_count_visit'] = $this->summary_model->record_count_visit();   
		
		$this->load->view('penyidik/page',$data);
	}

	function logout()
	{		
		$this->session->set_userdata(array('admin_loggedin' => FALSE, 'auth_user_id' => FALSE));		
		$this->index();
	}
	
}