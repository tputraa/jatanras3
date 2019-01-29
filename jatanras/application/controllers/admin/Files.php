<?php
/**
 * Media Manager for Codeigniter
 *
 * @package    CodeIgniter
 * @author     Prashant Pareek
 * @link       http://codecanyon.net/item/media-manager-for-codeigniter/9517058
 * @version    2.3.0
 * http://php.net/manual/en/function.opendir.php
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class Files extends CI_Controller {
	
	var $view = 'admin/index';	

	public function __construct()
	{
		parent::__construct();

		// load recaptcha library
    	$this->load->library('zip');

		if (!$this->session->userdata('admin_loggedin')) 
		{        	
			redirect('admin/dashboard','refresh');
		}  

		// create constant for media controller relative path
		$cn_dir = realpath(FCPATH.'application/controllers');
		$fl_dir = realpath(dirname(__FILE__));
		$path = str_replace($cn_dir,'',$fl_dir);	
		$cn_base = $path.'/files/';		
		define('CN_BASE',$cn_base);

		// app parameters
		$this->load->config('app');
		$media_path = $this->config->item('media_path');
		
		$mm_base = FCPATH.$media_path;

		$mm_base = str_replace(DIRECTORY_SEPARATOR, '/', $mm_base.'/');		

		define('MM_BASE', $mm_base);	

		$this->load->model('mmedia');
		$this->load->model('user_model');
		$this->lang->load('mm','english');
	}

	public function index()
	{				
		
		$path = $this->input->post('path');
		$this->session->set_userdata('path_zip',$path);

		if (!$path)
		{
			$path = $this->uri->segment(4);

			if ($path=='') {
				$path= $path = $this->session->userdata('path');	
			}
			$this->session->set_userdata('user_id',$this->uri->segment(4));
			$this->session->set_userdata('kosong',$this->uri->segment(4));
		}
		else
		{
			if ($path == 'home')
			{
				$path = null;
				$this->session->unset_userdata('path');
			}
			else
			{
				$this->session->set_userdata('path',$path);
			}
		}

		$data['folders'] = $this->mmedia->get_folders_list($path);
		$data['media'] = $this->mmedia->get_media_list($path);

        $data['path'] = $path;
		$data['page'] = 'admin/manager';		

		$this->load->view($this->view, $data);
	}

	public function download_media(){
        
        $media_path = $this->config->item('media_path');
        $mm_base = FCPATH.$media_path;
		$mm_base = str_replace(DIRECTORY_SEPARATOR, '/', $mm_base.'/');	
        
        $source      = $this->input->post('source'); 
        $file_name   = $this->input->post('file_name', true);
        $media_type  = $this->input->post('media_type', true);
        $curPath     = $this->input->post('curPath', true);
        
       
        $baseUser = $mm_base;
        
        $count = count($source);
        $date  = date('d-m-Y_His');
        
        if ( $count > 1 ){
            
            $this->load->library('zip');
            
            $resFile = $date.'.zip';
            
            for($i=0 ; $i < $count; $i++){
               
                
                if ( $media_type[$i] == 'file' ){
                    
                    $file = $baseUser . $source[$i];
                    
                    $this->zip->read_file($file);
                }
                if ( $media_type[$i] == 'folder' ){
                    
                    $dir = $baseUser . $source[$i];
                    
                    $this->zip->read_dir($dir,false);
                }
                
            }
            
            $this->zip->archive('./root/'.$date.'.zip');
            
            $response = (array(
        	    	'zip' => $file_name,
        	    	'file_name' => $resFile,
        	    	'path' => base_url('root/').$resFile
        		));
            
        }else{
            $this->load->library('zip');
            if ($media_type[0] == 'file'){
                
             	$x = str_replace($curPath,"",$file_name[0]);
        
        	    $response = (array(
        	    	'zip' => $file_name,
        	    	'file_name' => $x,
        	    	'path' => base_url('root/').$file_name[0]
        		));
                
            }else{
                $dir = $baseUser . $source[0];
               
                $resFile = $date.'.zip';
                
                $this->zip->read_dir($dir, false);
                $this->zip->archive('./root/'.$date.'.zip');
                
                $response = (array(
        	    	'zip' => $file_name,
        	    	'file_name' => $resFile,
        	    	'path' => base_url('root/').$resFile
        		));
            }
            
        }
        
        echo json_encode($response);
    }       

}

/* End of file Files.php */
/* Location: ./application/controllers/admin/Dashboard.php */
