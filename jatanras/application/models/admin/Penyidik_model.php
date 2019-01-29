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
class Penyidik_model extends CI_Model {

	// database table name
	var $table = 'penyidik';	
	var $search;    

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->search = $this->session->userdata('penyidik.filter.search');
	} 

	/**
	 * Method to validate user to login in
	 */
	function validate()
	{	
		// get user details for supplied username
		$this->db->where('usertype', 1);
		$this->db->where('username', $this->input->post('username'));
		$query = $this->db->get($this->table);
		
		// if user exists
		if($query->num_rows() == 1) 
		{
			$result = $query->result();

			$activated = $result[0]->activation;
			
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
		
					// update login time of user into database
					$data = array(
								'last_visit_date' => date('Y-m-d H:m:s')								
							);
					$this->db->where('id', $id);
					$this->db->update($this->table, $data); 
					
					$this->session->set_userdata('admin_loggedin',TRUE);
					$this->session->set_userdata('admin_user_id',$id);																
					
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

		// Create array of new user data
		$data = array(
			'nrp' => ucwords(trim($this->input->post('nrp'))),
			'nama' => trim($this->input->post('nama')),
			//'password' => $password,
			'telpon' => trim($this->input->post('telpon')),	
			'alamat' => trim($this->input->post('alamat')),
			'kanit_id' => trim($this->input->post('kanit_id')),
			/*			
			'gender' => trim($this->input->post('gender')),
			'mobile_no' => trim($this->input->post('mobile_no')),
			'region' => trim($this->input->post('location')),	
			'usertype' => 0, // normal user, 1: admin
			*/

			'created_date' => date('Y-m-d H:m:s'),
			'activation' => '1'			
		);

		// store data into database
		$insert = $this->db->insert($this->table, $data); 

		// if new user register send notification email
		if($insert)
		{	
			$this->load->config('site');					
			$site_name = $this->config->item('site_name');

			$email = $this->input->post('email');					
			$subject = 'Account registration';
			$message = 'An account is created for you on '.$site_name.' by site administrator.<br/>'.
						 'Your login details:<br/>Username: '.$this->input->post('username').'<br/>Password: '.$this->input->post('password');						
			
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
	 */
	public function update_details()
	{
		// birth-date
		$day = trim($this->input->post('day'));
		$month = trim($this->input->post('month'));		
		$year = trim($this->input->post('year'));
		$birth_date = $year.'-'.$month.'-'.$day;		

		// Create array of new user data
		$data = array(
			'nrp' => ucwords(trim($this->input->post('nrp'))),
			'nama' => trim($this->input->post('nama')),
			'telpon' => trim($this->input->post('telpon')),	
			'alamat' => trim($this->input->post('alamat')),
			'kanit_id' => trim($this->input->post('kanit_id')),
			'created_date' => date('Y-m-d H:m:s'),
		);
		
		
		$password = $this->input->post('password');

		// Encrypt password into md5 hash
		if($password) {
			$password = $this->base->encrypt_password($password);
			$data['password'] = $password;
		}		

		$this->db->where('id', $this->input->post('id'));
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

			if($password) {
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
		$this->db->where('usertype', '1');
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
		$this->db->where('usertype','1');
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
				$message = 'Click on following link to reset your password on password recovery page.<br/>'.
							 site_url().'admin/dashboard/reset_password/'.$token;
				
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
	 * Method to count records for supplied search filter
	 */
	public function record_count() 
	{        
		if($this->search) 
		{            
			$this->db->like('name',$this->search);
			$this->db->or_like('username',$this->search);
			$this->db->or_like('email',$this->search);
		}

		return $this->db->count_all_results($this->table);
	}
		
	/**
	 * Method to get list of user records
	 *
	 * @param  int  $limit  no. of records to retrieve from db table
	 * @param  int  $start  no. of record to start retrieve from
	 */
	public function get_list($limit, $start)
	{        
		// run query
		if($this->search) 
		{            
			$this->db->like('nrp',$this->search);
			$this->db->or_like('nama',$this->search);
			$this->db->or_like('alamat',$this->search);
		}
		$this->db->select('p.*, k.nama as nama_kanit');
		$this->db->from('penyidik as p');
		$this->db->join('kanit as k','k.id = p.kanit_id');
		$this->db->order_by('p.id','ASC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		
		if($query->num_rows() > 0) 
		{
			$users = $query->result();

			foreach($users as $user) 
			{
				if($user->activation != 1) 
				{
					$user->activation = 0;
				}		    	
			}

			return $users;
		}  

		return false;  	    	
	}

	/**
	 * Method to get single record from table 
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
				/*
				$tmp = strtotime($user['birth_date']);                
				$user['day'] = date('d',$tmp);
				$user['month'] = date('m',$tmp);
				$user['year'] = date('Y',$tmp);
				*/
				return $user;
			}              
		}

		return false;
	}

	public function get_datakanit(){
		$this->db->select('*');
		$this->db->from('kanit');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_datapenyidik(){
		$this->db->select('*');
		$this->db->from('penyidik');
		$query = $this->db->get();
		return $query->result();
	}

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */