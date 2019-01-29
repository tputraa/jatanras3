<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pasal extends CI_Controller {

	var $view = 'admin/index';
	var $limit;

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('admin_loggedin')) 
		{        	
			// redirect user to login page						
			redirect('admin/dashboard','refresh');
		}  

		// load libraries
		$this->load->model('admin/pasal_model');
		$this->load->library('pagination'); 	
		$this->load->library('pdf');
		$this->limit = $this->session->userdata('kasubdit.filter.limit');	
	}

	public function index()
	{
		// pagination configuration					
		$config = array();
		$config['base_url'] = base_url() . 'admin/pasal/index';
		$config['total_rows'] = $this->pasal_model->record_count();
		$config['per_page'] = $this->limit ? $this->limit : 10;
		$config['uri_segment'] = 4;
		$config['attributes'] = array('class' => 'page-link');        

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		// set details to load on page
		$data['pasal'] = $this->pasal_model->get_list($config['per_page'], $page);

		
		$data['pagination'] = $this->pagination->create_links();
		$data['enteries'] = 'Showing '.($page + 1).' to '.($page + count($data['pasal'])).' of '.$config['total_rows'].' entries'; 


		//var_dump($data);
		//exit();

		$data['page'] = 'admin/pasal';		

		$this->load->view($this->view,$data);
	}

	public function edit_details($id = NULL)
	{
		// get details
		if($id != NULL) 
		{
			$data['item'] = $this->pasal_model->get_item($id);
		}
		
		$data['page'] = 'admin/edit_pasal';		
		$this->load->view($this->view,$data);
	}

	public function save_details()
	{		

		// user id
		$pasal_id = $this->input->post('id');		

		$this->load->library('form_validation');	

		// set bootstrap error delimiter for registration form
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');		

		$this->form_validation->set_rules('pasal', 'Pasal', 'trim|required|strip_tags|min_length[1]|max_length[15]');

		// set validation rules for signup form fields
		$this->form_validation->set_rules('kasus', 'Kasus', 'trim|required|strip_tags|min_length[3]|max_length[100]');

		// set default page load data					
		$data['page'] = 'admin/edit_pasal';			

		// if form validation fails load edit pasal form	
		if($this->form_validation->run() == FALSE)
		{						
			$this->load->view($this->view,$data);
			return false;			
		}		

		if(!$pasal_id) // new pasal
		{ 			
		
			$result = $this->pasal_model->register();

			// check result of registering new pasal
			switch($result)
			{
				case 0: // could not save pasal details into database
								$msg = 'An error occured while creating pasal, try again later.';
								$type = 'danger';
								break;
						
				case 1: // pasal is created

								$msg = 'Successfully created pasal. An email is sent to Pasal containing pasal details.';
								$type = 'success';					
								break;									
						
				default: break;						
			}
		} 
		else 
		{
			// update pasal details
			$result = $this->pasal_model->update_details();

			switch($result)
			{
				case 0: // could not update user details
								$msg = 'Could not update pasal details.';
								$type = 'danger';
								break;

				case 1: // user details updated
								$msg = 'Pasal details updated successfully.';
								$type = 'success';
								break;

				default: break;
			}
		}		
		
		// set notification message
		$this->base->set_message($msg,$type);							
		//exit();

		redirect('admin/pasal');

		return true;
	}

	function delete ($id) {
		$where = array('id'=>$id);

		$result = $this->db->delete('pasal', $where);
		if ($result) {
			redirect(site_url('admin/pasal'),'refresh');
		}

	}

}

/* End of file Pasal.php */
/* Location: ./application/controllers/Pasal.php */