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
class Countries extends CI_Controller {
	
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

		$this->load->model('admin/countries_model');
		$this->load->library('pagination'); 

		$this->limit = $this->session->userdata('countries.filter.limit');	
	}

	/**
	 * Default method of users class
	 */
	public function index()
	{				
		// pagination configuration		
		$config = array();		
		$config['base_url'] = base_url() . 'admin/countries/index';
		$config['total_rows'] = $this->countries_model->record_count();
		$config['per_page'] = $this->limit ? $this->limit : 10;
		$config['uri_segment'] = 4;
		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		// set details to load on page
		$data['countries'] = $this->countries_model->get_list($config['per_page'], $page);
		$data['pagination'] = $this->pagination->create_links();
		$data['enteries'] = 'Showing '.($page + 1).' to '.($page + count($data['countries'])).' of '.$config['total_rows'].' entries'; 
		$data['page'] = 'admin/countries';		

		$this->load->view($this->view,$data);
	}

	/**
	 * Method to set query filters in session
	 */
	public function get_results()
	{
		$data = $this->input->post();
		$this->session->set_userdata('countries.filter.limit', (int) $data['limit']);
		$this->session->set_userdata('countries.filter.search', (string) $data['search']);
		redirect(site_url('admin/countries'),'refresh');
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
			$data['item'] = $this->countries_model->get_item($id);
		}
		
		$data['page'] = 'admin/edit_country';		
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
		$result = $this->countries_model->update_details();	

		if(!$country_id) // new user
		{ 			
			// check result
			switch($result)
			{
				case 0: // could not save user details into database
								$msg = 'An error occured while creating new entry for country.';
								$type = 'danger';
								break;
						
				case 1: // account is created and activation email is sent to user
								$msg = 'Successfully created new entry for country.';
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
								$msg = 'Could not update country name.';
								$type = 'danger';
								break;

				case 1: // user details updated
								$msg = 'Country name updated successfully.';
								$type = 'success';
								break;

				default: break;
			}
		}		
		
		// set notification message
		$this->base->set_message($msg,$type);	

		redirect(site_url('admin/countries'),'refresh');
		
		return true;
	}	
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */
