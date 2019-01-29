<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mlogin extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	function cekLogin($username,$password){
		$this->db->where('username', $username);
       	$this->db->where('password', $password);
       	$query = $this->db->get('tbl_users');
       	return $query;
	}

}

/* End of file Mlogin.php */
/* Location: ./application/models/Mlogin.php */