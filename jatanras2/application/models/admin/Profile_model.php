<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function selectIdProfil($userid){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$userid);
		return $this->db->get();
	}

}

/* End of file Profile_model.php */
/* Location: ./application/models/Profile_model.php */