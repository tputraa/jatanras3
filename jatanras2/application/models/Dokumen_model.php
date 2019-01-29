<?php
/**
 * JATANRAS DOKUMEN
 * Eka Riana
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen_model extends CI_Model {

	// database table name
	var $table = 'media';	
	var $search;    

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		
	}

	/* SAMPLE JOIN TABLE
	$this->db->select('*');    
	$this->db->from('table1');
	$this->db->join('table2', 'table1.id = table2.id');
	$this->db->join('table3', 'table1.id = table3.id');
	*/

	public function get_list()
	{

		$this->db->select('pasal.id, pasal.kasus, media.id, users.name, media.kanit_id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, media.pelaku, media.is_status'); 
		$this->db->join('pasal', 'media.pasal_id = pasal.id');
		$this->db->join('users', 'users.id = media.kanit_id', 'LEFT');
		//$this->db->where('media.kanit_id',$id);
		
		//$this->db->limit($limit, $start);
		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0) 
		{
			$users = $query->result();
			return $users;
		}  

		return false;  	    	
	}

	public function get_list2()
	{

		$this->db->select('pasal.id, pasal.kasus, media.id, kanit.nama, media.kanit_id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, media.pelaku, media.is_status'); 
		$this->db->join('pasal', 'media.pasal_id = pasal.id');
		$this->db->join('kanit', 'kanit.id = media.kanit_id', 'LEFT');
		//$this->db->where('media.kanit_id',$id);
		
		//$this->db->limit($limit, $start);
		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0) 
		{
			$users = $query->result();
			return $users;
		}  

		return false;  	    	
	}

	public function get_list_lama($id)
	{

		$this->db->select('pasal.id, pasal.kasus, media.id, kanit.nama, media.kanit_id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, media.pelaku'); 
		$this->db->join('pasal', 'media.pasal_id = pasal.id');
		$this->db->join('kanit', 'kanit.id = media.kanit_id', 'LEFT');
		$this->db->where('media.kanit_id',$id);
		
		//$this->db->limit($limit, $start);
		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0) 
		{
			$users = $query->result();
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

	public function SaveDokumen($data){
    	$this->db->insert('media',$data);
    }

    public function UpdateDokumen($data,$id){
    	$this->db->where('id',$id);
    	$this->db->update('media',$data);
    }
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */