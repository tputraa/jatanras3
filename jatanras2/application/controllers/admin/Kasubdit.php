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
 * Users Class 
 * https://www.youtube.com/watch?v=GEI1MbBHiMY
 */

class Kasubdit extends MY_Controller {
	
	var $view = 'admin/index';
	var $limit;

	/**
	 * Constructor, initializes the libraries and model
	 */
	public function __construct()
	{
		parent::__construct();

		if($this->usertype != 1){
	      redirect('user');
	    } 

		// load libraries
		$this->load->model('admin/kasubdit_model');
		$this->load->library('pagination'); 	
		$this->load->library('pdf');
		$this->limit = $this->session->userdata('kasubdit.filter.limit');	
	}

	/**
	 * Default method of users class
	 */
	public function index()
	{	
		// pagination configuration					
		$config = array();
		$config['base_url'] = base_url() . 'admin/kasubdit/index';
		$config['total_rows'] = $this->kasubdit_model->record_count();
		$config['per_page'] = $this->limit ? $this->limit : 10;
		$config['uri_segment'] = 4;
		$config['attributes'] = array('class' => 'page-link');        

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		// set details to load on page
		$data['users'] = $this->kasubdit_model->get_list($config['per_page'], $page);

		
		$data['pagination'] = $this->pagination->create_links();
		$data['enteries'] = 'Showing '.($page + 1).' to '.($page + count($data['users'])).' of '.$config['total_rows'].' entries'; 

		$data['page'] = 'admin/kasubdit';		

		$this->load->view($this->view,$data);
	}

	/**
	 * Method to set query filters in session
	 */
	public function get_results()
	{
		$data = $this->input->post();
		$this->session->set_userdata('kasubdit.filter.limit', (int) $data['limit']);
		$this->session->set_userdata('kasubdit.filter.search', (string) $data['search']);
		
		redirect(site_url('admin/kasubdit'),'refresh');
	}

	/* Cetak User Access */
	public function print_users()
	{
		
		$pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'YAYASAN KEMALA BAKTI BHAYANGKARI',0,1,'C');
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(190,7,'DAFTAR USER',0,1,'C');

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,8,'NO',1,0,'C');
        $pdf->Cell(55,8,'USERNAME',1,0);
        $pdf->Cell(55,8,'PASSWORD',1,0);
        $pdf->Cell(65,8,'CABANG',1,1);

        $pdf->SetFont('Arial','',10);

        $users = $this->kasubdit_model->get_data();

        $i=1;
        foreach ($users as $row){
            $pdf->Cell(10,8,$i,1,0, 'C');
            $pdf->Cell(55,8,$row->username,1,0);
            $pdf->Cell(55,8,$row->username,1,0);
            $pdf->Cell(65,8,$row->name,1,1); 

            $i++;
        }

        $pdf->Output();

	}



	/**
	 * Method to load edit page for user details, load
	 * user details if user ID is supplied
	 *
	 * @param  int  $id  user ID
	 */
	public function edit_details($id = NULL)
	{
		// get details
		if($id != NULL) 
		{
			$data['item'] = $this->kasubdit_model->get_item($id);
		}
		else{
	      $data['item'] = null;
	    }

		
		$data['page'] = 'admin/edit_kasubdit';		
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

		$this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required|strip_tags|min_length[3]|max_length[100]');
		
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

		// set default page load data					
		$data['page'] = 'admin/edit_kasubdit';			

		// if form validation fails load edit user form	
		if($this->form_validation->run() == FALSE)
		{						
			$this->load->view($this->view,$data);
			return false;			
		}		

		if(!$user_id) // new user
		{ 

			/* Membuat Folder di Folder Cabang */
			$resutl = $this->db->query("SELECT * FROM users ORDER BY id DESC LIMIT 1")->row();
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
			
			
			$result = $this->kasubdit_model->register();

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
			$result = $this->kasubdit_model->update_details();

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

		redirect(site_url('admin/kasubdit'),'refresh');

		return true;
	}

	/**
	 * Validate username 
	 *
	 * @param  string  $username  username supplied by user in registration form
	 * @return  boolean  TRUE if username validated, FALSE either
	 */
	public function check_username($username)
	{
		// check if username started with alphabet
		if(!preg_match('/^[A-Za-z]+/', $username))
		{
			$this->form_validation->set_message('check_username', '%s should start with alphabet');
			return false;
		}
		// check if username contains valid characters
		elseif(!preg_match('/^[A-Za-z0-9_.-]+$/', $username))
		{			
			$this->form_validation->set_message('check_username', 'Only alphanumeric characters, underscores (_), dashes(-) and periods(.) are allowed');
			return false;
		}

		return true;	
	}

	/** 
	 * Method to check if supplied email not is use
	 * by other user
	 *
	 * @param  string  $email  email address to check
	 */
	public function is_unique_email($email)
	{		
		// run query
		$this->db->where('id != ',$this->input->post('id'));
		$this->db->where('email',$email);
		$query = $this->db->get('users');

		if($query->num_rows() > 0) 
		{
			$this->form_validation->set_message('is_unique_email', '%s is already in use.');
			return false;
		}

		return true;	        
	}

	/**
	 * Check if username not in use by other user
	 *
	 * @param  string  $username  username to check
	 */
	public function is_unique_username($username)
	{		
		// run query
		$this->db->where('id != ',$this->input->post('id'));
		$this->db->where('username',$username);
		$query = $this->db->get('users');

		if($query->num_rows() > 0) 
		{
			$this->form_validation->set_message('is_unique_username', '%s is already in use.');
			return false;
		}

		return true;	        
	}

	public function buat_folder(){
		$resutl = $this->db->query("SELECT * FROM users ORDER BY id DESC LIMIT 1")->row();
		$user_id = ($resutl->id)+1;
			
		$this->load->config('app');
		$media_path = $this->config->item('media_path');
		
		// create constant for user media base directory
		//$user_id = $this->session->userdata('auth_user');
		$mm_base = FCPATH.$media_path.'/'.$user_id;
		$mm_base = str_replace(DIRECTORY_SEPARATOR, '/', $mm_base.'/');			
		define('MM_BASE', $mm_base);	

		// create folder to save user media
		if (!is_dir($mm_base)) {
		    if(!mkdir($mm_base, 0755, TRUE)){
		    	exit('Could not create user media directory.');									
		    }
		}	

	}

	function delete ($id) {
		$where = array('id'=>$id);
		$result = $this->db->delete('kasubdit', $where);

		if ($result) {
			$where = array('kon_id'=>$id);
			$result = $this->db->delete('users', $where);
			if ($result) {
				redirect(site_url('admin/kasubdit'),'refresh');	
			}
		}
	}

	function create_user() {

		$rows = $this->db->query("SELECT * FROM kasubdit ORDER BY id DESC LIMIT 1")->row();
		$password = $this->base->encrypt_password($this->input->post('nrp'));	
		$data = array (
			'username' => ucwords(trim($this->input->post('nrp'))),
			'password' => $password,
			'usertype' => '2',
			'kon_id' => $rows->id,
			'register_date' =>  date('Y-m-d H:m:s'),
			'activation' =>'1'

		);
		$insert = $this->db->insert('users', $data); 
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */
