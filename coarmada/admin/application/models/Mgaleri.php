<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mgaleri extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	function getAllData(){
		$this->db->select('*');
		$this->db->from('tbl_galeri');
		$q = $this->db->get();
		return $q->result();
	}

	function GetData($number = 8,$start = 0){
    	$this->db->select('*');
    	$this->db->from('tbl_galeri');
        $this->db->order_by('foto_id', 'DESC');
        $this->db->limit($number, $start);
    	$query = $this->db->get();
    	return $query->result();
    }

    function GetCountData(){
        return $this->db->get('tbl_galeri')->num_rows();
    }

	function SelectimgId($foto_id){
		$this->db->select('*');
        $this->db->from('tbl_galeri');
        $this->db->where('foto_id', $foto_id );
        return $this->db->get();  
	}

	function Saveimage($image){
		$this->db->insert('tbl_galeri',$image);
	}

	function Updateimage($foto_id,$images){
		$this->db->where('foto_id',$foto_id);
		$this->db->update('tbl_galeri',$images);
	}

	function DeleteFoto($foto_id){
		$this->db->where('foto_id',$foto_id);
		$this->db->delete('tbl_galeri');
	}

}

/* End of file Mbanner.php */
/* Location: ./application/models/Mbanner.php */