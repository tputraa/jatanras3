<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dokumen extends MY_Controller {
  
  var $view = 'kanit/page';
  var $limit;

  /**
   * Constructor, initializes the libraries and model
   */
  public function __construct()
  {
    parent::__construct();

    if($this->usertype != 3){
      redirect('user');
    }  

    // load libraries
    $this->load->model('kanit/dokumen_model');
    $this->load->model('admin/penyidik_model');
     
    
  }

  public function index()
  { 
    
    //$user_id = $this->session->userdata('kon_id');
    $user_id = $this->session->userdata('admin_user_id');

    $data['users'] = $this->dokumen_model->get_list($user_id);

    $data['kanit']  = $this->penyidik_model->get_datapenyidik();
    $data['page'] = 'kanit/dokumen';   
    
    $this->load->view($this->view,$data);
  }

  function delete ($id) {
    $where = array('id'=>$id);

    $result = $this->db->delete('media', $where);
    if ($result) {
      redirect(site_url('admin/dokumen'),'refresh');
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


  public function edit_details($id = NULL)
  {
    
    if($id != NULL) 
    {
      $data['item'] = $this->dokumen_model->get_item($id);
    }
    
    $data['dokumen'] = $this->dokumen_model->get_list_dokumen($id);
    $data['page'] = 'kanit/view';   
    $this->load->view($this->view,$data);
  }
}