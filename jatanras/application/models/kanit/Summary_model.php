<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Summary_model extends CI_Model {

	var $media 			= 'media';
	var $kasubdit 		= 'kasubdit';
	var $kanit 			= 'kanit';
	var $penyidik 		= 'penyidik';
	var $pasal 			= 'pasal';
	var $ci_sessions 	= 'ci_sessions';

	public function __construct()
	{
		parent::__construct();
		
	}

	public function record_count_media($id) 
	{        
		$this->db->where('kanit_id', $id);
		$query = $this->db->get($this->media);

		if($query->num_rows() > 0) 
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}

		return false;
	}
	
	public function record_count_kasubdit() 
	{        
		$query = $this->db->get($this->kasubdit);
		if($query->num_rows() > 0 ) 
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		} 

		return false;
	}

	public function record_count_kanit() 
	{        
		$query = $this->db->get($this->kanit);
		if($query->num_rows() > 0 ) 
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		} 

		return false;
	}

	public function record_count_penyidik($id) 
	{        
		$this->db->where('kanit_id', $id);
		$query = $this->db->get($this->penyidik);
		if($query->num_rows() > 0 ) 
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		} 

		return false;
	}

	public function record_count_pasal() 
	{        
		$query = $this->db->get($this->pasal);
		if($query->num_rows() > 0 ) 
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		} 

		return false;
	}

	public function record_count_visit() 
	{        
		$query = $this->db->get($this->ci_sessions);
		if($query->num_rows() > 0 ) 
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		} 

		return false;
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
			$this->db->like('pasal',$this->search);
			$this->db->or_like('kasus',$this->search);
		}

		$this->db->limit($limit, $start);
		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0) 
		{
			return $query->result();
		}  

		return false;  	    	
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

	public function register()
	{

		$pasal = trim($this->input->post('pasal'));
		$kasus = trim($this->input->post('kasus'));			

		// Create array of new user data
		$data = array(
			'pasal' => $pasal,
			'kasus' => $kasus,
			'created_date' => date('Y-m-d H:m:s'),		
		);

		// store data into database
		$insert = $this->db->insert($this->table, $data); 

		// if new user register send notification email
		if($insert)
		{	
						
			return 1;
		}
		else
		{
			return 0; // Could not register user
		}
	}

	public function update_details()
	{
		// birth-date
		$pasal = trim($this->input->post('pasal'));
		$kasus = trim($this->input->post('kasus'));				

		// Create array of new user data
		$data = array(
			'pasal' => $pasal,
			'kasus' => $kasus,
			'created_date' => date('Y-m-d H:m:s'),		
		);
		
		
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update($this->table, $data);

		return $result;
	}	

}

/* End of file Pasal_model.php */
/* Location: ./application/models/Pasal_model.php */