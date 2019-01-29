<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Muser extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getAllData(){
		$this->db->select('*');
		$this->db->from('tbl_users');
		$q = $this->db->get();
		return $q->result();
	}

	public function Saveuser($user){
		$this->db->insert('tbl_users',$user);
	}

	public function Selectuserid($user_id){
		$this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('user_id', $user_id);
                
        return $this->db->get()->row();
	}

	public function Updateuser($user,$user_id){
		$this->db->where('user_id',$user_id);
		$this->db->update('tbl_users',$user);
	}

	public function Deleteuser($user_id){
		$this->db->where('user_id',$user_id);
		$this->db->delete('tbl_users');
	}

	function SelectLevel(){
		$this->db->select('*');
		$this->db->from('tbl_level');
		$query = $this->db->get();
		return $query->result();
	}

	function checkEmailExists($email)
    {
        $this->db->select("email");
        $this->db->from("tbl_users");
        $this->db->where("email", $email);   
        $query = $this->db->get();

        return $query->result();
    }

    function checkUsernameExists($username)
    {
        $this->db->select("username");
        $this->db->from("tbl_users");
        $this->db->where("username", $username);   
        $query = $this->db->get();

        return $query->result();
    }

    public function getUserid($email){
    	$this->db->select('user_id');
        $this->db->from('tbl_users');
        $this->db->where('email',$email);
        $query = $this->db->get()->row();
        return $query->user_id;
    }

    public function selectbyemail($email){
        $this->db->select('email');
        $this->db->from('tbl_users');
        $this->db->where('email',$email);
        $query = $this->db->get();
        return $query;
    }

}

/* End of file muser.php */
/* Location: ./application/models/muser.php */