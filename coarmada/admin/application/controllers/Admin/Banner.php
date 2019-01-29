<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mbanner');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->data['pageTitle'] 	= 'Koarmada - Image Slider';
		$this->data['image']		= $this->mbanner->getAllData();
        $this->loadViews("Admin/banner", $this->data, null , null);
	}

	public function Add(){
		$this->data 				= array('error' => '');
		$this->data['pageTitle'] 	= 'Koarmada - Tambah Image Slider';
		$this->loadViews('Admin/banner_add', $this->data, null, null);
	}

	public function Save(){

		$config['upload_path'] 		= "assets/images/banner";
        $config['allowed_types'] 	= "jpg|jpeg|png";
        $config['overwrite'] 		= true;
        $config['encrypt_name'] 	= true;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if(!$this->upload->do_upload()){
            $this->data['error'] = $this->upload->display_errors();
            $this->session->set_flashdata('error', 'Tambah Data Tidak Berhasil');
            $this->loadViews('Admin/banner_add',$this->data, null, null);
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
                'image' 		=> $data['file_name'],
                'image_thumb' 	=> $thumb_namanya
            );
            $this->mbanner->Saveimage($images);
            $this->session->set_flashdata('success', 'Tambah Data Berhasil');
            redirect('Admin/Banner');
        }
	}

	public function Edit($banner_id){
		$this->data 				= array('error' => '');
		$this->data['pageTitle']	= 'Koarmada - Edit Image Slider';
		$this->data['image'] 		= $this->mbanner->SelectimgId($banner_id)->row();
		$this->loadViews('Admin/banner_edit',$this->data, null, null);
	}

	public function Update(){
		
		$banner_id = $this->input->post('banner_id');
		//var_dump($banner_id);exit();
		$config['upload_path'] 		= "assets/images/banner";
        $config['allowed_types'] 	= "jpg|jpeg|png";
        $config['overwrite'] 		= true;
        $config['encrypt_name'] 	= true;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if(!$this->upload->do_upload()){
            $this->data['error'] = $this->upload->display_errors();
            $this->loadViews('Admin/banner_add',$this->data, null, null);
        }
        else{

            $data 	= $this->upload->data();

            $query = $this->mbanner->SelectimgId($banner_id);

            foreach ($query->result() as $row) {
                unlink('./assets/images/banner/'.$row->image);
                unlink('./assets/images/banner/thumb/'.$row->image_thumb);
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
                'image' 		=> $data['file_name'],
                'image_thumb' 	=> $thumb_namanya
            );

            $this->mbanner->Updateimage($banner_id, $images);
            $this->session->set_flashdata('success', 'Update Data Berhasil');
            redirect('Admin/Banner');
        }
	}

	public function Delete($banner_id){

		$query = $this->mbanner->SelectimgId($banner_id);
        foreach ($query->result() as $row) {
                unlink('./assets/images/banner/'.$row->image);
                unlink('./assets/images/banner/thumb/'.$row->image_thumb);
            }
        $this->mbanner->DeleteBanner($banner_id);
		redirect('Admin/Banner');
		
	}

}

/* End of file Banner.php */
/* Location: ./application/controllers/Banner.php */