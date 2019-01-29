<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mberita');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->data['pageTitle'] 	= 'Koarmada - Berita';
		if ($this->level == 2){
			$this->data['berita']		= $this->mberita->getAllDataByUserId($this->user_id);
		}else{
			$this->data['berita']		= $this->mberita->getAllData();
		}
		
        $this->loadViews("Admin/berita", $this->data, null , null);
	}

	public function Add(){
		$data['error']		= '';
		$data['pageTitle']	= 'Koarmada - Tambah Berita';
		$this->loadViews('Admin/berita_add', $data, null, null);
	}

	public function Save(){

		$posted_by = $this->session->userdata('nama_lengkap');

		$this->form_validation->set_error_delimiters('<p class="help-block">', '</p>');
		$this->form_validation->set_rules('judul','Judul','trim|required');	
		$this->form_validation->set_rules('isi','Isi','trim|required');

		if ($this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('error', 'Tambah Data Tidak Berhasil');
			$this->Add();
		}
		else{
	        $config['upload_path'] 		= "assets/images/berita_images/";
	        $config['allowed_types'] 	= "jpg|jpeg|png";
	        $config['overwrite'] 		= true;
        	$config['encrypt_name'] 	= true;

	        $this->load->library('upload');
	        $this->upload->initialize($config);
			if(!$this->upload->do_upload()){
	            $this->data['error'] 		= $this->upload->display_errors();
	            $this->data['pageTitle'] 	= 'Koarmada - Tambah Berita';
				$this->loadViews('Admin/berita_add', $this->data, null, null);
	        }else{
				$cSlug = array(
					'field' => 'judul_slug',
					'table' => 'tbl_berita',
					'id' => 'berita_id'
				);
				$this->load->library('slug', $cSlug);

	            $data = $this->upload->data();

	            $berita = array(
	            	'user_id' => $this->user_id,
	                'judul' => $this->input->post('judul'),
	                'images' => $data['file_name'],
	                'isi' => $this->input->post('isi'),
	                'posted_by' => $posted_by,
	                'judul_slug' => $this->slug->create_uri($this->input->post('judul'),true)
	            );
	            $this->mberita->Saveberita($berita);
	            $this->session->set_flashdata('success', 'Tambah Data Berhasil');
	            redirect('berita');
	        }
	    }
	}

	public function Edit($id){

		$this->data['error'] 		= '';
	    $this->data['pageTitle'] 	= 'Koarmada - Edit Berita';

	    $userId = '';
		if ($this->level == 2){
			$userId = $this->user_id;
		}
		$this->data['berita'] = $this->mberita->SelectIdBerita($id,$userId)->row();
		$this->loadViews('Admin/berita_edit', $this->data, null, null);
		
	}

	public function Update(){

		$userId = '';
		if ($this->level == 2){
			$userId = $this->user_id;
		}
		$berita_id = $this->input->post('berita_id');
		
       	$config['upload_path'] 		= "assets/images/berita_images/";
	    $config['allowed_types'] 	= "jpg|jpeg|png";
	    $config['overwrite'] 		= true;
       	$config['encrypt_name'] 	= true;

	    $this->load->library('upload');
	    $this->upload->initialize($config);

        $cSlug = array(
					'field' => 'judul_slug',
					'table' => 'tbl_berita',
					'id' => 'berita_id'
				);
		$this->load->library('slug', $cSlug);

        if(empty($_FILES['userfile']['name'])){
            $berita = array(
                'judul' => $this->input->post('judul'),
                'isi' => $this->input->post('isi'),
                'judul_slug' => $this->slug->create_uri($this->input->post('judul'),true)
            );
            $this->mberita->Updateberita($berita_id, $berita);
            $this->session->set_flashdata('success', 'Update Data Berhasil');
            redirect('berita');
        }
        elseif(!$this->upload->do_upload()){
            $this->data['berita'] = $this->mberita->SelectIdBerita($berita_id,$userId)->row();
            $this->data['error'] = $this->upload->display_errors();
            $this->loadViews('Admin/berita_edit',$this->data, null, null);
        }
        else{
        	$data = $this->upload->data();
            $query = $this->mberita->SelectIdBerita($berita_id,$userId);
            foreach ($query->result() as $row) {
                unlink('assets/images/berita_images/'.$row->images);
            }

            $berita = array(
                'judul' => $this->input->post('judul'),
                'images' => $data['file_name'],
                'isi' => $this->input->post('isi'),
                'judul_slug' => $this->slug->create_uri($this->input->post('judul'),true)
            );
                $this->mberita->Updateberita($berita_id, $berita);
                $this->session->set_flashdata('success', 'Update Data Berhasil');
                redirect('berita');
        }
	}

	public function Delete($berita_id){
		$query = $this->mberita->SelectIdBerita($berita_id);
        foreach ($query->result() as $row) {
                unlink('assets/images/berita_images/'.$row->images);
        }
		$this->mberita->Deleteberita($berita_id);
		redirect('berita');
		
	}



}

/* End of file Berita.php */
/* Location: ./application/controllers/Berita.php */