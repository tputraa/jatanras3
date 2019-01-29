<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	var $view = 'admin/index';
	var $limit;

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('admin_loggedin')) 
		{        	
			redirect('admin/dashboard','refresh');
		}  

		$this->load->model('admin/jabatan_model');
	}

	public function index()
	{
		
		$data['jabatan'] = $this->jabatan_model->get_list();
		$data['page'] = 'admin/jabatan';		

		$this->load->view($this->view,$data);
	}

	public function edit_details($id = NULL)
	{
		// get details
		if($id != NULL) 
		{
			$data['item'] = $this->jabatan_model->get_item($id);
		}
		
		$data['page'] = 'admin/edit_jabatan';		
		$this->load->view($this->view,$data);
	}

	public function save_details()
	{		

		// user id
		$jabatan_id = $this->input->post('id');		

		$this->load->library('form_validation');	

		// set bootstrap error delimiter for registration form
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');		

		$this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required|strip_tags|min_length[1]|max_length[15]');


		// set default page load data					
		$data['page'] = 'admin/edit_jabatan';			

		// if form validation fails load edit jabatan form	
		if($this->form_validation->run() == FALSE)
		{						
			$this->load->view($this->view,$data);
			return false;			
		}		

		if(!$jabatan_id) // new jabatan
		{ 			
		
			$result = $this->jabatan_model->register();

			// check result of registering new jabatan
			switch($result)
			{
				case 0: // could not save jabatan details into database
								$msg = 'An error occured while creating jabatan, try again later.';
								$type = 'danger';
								break;
						
				case 1: // jabatan is created

								$msg = 'Successfully created jabatan. An email is sent to jabatan containing jabatan details.';
								$type = 'success';					
								break;									
						
				default: break;						
			}
		} 
		else 
		{
			// update jabatan details
			$result = $this->jabatan_model->update_details();

			switch($result)
			{
				case 0: // could not update user details
								$msg = 'Could not update jabatan details.';
								$type = 'danger';
								break;

				case 1: // user details updated
								$msg = 'jabatan details updated successfully.';
								$type = 'success';
								break;

				default: break;
			}
		}		
		
		// set notification message
		$this->base->set_message($msg,$type);							
		redirect('admin/jabatan');
		return true;
	}

	function delete ($id) {
		$where = array('id'=>$id);
		$result = $this->db->delete('jabatan', $where);
		if ($result) {
			redirect(site_url('admin/jabatan'),'refresh');
		}
	}

}

/* End of file jabatan.php */
/* Location: ./application/controllers/jabatan.php */