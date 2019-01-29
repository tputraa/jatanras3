<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Pagination configuration
|--------------------------------------------------------------------------
| The basic settings for the auth library.
|
*/

$config['full_tag_open']		=	'<nav><ul class="pagination justify-content-end">';
$config['full_tag_close']		=	'</ul></nav>';
$config['num_tag_open']			=	'<li class="page-item">';
$config['num_tag_close']		=	'</li>';
$config['cur_tag_open']			=	'<li class="page-item disabled active"><a class="page-link" href="#">';
$config['cur_tag_close']		=	'</a></li>';
$config['next_tag_open']		=	'<li class="page-item">';
$config['next_tag_close']		=	'</li>';
$config['prev_tag_open']		=	'<li class="page-item">';
$config['prev_tag_close']		=	'</li>';
$config['first_tag_open']		=	'<li class="page-item">';
$config['first_tag_close']	=	'</li>';
$config['last_tag_open']		=	'<li class="page-item">';
$config['last_tag_close']		=	'</li>';
$config['prev_link']				=	'Previous';
$config['next_link']				=	'Next';