<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan_model extends CI_Model {

	public $variable;
	var $table = 'jabatan';
	var $search;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function record_count() 
	{        
		if($this->search) 
		{            
			$this->db->like('jabatan',$this->search);
			$this->db->or_like('kasus',$this->search);
		}

		return $this->db->count_all_results($this->table);
	}
		
	
	public function get_list()
	{        
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

		$jabatan = trim($this->input->post('jabatan'));
		
		$data = array(
			'jabatan' => $jabatan,
			'created_date' => date('Y-m-d H:m:s'),		
		);

		$insert = $this->db->insert($this->table, $data); 

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
		
		$jabatan = trim($this->input->post('jabatan'));
		
		$data = array(
			'jabatan' => $jabatan,
			'created_date' => date('Y-m-d H:m:s'),		
		);
		
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update($this->table, $data);

		return $result;
	}	

}

/* End of file jabatan_model.php */
/* Location: ./application/models/jabatan_model.php */