<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//header("Cache-Control: no cache");
//session_cache_limiter("private_no_expire");

class Cari extends CI_Controller {
  
  var $view = 'admin/index';
  var $view2 = 'page';
  var $view3 = 'kanit/page';
  var $view4 = 'penyidik/page';
  var $view5 = 'renmin/page';
  var $limit;

 
  public function __construct()
  {
    parent::__construct();
    $this->load->model('kanit/dokumen_model');
    $this->load->model('admin/penyidik_model');
    
  }

  public function dokumen()
  { 
    
    if (empty($this->input->get('keyword', TRUE))) {
      $opsi = $this->session->userdata('opsi');
      $keyword = $this->session->userdata('keyword');
    }else{
      $keyword = $this->input->get('keyword', TRUE);
      $opsi = $this->input->get('opsi', TRUE);
      $page = $this->input->get('page',TRUE);
    }

    $arraydata = array('keyword' => $keyword, 'opsi' => $opsi, 'page' => $page);
    $this->session->set_userdata($arraydata);

    if ($opsi =="1" AND $keyword !="") {
      $data['opsi'] ="No LP";
      $sql ="SELECT media.id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, ";
      $sql .=" media.pelaku, media.korban, pasal.kasus FROM media "; 
      $sql .=" INNER JOIN pasal ON media.pasal_id = pasal.id WHERE media.no_lp LIKE '%$keyword%'";
    }elseif ($opsi=="2" AND $keyword !=""){
      $data['opsi'] ="Kasus";
      $sql ="SELECT media.id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, ";
      $sql .=" media.pelaku, media.korban, pasal.kasus FROM media "; 
      $sql .=" INNER JOIN pasal ON media.pasal_id = pasal.id WHERE pasal.kasus LIKE '%$keyword%'";
    }elseif ($opsi=="3" AND $keyword !=""){
      $data['opsi'] ="Pelapor";
      $sql ="SELECT media.id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, ";
      $sql .=" media.pelaku, media.korban, pasal.kasus FROM media "; 
      $sql .=" INNER JOIN pasal ON media.pasal_id = pasal.id WHERE media.nama_pelapor LIKE '%$keyword%'";
    }elseif ($opsi=="4" AND $keyword !=""){
      $data['opsi'] ="Pelaku";
      $sql ="SELECT media.id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, ";
      $sql .=" media.pelaku, media.korban, pasal.kasus FROM media "; 
      $sql .=" INNER JOIN pasal ON media.pasal_id = pasal.id WHERE media.pelaku LIKE '%$keyword%'";
    }elseif ($opsi=="5" AND $keyword !=""){
      $data['opsi'] ="Korban";
      $sql ="SELECT media.id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, ";
      $sql .=" media.pelaku, media.korban, pasal.kasus FROM media "; 
      $sql .=" INNER JOIN pasal ON media.pasal_id = pasal.id WHERE media.korban LIKE '%$keyword%'";
    }elseif ($opsi=="6" AND $keyword !=""){
      $data['opsi'] ="All Data";
      $sql ="SELECT media.id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, ";
      $sql .=" media.pelaku, media.korban, pasal.kasus FROM media "; 
      $sql .=" INNER JOIN pasal ON media.pasal_id = pasal.id WHERE media.korban LIKE '%$keyword%'";
    }elseif ($keyword==""){
      $data['opsi'] ="All Data";
      $sql ="SELECT media.id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, ";
      $sql .=" media.pelaku, media.korban, pasal.kasus FROM media "; 
      $sql .=" INNER JOIN pasal ON media.pasal_id = pasal.id WHERE media.id='x'";
      
    }
    
    $data['result'] = $this->db->query($sql)->result();
    
    $data['page'] = 'cari_data';

    if ($this->input->get('page', TRUE)=="2"){
      $this->load->view($this->view2,$data);  
    }else if($this->input->get('page', TRUE)=="3") {
      $this->load->view($this->view3,$data);
    }else if($this->input->get('page', TRUE)=="4") {
      $this->load->view($this->view4,$data);
    }else if ($this->input->get('page', TRUE)=="5") {
      $this->load->view($this->view5,$data);
    }else{
      $this->load->view($this->view,$data);
    }
    
  }


  public function details($id = NULL)
  {
    $user_id = $this->session->userdata('kon_id');

    if($id != NULL) 
    {
      $data['item'] = $this->dokumen_model->get_item($id);
    }
    

    $data['dokumen'] = $this->dokumen_model->get_list_dokumen($id);
    $data['page'] = 'detail_dokumen';   

    //echo $this->session->userdata('page');
    //exit();

    if ($this->session->userdata('page')=="2"){
      $this->load->view($this->view2,$data);  
    }else if($this->session->userdata('page')=="3") {
      $this->load->view($this->view3,$data);
    }else if($this->session->userdata('page')=="4") {
      $this->load->view($this->view4,$data);
    }else if ($this->session->userdata('page')=="5") {
      $this->load->view($this->view5,$data);
    }else{
      $this->load->view($this->view,$data);
    }
    //$this->load->view($this->view,$data);
  }

  function delete ($id) {
    $where = array('id'=>$id);

    $result = $this->db->delete('media', $where);
    if ($result) {
      redirect(site_url('penyidik/dokumen'),'refresh');
    }
  }

  function disposisi(){
    $kanit_id = $this->input->post('kanit_id', TRUE);
    $id = $this->input->post('txt_id', TRUE);

    $data = array( 'penyidik_id' => $kanit_id);

    $this->db->where('id', $id);
    $result = $this->db->update('media', $data);

    if ($result) {
      redirect('kanit/dokumen');
    }

  }

  function save_session(){
    $id = $this->input->post('id_dokumen', TRUE);
    $arraydata = array('id_dokumen' => $id);
    $result = $this->session->set_userdata($arraydata);
    echo json_encode($arraydata);
  }
}