<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelaku extends MY_Controller {

	var $view = 'admin/index';
	var $limit;

	public function __construct()
	{
		parent::__construct();

		if($this->usertype != 1){
	      redirect('user');
	    } 

		// load libraries
		$this->load->model('admin/pelaku_model');
		$this->load->library('pagination'); 	
		$this->load->library('pdf');
		$this->limit = $this->session->userdata('kasubdit.filter.limit');	
	}

	public function index()
	{
		$data['pelaku'] = $this->pelaku_model->get_list(0, 0);
		$data['page'] = 'admin/pelaku';		
		$this->load->view($this->view,$data);
	}

	public function edit_details($id = NULL)
	{
		// get details
		if($id != NULL) 
		{
			$data['item'] = $this->pelaku_model->get_item($id);
		}
		else{
	      $data['item'] = null;
	    }
		
		$data['page'] = 'admin/edit_pelaku';		
		$this->load->view($this->view,$data);
	}

	public function save_details()
	{		

		// user id
		$pelaku_id = $this->input->post('id');		

		$this->load->library('form_validation');	

		// set bootstrap error delimiter for registration form
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');		

		$this->form_validation->set_rules('telpon', 'telpon', 'trim|required|strip_tags|min_length[7]|max_length[13]');

		// set default page load data					
		$data['page'] = 'admin/edit_pelaku';
		$data['item'] = null;			

		// if form validation fails load edit pelaku form	
		if($this->form_validation->run() == FALSE)
		{						
			$this->load->view($this->view,$data);
			return false;			
		}		

		if(!$pelaku_id) // new pelaku
		{ 			
		
			$result = $this->pelaku_model->register();

			// check result of registering new pelaku
			switch($result)
			{
				case 0: // could not save pelaku details into database
								$msg = 'An error occured while creating pelaku, try again later.';
								$type = 'danger';
								break;
						
				case 1: // pelaku is created

								$msg = 'Successfully created pelaku. An email is sent to pelaku containing pelaku details.';
								$type = 'success';					
								break;									
						
				default: break;						
			}
		} 
		else 
		{
			// update pelaku details
			$result = $this->pelaku_model->update_details();

			switch($result)
			{
				case 0: // could not update user details
								$msg = 'Could not update pelaku details.';
								$type = 'danger';
								break;

				case 1: // user details updated
								$msg = 'pelaku details updated successfully.';
								$type = 'success';
								break;

				default: break;
			}
		}		
		
		// set notification message
		$this->base->set_message($msg,$type);							
		//exit();

		redirect('admin/pelaku');

		return true;
	}

	function delete ($id) {
		$where = array('id'=>$id);

		$result = $this->db->delete('pelaku', $where);
		if ($result) {
			redirect(site_url('admin/pelaku'),'refresh');
		}

	}

}

/* End of file pelaku.php */
/* Location: ./application/controllers/pelaku.php */