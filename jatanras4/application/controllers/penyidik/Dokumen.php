<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dokumen extends MY_Controller {
  
  var $view = 'penyidik/page';
  var $limit;

  /**
   * Constructor, initializes the libraries and model
   */
  public function __construct()
  {
    parent::__construct();

    if($this->usertype != 4){
      redirect('user');
    } 

    // load libraries
    $this->load->model('penyidik/dokumen_model');
    
     
    
  }

  public function index()
  { 
    
    //$user_id = $this->session->userdata('kon_id');
    $user_id = $this->session->userdata('admin_user_id');
    $data['users'] = $this->dokumen_model->get_list($user_id);
    //$data['surat'] = $this->dokumen_model->get_surat($user_id);
    $data['page'] = 'penyidik/dokumen';   
    
    $this->load->view($this->view,$data);
  }

  public function details($id = NULL)
  {
    $user_id = $this->session->userdata('kon_id');

    if($id != NULL) 
    {
      //$data['item'] = $this->dokumen_model->get_item($id);
      $data['surat'] = $this->dokumen_model->get_surat();
    }
    
    //$data['dokumen'] = $this->dokumen_model->get_list_dokumen($user_id);
   // $data['surat'] = $this->dokumen_model->get_surat();

    //var_dump($data);
    //exit();
    $data['page'] = 'penyidik/view';   
    $this->load->view($this->view,$data);
  }

    public function upload() {

        $user_id = $this->session->userdata('kon_id');
        $media_id = $this->input->post('media_id', TRUE);
        $keterangan = $this->input->post('keterangan', TRUE);

        $path = './assets/uploads/';
        $initialize = $this->upload->initialize(array(
            "upload_path" => $path,
            "allowed_types" => "gif|jpg|jpeg|png|bmp|pdf|txt|doc|docx|xls|xlsx",
            "remove_spaces" => TRUE
        ));
        $imagename = 'no-img.jpg';
        if (!$this->upload->do_upload('Fichier1')) {
            $error = array('error' => $this->upload->display_errors());
            echo $this->upload->display_errors();
        } else {
            $data = $this->upload->data();
            $imagename = $data['file_name'];
            $this->dokumen_model->setURL($imagename);            
            $this->dokumen_model->create($media_id, $user_id, $keterangan);                           
            redirect(site_url('penyidik/dokumen'),'refresh');
        }            
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