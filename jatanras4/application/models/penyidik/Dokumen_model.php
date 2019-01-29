<?php
/**
 * JATANRAS DOKUMEN
 * Eka Riana
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen_model extends CI_Model {

	var $table = 'media';
	var $dokumen = 'dokumen';
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
		
		/*
		$this->db->select('pasal.id, pasal.kasus, media.id, penyidik.nama, media.kanit_id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, media.pelaku'); 
		$this->db->join('pasal', 'media.pasal_id = pasal.id');
		$this->db->join('penyidik', 'penyidik.id = media.penyidik_id', 'LEFT');
		$this->db->where('media.penyidik_id',$id);
		*/

		//$this->db->select("*");

		$this->db->select('pasal.id, pasal.kasus, media.id, media.kanit_id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, media.pelaku, media.is_status'); 
		$this->db->join('pasal', 'media.pasal_id = pasal.id');
		$this->db->where('media.penyidik_id',$id);

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
		//$this->db->select('*'); 
		//$this->db->join('pasal', 'media.pasal_id = pasal.id');
		//$this->db->where('media.penyidik_id',$id);

		//$query = $this->db->get($this->media_detail);
		
		//if($query->num_rows() > 0) 
		//{
		//	$users = $query->result();
			//return $users;
		//}  

		///return false;

		$query = $this->db->query("SELECT * FROM dokumen");
		return $this->db->result();  	    	
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

	public function get_surat()
	{
		$query = $this->db->query("SELECT * FROM dokumen");
		$user = $query->result();
				return $user; 
	}

	private $_ID;
    private $_url;

    public function setID($ID) {
        $this->_ID = $ID;
    }

    public function setURL($url) {
        $this->_url = $url;
    }
    // get image
    public function getPicture() {        
        $this->db->select(array('p.id', 'p.raw_name'));
        $this->db->from('media p');  
        $this->db->where('p.id', $this->_ID);     
        $query = $this->db->get();
       return $query->row_array();
    }

    
    public function create($media_id, $user_id, $keterangan) { 
        $data = array(
            'raw_name' => $this->_url,
            'file_name' => $this->_url,
            'user_id' => $user_id,
            'media_id' => $media_id,
            'keterangan' => $keterangan
        );
        $this->db->insert('media_detail', $data);
        return $this->db->insert_id();
    }

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */