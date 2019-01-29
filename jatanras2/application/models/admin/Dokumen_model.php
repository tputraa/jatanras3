<?php
/**
 * JATANRAS DOKUMEN
 * Eka Riana
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen_model extends CI_Model {

	// database table name
	var $table = 'media';	
	var $search;    

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->search = $this->session->userdata('dokumen.filter.search');
	}

	/**
	 * Method to register new user
	 */
	public function register()
	{
		// Encrypt password into md5 hash
		$password = $this->base->encrypt_password($this->input->post('password'));		

		// birth-date
		$day = trim($this->input->post('day'));
		$month = trim($this->input->post('month'));		
		$year = trim($this->input->post('year'));
		$birth_date = $year.'-'.$month.'-'.$day;		

		// Create array of new user data
		$data = array(
			'nrp' => ucwords(trim($this->input->post('nrp'))),
			'nama' => trim($this->input->post('nama')),
			//'password' => $password,
			'telpon' => trim($this->input->post('telpon')),	
			'alamat' => trim($this->input->post('alamat')),

			/*			
			'gender' => trim($this->input->post('gender')),
			'mobile_no' => trim($this->input->post('mobile_no')),
			'region' => trim($this->input->post('location')),	
			'usertype' => 0, // normal user, 1: admin
			*/

			'created_date' => date('Y-m-d H:m:s'),
			'activation' => '1'			
		);

		// store data into database
		$insert = $this->db->insert($this->table, $data); 

		// if new user register send notification email
		if($insert)
		{	
			$this->load->config('site');					
			$site_name = $this->config->item('site_name');

			$email = $this->input->post('email');					
			$subject = 'Account registration';
			$message = 'An account is created for you on '.$site_name.' by site administrator.<br/>'.
						 'Your login details:<br/>Username: '.$this->input->post('username').'<br/>Password: '.$this->input->post('password');						
			
			// send email   
			if($this->base->send_email($email,$subject,$message)) 
			{
				return 1;  // Email is sent
			}
			else
			{
				return 2; // Account is created but email not sent
			}
		}
		else
		{
			return 0; // Could not register user
		}
	}

	/**
	 * Method to update user details
	 */
	public function update_details()
	{
		// birth-date
		$day = trim($this->input->post('day'));
		$month = trim($this->input->post('month'));		
		$year = trim($this->input->post('year'));
		$birth_date = $year.'-'.$month.'-'.$day;		

		// Create array of new user data
		$data = array(
			'nrp' => ucwords(trim($this->input->post('nrp'))),
			'nama' => trim($this->input->post('nama')),
			'telpon' => trim($this->input->post('telpon')),	
			'alamat' => trim($this->input->post('alamat')),
			'created_date' => date('Y-m-d H:m:s'),
		);
		
		
		$password = $this->input->post('password');

		// Encrypt password into md5 hash
		if($password) {
			$password = $this->base->encrypt_password($password);
			$data['password'] = $password;
		}		

		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update($this->table, $data);

		return $result;
	}	
	
	/**
	 * Method to count records for supplied search filter
	 */
	public function record_count() 
	{        
		if($this->search) 
		{            
			$this->db->like('name',$this->search);
			$this->db->or_like('username',$this->search);
			$this->db->or_like('email',$this->search);
		}

		return $this->db->count_all_results($this->table);
	}

	public function get_list($limit, $start)
	{        
		// run query

		$this->db->select('pasal.id, media.is_status, pasal.kasus, media.id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, media.pelaku'); 
		if($this->search) 
		{            
			$this->db->like('nrp',$this->search);
			$this->db->or_like('nama',$this->search);
			$this->db->or_like('alamat',$this->search);
		}

		$this->db->join('pasal', 'media.pasal_id = pasal.id');
		$this->db->limit($limit, $start);
		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0) 
		{
			$users = $query->result();

			/*
			foreach($users as $user) 
			{
				if($user->activation != 1) 
				{
					$user->activation = 0;
				}		    	
			}
			*/
			
			return $users;
		}  

		return false;  	    	
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
			// run query
			$this->db->where('id',$id);
			$query = $this->db->get($this->table);

			if($query->num_rows() == 1) 
			{
				$user = $query->row_array();

				// split birth date into day, month, year
				/*
				$tmp = strtotime($user['birth_date']);                
				$user['day'] = date('d',$tmp);
				$user['month'] = date('m',$tmp);
				$user['year'] = date('Y',$tmp);
				*/
				return $user;
			}              
		}

		return false;
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

    public function SaveDokumen($data){
    	$this->db->insert('media',$data);
    }

    public function UpdateDokumen($data,$id){
    	$this->db->where('id',$id);
    	$this->db->update('media',$data);
    }

    public function SelectIdMedia($media_id){
        $this->db->select('*');
        $this->db->from('media');
        $this->db->where('id', $media_id);
        $res = $this->db->get();
        return $res->result_array();
    }

    
    // insert image
    public function create($nolp, $nama_pelapor, $tanggal_kejadian,  $pelaku, $korban, $kasus, $tanggal_lapor, $ext_name) { 
        $data = array(
            'raw_name' => $this->_url,
            'file_name' => $this->_url,
            'no_lp'=>$nolp,
            'nama_pelapor'=>$nama_pelapor,
            'tanggal_kejadian'=>$tanggal_kejadian,
            'pelaku' => $pelaku,
            'korban'=> $korban,
            'pasal_id' => $kasus,
            'tanggal_lapor'=>$tanggal_lapor,
            'file_ext' => $ext_name
        );
        $this->db->insert('media', $data);
        return $this->db->insert_id();
    }


    public function update($id, $nolp, $nama_pelapor, $tanggal_kejadian,  $pelaku, $korban, $kasus, $tanggal_lapor, $ext_name) { 

        $data = array(
            'raw_name' => $this->_url,
            'file_name' => $this->_url,
            'no_lp'=>$nolp,
            'nama_pelapor'=>$nama_pelapor,
            'tanggal_kejadian'=>$tanggal_kejadian,
            'pelaku' => $pelaku,
            'korban'=> $korban,
            'pasal_id' => $kasus,
            'tanggal_lapor'=>$tanggal_lapor,
            'file_ext' => $ext_name
        );
        $this->db->where('id', $id);
        $this->db->update('media', $data);
    }

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */