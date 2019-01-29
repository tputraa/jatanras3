<?php
/**
 * Media Manager for Codeigniter
 *
 * @package		CodeIgniter
 * @author 		Prashant Pareek
 * @link 		http://codecanyon.net/item/media-manager-for-codeigniter/9517058
 * @version 	2.1.3
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$config['allowed_types'] = 'bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,mp3,mp4';
$config['max_size'] = 10;
$config['max_width'] = 1024;
$config['max_height'] = 1024;
$config['media_path'] = 'media';
$config['max_filename'] = 0;
$config['max_files'] = 10;
$config['overwrite'] = 0;
$config['remove_spaces'] = 1;
$config['encrypt_name'] = 0;