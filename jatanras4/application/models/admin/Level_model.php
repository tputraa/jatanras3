<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Level_model extends CI_Model {

	// database table name
	var $table = 'level';	
	var $search;    

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->search = $this->session->userdata('users.filter.search');
	} 

	
	public function get_list()
	{        
		
		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0) 
		{
			$users = $query->result();
			return $users;
		}  

		return false;  	    	
	}
}

/* End of file Level_model.php */
/* Location: ./application/models/Level_model.php */