<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Kanit_model extends CI_Model {

	var $order = array('nrp' => 'desc'); // default order

	var $table = 'kanit';	
	var $search;    

	function __construct() {
        parent::__Construct();
    }

	function get_order_list($post){
        $this->_get_order_list_query($post);
        if ($post['length'] != -1) {
            $this->db->limit($post['length'], $post['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    function _get_order_list_query($post){
        $this->db->select("id, nrp, nama, telpon, alamat, created_date");
        $this->db->from('kanit');
        
        if(!empty($post['where'])){
            $this->db->where($post['where']);
        }
        
        foreach ($post['where_in'] as $index => $value){
           
            $this->db->where_in($index, $value);
        }
        
        if (!empty($post['search_value'])) {
            $like = "";
            foreach ($post['column_search'] as $key => $item) { // loop column 
                // if datatable send POST for search
                if ($key === 0) { // first loop
                    $like .= "( ".$item." LIKE '%".$post['search_value']."%' ";
                   
                } else {
                    $like .= " OR ".$item." LIKE '%".$post['search_value']."%' ";
                     
                }
             }
             $like .= ") ";

           $this->db->where($like, null, false);
        }

        if (!empty($post['order'])) { // here order processing
            
            $this->db->order_by($post['column_order'][$post['order'][0]['column']], $post['order'][0]['dir']);
            
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
    }
    
    function count_all($post){
        $this->_count_all_bb_order($post);
        $query = $this->db->count_all_results();
       
        return $query;
    }
    
    public function _count_all_bb_order($post){
        $this->db->from('kanit');
        $this->db->where($post['where']);
        foreach ($post['where_in'] as $index => $value){
            $this->db->where_in($index, $value);
        }
    }
    
    function count_filtered($post){
        $this->_get_order_list_query($post);
        
        $query = $this->db->get();
        return $query->num_rows();
    }

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
				return $user;
			}              
		}

		return false;
	}


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
			'telpon' => trim($this->input->post('telpon')),	
			'alamat' => trim($this->input->post('alamat')),
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
			'activation' => trim($this->input->post('activation')),
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

}