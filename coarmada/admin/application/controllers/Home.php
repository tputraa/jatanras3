<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('mbanner','mrunning','mblog','mprofile','mgaleri'));
		$this->load->helper('text');
		$url = '';
		$data['singlepost'] 		= $this->mblog->GetPost($url);
	}

	public function index()
	{	
		$data['running']	= $this->mrunning->getAllData();
		$data['images'] 	= $this->mbanner->getAllData();
		
		$this->load->view('index',$data);
	}

	public function profilekoarmada(){
		$data['profiles'] 	= $this->mprofile->selectIdProfil()->result();
		$this->load->view('profile',$data);
	}

	public function galeri($start = 0){
		$this->load->library('pagination');

		$this->data['images'] 		= $this->mgaleri->GetData(12, $start);

		$config['base_url'] 		= base_url().'galeri/';
		$config['total_rows'] 		= $this->mgaleri->GetCountData();
		$config['per_page'] 		= 12;

		    $config['full_tag_open'] = '<ul class="pagination justify-content-center">';        
			$config['full_tag_close'] = '</ul>';  
			$config['attributes'] = array('class' => 'page-link');   
			$config['first_link'] = 'First';        
			$config['last_link'] = 'Last';   
			$config['first_tag_open'] = '<li>';        
			$config['first_tag_close'] = '</li>';        
			$config['prev_link'] = '&laquo';        
			$config['prev_tag_open'] = '<li class="prev">';        
			$config['prev_tag_close'] = '</li>';        
			$config['next_link'] = '&raquo';        
			$config['next_tag_open'] = '<li>';        
			$config['next_tag_close'] = '</li>';        
			$config['last_tag_open'] = '<li>';        
			$config['last_tag_close'] = '</li>';        
			$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';        
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';        
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$this->data['pages'] 	= $this->pagination->create_links();
		$this->load->view('header',$this->data);
		$this->load->view('galeri',$this->data);	
		$this->load->view('footer');	
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */