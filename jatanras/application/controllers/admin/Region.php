<?php
/**
 * Media Manager for Codeigniter
 *
 * @package    CodeIgniter
 * @author     Prashant Pareek
 * @link       http://codecanyon.net/item/media-manager-for-codeigniter/9517058
 * @version    2.3.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Countries Class
 */
class Region extends CI_Controller {
	
	var $view = 'admin/index';	
	var $limit;

	/**
	 * Constructor, initializes the libraries and model
	 */
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('admin_loggedin')) 
		{        	
			// redirect user to login page						
			redirect('admin/dashboard','refresh');
		}  

		$this->load->model('admin/region_model');
		$this->load->library('pagination'); 

		$this->limit = $this->session->userdata('region.filter.limit');	
	}

	/**
	 * Default method of users class
	 */
	public function index()
	{				
		// pagination configuration		
		$config = array();		
		$config['base_url'] = base_url() . 'admin/region/index';
		$config['total_rows'] = $this->region_model->record_count();
		$config['per_page'] = $this->limit ? $this->limit : 10;
		$config['uri_segment'] = 4;
		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		// set details to load on page
		$data['region'] = $this->region_model->get_list($config['per_page'], $page);
		$data['pagination'] = $this->pagination->create_links();
		$data['enteries'] = 'Showing '.($page + 1).' to '.($page + count($data['region'])).' of '.$config['total_rows'].' entries'; 
		$data['page'] = 'admin/cabang';		

		$this->load->view($this->view,$data);
	}

	/**
	 * Method to set query filters in session
	 */
	public function get_results()
	{
		$data = $this->input->post();
		$this->session->set_userdata('region.filter.limit', (int) $data['limit']);
		$this->session->set_userdata('region.filter.search', (string) $data['search']);
		redirect(site_url('admin/region'),'refresh');
	}

	/**
	 * Method to load edit page of country form, load 
	 * country details if country id is supplied
	 *
	 * @param  int  $id  country ID
	 */
	public function edit_details($id = NULL)
	{
		if($id != NULL) {
			$data['item'] = $this->region_model->get_item($id);
		}
		
		$data['page'] = 'admin/edit_region';		
		$this->load->view($this->view,$data);
	}

	/**
	 * Method to create new country or update one
	 */
	public function save_details()
	{		
		$country_id = $this->input->post('id');		

		$this->load->library('form_validation');	

		// set bootstrap error delimiter for registration form
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');		

		// set validation rules for signup form fields
		$this->form_validation->set_rules('name', 'Name', 'trim|required|strip_tags|min_length[3]|max_length[100]');		

		// set default page load data					
		$data['page'] = 'admin/edit_country';			

		// if form validation fails load signup form	
		if($this->form_validation->run() == FALSE)
		{						
			$this->load->view($this->view,$data);
			return false;			
		}	

		// update user details
		$result = $this->region_model->update_details();	

		if(!$country_id) // new user
		{ 			
			
			$resutl = $this->db->query("SELECT count(*) as id FROM region ORDER BY id DESC LIMIT 1")->row();
			$user_id = $resutl->id;

			//exit();

			
			$this->load->config('app');
			$media_path = $this->config->item('media_path');
			
			// create constant for user media base directory
			$mm_base = FCPATH.$media_path.'/'.$user_id;
			$mm_base = str_replace(DIRECTORY_SEPARATOR, '/', $mm_base.'/');			
			define('MM_BASE', $mm_base);	

			// create folder to save user media
			if (!is_dir($mm_base)) {
			    if(!mkdir($mm_base, 0755, TRUE)){
			    	exit('Could not create user media directory.');									
			    }
			}	

			// check result
			switch($result)
			{
				case 0: // could not save user details into database
								$msg = 'An error occured while creating new entry for cabang.';
								$type = 'danger';
								break;
						
				case 1: // account is created and activation email is sent to user
								$msg = 'Successfully created new entry for cabang.';
								$type = 'success';					
								break;																		
						
				default: break;						
			}
		} 
		else 
		{
			// check result
			switch($result)
			{
				case 0: // could not update user details
								$msg = 'Could not update cabang name.';
								$type = 'danger';
								break;

				case 1: // user details updated
								$msg = 'cabang name updated successfully.';
								$type = 'success';
								break;

				default: break;
			}
		}		
		
		// set notification message
		$this->base->set_message($msg,$type);	

		///exit();

		redirect(site_url('admin/region'),'refresh');
		
		return true;
	}	

	function list_cabang(){
		$data['region'] = $this->region_model->get_list_cabang();
		$data['page'] = 'admin/cabang';		
		$this->load->view($this->view,$data);
	}

	function list_user_cabang(){
		$id = $this->uri->segment(4) ;

		//exit();

		$data['users'] = $this->region_model->get_list_user_cabang($id);

		//var_dump($data);
		//exit();
		$data['page'] = 'admin/list_user';		
		$this->load->view($this->view,$data);
	}

	
	


}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */
