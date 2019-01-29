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
 * class pages
 */
class Pages extends CI_Controller {

	/**
	 * Default method
	 */
	function index($page)
	{	
		$data['page'] = $page;
				
		$this->load->view('index',$data);

		return true;
	}
}

/* End of file Pages.php */
/* Location: ./application/controllers/Pages.php */