<?php
/**
 * CodeIgniter Recaptcha library
 *
 * This is a PHP library that handles calling reCAPTCHA.
 *    - Documentation and latest version
 *          https://developers.google.com/recaptcha/docs/php
 *    - Get a reCAPTCHA API Key
 *          https://www.google.com/recaptcha/admin/create
 *    - Discussion group
 *          http://groups.google.com/group/recaptcha
 *
 * @package  	CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author  	Prashant Pareek <prashantpareek1988@gmail.com>
 * @copyright 	Copyright (c) 2014, Google Inc.
 * @link      	http://www.google.com/recaptcha
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ReCaptcha Class
 */
class Recaptcha {
	/**
	 * ci instance object
	 *
	 */
	private $_ci;

	/**
	 * reCAPTCHA site verfiy URL to communicate between site and Google
	 */
	const site_verify_url = 'https://www.google.com/recaptcha/api/siteverify';       

	/**
	 * constructor     
	 */
	public function __construct()
	{
		$this->_ci = & get_instance();
		$this->_ci->load->config('recaptcha');        
		$this->_secret_key = $this->_ci->config->item('recaptcha_secret_key');            
	}	

	/**
	 * Submits an HTTP GET to a reCAPTCHA server.
	 *     
	 * @param array  $data array of parameters to be sent.
	 *
	 * @return array response
	 */
	private function _submitHTTPGet($data)
	{
		$url = self::site_verify_url.'?'.http_build_query($data);
		$response = file_get_contents($url);

		return $response;
	}

	/**
	 * Calls the reCAPTCHA siteverify API to verify whether the user passes
	 * CAPTCHA test.
	 *
	 * @param string $remoteIp   IP address of end user.
	 * @param string $response   response string from recaptcha verification.
	 *
	 * @return ReCaptchaResponse
	 */
	public function verifyResponse($response, $remoteIp = null)
	{
		$remoteIp = (!empty($remoteIp)) ? $remoteIp : $this->_ci->input->ip_address();
			
		// Discard empty solution submissions
		if (empty($response)) 
		{
			return array(
				'success' => false,
				'error-codes' => 'missing-input',
			);
		}

		$getResponse = $this->_submitHttpGet(
			array(
				'secret' => $this->_secret_key,
				'remoteip' => $remoteIp,
				'response' => $response,
			)
		);

		// get reCAPTCHA server response
		$responses = json_decode($getResponse, true);

		if (isset($responses['success']) and $responses['success'] == true) 
		{
			$status = true;
		} 
		else 
		{
			$status = false;
			$error = (isset($responses['error-codes'])) ? $responses['error-codes'] : 'invalid-input-response';
		}

		return array(
			'success' => $status,
			'error-codes' => (isset($error)) ? $error : null,
		);
	}
}

/* End of file Recaptcha.php */
/* Location: ./application/libraries/Recaptcha.php */	