<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mblog');
		$this->load->helper('text');
		$this->load->helper('url');
		$url = '';
		$this->data['singlepost']			= $this->mblog->GetPost($url);
	}

	public function index($start = 0)
	{
		$this->load->library('pagination');
		$this->data['home'] 		= $this->mblog->GetData(3, $start);

		$config['base_url'] 		= base_url().'Blog/';
		$config['total_rows'] 		= $this->mblog->GetCountData();
		$config['per_page'] 		= 3;

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
		$this->data['recentpost'] = $this->mblog->showRecentPost();
		$this->data['pages'] 	= $this->pagination->create_links();
		
		$this->load->view('blog', $this->data);
	}

	public function post(){
		$id = $this->uri->segment(3);
		$url = urldecode($id);

		$this->data['singlepost'] = $this->mblog->GetPost($url);
		$this->data['recentpost'] = $this->mblog->showRecentPost();
		$this->load->view('blog_details',$this->data);
	}

	function Search(){
		
		$word = $this->input->get_post('q');

		$data['recentpost'] = $this->mblog->showRecentPost();
		$data['home'] 		= $this->mblog->Search($word);
		$data['keyword'] 	= $word;
		$this->load->view('search',$data);
	}
	
	public function error(){
		$data['recentpost'] = $this->mblog->showRecentPost();
		$this->load->view('header',$data);
		$this->load->view('notfound',$data);
		$this->load->view('footer');
	}

}

/* End of file Blog.php */
/* Location: ./application/controllers/Blog.php */