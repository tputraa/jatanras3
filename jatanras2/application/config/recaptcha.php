<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| Register Google reCAPTCHA API keys at https://www.google.com/recaptcha/admin
*/

/*
|--------------------------------------------------------------------------
| reCAPTCHA Site Key
|--------------------------------------------------------------------------
|
| reCAPTCHA Site Key is used in HTML forms to generate the reCAPTCHA widget.
|
*/
$config['recaptcha_site_key'] = '';

/*
|--------------------------------------------------------------------------
| reCAPTCHA Secret Key
|--------------------------------------------------------------------------
|
| reCAPTCHA Secret Key is used for communication between your site and Google.
|
*/
$config['recaptcha_secret_key'] = '';

/*
|--------------------------------------------------------------------------
| reCAPTCHA Language
|--------------------------------------------------------------------------
|
| Forces the widget to render in a specific language. Auto-detects the user's language if unspecified.
| 
| reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
|
*/
$config['recaptcha_lang'] = 'en';

/* End of file recaptcha.php */
/* Location: ./application/config/recaptcha.php */
