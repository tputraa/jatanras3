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
 * Countries model class
 */
class Region_model extends CI_Model {

	// database table name
	var $table = 'region';
	var $search;    

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->search = $this->session->userdata('region.filter.search');
	}

	/**
	 * Method to count records for supplied search filter
	 */
	public function record_count() 
	{
		if($this->search) 
		{            
			$this->db->like('name',$this->search);            
		}

		return $this->db->count_all_results($this->table);
	}
	
	/**
	 * Method to get list of countries records
	 *
	 * @param  int  $limit  no. of records to retrieve from db table
	 * @param  int  $start  no. of record to start retrieve from
	 */
	public function get_list($limit, $start)
	{       
		// run query 
		if($this->search) 
		{
			$search = $this->search;
			$this->db->like('name',$search);            
		}

		$this->db->limit($limit, $start);
		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0) 
		{
			$countries = $query->result();    		
			return $countries;
		}  

		return false;  	    	
	}

	/**
	 * Method to get single record from table 
	 *
	 * @param  int  $id  country ID
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
				$country = $query->row_array();                            
				return $country;
			}              
		}

		return false;
	}

	/**
	 * Method to update user details
	 */
	public function update_details()
	{
		$id = $this->input->post('id'); 
		$data = array('name'=>trim($this->input->post('name')));    

		// update entry if id exists
		if($id) 
		{
			$this->db->where('id', $this->input->post('id'));
			$result = $this->db->update($this->table, $data);
			return $result;
		} 
		else // else insert new entry
		{
			$result = $this->db->insert($this->table, $data);
			return $result;
		}
	}


	public function get_list_cabang()
	{       
		
		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0) 
		{
			$countries = $query->result();    		
			return $countries;
		}  

		return false;  	    	
	}

	public function get_list_user_cabang2($id = NULL)
	{       
		
		/*

		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0) 
		{
			$countries = $query->result();    		
			return $countries;
		}  

		return false;  	    	*/

		if($id != NULL)
		{
			// run query

			$this->db->where('id',$id);
			$query = $this->db->get($this->table);

			if($query->num_rows() == 1) 
			{
				$country = $query->row_array();                            
				return $country;
			}              
		}

		return false;
	}


	public function get_list_user_cabang($id = NULL)
	{
		$this->db->select('u.id,u.name,u.region');
		$this->db->from('users as u');
		$this->db->join('region as r', 'u.region = r.id');
		$this->db->where('u.region',$id);
		$query = $this->db->get();
		return $query->result();
	}
}

/* End of file Countries.php */
/* Location: ./application/models/admin/Countries_model.php */