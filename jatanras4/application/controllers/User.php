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
 * User Class
 */
class User extends CI_Controller {
  
  /**
   * Constructor, initializes the libraries and model
   https://mbahcoding.com/tutorial/php/codeigniter/codeigniter-ajax-crud-modal-server-side-validation.html
   https://pascaldhika.blogspot.com/2017/11/cara-membuat-create-read-update-delete.html
   http://nisn.data.kemdikbud.go.id/page/data
   */
  public function __construct()
  {
    parent::__construct();               

    // load recaptcha library
    $this->load->library('recaptcha');

    // load form validation library
    $this->load->library('form_validation');

    // load user model 
    $this->load->model('user_model');

    $this->lang->load('mm','english');
  }

  /**
   * Default method of user class, redirect to media class if user is logged in,
   * else display login-registration page.
   */
  public function index()
  {           
    // check if user logged in (note: auth library is auto loaded)
    if ($this->auth->loggedin()) {          
      if ($this->session->userdata('region')=="2"){
        redirect('frontpage','refresh');
      }else if($this->session->userdata('region')=="3"){
        redirect('kanit/frontpage','refresh');
      }else if($this->session->userdata('region')=="4"){
        redirect('penyidik/frontpage','refresh');
      }else if($this->session->userdata('region')=="5"){
        redirect('renmin/frontpage','refresh');
      }else{
        redirect('admin/frontpage','refresh');
      }
    }
    else
    {    
      $this->load->view('user/login_new');     
    }
  }

  /**
   * Method to validate and allow user to login
   */
  function validate_credentials()
  {         

    // set validation rules for username and password fields
    $this->form_validation->set_rules('username', lang('mm_sign_ph_username'), 'trim|required');
    $this->form_validation->set_rules('password', lang('mm_sign_ph_password'), 'trim|required');
    
    // if form validation fails load login page   
    if ($this->form_validation->run() == FALSE)
    {       
      $this->index();
      return false;
    }
    
    // validate user    
    $result = $this->user_model->validate();
    
    switch($result)
    {       
      case 0: // Username or password field do not match                
              $this->base->set_message(lang('mm_msg_login_1'), 'danger');
              break;
          
      case 1: // User's credentials are validated                                   
              break;      
          
      case 2: // User's account is not activated yet.                 
              $this->base->set_message(lang('mm_msg_login_2'), 'warning');
              break;
      default: 
              break;  
    } 

    $this->index();

    return true;
  }

  /**
   * Method to logout user
   */
  function logout()
  {   
    $this->auth->logout();
    $this->session->sess_destroy();
    $this->session->set_userdata(array('admin_loggedin' => FALSE, 'auth_user_id' => FALSE));
    redirect(site_url("user"));
  }

  /**
   * Method to register user
   */
  public function register()
  {
    // set default page load data         
    $data['page'] = 'user/login';
    $data['form'] = 'registration';

    // set bootstrap error delimiter for registration form
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');    

    // set validation rules for signup form fields
    $this->form_validation->set_rules('name', lang('mm_rgtr_ph_name'), 'trim|required|strip_tags|min_length[3]|max_length[100]');
    $this->form_validation->set_rules('email', lang('mm_rgtr_ph_email'), 'trim|required|strip_tags|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('username', lang('mm_rgtr_ph_username'), 'trim|required|strip_tags|callback_check_username|min_length[8]|max_length[32]|is_unique[users.username]');
    $this->form_validation->set_rules('password', lang('mm_rgtr_ph_password'), 'trim|required|strip_tags|min_length[8]|max_length[32]');
    $this->form_validation->set_rules('confirm_password', lang('mm_rgtr_tl_cnf_password'), 'trim|required|strip_tags|matches[password]');
    $this->form_validation->set_rules('month', lang('mm_rgtr_lb_month'), 'trim|strip_tags');
    $this->form_validation->set_rules('day', lang('mm_rgtr_lb_day'), 'trim|strip_tags');
    $this->form_validation->set_rules('year', lang('mm_rgtr_lb_year'), 'trim|strip_tags');
    $this->form_validation->set_rules('gender', lang('mm_rgtr_lb_gender'), 'trim|strip_tags');
    $this->form_validation->set_rules('mobile_no', lang('mm_rgtr_lb_mobile'), 'trim|strip_tags');
    $this->form_validation->set_rules('location', lang('mm_rgtr_lb_location'), 'trim|strip_tags');
    $this->form_validation->set_rules('accept_terms', '', 'callback_accept_terms');

    // check if site and secret key of recaptcha service exists
    $this->load->config('recaptcha');
    $site_key = $this->config->item('recaptcha_site_key');
    $secret_key = $this->config->item('recaptcha_secret_key');

    // if both keys exists validate recaptcha response
    if(($site_key) && ($secret_key)) 
    {
      $this->form_validation->set_rules('g-recaptcha-response', 'ReCaptcha Reponse', 'callback_verify_recaptcha');
    }   

    // set custom error message for unique field
    $this->form_validation->set_message('is_unique', lang('mm_msg_rgtr_1'));        

    // if form validation fails load signup form  
    if($this->form_validation->run() == FALSE)
    {           
      $this->load->view('index',$data);
      return false;     
    }

    // register new user
    $result = $this->user_model->register();

    // check result of operation
    switch($result)
    {
      case 0: // could not save user details into database
              $msg = 'An error occured while creating account, try again later.';
              $type = 'danger';           
              break;
          
      case 1: // account is created and activation email is sent to user
              $msg = 'Congratulations, you have successfully created your account. An activation email is sent to your email address.';
              $type = 'success';
              $data['form'] = 'login';
              break;
          
      case 2: // account is created, but could not send activation email
              $msg = 'You have successfully created your account. System could not initiate activation email.';
              $type = 'danger';
              $data['form'] = 'login';
              break;                    
          
      default:
              break;            
    }
    
    // set notification message
    $this->base->set_message($msg,$type);     
        
    redirect(site_url().'/user', 'refresh');

    return true;
  }

  /**
   * Validate username 
   *
   * @param  string  $username  username supplied by user in registration form
   * @return  boolean  TRUE if username validated, FALSE either
   */
  public function check_username($username)
  {
    // check if username started with alphabet
    if(!preg_match('/^[A-Za-z]+/', $username))
    {
      $this->form_validation->set_message('check_username', '%s should start with alphabet');
      return false;
    }
    // check if username contains valid characters
    elseif(!preg_match('/^[A-Za-z0-9_.-]+$/', $username))
    {     
      $this->form_validation->set_message('check_username', 'Only alphanumeric characters, underscores (_), dashes(-) and periods(.) are allowed');
      return false;
    }

    return true;  
  }

  /**
   * Check if user accepted the terms by clicking on checkbox 
   *
   * @param  int  $accept_terms  accept terms checkbox value
   * @return  boolean  TRUE if username validated, FALSE either
   */
  public function accept_terms($accept_terms)
  { 
    if(!$accept_terms)
    {
      $this->form_validation->set_message('accept_terms', 'Please confirm that you agree to the Terms of Service and Privacy Policy.');
      return false;
    }

    return true;
  }

  /**
   * Method to verify if user solved recaptcha successfully 
   *
   * @param  string  $response  response code received from reCAPTCHA google service
   * @return  boolean  TRUE if username validated, FALSE either
   */
  public function verify_recaptcha($response) 
  {         
    // if no response received 
    if(empty($response))
    {
      $this->form_validation->set_message('verify_recaptcha', 'Please confirm that you are not a robot.');
      return false;       
    }
    else 
    {
      // check if response code verified
      $result = $this->recaptcha->verifyResponse($response);
            
      if(!$result['success'])
      {                           
        $this->form_validation->set_message('verify_recaptcha', 'Verifying reCAPTCHA is unsuccessful. Error: '.$result['error-codes']);
        return false;       
      }
    } 

    return true;
  }   

  /**
   * Method to activate user account. This method is invoked
   * by the activation link sent to user email address on registration.
   *
   * @param  string  $key  activation key received from activation link
   */
  function activate($key)
  {
    // activate account
    $result = $this->user_model->activate_account($key);
    
    switch($result)
    {
      case 0: // If activation key not matched with any account
              $msg = 'No account is related with this activation key, either your account is already activated or key is expired !!!';  
              $type = "danger";
              break;
          
      case 1: // Account activated
              $msg = 'Congratulations, your account is activated now. Login here';
              $type = "success";          
              break;
          
      case 2: // Activation key expired
              $msg = 'Activation key expired, create new account.';
              $type = "warning";
              break;                
          
      default:
              break;
      
    }

    // set notification message to show on page
    $this->base->set_message($msg, $type);      
    
    $this->index();

    return true;
  }

  /**
   * Method to load username recovery form 
   */
  public function recover_username()
  {   
    $data['page'] = 'user/recover_username';
    $this->load->view('index',$data);
  }

  /**
   * Method to load password recovery form 
   */
  public function recover_password()
  {   
    $data['page'] = 'user/recover_password';
    $this->load->view('index',$data);
  }

  /**
   * Method to send username to email address received 
   * from user in case email address exists in database
   * to let user recover his username
   */
  public function send_username()
  {
    // set bootstrap error delimiter for registration form
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $this->form_validation->set_rules('email', 'Email Address', 'trim|required|strip_tags|valid_email');    

    // if form validation fails load username recovery form 
    if($this->form_validation->run() == FALSE)
    {               
      $data['page'] = 'user/recover_username';
      $this->load->view('index',$data);
      return false;     
    } 

    // send email
    $result = (int) $this->user_model->email_username();
    
    switch($result)
    {
      case -1: // no user account found
               $msg = 'No user account is associated with supplied email address.';
               $type = 'danger';
               break;

      case 1:  // user details updated
               $msg = 'An email is sent to supplied email address containing username.';
               $type = 'success';                   
               break;

      case 0:  // could not update user details
      default: $msg = 'Could not initiate email function, try again later.';
               $type = 'danger';
               break;     
    }
    
    // set notification message
    $this->base->set_message($msg,$type);

    if($result == -1) {
      $data['page'] = 'user/recover_username';
      $this->load->view('index',$data);
    } else {
      $this->index();
    }     
  } 

  /**
   * Method to send password recovery link to user's
   * email address
   */ 
  public function get_recovery_link()
  {
    // set bootstrap error delimiter for registration form
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $this->form_validation->set_rules('user', 'Email Address or Username', 'trim|required|strip_tags');   

    // if form validation fails load password recovery form 
    if($this->form_validation->run() == FALSE)
    {               
      $data['page'] = 'user/recover_password';
      $this->load->view('index',$data);
      return false;     
    } 

    // send recovery link via email
    $result = (int) $this->user_model->send_password_recovery_link();
    
    switch($result)
    {
      case -1: // no user account found
               $msg = 'No user account is associated with supplied email address/username';
               $type = 'danger';
               break;

      case 1:  // user details updated
               $msg = 'An email is sent to supplied email address containing password recovery link.';
               $type = 'success';                   
               break;

      case 0:  // could not update user details
      default: $msg = 'Could not initiate email function, try again later.';
               $type = 'danger';
               break;     
    }
    
    // set message
    $this->base->set_message($msg,$type);

    if($result == -1) 
    {
      $data['page'] = 'user/recover_password';
      $this->load->view('index',$data);
    } 
    else 
    {
      $this->index();
    }     
  } 

  /**
   * Loads reset password form page if password
   * recovery token exists in recovery link
   *
   * @param  string  $token  token supplied in password recovery link
   */
  public function reset_password($token = NULL)
  {
    if(!$token) 
    {
      $this->base->set_message('Password recovery token is missing.','danger');
      $this->index();
    } 
    else 
    {
      // add supplied token in session
      $this->session->set_userdata('token',$token);
      $data['page'] = 'user/reset_password';
      $this->load->view('index',$data);
    }   
  }

  /**
   * Method to update password received from reset
   * password form
   */
  public function update_password()
  {
    $this->form_validation->set_rules('password', 'Password', 'trim|required|strip_tags|min_length[8]|max_length[32]');

    // if form validation fails load reset password form  
    if($this->form_validation->run() == FALSE)
    {               
      $data['page'] = 'user/reset_password';
      $this->load->view('index',$data);
      return false;     
    } 

    // reset password
    $result = (int) $this->user_model->reset_password();

    switch($result)
    {
      case -2: // session expired
               $msg = 'Timeout, try again clicking on password recovery link.';
               $type = 'warning';
               break;

      case -1: // invalid token
               $msg = 'Either invalid token supplied or it is expired.';
               $type = 'danger';
               break;

      case 1:  // user details updated
               $msg = 'Reseted your password successfully.';
               $type = 'success';                   
               break;

      case 0:  // could not update user details
      default: $msg = 'An error occured while reseting your password, try again later.';
               $type = 'danger';
               break;     
    }
    
    // set message
    $this->base->set_message($msg, $type);

    $this->index();
  }
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
