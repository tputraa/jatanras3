<?php
/**
 * Media Manager for Codeigniter
 *
 * @package    CodeIgniter
 * @author     Prashant Pareek
 * @link       http://codecanyon.net/item/media-manager-for-codeigniter/9517058
 * @version    2.3.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Media Class
 */
class Media extends MY_Controller { 
  /**
   * Constructor, initializes the libraries and model
   */
  public function __construct()
  {
    parent::__construct();

    if($this->usertype != 1){
        redirect('user');
    } 
  }

  /**
   * Default method of users class
   */
  public function index()
  { 
    $this->load->model('media_model');

    $this->load->config('app');

    $data['page'] = 'admin/media';
    $this->load->view('admin/index',$data);
  }

  /**
   * Save user settings
   */
  public function save_params()
  {   
    $params = $this->input->post(); 
    $path = realpath(APPPATH.'config/app.php');
    $default_path = realpath(APPPATH.'config/default-app.php');

    // restore default settings
    if(isset($params['restore'])) 
    {               
      $content = file_get_contents($default_path);
      
      if($handle = fopen($path, 'w')) 
      {
        if(fwrite($handle, $content)) 
        {
          $message = 'Default settings restored successfully.';
          $type = 'success';
        } 
        else 
        {
          $message = 'Could not save default settings.';
          $type = 'error';
        }

        fclose($handle);
      } 
      else 
      {
        $message = 'Error encountered while saving default settings.';
        $type = 'warning';
      }
    } 
    else 
    {
      // remove extra slashes from media path
      $media_path = explode('/',$params['media_path']);     
      $media_path = array_filter($media_path);      
      $media_path = array_diff($media_path, array('.','..'));     
      $media_path = implode('/',$media_path);
      
      $dir = realpath(FCPATH).DIRECTORY_SEPARATOR.$media_path;      

      // Check if path exists
      if(!is_dir($dir)) 
      {
        mkdir($dir, 0777, TRUE);
      }

      $params['media_path'] = $media_path;
      
      // Check if other fields left empty     
      $fields = array('allowed_types','max_size','max_width','max_height','media_path','max_filename','max_files');
        
      $this->load->config('default-app');     

      // Set default value
      foreach($fields as $key)
      {       
        if(!$params[$key])
        {
          $params[$key] = $this->config->item($key);
        }         
      }
      
      $params['overwrite'] = isset($params['overwrite']) ? 1 : 0;
      $params['remove_spaces'] = isset($params['remove_spaces']) ? 1 : 0;
      $params['encrypt_name'] = isset($params['encrypt_name']) ? 1 : 0;
      
      $content = file_get_contents($path);

      // edit config key values
      $content = $this->editConfigContent($params, $content, 'allowed_types', TRUE);
      $content = $this->editConfigContent($params, $content, 'max_size');     
      $content = $this->editConfigContent($params, $content, 'max_width');
      $content = $this->editConfigContent($params, $content, 'max_height');
      $content = $this->editConfigContent($params, $content, 'media_path', TRUE);
      $content = $this->editConfigContent($params, $content, 'max_filename');
      $content = $this->editConfigContent($params, $content, 'max_files');
      $content = $this->editConfigContent($params, $content, 'overwrite');
      $content = $this->editConfigContent($params, $content, 'remove_spaces');
      $content = $this->editConfigContent($params, $content, 'encrypt_name');   
      
      if($handle = fopen($path, 'w')) 
      {
        if(fwrite($handle, $content)) 
        {
          $message = 'Media manager settings saved successfully.';
          $type = 'success';
        } 
        else 
        {
          $message = 'Could not save media manager settings.';
          $type = 'error';
        }

        fclose($handle);
      } 
      else 
      {
        $message = 'Error encountered while saving media manager settings.';
        $type = 'warning';
      }
    }

    $this->base->set_message($message, $type);

    $this->index();
  }

  /**
   * Method to edit configuration settings with keys and values
   *
   * $params  array    script parameters 
   * $content string   script config file content
   * $key     string   parameter key to set
   * $str     boolean  TRUE if config value a string, FALSE if numeric
   */
  public function editConfigContent($params, $content, $key, $str = FALSE)
  {
    $pattern = '/\n\$config\[\'OPTION\'\] = .*/'; 
    $replace = "\n".'$config[\'OPTION\'] = ';

    $p = str_replace('OPTION', $key, $pattern);
    $r = str_replace('OPTION', $key, $replace);

    if ($str) 
    {
      $r .= "'".$params[$key]."';";
    } 
    else 
    {
      $r .= $params[$key].';';
    }     

    return preg_replace($p, $r, $content);    
  }   
}

/* End of file Media.php */
/* Location: ./application/controllers/admin/Media.php */
