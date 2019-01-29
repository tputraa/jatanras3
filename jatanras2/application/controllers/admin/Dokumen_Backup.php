<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dokumen extends MY_Controller {
  
  var $view = 'admin/index';
  var $limit;

  /**
   * Constructor, initializes the libraries and model
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->helper(array('url','file'));

    if($this->usertype != 1){
      redirect('user');
    } 

    // load libraries
    $this->load->model('admin/dokumen_model');
    $this->load->model('admin/mdokumen');
    $this->load->library('pagination');   
    $this->load->library('pdf');
    $this->limit = $this->session->userdata('dokumen.filter.limit'); 
  }

  /**
   * Default method of users class
   */
  public function index()
  { 
    // pagination configuration         
    $config = array();
    $config['base_url'] = base_url() . 'admin/dokumen/index';
    $config['total_rows'] = $this->dokumen_model->record_count();
    $config['per_page'] = $this->limit ? $this->limit : 10;
    $config['uri_segment'] = 4;
    $config['attributes'] = array('class' => 'page-link');        

    $this->pagination->initialize($config);

    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

    // set details to load on page
    $data['users'] = $this->dokumen_model->get_list($config['per_page'], $page);

    
    $data['pagination'] = $this->pagination->create_links();
    $data['enteries'] = 'Showing '.($page + 1).' to '.($page + count($data['users'])).' of '.$config['total_rows'].' entries'; 


    $data['page'] = 'admin/dokumen';   
    $data['pages'] ='1';
    $this->load->view($this->view,$data);
  }


  /**
   * Method to set query filters in session
   */
  public function get_results()
  {
    $data = $this->input->post();
    $this->session->set_userdata('dokumen.filter.limit', (int) $data['limit']);
    $this->session->set_userdata('dokumen.filter.search', (string) $data['search']);
    
    redirect(site_url('admin/dokumen'),'refresh');
  }


  /**
   * Method to load edit page for user details, load
   * user details if user ID is supplied
   *
   * @param  int  $id  user ID
   */

  public function add(){

    $sql ="SELECT * FROM pasal";
    $result = $this->db->query($sql)->result();
    $data['pasal'] = $result;


    $q="SELECT dokumen.id, dokumen.dokumen, photo.raw_name FROM photo right JOIN dokumen ON photo.dokumen_id = dokumen.id ORDER BY dokumen.id";

    $hasil = $this->db->query($q)->result();
    $data['surat'] = $hasil;

    $data['page'] = 'admin/add_dokumen';    
    $this->load->view($this->view,$data);
  }

public function getSurat(){
   $data = "";

    $q="SELECT dokumen.id, dokumen.dokumen, photo.raw_name FROM photo right JOIN dokumen ON photo.dokumen_id = dokumen.id ORDER BY dokumen.id";
    $hasil = $this->db->query($q)->result();
    
    $nomor=1;

    foreach ($hasil as $row) {
      if ($row->raw_name !=""){
        $status ='<i class="fa fa-check" aria-hidden="true" style="color:green;"></i>'; 
      }else{
        $status ='<i class="fa fa-close" aria-hidden="true" style="color:red;"></i>'; 
      }

      $tombol = '<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="add_person('."'".$row->id."'".')"> Upload</a><a class="btn btn-sm btn-danger" href="#">Hapus</a>';

      $data .= "<tr><td>$nomor</td><td>$row->dokumen</td><td>$status</td><td>$tombol</td></tr>"; 

      $nomor++;
    }

      echo $data;
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

    $data['page'] = 'admin/edit_dokumen';    
 
    $this->load->view($this->view,$data);
  }

  public function edit_details2($id = NULL)
  {
    // get details
    if($id != NULL) 
    {
      $data['item'] = $this->dokumen_model->get_item($id);
    }
    
    $data['page'] = 'admin/edit_dokumen';    
    $this->load->view($this->view,$data);
  }


public function upload() {

        $user_id = $this->session->userdata('admin_user_id');
        $media_id = $this->input->post('media_id', TRUE);
        $keterangan = $this->input->post('keterangan', TRUE);
        $token = $this->input->post('token', TRUE);

        $path  = './assets/uploads/';
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

            $imageExt = $data['file_ext'];
            $this->mdokumen->setURL($imagename);            
            $hasil = $this->mdokumen->create($media_id, $user_id, $imageExt, $token);
            echo json_encode(array("status" => TRUE));
        }            
    }   


  // action save method
    public function save() {

      $nolp             = $this->input->post('nolp',TRUE);
      $pelapor          = $this->input->post('pelapor',TRUE);
      $tanggal_kejadian = $this->input->post('tanggal_kejadian', TRUE);
      $jam_kejadian = $this->input->post('jam_kejadian', TRUE);
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
        /*
        if (!$this->upload->do_upload()) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('admin/dokumen/add');
        }
        else {

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
            $this->dokumen_model->SaveDokumen($data);
            $this->session->set_flashdata('success', 'Dokumen Berhasil Ditambah');
            redirect('admin/dokumen');
        }
        */  

        $data = array(
              //'raw_name' => $data['file_name'],
              //'file_name' => $data['file_name'],
              'no_lp'=> $nolp,
              'nama_pelapor'=> $pelapor,
              'tanggal_kejadian'=>$tanggal_kejadian,
              'jam'=>$jam_kejadian,
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
        redirect('admin/dokumen');

        /*
        id
media_id
user_id
raw_name
file_name
file_ext
keterangan
created_date

        */

    }   

    public function update() {

      $nolp             = $this->input->post('nolp',TRUE);
      $pelapor          = $this->input->post('pelapor',TRUE);
      $tanggal_kejadian = $this->input->post('tanggal_kejadian', TRUE);
      $jam_kejadian = $this->input->post('jam_kejadian', TRUE);
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
              'jam' => $jam_kejadian,
              'pelaku' => $pelaku,
              'korban'=> $korban,
              'pasal_id' => $kasus,
              'tanggal_lapor'=>$tanggal_lapor,
            );
            $this->dokumen_model->UpdateDokumen($data,$media_id);
            $this->session->set_flashdata('success', 'Dokumen Berhasil Diupdate');
            redirect('admin/dokumen');
        }
        elseif(!$this->upload->do_upload()){
            $data['item'] = $this->dokumen_model->SelectIdMedia($media_id);
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
             redirect('admin/dokumen/edit_details',$data);
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
            redirect('admin/dokumen');
        }            
    }   
/*
    $data = array(
      'id'            => $id,
      'user_id'       => $user_id,
      'raw_name'      => $upload_data['raw_name'],
      'file_name'     => $upload_data['file_name'],
      'file_type'     => $upload_data['file_type'],
      'file_path'     => $path,
      'file_ext'      => $upload_data['file_ext'],
      'file_size'     => $upload_data['file_size'],
      'is_image'      => $upload_data['is_image'],
      'image_width'   => $upload_data['image_width'],
      'image_height'  => $upload_data['image_height'],
      'image_type'    => $upload_data['image_type']
    ); 

  /**
   * Method to save user details or create new user
   */
  public function save_details()
  {   

    // user id
    $user_id = $this->input->post('id');    

    $this->load->library('form_validation');  

    // set bootstrap error delimiter for registration form
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');    

    $this->form_validation->set_rules('nrp', 'NRP', 'trim|required|strip_tags|min_length[3]|max_length[15]');

    // set validation rules for signup form fields
    $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required|strip_tags|min_length[3]|max_length[100]');

    $this->form_validation->set_rules('telpon', 'Nomor Telpon', 'trim|required|strip_tags|min_length[11]|max_length[15]');

    // different rules for new and old user
    if(!$user_id) 
    {
      
      $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required|strip_tags|min_length[3]|max_length[100]');
      /*
      $this->form_validation->set_rules('email', 'Email Address', 'trim|required|strip_tags|valid_email|is_unique[users.email]');
      $this->form_validation->set_rules('username', 'Username', 'trim|required|strip_tags|callback_check_username|min_length[8]|max_length[32]|is_unique[users.username]');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|strip_tags|min_length[8]|max_length[32]');
      $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|strip_tags|matches[password]');
      */
    } 
    else 
    {
      $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required|strip_tags|min_length[3]|max_length[100]');
      /*
      $this->form_validation->set_rules('email', 'Email Address', 'trim|required|strip_tags|valid_email|callback_is_unique_email');
      $this->form_validation->set_rules('username', 'Username', 'trim|required|strip_tags|callback_check_username|min_length[8]|max_length[32]|callback_is_unique_username');
      $this->form_validation->set_rules('password', 'Password', 'trim|strip_tags|min_length[8]|max_length[32]');
      $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|strip_tags|matches[password]');
      */
    } 
    
    // other rules
    /*
    $this->form_validation->set_rules('month', 'Month', 'trim|strip_tags');
    $this->form_validation->set_rules('day', 'Day', 'trim|strip_tags');
    $this->form_validation->set_rules('year', 'Year', 'trim|strip_tags');
    $this->form_validation->set_rules('gender', 'Gender', 'trim|strip_tags');
    $this->form_validation->set_rules('mobile_no', 'Mobile no', 'trim|strip_tags');
    $this->form_validation->set_rules('location', 'Location', 'trim|strip_tags');         
    */
    // set custom error message for unique field
    $this->form_validation->set_message('is_unique', 'The %s is already in use.');  

    // set default page load data         
    $data['page'] = 'admin/edit_dokumen';      

    // if form validation fails load edit user form 
    if($this->form_validation->run() == FALSE)
    {           
      $this->load->view($this->view,$data);
      return false;     
    }   

    if(!$user_id) // new user
    { 

      /* Membuat Folder di Folder Cabang */
      $resutl = $this->db->query("SELECT * FROM users ORDER BY id DESC LIMIT 1")->row();
      $user_id = ($resutl->id)+1;
      
      $region   = trim($this->input->post('location'));
      $username   = trim($this->input->post('username'));

      $this->load->config('app');
      $media_path = $this->config->item('media_path');
      
      // create constant for user media base directory
      $mm_base = FCPATH.$media_path.'/'.$region.'/'.$username.$user_id;
      $mm_base = str_replace(DIRECTORY_SEPARATOR, '/', $mm_base.'/');     
      define('MM_BASE', $mm_base);  

      // create folder to save user media
      if (!is_dir($mm_base)) {
          if(!mkdir($mm_base, 0755, TRUE)){
            exit('Could not create user media directory.');                 
          }
      } 
      
      
      $result = $this->dokumen_model->register();

      // check result of registering new user
      switch($result)
      {
        case 0: // could not save user details into database
                $msg = 'An error occured while creating account, try again later.';
                $type = 'danger';
                break;
            
        case 1: // account is created and activation email is sent to user

                $msg = 'Successfully created the account. An email is sent to user containing login details.';
                $type = 'success';          
                break;
            
        case 2: // account is created, but could not send activation email
                
          
                $msg = 'Successfully created the account. System could not initiate email.';
                $type = 'danger';         
                break;                    
            
        default: break;           
      }
    } 
    else 
    {
      // update user details
      $result = $this->dokumen_model->update_details();

      switch($result)
      {
        case 0: // could not update user details
                $msg = 'Could not update user details.';
                $type = 'danger';
                break;

        case 1: // user details updated
                $msg = 'User details updated successfully.';
                $type = 'success';
                break;

        default: break;
      }
    }   
    
    // set notification message
    $this->base->set_message($msg,$type);             
    //exit();

    redirect(site_url('admin/dokumen'),'refresh');

    return true;
  }

  /**
   * Validate username 
   *
   * @param  string  $username  username supplied by user in registration form
   * @return  boolean  TRUE if username validated, FALSE either
   */
  public function check_username($username)
  {
    // check if username started with alphabet
    if(!preg_match('/^[A-Za-z]+/', $username))
    {
      $this->form_validation->set_message('check_username', '%s should start with alphabet');
      return false;
    }
    // check if username contains valid characters
    elseif(!preg_match('/^[A-Za-z0-9_.-]+$/', $username))
    {     
      $this->form_validation->set_message('check_username', 'Only alphanumeric characters, underscores (_), dashes(-) and periods(.) are allowed');
      return false;
    }

    return true;  
  }

  /** 
   * Method to check if supplied email not is use
   * by other user
   *
   * @param  string  $email  email address to check
   */
  public function is_unique_email($email)
  {   
    // run query
    $this->db->where('id != ',$this->input->post('id'));
    $this->db->where('email',$email);
    $query = $this->db->get('users');

    if($query->num_rows() > 0) 
    {
      $this->form_validation->set_message('is_unique_email', '%s is already in use.');
      return false;
    }

    return true;          
  }

  /**
   * Check if username not in use by other user
   *
   * @param  string  $username  username to check
   */
  public function is_unique_username($username)
  {   
    // run query
    $this->db->where('id != ',$this->input->post('id'));
    $this->db->where('username',$username);
    $query = $this->db->get('users');

    if($query->num_rows() > 0) 
    {
      $this->form_validation->set_message('is_unique_username', '%s is already in use.');
      return false;
    }

    return true;          
  }

  public function buat_folder(){
    $resutl = $this->db->query("SELECT * FROM users ORDER BY id DESC LIMIT 1")->row();
    $user_id = ($resutl->id)+1;
      
    $this->load->config('app');
    $media_path = $this->config->item('media_path');
    
    // create constant for user media base directory
    //$user_id = $this->session->userdata('auth_user');
    $mm_base = FCPATH.$media_path.'/'.$user_id;
    $mm_base = str_replace(DIRECTORY_SEPARATOR, '/', $mm_base.'/');     
    define('MM_BASE', $mm_base);  

    // create folder to save user media
    if (!is_dir($mm_base)) {
        if(!mkdir($mm_base, 0755, TRUE)){
          exit('Could not create user media directory.');                 
        }
    } 

  }

  function delete ($id) {
    $where = array('id'=>$id);

    $result = $this->db->delete('media', $where);
    if ($result) {
      redirect(site_url('admin/dokumen'),'refresh');
    }

  }


  //Untuk proses upload foto
  function proses_upload(){

     $path = './assets/uploads/';
        // Define file rules
        $this->load->library('upload');
        
        $initialize = $this->upload->initialize(array(
            "upload_path" => $path,
            "allowed_types" => "gif|jpg|jpeg|png|bmp|pdf|txt|doc|docx|xls|xlsx",
            "remove_spaces" => TRUE,
            "encrypt_name" => FALSE
        ));

        if (!$this->upload->do_upload()) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            //redirect('admin/dokumen/add');
        }else {
          $user_id = $this->session->userdata('admin_user_id',$id);
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
  }


  //Untuk menghapus foto
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

  function hasil(){
    $id = $this->input->post('id');
    $this->load->view('renmin/hasil',$id);
  }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */
