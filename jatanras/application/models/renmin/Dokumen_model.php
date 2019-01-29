<?php
/**
 * JATANRAS DOKUMEN
 * Eka Riana
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen_model extends CI_Model {

	// database table name
	var $table = 'media';	
	var $media_detail = 'media_detail';
	var $search;    

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		
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
        //$this->db->select("id, nrp, nama, telpon, alamat, created_date");
        //$this->db->from('media');
        $this->db->select('pasal.id, media.is_status, pasal.kasus, media.id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, media.pelaku'); 
		$this->db->from('media');
		$this->db->join('pasal', 'media.pasal_id = pasal.id');

		//$query = $this->db->get($this->table);
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
        $this->db->from('media');
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

	public function get_list($id)
	{        
		
		$this->db->select('pasal.id, media.is_status, pasal.kasus, media.id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, media.pelaku'); 
		$this->db->join('pasal', 'media.pasal_id = pasal.id');

		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0) 
		{
			$users = $query->result();
			return $users;
		}  

		return false;  	    	
	}

	public function get_list_dokumen($id)
	{        
		$this->db->select('*'); 
		//$this->db->join('pasal', 'media.pasal_id = pasal.id');
		//$this->db->where('media.penyidik_id',$id);

		$query = $this->db->get($this->media_detail);
		
		if($query->num_rows() > 0) 
		{
			$users = $query->result();
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
			// $this->db->select('pasal.id, pasal.kasus, media.id, media.kanit_id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, media.pelaku,media.pasal_id ,media_detail.file_name, media.tanggal_kejadian, media.korban, media.tanggal_lapor, media_detail.file_ext'); 
			// $this->db->join('pasal', 'media.pasal_id = pasal.id');
			// $this->db->join('media_detail', 'media_detail.media_id = media.id');
			// $this->db->where('media.id',$id);

			$q = "SELECT * FROM media m ";
			$q.= "LEFT JOIN pasal p ON m.pasal_id = p.id ";
			$q.= "LEFT JOIN media_detail md ON md.media_id = m.id WHERE m.id = ".$id."";

			$res = $this->db->query($q)->row_array();

			// echo "<pre>";
			// var_dump($res);exit();
			// if($query->num_rows() == 1) 
			// {
			// 	$user = $query->row_array();

				return $res;
			// }   

		}

		return false;
	}
	
	public function SaveDokumen($data){
    	$this->db->insert('media',$data);
    }

    public function UpdateDokumen($data,$id){
    	$this->db->where('id',$id);
    	$this->db->update('media',$data);
    }
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */