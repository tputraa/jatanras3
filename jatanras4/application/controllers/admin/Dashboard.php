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
class Dashboard extends MY_Controller {

	public function __construct()
	{
	    parent::__construct();

	    $this->load->model('admin/summary_model');
	    
	    if($this->usertype != 1){
			redirect('user');
		}
	}

	/**
	 * Default method of dashboard class
	 */
	public function index()
	{				
		if($this->session->userdata('admin_loggedin')) 
		//if ($this->auth->loggedin())    
		{	
			$data['page'] = 'admin/dashboard';					
		} 
		else 
		{
			$data['page'] = 'admin/login';
		}	
		
		$filter['fromdate'] 	= $this->input->get_post('fromdate');
		$filter['todate'] 		= $this->input->get_post('todate');

		$data['record_count_kasubdit'] = $this->summary_model->record_total('2',$filter);   
		$data['record_count_kanit'] = $this->summary_model->record_total('3',$filter);   
		$data['record_count_penyidik'] = $this->summary_model->record_total('4',$filter);   
		$data['record_count_pasal'] = $this->summary_model->record_count_pasal();   
		$data['record_count_media'] = $this->summary_model->record_count_media($filter);   
		$data['record_count_visitor'] = $this->summary_model->record_count_visit();
		$data['record_count_renmin'] = $this->summary_model->record_total('5',$filter);
		
		$sql ="SELECT
				pasal.id,
				media.id,
				media.no_lp,
				pasal.kasus,
				media.nama_pelapor,
				media.tanggal_kejadian,
				media.pelaku,
				media.korban,
				media.tanggal_lapor,
				media.is_status,
				media.created_date
				FROM
				pasal
				INNER JOIN media ON media.pasal_id = pasal.id ORDER BY media.created_date DESC";

//exit();

		$data['dokumen'] = $this->db->query($sql)->result();
		$this->load->view('admin/index',$data);
	}

	/**
	 * Method to validate and allow user to login
	 */
	function validate_credentials()
	{	
		// load form validation library
		$this->load->library('form_validation');

		// set validation rules for username and password fields
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		// if form validation fails load login page		
		if ($this->form_validation->run() == FALSE)
		{				
			$this->index();
			return false;
		}
		
		// validate user
		$this->load->model('admin/user_model');		
		$result = $this->user_model->validate();
		
		switch($result)
		{				
			case 0: // Username or password field do not match								
							$this->base->set_message('Invalid username or password','danger');
							break;
					
			case 1: // User's credentials are validated						
							break;			
					
			case 2:	// User's account is not activated yet.									
							$this->base->set_message('Your account is not activated yet','warning');						
							break;

			default: break;	
		}	

		//$this->index();

		//exit();
		redirect('admin/dashboard','refresh');
		return true;
	}

	/**
	 * Method to logout user
	 */
	function logout()
	{		
		$this->session->sess_destroy();
		//$this->session->set_userdata(array('admin_loggedin' => FALSE, 'auth_user_id' => FALSE));		
		//redirect('admin','refresh');
		redirect(site_url("user"));

	}		

	/**
	 * Method to load username recovery form 
	 */
	public function recover_username()
	{		
		$data['page'] = 'admin/recover_username';
		$this->load->view('admin/index',$data);
	}

	/**
	 * Method to load password recovery form 
	 */
	public function recover_password()
	{		
		$data['page'] = 'admin/recover_password';
		$this->load->view('admin/index',$data);
	}

	/**
	 * Method to send username to email address received 
	 * from user in case email address exists in database
	 * to let user recover his username
	 */
	public function send_username()
	{
		// load form validation library
		$this->load->library('form_validation');

		// set bootstrap error delimiter for registration form
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|strip_tags|valid_email');		

		// if form validation fails load username recovery form	
		if($this->form_validation->run() == FALSE)
		{								
			$data['page'] = 'admin/recover_username';
			$this->load->view('admin/index',$data);
			return false;			
		}	

		// send email
		$this->load->model('admin/user_model');
		$result = (int) $this->user_model->email_username();
		
		switch($result)
		{
			case -1: // no user account found
							 $msg = 'No user account is associated with supplied email address.';
							 $type = 'danger';
							 break;

			case 1:  // user details updated
							 $msg = 'An email is sent to supplied email address containing username.';
							 $type = 'success';					 					
							 break;

			case 0:  // could not update user details
			default: $msg = 'Could not initiate email function, try again later.';
							 $type = 'danger';
							 break;			
		}
		
		// set notification message
		$this->base->set_message($msg,$type);

		if($result == -1) 
		{
			$data['page'] = 'admin/recover_username';
			$this->load->view('admin/index',$data);
		} 
		else 
		{
			$this->index();
		}			
	}	

	/**
	 * Method to send password recovery link to user's
	 * email address
	 */
	public function get_recovery_link()
	{
		// load form validation library
		$this->load->library('form_validation');

		// set bootstrap error delimiter for registration form
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->form_validation->set_rules('user', 'Email Address or Username', 'trim|required|strip_tags');		

		// if form validation fails load password recovery form	
		if($this->form_validation->run() == FALSE)
		{								
			$data['page'] = 'admin/recover_password';
			$this->load->view('admin/index',$data);
			return false;			
		}	

		// send recovery link via email
		$this->load->model('admin/user_model');
		$result = (int) $this->user_model->send_password_recovery_link();
		
		switch($result)
		{
			case -1: // no user account found
							 $msg = 'No user account is associated with supplied email address/username';
							 $type = 'danger';
							 break;

			case 1:  // user details updated
							 $msg = 'An email is sent to supplied email address containing password recovery link.';
							 $type = 'success';					 					
							 break;

			case 0:  // could not update user details
			default: $msg = 'Could not initiate email function, try again later.';
							 $type = 'danger';
							 break;			
		}
		
		// set message
		$this->base->set_message($msg,$type);

		if($result == -1) 
		{
			$data['page'] = 'admin/recover_password';
			$this->load->view('admin/index',$data);
		} 
		else 
		{
			$this->index();
		}			
	}	

	/**
	 * Loads reset password form page if password
	 * recovery token exists in recovery link
	 *
	 * @param  string  $token  token supplied in password recovery link
	 */
	public function reset_password($token = NULL)
	{
		if(!$token) 
		{
			$this->base->set_message('Password recovery token is missing.','danger');
			$this->index();
		} 
		else 
		{
			// add supplied token in session
			$this->session->set_userdata('token',$token);
			$data['page'] = 'admin/reset_password';
			$this->load->view('admin/index',$data);
		}		
	}

	/**
	 * Method to update password received from reset
	 * password form
	 */
	public function update_password()
	{
		// load form validation library
		$this->load->library('form_validation');

		$this->form_validation->set_rules('password', 'Password', 'trim|required|strip_tags|min_length[8]|max_length[32]');

		// if form validation fails load reset password form	
		if($this->form_validation->run() == FALSE)
		{								
			$data['page'] = 'admin/reset_password';
			$this->load->view('admin/index',$data);
			return false;			
		}	

		// reset password
		$this->load->model('admin/user_model');
		$result = (int) $this->user_model->reset_password();

		switch($result)
		{
			case -2: // session expired
							 $msg = 'Timeout, try again clicking on password recovery link.';
							 $type = 'warning';
							 break;

			case -1: // invalid token
							 $msg = 'Either invalid token supplied or it is expired.';
							 $type = 'danger';
							 break;

			case 1:  // user details updated
							 $msg = 'Successfully reseted your password.';
							 $type = 'success';					 					
							 break;

			case 0:  // could not update user details
			default: $msg = 'An error occured while reseting your password, try again later.';
							 $type = 'danger';
							 break;			
		}
		
		// set message
		$this->base->set_message($msg,$type);
		$this->index();
	}	
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */
