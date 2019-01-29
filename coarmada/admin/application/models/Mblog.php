<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mblog extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	function GetData($number = 5,$start = 0){
    	$this->db->select('*');
    	$this->db->from('tbl_berita');
        $this->db->order_by('tanggal_posting', 'DESC');
        $this->db->limit($number, $start);
    	$query = $this->db->get();
    	return $query->result();
    }

    function GetCountData(){
        return $this->db->get('tbl_berita')->num_rows();
    }

    function GetPost($url){
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->where('judul_slug like',$url);
        $query = $this->db->get();
        return $query->result();
    }

    function showRecentPost(){
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->order_by('tanggal_posting', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    function Search($words){
        $this->db->like('judul',$words);
        $query = $this->db->get('tbl_berita');
        return $query->result();
    }

}

/* End of file MBlog.php */
/* Location: ./application/models/MBlog.php */