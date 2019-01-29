<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Galeri extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mgaleri');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->data['pageTitle'] 	= 'Koarmada - Galeri';
		$this->data['image']		= $this->mgaleri->getAllData();
        $this->loadViews("Admin/galeri", $this->data, null , null);
	}

	public function Add(){
		$this->data 				= array('error' => '');
		$this->data['pageTitle'] 	= 'Koarmada - Tambah Foto';
		$this->loadViews('Admin/galeri_add', $this->data, null, null);
	}

	public function Save(){

		$config['upload_path'] 		= "assets/images/galeri";
        $config['allowed_types'] 	= "jpg|jpeg|png";
        $config['overwrite'] 		= true;
        $config['encrypt_name'] 	= true;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if(!$this->upload->do_upload()){
            $this->data['error'] = $this->upload->display_errors();
            $this->session->set_flashdata('error', 'Tambah Data Tidak Berhasil');
            $this->loadViews('Admin/galeri_add',$this->data, null, null);
        }
        else{
            
            $data 	= $this->upload->data();

            $file   = $config['upload_path']."/".$data['file_name'];
                        
	        $resize = $this->load->helper('image_lib');
	          
	        $resize 	= new Image_lib($file);
	        $avatar   	= $config['upload_path']."/".$data['file_name'];
	                        
	        $thumb_namanya 		= "thumb_".$data['file_name'];
	        $newpath1        	= $config['upload_path']."/thumb/".$thumb_namanya;
	        $resize 			= new Image_lib($file);
	      
	        $resize->resizeTo(300, 300, 'exact');
	        $resize->saveImage($newpath1);

            $images = array(
            	'judul'			=> $this->input->post('judul'),
                'image' 		=> $data['file_name'],
                'image_thumb' 	=> $thumb_namanya
            );
            $this->mgaleri->Saveimage($images);
            $this->session->set_flashdata('success', 'Tambah Data Berhasil');
            redirect('menugaleri');
        }
	}

	public function Edit($banner_id){
		$this->data 				= array('error' => '');
		$this->data['pageTitle']	= 'Koarmada - Edit Foto';
		$this->data['image'] 		= $this->mgaleri->SelectimgId($banner_id)->row();
		$this->loadViews('Admin/galeri_edit',$this->data, null, null);
	}

	public function Update(){
		
		$foto_id = $this->input->post('foto_id');
		//var_dump($banner_id);exit();
		$config['upload_path'] 		= "assets/images/galeri";
        $config['allowed_types'] 	= "jpg|jpeg|png";
        $config['overwrite'] 		= true;
        $config['encrypt_name'] 	= true;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if(empty($_FILES['userfile']['name'])){
            $images = array(
                'judul' => $this->input->post('judul')
            );
            $this->mgaleri->Updateimage($foto_id, $images);
            $this->session->set_flashdata('success', 'Update Data Berhasil');
            redirect('menugaleri');
        }
        elseif(!$this->upload->do_upload()){
            $this->data['error'] = $this->upload->display_errors();
            $this->loadViews('Admin/galeri_add',$this->data, null, null);
        }
        else{

            $data 	= $this->upload->data();

            $query = $this->mgaleri->SelectimgId($foto_id);

            foreach ($query->result() as $row) {
                unlink('./assets/images/galeri/'.$row->image);
                unlink('./assets/images/galeri/thumb/'.$row->image_thumb);
            }

            $file   = $config['upload_path']."/".$data['file_name'];

                        
	        $resize = $this->load->helper('image_lib');
	          
	        $resize 	= new Image_lib($file);
	        $avatar   	= $config['upload_path']."/".$data['file_name'];
	                        
	        $thumb_namanya 		= "thumb_".$data['file_name'];
	        $newpath1        	= $config['upload_path']."/thumb/".$thumb_namanya;
	        $resize 			= new Image_lib($file);
	      
	        $resize->resizeTo(300, 300, 'exact');
	        $resize->saveImage($newpath1);

            $images = array(
            	'judul'			=> $this->input->post('judul'),
                'image' 		=> $data['file_name'],
                'image_thumb' 	=> $thumb_namanya
            );

            $this->mgaleri->Updateimage($foto_id, $images);
            $this->session->set_flashdata('success', 'Update Data Berhasil');
            redirect('menugaleri');
        }
	}

	public function Delete($foto_id){

		$query = $this->mgaleri->SelectimgId($foto_id);
        foreach ($query->result() as $row) {
                unlink('./assets/images/galeri/'.$row->image);
                unlink('./assets/images/galeri/thumb/'.$row->image_thumb);
            }
        $this->mgaleri->DeleteFoto($foto_id);
		redirect('menugaleri');
		
	}

}

/* End of file Banner.php */
/* Location: ./application/controllers/Banner.php */