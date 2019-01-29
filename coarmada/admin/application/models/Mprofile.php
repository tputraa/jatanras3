<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mprofile extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function selectbyid($user_id){
		$this->db->select('*');
      	$this->db->from('tbl_users');
      	$this->db->where('user_id', $user_id);
      	return $this->db->get();
	}
	
	public function updateAvatar($user_id,$data){
		$this->db->where('user_id',$user_id);
		$this->db->update('tbl_users',$data);
	}

	public function cekPass($user_id){
		$q = "SELECT password FROM tbl_users WHERE user_id = '$user_id'";
		$res = $this->db->query($q)->row();
		return $res->password;
	}

	public function selectIdProfil(){
		$this->db->select('*');
		$this->db->from('tbl_profile');
		$this->db->where('profile_id',1);
		return $this->db->get();
	}

	public function Updateprofile($profile_id,$profile){
		$this->db->where('profile_id',$profile_id);
		$this->db->update('tbl_profile',$profile);
	}

}

/* End of file mprofile.php */
/* Location: ./application/models/mprofile.php */