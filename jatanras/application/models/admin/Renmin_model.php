<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Renmin_model extends CI_Model {

	var $table = 'renmin';	

	function __construct() {
        parent::__Construct();
    }

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
				return $user;
			}              
		}

		return false;
	}


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
			'telpon' => trim($this->input->post('telpon')),	
			'alamat' => trim($this->input->post('alamat')),
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
			'created_date' => date('Y-m-d H:m:s'),
			'activation' => trim($this->input->post('activation')),
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

}