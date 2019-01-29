<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Runningtext extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mrunning');
		$this->load->library('form_validation');
	}

	public function index(){
		$this->data['pageTitle'] 	= 'Koarmada - Running Text';
		$this->data['text']			= $this->mrunning->getAllData();
        $this->loadViews("Admin/runningtext", $this->data, null , null);	
	}

	public function Add(){
		$this->data 				= array('error' => '');
		$this->data['pageTitle'] 	= 'Koarmada - Tambah Running Text';
		$this->loadViews('Admin/runningtext_add', $this->data, null, null);
	}

	public function Save(){

		$this->form_validation->set_error_delimiters('<p class="help-block">', '</p>');
		$this->form_validation->set_rules('judul','Judul','trim|required');	
		$this->form_validation->set_rules('isi','Isi','trim|required');

		if ($this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('error', 'Tambah Data Tidak Berhasil');
			$this->Add();
			
		}
		else{
	            $running = array(
	                'judul' => $this->input->post('judul',true),
	                'isi' => $this->input->post('isi',true)
	            );
	            $this->mrunning->Savetext($running);
	            $this->session->set_flashdata('success', 'Tambah Data Berhasil');
	            redirect('Admin/Runningtext');
	        }
	}

	public function Edit($text_id){
		$this->data 				= array('error' => '');
		$this->data['pageTitle']	= 'Koarmada - Edit Running Text';
		$this->data['text'] 		= $this->mrunning->SelectTextId($text_id);
		$this->loadViews('Admin/runningtext_edit',$this->data, null, null);
	}

	public function Update(){
		$text_id = $this->input->post('text_id');

		$this->form_validation->set_error_delimiters('<p class="help-block">', '</p>');
		$this->form_validation->set_rules('judul','Judul','trim|required');	
		$this->form_validation->set_rules('isi','Isi','trim|required');

		if ($this->form_validation->run() == FALSE ){
			$this->Add();
		}else{
			$running = array(
		        'judul' => $this->input->post('judul', true),
		        'isi' => $this->input->post('isi', true)
	    	);
	        $this->mrunning->UpdateText($text_id, $running);
	        $this->session->set_flashdata('success', 'Update Data Berhasil');
	        redirect('Admin/runningtext');
		}
	}

	public function Delete($text_id){
		$this->mrunning->DeleteText($text_id);
		redirect('Admin/runningtext');
	}

	public function status_submit($text_id,$status){
		$this->mrunning->status_text($text_id,$status);
		redirect('Admin/runningtext');
	}

}