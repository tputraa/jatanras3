<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mrunning extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	function getAllData(){
		$this->db->select('*');
		$this->db->from('tbl_infotext');
		$q = $this->db->get();
		return $q->result();
	}

	function Savetext($running){
		$this->db->insert('tbl_infotext',$running);
	}

	function SelectTextId($text_id){
		$this->db->select('*');
        $this->db->from('tbl_infotext');
        $this->db->where('text_id', $text_id);
                
        return $this->db->get()->row();
	}

	function UpdateText($text_id, $running){
		$this->db->where('text_id',$text_id);
		$this->db->update('tbl_infotext',$running);
	}

	function DeleteText($text_id){
		$this->db->where('text_id',$text_id);
		$this->db->delete('tbl_infotext');
	}

	function status_text($text_id,$status){
		$this->db->set('status',$status);
		$this->db->where('text_id',$text_id);
		$this->db->update('tbl_infotext');
	}

}

/* End of file Mrunning.php */
/* Location: ./application/models/Mrunning.php */