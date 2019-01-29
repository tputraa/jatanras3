<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Cari extends CI_Controller {
  
  var $view = 'admin/index';
  var $view2 = 'page';
  var $view3 = 'kanit/page';
  var $view4 = 'penyidik/page';
  var $limit;

 
  public function __construct()
  {
    parent::__construct();
    $this->load->model('kanit/dokumen_model');
    $this->load->model('admin/penyidik_model');
    
  }

  public function dokumen()
  { 
    
    $keyword = $this->input->post('keyword', TRUE);
    $opsi = $this->input->post('opsi', TRUE);

    if ($opsi =="2") {
      $sql ="SELECT media.id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, ";
      $sql .=" media.pelaku, media.korban, pasal.kasus FROM media "; 
      $sql .=" INNER JOIN pasal ON media.pasal_id = pasal.id WHERE pasal.kasus LIKE '%$keyword%'";
    }else{
      $sql ="SELECT media.id, media.no_lp, media.nama_pelapor, media.tanggal_kejadian, ";
      $sql .=" media.pelaku, media.korban, pasal.kasus FROM media "; 
      $sql .=" INNER JOIN pasal ON media.pasal_id = pasal.id WHERE media.no_lp LIKE '%$keyword%'";
    }
    

    $data['result'] = $this->db->query($sql)->result();
    
    $data['page'] = 'cari_data';
    if ($this->input->post('page', TRUE)=="2"){
      $this->load->view($this->view2,$data);  
    }else if($this->input->post('page', TRUE)=="3") {
      $this->load->view($this->view3,$data);
    }else if($this->input->post('page', TRUE)=="4") {
      $this->load->view($this->view4,$data);
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
    $this->load->view($this->view,$data);
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