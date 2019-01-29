<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dokumen extends MY_Controller {
  
  var $view = 'page';
  var $limit;

  /**
   * Constructor, initializes the libraries and model
   */
  public function __construct()
  {
    parent::__construct();

    if($this->usertype != 2){
      redirect('user');
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

  public function hasil(){
    $id = $this->input->post('id');
    $this->load->view('hasil',$id);
  }

  public function edit_details($id = NULL)
  {
    // get details
    if($id != NULL) 
    {
      $data['item'] = $this->dokumen_model->get_item($id);
    }
    else{
      $data['item'] = null;
    }

    $sql ="SELECT * FROM pasal";
    $result = $this->db->query($sql)->result();
    $data['pasal'] = $result;

    $data['page'] = 'edit_dokumen';    
 
    $this->load->view($this->view,$data);
  }

  function delete ($id) {
    $where = array('id'=>$id);

    $result = $this->db->delete('media', $where);
    if ($result) {
      redirect(site_url('dokumen'),'refresh');
    }
  }

  function disposisi(){
    $kanit_id = $this->input->post('kanit_id', TRUE);
    $id = $this->input->post('txt_id', TRUE);

    $data = array( 'kanit_id' => $kanit_id, 'is_status'=> '1');

    $this->db->where('id', $id);
    $result = $this->db->update('media', $data);

    if ($result) {
      redirect('dokumen');
    }
  }

  public function save() {

      $nolp             = $this->input->post('nolp',TRUE);
      $pelapor          = $this->input->post('pelapor',TRUE);
      $tanggal_kejadian = $this->input->post('tanggal_kejadian', TRUE);
      $pelaku           = $this->input->post('pelaku',TRUE);
      $korban           = $this->input->post('korban',TRUE);
      $kasus            = $this->input->post('kasus',TRUE);
      $tanggal_lapor    = $this->input->post('tanggal_lapor',TRUE);

      
        $path = './assets/uploads/';
        // Define file rules
        $this->load->library('upload');
        
        $initialize = $this->upload->initialize(array(
            "upload_path" => $path,
            "allowed_types" => "gif|jpg|jpeg|png|bmp|pdf|txt|doc|docx|xls|xlsx",
            "remove_spaces" => TRUE
        ));
        $imagename = 'no-img.jpg';

        $data = array(
              //'raw_name' => $data['file_name'],
              //'file_name' => $data['file_name'],
              'no_lp'=> $nolp,
              'nama_pelapor'=> $pelapor,
              'tanggal_kejadian'=>$tanggal_kejadian,
              'pelaku' => $pelaku,
              'korban'=> $korban,
              'pasal_id' => $kasus,
              'tanggal_lapor'=>$tanggal_lapor,
              //'file_ext' => $imageExt
              'user_id'=> $this->session->userdata('admin_user_id'),
            );
        $this->dokumen_model->SaveDokumen($data);

        $last_id = $this->db->insert_id();

        $sql ="SELECT * FROM photo";
        $result = $this->db->query($sql)->result();

        foreach ($result as $rows) {

            $data = array(
              'raw_name' => $rows->raw_name, 
              'file_name' => $rows->file_name, 
              'media_id'=> $nolp,
              'user_id'=> $this->session->userdata('admin_user_id'),
              'file_ext' => $rows->file_ext,
              'media_id' => $last_id
            );

            $this->db->insert('media_detail', $data);

            //$this->dokumen_model->SaveDokumen($data);
        }
        
        $sql ="TRUNCATE photo";
        $result = $this->db->query($sql);

        $this->session->set_flashdata('success', 'Dokumen Berhasil Ditambah');
        redirect('dokumen');


    }

  public function update() {

      $nolp             = $this->input->post('nolp',TRUE);
      $pelapor          = $this->input->post('pelapor',TRUE);
      $tanggal_kejadian = $this->input->post('tanggal_kejadian', TRUE);
      $pelaku           = $this->input->post('pelaku',TRUE);
      $korban           = $this->input->post('korban',TRUE);
      $kasus            = $this->input->post('kasus',TRUE);
      $tanggal_lapor    = $this->input->post('tanggal_lapor',TRUE);
      $media_id         = $this->input->post('id',TRUE);

      
      $sql ="SELECT * FROM photo";
            $result = $this->db->query($sql)->result();

            foreach ($result as $rows) {
                $data = array(
                  'raw_name' => $rows->raw_name, 
                  'file_name' => $rows->file_name, 
                  'media_id'=> $nolp,
                  'user_id'=> $this->session->userdata('admin_user_id'),
                  'file_ext' => $rows->file_ext,
                  'media_id' => $media_id
                );

                $this->db->insert('media_detail', $data);
            }
            
            $sql ="TRUNCATE photo";
            $result = $this->db->query($sql);

        $path = './assets/uploads/';
        $this->load->library('upload');
        
        $initialize = $this->upload->initialize(array(
            "upload_path" => $path,
            "allowed_types" => "gif|jpg|jpeg|png|bmp|pdf|txt|doc|docx|xls|xlsx",
            "remove_spaces" => TRUE
        ));
        $imagename = 'no-img.jpg';

        if(empty($_FILES['userfile']['name'])){
            $data = array(
              'no_lp'=> $nolp,
              'nama_pelapor'=> $pelapor,
              'tanggal_kejadian'=>$tanggal_kejadian,
              'pelaku' => $pelaku,
              'korban'=> $korban,
              'pasal_id' => $kasus,
              'tanggal_lapor'=>$tanggal_lapor,
            );
            $this->dokumen_model->UpdateDokumen($data,$media_id);
            $this->session->set_flashdata('success', 'Dokumen Berhasil Diupdate');
            redirect('dokumen');
        }
        elseif(!$this->upload->do_upload()){
            $data['item'] = $this->dokumen_model->SelectIdMedia($media_id);
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
             redirect('dokumen/edit_details',$data);
        }
        else{

            $data = $this->upload->data();

            $imageExt = $data['file_ext'];
            $imagename = $data['file_name'];
            
            $data = array(
              'raw_name' => $data['file_name'],
              'file_name' => $data['file_name'],
              'no_lp'=> $nolp,
              'nama_pelapor'=> $pelapor,
              'tanggal_kejadian'=>$tanggal_kejadian,
              'pelaku' => $pelaku,
              'korban'=> $korban,
              'pasal_id' => $kasus,
              'tanggal_lapor'=>$tanggal_lapor,
              'file_ext' => $imageExt
            );
            $this->dokumen_model->UpdateDokumen($data,$media_id);
            $this->session->set_flashdata('success', 'Dokumen Berhasil Diupdate');
            redirect('dokumen');
        }            
    }


  function save_session(){
    $id = $this->input->post('id_dokumen', TRUE);
    $arraydata = array('id_dokumen' => $id);
    $result = $this->session->set_userdata($arraydata);
    echo json_encode($arraydata);
  }

   function proses_upload(){

     $path = './assets/uploads/';
        // Define file rules
        $this->load->library('upload');
        
        $initialize = $this->upload->initialize(array(
            "upload_path" => $path,
            "allowed_types" => "gif|jpg|jpeg|png|bmp|pdf|txt|doc|docx|xls|xlsx",
            "remove_spaces" => TRUE,
            "encrypt_name" => TRUE
        ));

        if (!$this->upload->do_upload()) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            //redirect('admin/dokumen/add');
        }else {
          $user_id = $this->session->userdata('admin_user_id');
          $token=$this->input->post('token_foto');
          $nama=$this->upload->data('file_name');
          $data = $this->upload->data();

          $imageExt = $data['file_ext'];
          $imagename = $data['file_name'];
            
          $dataarr = array(
              'raw_name' => $data['file_name'],
              'file_name' => $data['file_name'],
              'file_ext' => $imageExt,
              'nama_photo'=> $nama,
              'token'=> $token,
              'user_id'=>$user_id
          );

          $this->db->insert('photo',$dataarr);
        }

        exit();

    //echo FCPATH.'/assets/uploads/';
    //$path = './assets/uploads/';
    //$this->load->library('upload');
    /*
    $config = array(
            'upload_path'  => '/assets/uploads/',
            'allowed_types'=> 'gif|jpg|png',
            'encrypt_name' => TRUE // Optional, you can add more options as need
        );
  */

//echo dirname($_SERVER["SCRIPT_FILENAME"])."/files/";

    $config =  array(
                  'upload_path'     => './assets/uploads/',
                  'upload_url'      => base_url()."files/",
                  'allowed_types'   => "gif|jpg|png|jpeg|pdf|doc|xml",
                  'overwrite'       => TRUE,
                  //'max_size'        => "1000KB",
                  //'max_height'      => "768",
                  //'max_width'       => "1024"   
                );

        $this->load->library('upload', $config);

        //$config['upload_path']   = $path;
        //$config['allowed_types'] = 'gif|jpg|png|ico';
        //$this->load->library('upload',$config);

        //$this->upload->do_upload('file');
        if($this->upload->do_upload('userfile'))
{
    echo "file upload success";

    $data = $this->upload->data();

            $imageExt = $data['file_ext'];
            $imagename = $data['file_name'];

            $data = array(
              'raw_name' => $data['file_name'],
              'file_name' => $data['file_name'],
              'no_lp'=> $nolp,
              'nama_pelapor'=> $pelapor,
              'tanggal_kejadian'=>$tanggal_kejadian,
              'pelaku' => $pelaku,
              'korban'=> $korban,
              'pasal_id' => $kasus,
              'tanggal_lapor'=>$tanggal_lapor,
              'file_ext' => $imageExt
            );

}
else
{
   //echo "file upload failed";
  echo $this->upload->display_errors();
}
/*
        if($this->upload->do_upload('userfile')){
          $token=$this->input->post('token_foto');
          $nama=$this->upload->data('file_name');
          $this->db->insert('photo',array('nama_photo'=>$nama,'token'=>$token));
        }else{
          echo "ERROR";
        }
*/

  }

    function remove_foto(){

    //Ambil token foto
    $token=$this->input->post('token');
    $foto=$this->db->get_where('photo',array('token'=>$token));

    if($foto->num_rows()>0){
      $hasil=$foto->row();
      $nama_foto=$hasil->nama_photo;
      if(file_exists($file=FCPATH.'/assets/uploads/'.$nama_foto)){
        unlink($file);
      }
      $this->db->delete('photo',array('token'=>$token));

    }


    echo "{}";
  }

  function remove_media(){

    //Ambil token foto
    $token=$this->input->post('token');
    $foto=$this->db->get_where('media_detail',array('id'=>$token));
    
    if($foto->num_rows()>0){
      $hasil=$foto->row();
      $nama_foto=$hasil->file_name;
      if(file_exists($file=FCPATH.'/assets/uploads/'.$nama_foto)){
        unlink($file);
      }
      $this->db->delete('media_detail',array('id'=>$token));

    }


    echo "{}";
  }
}