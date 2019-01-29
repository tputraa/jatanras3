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
class Countries_model extends CI_Model {

	// database table name
	var $table = 'countries';
	var $search;    

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->search = $this->session->userdata('countries.filter.search');
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
			$insert = $this->db->insert($this->table, $data);
			return $result;
		}
	}
}

/* End of file Countries.php */
/* Location: ./application/models/admin/Countries_model.php */