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
 * Class base
 */
class Base {

	private $ci;

	/**
	 * constructor
	 */
	public function __construct() 
	{
		$this->ci = &get_instance();
		
		// load session library
		$this->ci->load->library('session');               
	}

	/** 
	 * Method to set notification message in session	 
	 *
	 * @param  string  $message  message to show
	 * @param  string  $type  type of message: success, warning, info, error
	 */
	public function set_message($message, $type)
	{	
		// get previously set messages
		$messages = $this->ci->session->userdata('messages');		

		// push current message in list
		$messages[] = array(
				'message' => $message,
				'type'	  => $type
			);

		// set message into session
		$this->ci->session->set_userdata('messages', $messages);		
	}

	/**
   * Method to match password stored in db to received password
   *
   * @param  string  $db_password  stored db password
   * @param  string  $password  received user password
   *
   * @return  boolean  TRUE if password matches FALSE either
   */
	public function match_password($db_password,$password)
	{
		/**
		 * split password from database into two parts 
		 * first part will be user password itself
		 * and second part will be hash key
		 */
		$hashparts = preg_split('/:/',$db_password);

		// create hash of supplied password with saved password hash key
		$passhash = md5($password.$hashparts[1]);

		// if both password hash matches
		if($passhash == $hashparts[0]) 
		{
			return TRUE;
		} 
		else 
		{
			return FALSE;
		}
	}	

	/**
	 * Method to encrypt password into md5 hash
	 *
	 * @param  string  $password  raw password string
	 *
	 * @return  string  $password  processed password string
	 */ 
	public function encrypt_password($password)
	{
		// Get random string
		$salt = $this->get_random_string();

		// Create password hash
		$hash = md5($password.$salt);

		// Attach hash key with password
		$password = $hash.':'.$salt; 

		return $password;
	}

	/**
	 * Method to get random string of supplied length
	 *
	 * @param  int  $length  length of string with random characters to be generated
	 *
	 * @return  string  $random_string  string containing random characters
	 */
	public function get_random_string($length = 32)
	{
		// valid characters lowercase alphabet (a-z), uppercase alphabet (A-Z), numbers (0-9)
		$valid_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$random_string = '';

		// length of valid characters
		$num_valid_chars = strlen($valid_chars); 		
			
		for ($i = 0; $i < $length; $i++)
		{			
			// pick a random number
			$random_pick = mt_rand(1, $num_valid_chars); 	

			// pick a random character
			$random_char = $valid_chars[$random_pick-1];
	
			$random_string .= $random_char;
		}

		return $random_string;
	}

	/**
	 * Method to send email
	 *
	 * @param  string  $to  email address to whom send email
	 * @param  string  $subject  subject of email
	 * @param  string  $message  message or body of email to send
	 *
	 * @return  boolean  TRUE if email sent, FALSE either
	 */
	public function send_email($to,$subject,$message)
	{	
		// set email configuration	
		$config = array(
		    'protocol'      => 'sendmail', 
		    'mailpath'	    => '/usr/sbin/sendmail',		        
		    'charset'       => 'utf-8',      
		    'mailtype' 	    => 'html',
		    'wordwrap'      => TRUE
			);
		
		// load email library
		$this->ci->load->library('email');		
		$this->ci->email->initialize($config);

		// load site config
		$this->ci->load->config('site');		
		$admin_email = $this->ci->config->item('admin_email');
		$site_name = $this->ci->config->item('site_name');		

		// email settings and append data
		$this->ci->email->from($admin_email, $site_name);
		$this->ci->email->to($to); 
		$this->ci->email->subject($subject); 
		$this->ci->email->message($message); 

		if($this->ci->email->send())
		{
			return TRUE;	
		}
		else
		{
			//show_error($this->ci->email->print_debugger());
			return FALSE;
		}
	}
}