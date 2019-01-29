<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Renmin extends MY_Controller {
	
	var $view = 'admin/index';
	var $limit;

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		
		if($this->usertype != 1){
	      redirect('user');
	    } 

		$this->load->model('admin/renmin_model');
			
	}

	public function index()
	{	
		
		$sql="SELECT * FROM renmin";
		$result = $this->db->query($sql)->result();

		$data['data'] = $result;
		$data['page'] = 'admin/renmin';		
		$this->load->view($this->view,$data);
	}

	public function edit_details($id = NULL)
	{
		// get details
		if($id != NULL) 
		{
			$data['item'] = $this->renmin_model->get_item($id);
		}
		else{
	      $data['item'] = null;
	    }
		
		$data['page'] = 'admin/edit_ranmin';		
		$this->load->view($this->view,$data);
	}

	/**
	 * Method to save user details or create new user
	 */
	public function save_details()
	{		

		// user id
		$user_id = $this->input->post('id');		

		$this->load->library('form_validation');	

		// set bootstrap error delimiter for registration form
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');		

		$this->form_validation->set_rules('nrp', 'NRP', 'trim|required|strip_tags|min_length[3]|max_length[15]');

		// set validation rules for signup form fields
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required|strip_tags|min_length[3]|max_length[100]');

		$this->form_validation->set_rules('telpon', 'Nomor Telpon', 'trim|required|strip_tags|min_length[11]|max_length[15]');

		// different rules for new and old user
		if(!$user_id) 
		{
			
			$this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required|strip_tags|min_length[3]|max_length[100]');
			/*
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|strip_tags|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|strip_tags|callback_check_username|min_length[8]|max_length[32]|is_unique[users.username]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|strip_tags|min_length[8]|max_length[32]');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|strip_tags|matches[password]');
			*/
		} 
		else 
		{
			$this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required|strip_tags|min_length[3]|max_length[100]');
			/*
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|strip_tags|valid_email|callback_is_unique_email');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|strip_tags|callback_check_username|min_length[8]|max_length[32]|callback_is_unique_username');
			$this->form_validation->set_rules('password', 'Password', 'trim|strip_tags|min_length[8]|max_length[32]');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|strip_tags|matches[password]');
			*/
		}	
		
		// other rules
		/*
		$this->form_validation->set_rules('month', 'Month', 'trim|strip_tags');
		$this->form_validation->set_rules('day', 'Day', 'trim|strip_tags');
		$this->form_validation->set_rules('year', 'Year', 'trim|strip_tags');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|strip_tags');
		$this->form_validation->set_rules('mobile_no', 'Mobile no', 'trim|strip_tags');
		$this->form_validation->set_rules('location', 'Location', 'trim|strip_tags');					
		*/
		// set custom error message for unique field
		$this->form_validation->set_message('is_unique', 'The %s is already in use.');	

		///exit();

		// set default page load data					
		$data['page'] = 'admin/edit_ranmin';			

		// if form validation fails load edit user form	
		if($this->form_validation->run() == FALSE)
		{						
			$this->load->view($this->view,$data);
			return false;			
		}		

		if(!$user_id) // new user
		{ 

			/* Membuat Folder di Folder Cabang */
			$resutl = $this->db->query("SELECT * FROM renmin ORDER BY id DESC LIMIT 1")->row();
			$user_id = ($resutl->id)+1;
			
			$region 	= trim($this->input->post('location'));
			$username 	= trim($this->input->post('username'));

			$this->load->config('app');
			$media_path = $this->config->item('media_path');
			
			// create constant for user media base directory
			$mm_base = FCPATH.$media_path.'/'.$region.'/'.$username.$user_id;
			$mm_base = str_replace(DIRECTORY_SEPARATOR, '/', $mm_base.'/');			
			define('MM_BASE', $mm_base);	

			// create folder to save user media
			if (!is_dir($mm_base)) {
			    if(!mkdir($mm_base, 0755, TRUE)){
			    	exit('Could not create user media directory.');									
			    }
			}	
			
			
			$result = $this->renmin_model->register();

			// check result of registering new user
			switch($result)
			{
				case 0: // could not save user details into database
								$msg = 'An error occured while creating account, try again later.';
								$type = 'danger';
								break;
						
				case 1: // account is created and activation email is sent to user

						$this->create_user();

								$msg = 'Successfully created the account. An email is sent to user containing login details.';
								$type = 'success';					
								break;
						
				case 2: // account is created, but could not send activation email
							$this->create_user();	
					
								$msg = 'Successfully created the account. System could not initiate email.';
								$type = 'danger';					
								break;										
						
				default: break;						
			}
		} 
		else 
		{
			// update user details
			$result = $this->renmin_model->update_details();

			switch($result)
			{
				case 0: // could not update user details
								$msg = 'Could not update user details.';
								$type = 'danger';
								break;

				case 1: // user details updated
								$msg = 'User details updated successfully.';
								$type = 'success';
								break;

				default: break;
			}
		}		
		
		// set notification message
		$this->base->set_message($msg,$type);							
		//exit();

		redirect(site_url('admin/renmin'),'refresh');

		return true;
	}

	function delete ($id) {
		$where = array('id'=>$id);
		$result = $this->db->delete('renmin', $where);
		
		if ($result) {
			$where = array('kon_id'=>$id);
			$result = $this->db->delete('users', $where);
			if ($result) {
				redirect(site_url('admin/renmin'),'refresh');	
			}
		}

	}

	function create_user() {
		$rows = $this->db->query("SELECT * FROM renmin ORDER BY id DESC LIMIT 1")->row();
		$password = $this->base->encrypt_password($this->input->post('nrp'));	
		$data = array (
			'username' => ucwords(trim($this->input->post('nrp'))),
			'password' => $password,
			'usertype' => '1',
			'kon_id' => $rows->id,
			'register_date' =>  date('Y-m-d H:m:s'),
			'activation' =>'1'

		);
		$insert = $this->db->insert('users', $data); 
	}
}