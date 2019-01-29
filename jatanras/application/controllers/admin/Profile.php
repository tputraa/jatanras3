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
class Profile extends CI_Controller {

	var $view = 'admin/index';

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('admin_loggedin')) 
		{        	
			// redirect user to login page						
			redirect('admin','refresh');
		}  

		$this->load->library('form_validation');
		$this->load->model('admin/profile_model');
	}

	public function index()
	{				
		if($this->session->userdata('admin_loggedin')) 
		{
			// display login-registration page        	
			$data['page'] = 'admin/profile';					
		} 
		else 
		{
			$data['page'] = 'admin/login';
		}
		$userid = $this->session->userdata('admin_user_id');

		$data['biodata']	= $this->profile_model->selectIdProfil($userid)->row();
		$data['page'] 		= 'admin/profile';	

		$this->load->view($this->view,$data);
	}
	
	public function Update_info(){
		$this->form_validation->set_error_delimiters('<p class="help-block">', '</p><br>');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');	

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', 'Cannot Null');
			redirect('admin/profile');
		}
		else{
			$nama 	= trim($this->input->post('nama',TRUE));
			$email 	= trim($this->input->post('email',TRUE));
			$userid = $this->session->userdata('admin_user_id');

			$data = array(
				'name' => $nama,
				'email' => $email
			);
			$this->db->where('id',$userid);
			$this->db->update('users',$data);

			$this->session->set_flashdata('success', 'Update Info Berhasil');
			redirect('admin/profile');
		}

	}

	public function Update_pass(){

        //$this->form_validation->set_error_delimiters('<p class="help-block">', '</p>');
        
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('repassword', 'Confirm Password', 'trim|required|matches[password]');

		$password 		= $this->input->post('password',TRUE);
		$cpasssword 	= $this->input->post('repassword',TRUE);
		$userid 		= $this->session->userdata('admin_user_id');

		if($this->form_validation->run() == FALSE){
		   $error = "";
		   $error.= form_error('password');
           $error.= form_error('repassword');
           
			$this->session->set_flashdata('error', $error);
            $this->index();
			//redirect('admin/profile');
		}
		else{

			$pw_update = array('password' => $this->base->encrypt_password($password));

			$this->db->where('id', $userid);
			$this->db->update('users',$pw_update);

			$this->session->set_flashdata('success', 'Ganti password berhasil');
			redirect('admin/profile');
			
		}
	}

	public function Update_avatar(){

		$config['upload_path'] 		= "assets/uploads/avatar/";
        $config['allowed_types'] 	= "jpg|jpeg|png";
        $config['encrypt_name']		= TRUE;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if(!$this->upload->do_upload()){
            $data['error'] = $this->upload->display_errors();
            $this->session->set_flashdata('error', $data);
            redirect('admin/profile');
        }
        else{

            $data = $this->upload->data();
            
            $file   = $config['upload_path'].$data['file_name'];
                
            $resize = $this->load->helper('image_lib');
              
            $resize = new Image_lib($file);
            $path   = $config['upload_path'].$data['file_name'];
                            
            $thumb_namanya 	= "thumb_".$data['file_name'];
            $newpath1        = $config['upload_path']."/thumb/".$thumb_namanya;
            $resize 		= new Image_lib($file);
          
            $resize->resizeTo(300, 300, 'exact');
            $resize->saveImage($newpath1);

        	$user_id  	= $this->session->userdata('admin_user_id');
            $query 		= $this->profile_model->selectIdProfil($user_id);

            foreach ($query->result() as $row) {
                @unlink('assets/uploads/avatar/'.$row->avatar);
                @unlink('assets/uploads/avatar/thumb/'.$row->avatar_thumb);
            }

            $update = array(
            	'avatar' 		=> $data['file_name'],
            	'avatar_thumb'	=> $thumb_namanya
            );

            $this->db->where('id',$user_id);
			$this->db->update('users',$update);

            $this->session->set_userdata($update);
            $this->session->set_flashdata('success', 'Update avatar berhasil');
	        redirect('admin/profile');
	    }
	}


}