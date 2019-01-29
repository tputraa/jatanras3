<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelaku_model extends CI_Model {

	public $variable;
	var $table = 'pelaku';
	var $search;

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}

	public function record_count() 
	{        
		if($this->search) 
		{            
			$this->db->like('nama',$this->search);
			$this->db->or_like('alamat',$this->search);
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
			$this->db->like('nama',$this->search);
			$this->db->or_like('alamat',$this->search);
		}

		//$this->db->limit($limit, $start);
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

		$nama 			= trim($this->input->post('nama'));
		$tempat_lahir 	= trim($this->input->post('tempat_lahir'));			
		$tanggal_lahir 	= trim($this->input->post('tanggal_lahir'));
		$alamat 		= trim($this->input->post('alamat'));
		$telpon 		= trim($this->input->post('telpon'));
		$jenis_kelamin 	= trim($this->input->post('jenis_kelamin'));	

		// Create array of new user data
		$data = array(
			'nama' 			=> $nama,
			'tempat_lahir' 	=> $tempat_lahir,
			'tanggal_lahir' => $tanggal_lahir,
			'alamat'		=> $alamat,
			'telpon'		=> $telpon,
			'jenis_kelamin'	=> $jenis_kelamin,
			'created_date' 	=> date('Y-m-d H:m:s'),		
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
		$nama 			= trim($this->input->post('nama'));
		$tempat_lahir 	= trim($this->input->post('tempat_lahir'));			
		$tanggal_lahir 	= trim($this->input->post('tanggal_lahir'));
		$alamat 		= trim($this->input->post('alamat'));
		$telpon 		= trim($this->input->post('telpon'));
		$jenis_kelamin 	= trim($this->input->post('jenis_kelamin'));	

		// Create array of new user data
		$data = array(
			'nama' 			=> $nama,
			'tempat_lahir' 	=> $tempat_lahir,
			'tanggal_lahir' => $tanggal_lahir,
			'alamat'		=> $alamat,
			'telpon'		=> $telpon,
			'jenis_kelamin'	=> $jenis_kelamin,
			'created_date' 	=> date('Y-m-d H:m:s'),		
		);
		
		
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update($this->table, $data);

		return $result;
	}	

}

/* End of file pelaku_model.php */
/* Location: ./application/models/pelaku_model.php */