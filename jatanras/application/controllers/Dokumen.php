<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dokumen extends CI_Controller {
  
  var $view = 'page';
  var $limit;

  /**
   * Constructor, initializes the libraries and model
   */
  public function __construct()
  {
    parent::__construct();

    if ($this->auth->loggedin())  
    {         
      // redirect user to login page            
      //redirect('user','refresh');
    }  

    // load libraries
    $this->load->model('dokumen_model');
    $this->load->model('admin/penyidik_model');
     
    
  }

  /**
   * Default method of users class
   */
  public function index()
  { 
    
    $data['users'] = $this->dokumen_model->get_list();
    $data['kanit']  = $this->penyidik_model->get_datakanit();
    $data['page'] = 'dokumen';   
    $data['pages'] ='1';
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

    $data = array( 'kanit_id' => $kanit_id);

    $this->db->where('id', $id);
    $result = $this->db->update('media', $data);

    if ($result) {
      redirect('dokumen');
    }

  }


  function save_session(){
    $id = $this->input->post('id_dokumen', TRUE);
    $arraydata = array('id_dokumen' => $id);
    $result = $this->session->set_userdata($arraydata);
    echo json_encode($arraydata);
  }
}