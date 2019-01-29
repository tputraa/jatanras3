<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mberita extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	function getAllDataByUserId($user_id){
		$this->db->select('*');
		$this->db->from('tbl_berita');
		$this->db->where('user_id',$user_id);
		$this->db->order_by('tanggal_posting', 'DESC');
		$q = $this->db->get();
		return $q->result();
	}

	function getAllData(){
		$this->db->select('*');
		$this->db->from('tbl_berita');
		$this->db->order_by('tanggal_posting', 'DESC');
		$q = $this->db->get();
		return $q->result();
	}

	function Saveberita($berita){
		$this->db->insert('tbl_berita',$berita);
	}

	function SelectIdBerita($berita_id,$userid=''){
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->where('berita_id', $berita_id);

        if (!empty($userid)){
			$this->db->where('user_id', $userid);        	
        }
        
        
        return $this->db->get();
    }

    function Updateberita($berita_id,$berita){
    	$this->db->where('berita_id',$berita_id);
    	$this->db->update('tbl_berita',$berita);
    }

    function Deleteberita($berita_id){
    	$this->db->where('berita_id',$berita_id);
    	$this->db->delete('tbl_berita');
    }

}

/* End of file Mberita.php */
/* Location: ./application/models/Mberita.php */