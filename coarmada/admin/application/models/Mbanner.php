<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mbanner extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	function getAllData(){
		$this->db->select('*');
		$this->db->from('tbl_banner');
		$q = $this->db->get();
		return $q->result();
	}

	function SelectimgId($banner_id){
		$this->db->select('*');
        $this->db->from('tbl_banner');
        $this->db->where('banner_id', $banner_id );
        return $this->db->get();  
	}

	function Saveimage($image){
		$this->db->insert('tbl_banner',$image);
	}

	function Updateimage($banner_id,$images){
		$this->db->where('banner_id',$banner_id);
		$this->db->update('tbl_banner',$images);
	}

	function DeleteBanner($banner_id){
		$this->db->where('banner_id',$banner_id);
		$this->db->delete('tbl_banner');
	}

}

/* End of file Mbanner.php */
/* Location: ./application/models/Mbanner.php */