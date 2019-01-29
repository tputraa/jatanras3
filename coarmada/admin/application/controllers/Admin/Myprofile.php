<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myprofile extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mprofile');
		$this->load->library('form_validation');
	}

	public function index(){
		$this->data['pageTitle'] 	= 'Koarmada - My Profile';
        $this->loadViews("Admin/myprofile", $this->data, null , null);	
	}

	public function Change_avatar(){
		$this->data['error'] 		= "";
		$this->data['pageTitle'] 	= 'Koarmada - My Profile';
        $this->loadViews("Admin/myprofile_change_avatar", $this->data, null , null);
	}

	public function Change_password(){
		$this->data['pageTitle']	= 'Koarmada - Change Password';
		$this->loadViews("Admin/myprofile_change_pass", $this->data, null , null);	
	}

	function Update_pass(){


		$this->form_validation->set_error_delimiters('<p class="help-block">', '</p><br>');
		$this->form_validation->set_rules('password', 'New Password', 'trim|required');
		$this->form_validation->set_rules('cpasssword', 'Confirm Password', 'trim|required');	

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('msg', 'Cannot Null');
			redirect('myprofile/Change_pass');
		}
		else{
			$password 	= $this->input->post('password',TRUE);
			$userid 	= $this->session->userdata('user_id');

			$cpasssword 	= $this->input->post('cpasssword',TRUE);

			if($password != $cpasssword){
				$this->session->set_flashdata('msg', 'Password tidak cocok');
				redirect('Admin/myprofile/change_password');
			}else{
				
				$pw_update = array('password' => md5($password));

				$this->db->where('user_id', $userid);
				$this->db->update('tbl_users',$pw_update);

				$this->session->set_flashdata('success', 'Ganti password berhasil');
				redirect('Admin/myprofile/change_password');
			}
		}
	}

	public function UpdateAvatar(){

		$config['upload_path'] 		= "assets/images/avatar/";
        $config['allowed_types'] 	= "jpg|jpeg|png";
        $config['encrypt_name']		= TRUE;


        $this->load->library('upload');
        $this->upload->initialize($config);

        if(!$this->upload->do_upload()){
            $this->data['error'] = $this->upload->display_errors();
            $this->loadViews('Admin/myprofile_change_avatar',$this->data, null, null);
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

        	$user_id  	= $this->session->userdata('user_id');
            $query 		= $this->mprofile->selectbyid($user_id);

            foreach ($query->result() as $row) {
                @unlink('assets/images/avatar/'.$row->avatar);
                @unlink('assets/images/avatar/thumb/'.$row->avatar_thumb);
            }

            $update = array(
            	'avatar' 		=> $data['file_name'],
            	'avatar_thumb'	=> $thumb_namanya
            );

            $this->mprofile->updateAvatar($user_id,$update);
            $this->session->set_userdata($update);
	        redirect('myprofile');
	    }
	}

	public function profile(){
		$data['pageTitle']	= 'Koarmada - Profile Koarmada';
		$data['profile'] 	= $this->mprofile->selectIdProfil()->row();
        $data['error'] 		= '';
        $this->loadViews('Admin/profileadm',$data, null, null);
	}

	public function UpdateProfile(){

		$profile_id = $this->input->post('profile_id');

		$this->form_validation->set_error_delimiters('<p class="help-block">', '</p>');
		$this->form_validation->set_rules('judul','Judul','trim|required');	
		$this->form_validation->set_rules('isi','Isi','trim|required');

		if ($this->form_validation->run() == FALSE ){
			$this->data['profile'] 		= $this->mprofile->selectIdProfil()->row();
			$this->session->set_flashdata('error', 'Tambah Data Tidak Berhasil');
			$this->loadViews('Admin/profileadm', $this->data, null, null);
		}
		else if(empty($_FILES['userfile']['name'])){
			$profile = array(
                'judul' => $this->input->post('judul'),
                'isi' => $this->input->post('isi')
              
            );
            $this->mprofile->Updateprofile($profile_id,$profile);
            $this->session->set_flashdata('success', 'Update Data Berhasil');
            redirect('Admin/myprofile/profile');
		}
		else{
	        $config['upload_path'] 		= "assets/images/profile_images/";
	        $config['allowed_types'] 	= "jpg|jpeg|png";
	        $config['overwrite'] 		= true;
        	$config['encrypt_name'] 	= true;

	        $this->load->library('upload');
	        $this->upload->initialize($config);
			if(!$this->upload->do_upload()){
	            $this->data['error'] 		= $this->upload->display_errors();
	            $this->data['profile'] 		= $this->mprofile->selectIdProfil()->row();
	            $this->data['pageTitle'] 	= 'Koarmada - Profile Koarmada';
				$this->loadViews('Admin/profileadm', $this->data, null, null);
	        }else{

	            $data = $this->upload->data();

	            $profile = array(
	                'judul' => $this->input->post('judul'),
	                'images' => $data['file_name'],
	                'isi' => $this->input->post('isi'),
	              
	            );
	            $this->mprofile->Updateprofile($profile_id,$profile);
	            $this->session->set_flashdata('success', 'Update Data Berhasil');
	            redirect('Admin/myprofile/profile');
	        }
	    }
	}

}

/* End of file Myprofile.php */
/* Location: ./application/controllers/Myprofile.php */