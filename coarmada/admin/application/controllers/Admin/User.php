<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('muser');
		$this->load->library('form_validation');
		if($this->session->userdata('level') == 2){
			redirect('dashboard');
		}
	}

	public function index()
	{
		$data['pageTitle']	= 'Koarmada - User';
		$data['user']		= $this->muser->getAllData();
		$this->loadViews('Admin/user', $data, null, null);
	}

	public function Add(){
		$data['pageTitle']	= 'Koarmada - Tambah User';
		$this->loadViews('Admin/user_add', $data, null, null);
	}

	public function Save(){

		$nama_lengkap 	= $this->input->post('nama_lengkap',true);
		$username 		= $this->input->post('username',true);
		$email 			= $this->input->post('email',true);
		$password 		= $this->input->post('password',true);
		$level 			= $this->input->post('level', true);

		$this->form_validation->set_error_delimiters('<p class="help-block">', '</p>');
		$this->form_validation->set_rules('nama_lengkap','Nama Lengkap','trim|required');	
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		$this->form_validation->set_rules('level','Level','trim|required');

		if ($this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('error', 'Tambah Data Tidak Berhasil');
			$this->Add();
		}
		else{
	            $user = array(
	                'nama_lengkap' => $nama_lengkap,
	                'username' => $username,
	                'email' => $email,
	                'password' => md5($password),
	                'level' => $level
	                
	            );
	            $this->muser->Saveuser($user);
	            $this->session->set_flashdata('success', 'Tambah Data Berhasil');
	            redirect('Admin/User');
	        }

	}

	public function Edit($user_id){
		$data['pageTitle']	= 'Koarmada - Edit User';
		$data['user'] 		= $this->muser->Selectuserid($user_id);	
		$data['levels'] 	= $this->muser->SelectLevel();
	
		$this->loadViews('Admin/user_edit', $data, null, null);
	}

	public function Update(){
		
		$user_id  		= $this->input->post('user_id',true);
		$nama_lengkap 	= $this->input->post('nama_lengkap',true);
		$email 			= $this->input->post('email',true);
		$password 		= $this->input->post('password',true);
		$level 			= $this->input->post('level', true);

		$this->form_validation->set_error_delimiters('<p class="help-block">', '</p>');
		$this->form_validation->set_rules('nama_lengkap','Nama Lengkap','trim|required');	
		$this->form_validation->set_rules('email','Email','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		$this->form_validation->set_rules('level','Level','trim|required');

		if ($this->form_validation->run() == FALSE ){
			$this->Add();
		}
		else{
	            $user = array(
	                'nama_lengkap' => $nama_lengkap,
	                'email' => $email,
	                'password' => md5($password),
	                'level' => $level
	                
	            );
	            $this->muser->Updateuser($user,$user_id);
	            $this->session->set_flashdata('success', 'Update Data Berhasil');
	            redirect('Admin/User');
	        }
	}

	public function Delete($user_id){
		$this->muser->DeleteUser($user_id);
		redirect('Admin/User');
	}

	public function checkEmailExists()
    {
        $email = $this->input->post("email");
        $result = $this->muser->checkEmailExists($email);

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }

    public function checkUsernameExists()
    {
        $username = $this->input->post("username");
        $result = $this->muser->checkUsernameExists($username);

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */