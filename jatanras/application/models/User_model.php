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
 * User model class
 */
class User_model extends CI_Model {

	// database table name
  var $table = 'users';	    

  /**
   * Method to validate user to login in
   */
  function validate()
	{

		$this->db->where('username', $this->input->post('username'));
		$query = $this->db->get($this->table);
		
		$this->session->set_userdata('username',$this->input->post('username')); 

		// if user exists
		if($query->num_rows() == 1) 
		{
			$result = $query->result();

			$activated = $result[0]->activation;

			//ambil row cabang
			$region = $result[0]->usertype;
			
			$this->session->set_userdata('kon_id',$result[0]->kon_id); 

			// check if user is activated
			if($activated == 1) 
			{	
				// get user's password from db
				$db_password = $result[0]->password;
				$password = $this->input->post('password');				
				$is_match = $this->base->match_password($db_password,$password);							
				
				// if both password hash matches
				if($is_match) 
				{						
					$id = $result[0]->id;
					$username = $result[0]->username;
					// update login time of user into database
					$data = array('last_visit_date' => date('Y-m-d H:m:s'));
					$this->db->where('id', $id);
					$this->db->update($this->table, $data); 

					$array_sess = array (
						'admin_loggedin' => TRUE,
						'admin_user_id' => $id,
						'name' => $result[0]->nama,
						'username' => $username,
						'avatar' => $result[0]->avatar,
						'avatar_thumb' => $result[0]->avatar_thumb,
					);

					$this->session->set_userdata($array_sess);

					// check if user checked the 'remember me' checkbox
					$remember = $this->input->post('remember') ? TRUE : FALSE;										
					// mark user as logged in
					$this->load->library('auth');
          			$this->auth->login($id, $region, $remember);												
					
					//$this->session->set_userdata(array('auth_user' => $region, 'auth_loggedin' => TRUE));

					return 1;
				}
				else // invalid password supplied
				{	
					return 0;
				}
			}
			else // account is not activated yet
			{
				return 2;	
			}
		}
		else // invalid username supplied
		{	
			return 0;
		}			
	}	

  /**
   * Method to register new user
   */
  public function register()
	{
		// Encrypt password into md5 hash
		$password = $this->base->encrypt_password($this->input->post('password'));		

		// birth-date
		$day = trim($this->input->post('day'));
		$month = trim($this->input->post('month'));		
		$year = trim($this->input->post('year'));
		$birth_date = $year.'-'.$month.'-'.$day;	

		$activation = $this->base->get_random_string();

		// Create array of new user data
		$data = array(
			'name' => ucwords(trim($this->input->post('name'))),
			'username' => trim($this->input->post('username')),
			'password' => $password,
			'email' => trim($this->input->post('email')),	
			'birth_date' => $birth_date,			
			'gender' => trim($this->input->post('gender')),
			'mobile_no' => trim($this->input->post('mobile_no')),
			'location' => trim($this->input->post('location')),	
			'usertype' => 0, // normal user, 1: admin
			'register_date' => date('Y-m-d H:m:s'),
			'activation' => $activation			
		);

		// store data into database
		$insert = $this->db->insert($this->table, $data); 

		// if new user register send notification email
		if($insert)
		{	
			$this->load->config('site');					
			$site_name = $this->config->item('site_name');

			$email = $this->input->post('email');						
			$subject = 'Account activation link';
			$message = 'Congratulations, you have successfully created your account for '.$site_name.'.<br/>'.
							   'Your login details:<br/>Username: '.$this->input->post('username').'<br/>Password: '.$this->input->post('password').
							   '<br/><br/>Click on following link to activate you account<br/>'.
							   base_url().'index.php/user/activate/'.$activation.
							   '<br/><br/>Remember you have 15 days to activate your account.';			
			
			// send email   
			if($this->base->send_email($email,$subject,$message)) 
			{
				return 1;  // Email is sent
			}
			else
			{
				return 2; // Account is created but email not sent
			}
		}
		else
		{
			return 0; // Could not register user
		}
	}	

	/**
	 * Method to update user details
	 *
	 * @param  int  $user_id  user ID of user to update details
	 */
	public function update_details($user_id)
	{
		// birth-date
		$day = trim($this->input->post('day'));
		$month = trim($this->input->post('month'));		
		$year = trim($this->input->post('year'));
		$birth_date = $year.'-'.$month.'-'.$day;		

		// Create array of new user data
		$data = array(
			'name' => ucwords(trim($this->input->post('name'))),				
			'email' => trim($this->input->post('email')),	
			'birth_date' => $birth_date,			
			'gender' => trim($this->input->post('gender')),
			'mobile_no' => trim($this->input->post('mobile_no')),
			'location' => trim($this->input->post('location')),										
		);			

		// run query
		$this->db->where('id', $user_id);
		$result = $this->db->update($this->table, $data);

		return $result;
	}

	/**	
	 * Method to update password 
	 *
	 * @param  int  $user_id  user ID of user
	 */
	public function update_password($user_id)
	{
		// get user details
		$this->db->where('id', $user_id);
		$result = $this->db->get($this->table)->row();			

		// get user's password from db
		$db_password = $result->password;		
		$old_password = $this->input->post('old_password');		
		$is_match = $this->base->match_password($db_password,$old_password);
		
		// if both password hash matches
		if($is_match) 
		{						
			// Encrypt password into md5 hash
			$password = $this->input->post('new_password');

			if($password) 
			{
				$password = $this->base->encrypt_password($password);					
			}	

			$this->db->where('id', $user_id);
			$result = $this->db->update($this->table, array('password' => $password));																		
			return $result;
		}
		else // invalid password supplied
		{	
			return -1;
		}		
	}

	/**
	 * Method to send username to user via email
	 * on username recovery request
	 */
	public function email_username()
	{		
		// email received
		$email = $this->input->post('email');

		// get user details
		$this->db->where('email', $email);
		$query = $this->db->get($this->table);
		
		// if user exists
		if($query->num_rows() == 1) 
		{
			$user = $query->row_array();

			$this->load->config('site');					
			$site_name = $this->config->item('site_name');

			// send email
			$subject = 'Username recovery email';
			$message = $site_name.'<br>'.
					   'Here is your username: '.$user['username'];
			$result = $this->base->send_email($email,$subject,$message);

			return $result;
		} 
		else 
		{
			return -1;
		}
	}

	/**
	 * Method to send password recovery url via 
	 * email to user on password recovery request
	 */
	public function send_password_recovery_link()
	{
		// email or username
		$user = $this->input->post('user');

		// get user details
		$this->db->where('email',$user);
    $this->db->or_where('username',$user);
    $query = $this->db->get($this->table);
		
		// if user exists
		if($query->num_rows() == 1) 
		{
			$user = $query->row_array();
			$token = $this->base->get_random_string();		

			// Create array of new user data
			$data = array(
				'user_id' => $user['id'],				
				'token' => $token		
			);

			// store data into database
			$insert = $this->db->insert('recovery_tokens', $data); 

			// if new user register send notification email
			if($insert)
			{	
				$email = $user['email'];
				$subject = 'Password recovery link';
				$message = 'Click on following link to reset your password on password recovery page.<br/>'.site_url().'user/reset_password/'.$token;
				
				// send email   
				if($this->base->send_email($email,$subject,$message)) 
				{
					return 1;  // Email is sent
				}
				else
				{
					return 0; // Error occured in sending email
				}
			}			
		} 
		else 
		{
			return -1;
		}
	}

	/**
	 * Method to reset password
	 */
	public function reset_password()
	{
		$table = 'recovery_tokens';
		$token = $this->session->userdata('token');

		// if password recovery token exists in session
		if($token)
		{
			// get user id corresponding to token
			$this->db->where('token',$token);        
      $query = $this->db->get($table);

      if($query->num_rows() == 1) 
			{
				$row = $query->row_array();

				// encrypt password
				$password = $this->input->post('password');
				$password = $this->base->encrypt_password($password);	

				// reset password
				$this->db->where('id', $row['user_id']);
				$result = $this->db->update($this->table, array('password' => $password));	

				// remove token from db
				$this->db->where('user_id',$row['user_id'])->where('token',$token)->delete($table);
				
				return $result;
			} 
			else // invalid token
			{ 
				return -1;
			}
		} 
		else // token expired
		{ 
			return -2;
		}		
	}	

	/**
	 * Method to activate user account.
	 *
	 * @param  string  $key  activation key
	 */
	function activate_account($key)
	{				
		// fetch user data which matches activation key supplied
		$this->db->where('activation', $key);
		$query = $this->db->get($this->table); 
		
		if($query->num_rows() == 1) // If row exists
		{
			$result = $query->result();
			
			$id = $result[0]->id; // user id
			$activation = $result[0]->activation; // activation status			
			$register_date = strtotime($result[0]->register_date); // date of account creation
			
			// get current date			
			$curr_date = strtotime(time());

			// get days difference between current and register date
			$diff = $curr_date - $register_date;
			$days = floor($diff/(60*60*24));
						
			if($diff <= 15) // Check if activation key not expired
			{
				// Update database				
				$this->db->where('id', $id);
				$this->db->update($this->table, array('activation' => 1)); 
				return 1;
			}			
			else // Activation key expired, delete user entry from database
			{
				$this->db->delete($this->table, array('id' => $id)); 
				return 2;
			}
		}
		else
		{
			return 0;
		}
	}

	/**
	 * Method to retrieve user details
	 *
	 * @param  int  $id  user ID
	 */
	public function get_item($id = NULL)
  {
    if($id != NULL)
    {
    	// run query
      $this->db->where('id',$id);
      $query = $this->db->get($this->table);

      if($query->num_rows() == 1) 
      {
        $user = $query->row_array();

        // split birth date into day, month, year
        $tmp = strtotime($user['birth_date']);                
        $user['day'] = date('d',$tmp);
        $user['month'] = date('m',$tmp);
        $user['year'] = date('Y',$tmp);
        
        return $user;
      }              
    }

    return false;
  }
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */