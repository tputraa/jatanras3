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
 * Media model class
 */
class Media_model extends CI_Model {	

	var $img_width = '200';

	// database table name
  var $table = 'media';

	/**
	 * Method to get array contaning folder map
	 * in media directory
	 */
	public function get_folder_tree()
	{		
		$media_map = $this->dir_map_sort(directory_map(MM_BASE));		

		// get array of folder
		$folder_map = $this->get_folder_map($media_map);

		if (isset($folder_map['children']))
		{			
			return $folder_map['children'];	
		}			
		
		return NULL;		
	}

	/**
	 * Sorts the return of directory_map() alphabetically
	 * directories listed before files	 
	 */
	function dir_map_sort($array)
	{
    $dirs = array();
    $files = array();

    foreach ($array as $key => $val)
    {
      if (is_array($val)) // if is dir
      {
        // run dir array through function to sort subdirs and files
        // unless it's empty
        $dirs[$key] = (!empty($array)) ? $this->dir_map_sort($val) : $val;
      }
      else
      {
        $files[$key] = $val;
      }
    }

    // sort by key (dir name)
    uksort($dirs, function($a, $b) {
    	return strnatcasecmp($a, $b);
    });

    asort($files); // sort by value (file name)

    // put the sorted arrays back together
    // swap $dirs and $files if you'd rather have files listed first
    return array_merge($dirs, $files); 
	}

	/**
	 * Recursive method to folder array map of supplied
	 * media files and folder array
	 *
	 * @param  array  $media_arr  array containing media files and folder map
	 * @param  string  $path   contains path of upper level folder map
	 * @return  array  $tree  processed folder map	 
	 */ 
	public function get_folder_map($media_arr, $path = null)
	{		
		$tree = array();
		
		// add path of folder to array element
		if ($path)
		{	
			$tree['path'] = $path; 
			$path .= '/';
		}

		// loop through media array
		foreach ($media_arr as $key => $value)
		{	
			if (is_array($value))
			{	
				// remove backslash from folder key
				$key = substr($key,0,-1);				

				// thumb folder is used by script to store thumbnail images				
				if ($key !== 'thumb') 
				{
					// append sub folders under children array element
					// and call function recursively					
					$tree['children'][$key] = $this->get_folder_map($value,$path.$key);
				}					
			}			
		}		
		
		return $tree;
	}

	/**
	 * Method to get folders list 
	 *
	 * @param  string  $path  media directory path
	 */
	public function get_folders_list($path = NULL)
	{
		if ($path)
		{
      $path .= '/';
    }               

    // media directory path
    $basepath = MM_BASE.$path;

    // get media files and folder map array
    $media = $this->dir_map_sort(directory_map(realpath($basepath)));          

    // initialize variables
    $data = array();
    $count = 0;

    if(!empty($media))
    {
      // loop through media files and folders
      foreach($media as $key => $value)
      {                         
      	// if folders
        if(is_array($value)) 
        {
          // remove backslash from folder key
          $key = substr($key,0,-1);

          // if not thumb folder
          if($key !== 'thumb') 
          {                    	
            $data[$count] = array(
	              'name' => $key,                           
	              'path' => $path.$key
	            ); 

            $count++;
          }                   
        }
      }
    }

    return $data;
	}	

	/**
   * Method to get folders and media files list 
   *
   * @param  string  $path  media directory path
   */
	public function get_media_list($path = NULL)
	{	
		if ($path)
		{	
			$path .= '/';
		}				
		
    $mediapath = '/'.$path;

    // media directory path
		$basepath = MM_BASE.$path;

		// params
		$this->load->config('app');
		$media_path = $this->config->item('media_path');

		$data = array();

		// logged-in user's ID
		$user_id = $this->session->userdata('auth_user');

		// query to fetch media files    
		$this->db->where('user_id', $user_id);
    $this->db->where('file_path', $mediapath);
    $this->db->order_by('raw_name', 'ASC');
		$query = $this->db->get($this->table); 		
		
		// if media exists
		if($query->num_rows()) 
		{
			// get media files
			$media = $query->result();
			
			// loop through media files
			foreach($media as $md) 
			{	
				// get real path of each file						
				$file_path = realpath($basepath.$md->file_name);				
				
				// check if file exists
				if(file_exists($file_path))
				{
					if($md->is_image) 
					{
						$img_url = $anchor_url = $media_path.'/'.$user_id.'/'.$path.$md->file_name;						
						
						// get image size in ratio of global variables $img_width * $img_width
						if (($md->image_width > $this->img_width) || ($md->image_height > $this->img_width))
						{
							$dimensions = $this->image_resize($md->image_width, $md->image_height, $this->img_width);
							$width_x = $dimensions[0];
							$height_x = $dimensions[1];
			
							$url = $media_path.'/'.$user_id.'/'.$path.'thumb/'.$md->file_name;

							if(file_exists(realpath($url))) 
							{
								$img_url = $url;											
							}
						}
						else 
						{
							$width_x = $md->image_width;
							$height_x = $md->image_height;									
						}	

						// get image size in ratio of 16 * 16
						if (($md->image_width > 16) || ($md->image_height > 16))
						{
							$dimensions = $this->image_resize($md->image_width, $md->image_height, 16);
							$width_16 = $dimensions[0];
							$height_16 = $dimensions[1];
						}
						else 
						{
							$width_16 = $md->image_width;
							$height_16 = $md->image_height;
						}						

						$data['files'][] = array(
								'name'		   =>  $md->file_name,			
								'raw_name'   =>  $md->raw_name,
								'type'		   =>  'image',
								'is_image'   =>  true,
								'path' 		   =>  $path.$md->file_name, // relative path of image
								'url'	 	     =>  $img_url, // image url
								'anchor_url' =>  $anchor_url,
								'size' 		   =>  $this->format_bytes($md->file_size), // file size
								'width' 	   =>  $md->image_width, 
								'height' 	   =>  $md->image_height,
								'width_x'  	 =>  $width_x,
								'height_x'   =>  $height_x,
								'width_16' 	 =>  $width_16,
								'height_16'  =>  $height_16
							);
					}
					else
					{
						// get file type
						$tmp = explode('/',$md->file_type);
						$file_type = $tmp[0];

						$tmp = explode('.', $md->file_ext); 						                   
            $file_ext = strtolower(end($tmp));

						// icon image files for file format other than images
						$icon_file = realpath(FCPATH.'assets/icons/mime-icon-16/'.$file_ext.'.png');

						if(!is_file($icon_file))
						{	
							// if html file							
							if(($file_ext == 'html') || ($file_ext == 'htm'))
							{
								$file_ext = 'page';
							} 
							else 
							{ 	// default icon image file, if not exists for file extension
								$file_ext = 'blank';
							}
						}

						$data['files'][] = array(
								'name'		    =>  $md->file_name,			
								'raw_name'    =>  $md->raw_name,
								'type'		  	=>  $file_type,
								'is_image'    =>  false,
								'path'		  	=>  $path.$md->file_name,									
								'url'	  	  	=>	$media_path.'/'.$user_id.'/'.$path.$md->file_name,
								'icon_url-16' =>	'assets/icons/mime-icon-16/'.$file_ext.'.png',
								'icon_url-32' =>	'assets/icons/mime-icon-32/'.$file_ext.'.png',
								'size' 		  	=> 	$this->format_bytes($md->file_size) // file size
							);
					}
				}
			}
		}
		
		return $data;
	}

	/**
	 * Get file sizes in GB, MB, KB ant bytes
	 *
	 * @param  int  $bytes  file size in bytes
	 * @return  int  $bytes  file size in GB, MB, ..
	 */
	public function format_bytes($kbs)
  {
  	$bytes = $kbs * 1024;

  	// get file size
    if ($bytes >= 1073741824){
      $size = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
      $size = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
      $size = $kbs . ' KB';
    } elseif ($bytes > 1) {
      $size = $bytes . ' Bytes';
    } elseif ($bytes == 1) {
      $size = $bytes . ' Byte';
    } else {
      $size = '0 Bytes';
    }

    return $size;
	}

	/**
	 * Method to upload media files
	 *
	 * @param  array  $files  containing files object list
	 */
	public function upload_files($files)
	{		
		$basepath = MM_BASE;

		if ($this->session->userdata('path'))
		{
			$basepath .= '/'.$this->session->userdata('path').'/'; 
		}
		
		// get media manager settings
		$this->load->config('app');		

		// get upload configration	
		$config = array(
				'upload_path' 	=> realpath($basepath),
				'allowed_types' => str_replace(',', '|', $this->config->item('allowed_types')),
				'overwrite' 		=> (boolean) $this->config->item('overwrite'),
				'max_size'			=> 500000,//$this->config->item('max_size') * 500000,
				'max_width'  		=> $this->config->item('max_width'),
				'max_height'  	=> $this->config->item('max_height'),
				'max_filename'  => $this->config->item('max_filename'),
				'encrypt_name'  => (boolean) $this->config->item('encrypt_name'),
				'remove_spaces' => (boolean) $this->config->item('remove_spaces')
			);

		// make configuration compatible to different browsers/devices
		$config = $this->cross_browser_hacks($config);
		
		// load upload library
		$this->load->library('upload');
		$this->upload->initialize($config);

		$errors = array();
		$count = 0;

		// upload files one by one
		foreach ($files['name'] as $k => $v) 
		{
			// check if file size is not zero
			if ($files['size'][$k]) 
			{
				$_FILES['filedata'] = array(
						'name'			=> strip_tags($v),
						'type'			=> $files['type'][$k],
						'tmp_name'	=> $files['tmp_name'][$k],
						'error' 		=> $files['error'][$k],
						'size' 			=> $files['size'][$k]
					);
				
				if ($this->upload->do_upload('filedata'))
				{
					// get uploaded file data
					$upload_data = $this->upload->data();
					
					// store file details in database
					$this->save_file_details($upload_data, $this->config->item('overwrite'));

					// create thumbs for larger uploaded images				
					$return = $this->create_thumb($upload_data);

					$count++;
				}
				else
				{					
					$errors[] = $this->upload->display_errors('<span><strong>'.$v.':</strong> ','</span>');
				}
			}
			else
			{
				$errors[] = '<strong>'.$v.':</strong> file size set to 0.';
			}
		}

		// if files uploading using dropzone
		$dz = (int) $this->input->post('dz');

		if($dz) 
		{
			// append total uploaded file count to session	
			$upload_count = (int) $this->session->userdata('upload_count');
			$count += $upload_count;					
		}

		if ($count)
		{
			$this->session->set_userdata('upload_count',$count);			
		}		
		
		$upload_errors = (array) $this->session->userdata('upload_errors');
		$errors = array_merge($upload_errors, $errors);
		$errors = array_filter($errors);
		
		// set error message
		if ($errors)
		{
			$this->session->set_userdata('upload_errors',$errors);
		}

		return TRUE;		
	}

	/**
	 * Method to set configuration for files to upload
	 * in case files uploaded from some special devices 
	 * or broswers, like safari of IOS.
	 *
	 * Broswer data is sent from client.js to this function
	 *
	 * @param  array  $config  configuration set for upload library
	 * @return  array  $config  modified configuration
	 */
	public function cross_browser_hacks($config)
	{
		// device data
		$client = $this->input->post('client');

		// convert json data to array
		$client = json_decode($client,TRUE);

		// operating system
		$os = $client['os'];						
		
		// operating system version		
		$tmp = explode('.',$client['osVersion']);
		$osVersion = $tmp[0];

		// web browser
		$browser = $client['browser'];						
		$tmp = explode('.',$client['browserVersion']);

		// browser version
		$browserVersion = $tmp[0];

		// is device a mobile
		$mobile = $client['mobile'];
		
		// if files uploaded from iphone mobile using safari browser
		if(($os == 'iOS') && ($browser == 'Safari') && ($mobile == 1))
		{				
			// possible bug of codeigniter
			$config['overwrite'] = 0;

			// a bug in iphone safari set all upload image name to image.jpg, 
			// so it is necessary to encrypt uploaded file name
			$config['encrypt_name'] = 1;
		}
		
		return $config;
	}

	/**
	 * Method to store uploaded file details in db
	 *
	 * @param  array  $data  upload file data
	 */
	public function save_file_details($upload_data, $overwrite)
	{
		$user_id = $this->session->userdata('auth_user');

		$path = str_replace(MM_BASE, '/', $upload_data['file_path']);

		if ($overwrite) {
			$this->db->where('user_id', $user_id);			
			$this->db->where('file_name',$upload_data['file_name']);
			$this->db->where('file_path',$path);
			$this->db->delete($this->table);			
		}

		// get max id specific to user id
		$this->db->select_max('id');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get($this->table);
		$row = $query->row();
		$id = (int) $row->id + 1;

		$data = array(
			'id'						=> $id,
			'user_id' 			=> $user_id,
			'raw_name' 			=> $upload_data['raw_name'],
			'file_name' 		=> $upload_data['file_name'],
			'file_type' 		=> $upload_data['file_type'],
			'file_path' 		=> $path,
			'file_ext'			=> $upload_data['file_ext'],
			'file_size'		 	=> $upload_data['file_size'],
			'is_image'			=> $upload_data['is_image'],
			'image_width'		=> $upload_data['image_width'],
			'image_height'	=> $upload_data['image_height'],
			'image_type'		=> $upload_data['image_type']
		);

		$result = $this->db->insert($this->table, $data);

		return $result;
	}

	/**
	 * Method to create thumbnail for large images
	 * 	 
	 * @param  array  $data  details of upload file
	 */
	public function create_thumb($data) 
	{		
		// if uploaded file is a image
		if ($data['is_image']) 
		{	
			if (($data['image_width'] > $this->img_width) || ($data['image_height'] > $this->img_width)) 
			{
				// get image sizes for supplied ratio
				$dimensions = $this->image_resize($data['image_width'], $data['image_height'], $this->img_width);
				$width_x = $dimensions[0];
				$height_x = $dimensions[1];

				$thumb_path = $data['file_path'].'thumb';

				// create thumb folder if not exists
				if (!is_dir($thumb_path)) 
				{
		    	mkdir($thumb_path, 0777, TRUE);
				}
								
				// Get configration
				$config = array(
						'source_image'		=> $data['full_path'],
						'new_image'		 		=> $thumb_path.'/'.$data['file_name'],			
						'maintain_ratio' 	=> TRUE,
						'width' 		 			=> $width_x,
						'height' 		 			=> $height_x
					);

				// load image library
				$this->load->library('image_lib');
				$this->image_lib->initialize($config); 				

				// create and save thumb of image
				if (!$this->image_lib->resize()) {					
					$return = $this->image_lib->display_errors('<p><strong>'.$data['orig_name'].': </strong>', '</p>');					
					return $return;
				}
			}
		}

		return TRUE;
	}	

	/**
	 * Get image dimensions with specified size ratio 
	 *
	 * @param  int  $width  width of image
	 * @param  int  $height  height of image
	 * @param  int  $size  size ratio to get image dimensions
	 *
	 * @return  array  containing width and height of image according to supplied ratio
	 */
	public function image_resize($width, $height, $size) 
	{		
		// if width is greater than height
		if ($width > $height) 
		{
			$percentage = ($size / $width);
		} 
		else 
		{
			$percentage = ($size / $height);
		}
		
		// get round of image width and height
		$width  = round($width * $percentage);
		$height = round($height * $percentage);

		return array($width, $height);
	}


	public function get_data($id) {
		$sql ="SELECT
				media.id,
				media.user_id,
				media.raw_name,
				media.file_name,
				media.file_type,
				media.file_path,
				media.file_size,
				users.`name`
				FROM
				media
				INNER JOIN users ON media.user_id = users.id
				WHERE media.user_id='".$id."'";

		$data = $this->db->query($sql)->result();
		return $data;

	}	
}