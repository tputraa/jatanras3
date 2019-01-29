<?php
/**
 * JATANRAS DOKUMEN
 * Eka Riana
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Mdokumen extends CI_Model {

  var $table = 'media';
  var $dokumen = 'dokumen';
  var $media_detail = 'media_detail';


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
    
  public function create($media_id, $user_id, $file_ext, $token) { 
    $data = array(
      'raw_name' => $this->_url,
      'file_name' => $this->_url,
      'user_id' => $user_id,
      'file_ext' => $file_ext,
      'token' =>$token,
      'dokumen_id'=>$media_id
    );

    $this->db->insert('photo', $data);
    return $this->db->insert_id();
  }

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */