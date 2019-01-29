<?php
/**
 * JATANRAS DOKUMEN
 * Eka Riana
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen_model extends CI_Model {

	// database table name
	var $table = 'media';	
	var $media_detail = 'media_detail';
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

	public function get_list($id)
	{        
		
		$this->db->select('pasal.id, pasal.kasus, media.id, penyidik.nama, media.kanit_id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, media.pelaku'); 
		$this->db->join('pasal', 'media.pasal_id = pasal.id');
		$this->db->join('penyidik', 'penyidik.id = media.penyidik_id', 'LEFT');
		$this->db->where('media.kanit_id',$id);

		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0) 
		{
			$users = $query->result();
			return $users;
		}  

		return false;  	    	
	}

	public function get_list_dokumen($id)
	{        
		$this->db->select('*'); 
		//$this->db->join('pasal', 'media.pasal_id = pasal.id');
		//$this->db->where('media.penyidik_id',$id);

		$query = $this->db->get($this->media_detail);
		
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
			
			$this->db->select('pasal.id, pasal.kasus, media.id, media.kanit_id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, media.pelaku, media.file_name, media.tanggal_kejadian, media.korban, media.tanggal_lapor'); 
			$this->db->join('pasal', 'media.pasal_id = pasal.id');
			$this->db->where('media.id',$id);
			$query = $this->db->get($this->table);

			if($query->num_rows() == 1) 
			{
				$user = $query->row_array();
				return $user;
			}              
		}

		return false;
	}
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */