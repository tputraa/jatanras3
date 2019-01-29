<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('mlogin','muser'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('Admin/login');
	}

	public function signin(){

		$this->form_validation->set_error_delimiters('<div class="alerterror">', '</div>');
		$this->form_validation->set_rules('username','Username','trim|required');	
		$this->form_validation->set_rules('password','Password','trim|required');	
		
		if ($this->form_validation->run() == FALSE ){
			redirect('Admin/login','refresh');
		}
		else{

			$username 	= $this->input->post('username');
	        $password 	= md5($this->input->post('password'));
	        $cek		= $this->mlogin->cekLogin($username,$password);

	        if($cek->num_rows()>0){

				foreach ($cek->result() as $sess) {
					$data_session['status'] = 'login';
					$data_session['user_id'] = $sess->user_id;
					$data_session['nama_lengkap'] = $sess->nama_lengkap;
					$data_session['username'] = $sess->username;
					$data_session['level'] = $sess->level;
					$data_session['email'] = $sess->email;
					$data_session['avatar'] = $sess->avatar;
					$data_session['avatar_thumb'] = $sess->avatar_thumb;
					$this->session->set_userdata($data_session);
				}
				redirect('dashboard');
			
	        }
	        else{
	            redirect('Admin/login','refresh');
		    }
		}
	}

	public function Signout(){
		$this->session->sess_destroy();
		redirect('login');
	}

	public function Forgetpassword(){
		$this->load->view('Admin/forgetpassword');
	}

	public function sendemail(){

        $email = $this->input->post("email",TRUE);

        $cekemail = $this->muser->selectbyemail($email);

        $getUserid = $this->muser->getUserid($email);

        if($cekemail != null){

        	$UserId = $getUserid;

            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@";
            $password = substr( str_shuffle( $chars ), 0, 8 );
            $password1= md5($password); //Encrypting Password

            $newpassword = $password;

            $user = array(
                'password' => $password1
            );
            $this->muser->Updateuser($user,$UserId);

            if($this->db->affected_rows()){
                
                $from = "zambonmimin@gmail.com";
                $config['mailtype'] = 'html';
                $config['smtp_host']    = 'ssl://smtp.gmail.com';
                $config['smtp_port']    = '465';
                $config['smtp_timeout'] = '30';
                $config['smtp_user']    = 'zambonmimin@gmail.com';
                $config['smtp_pass']    = 'akunadmin';
                $config['charset']    = 'utf-8';
                $config['protocol']    = 'smtp';
                $config['wordwrap'] = TRUE;
                $config['newline']    = "\r\n";
                $config['smtp_auto_tls']    = false; 
                $config['smtp_conn_options'] = array(
		            'ssl' => array(
		                'verify_peer' => false,
		                'verify_peer_name' => false,
		                'allow_self_signed' => true
		            )
		        );
                
                $this->load->library('email');
                $this->email->initialize($config);
                $this->email->from($from, "Administrator");
                $this->email->to($email); 
                $this->email->subject('New Password');

                $message = 
                "<div>
                    <label>
                    Dear ".$email."
                    <br>
                    <br>
                    Password Baru Anda Adalah <b>".$password."</b><br><br>
                    Silahkan login dengan password baru anda dan segera ganti password anda di menu My Profile.<br>
                    </label><br>
                    Best Regards
                </div>";

                $this->email->message($message);

	                if(!$this->email->send())
	                {
	                    $error = show_error($this->email->print_debugger());
	                    $this->session->set_flashdata('error', 'Password Baru Tidak Terkirim');
	                    redirect('forgetpassword');
	                }
	                else{
	                    $this->session->set_flashdata('success', 'Password Baru Terkirim');
	                    redirect('forgetpassword');
	                }
                }
            }
            else{
            	$this->session->set_flashdata('error', 'Email Tidak Terdaftar');
            	redirect('forgetpassword');
        	}
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */