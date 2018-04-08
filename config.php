<?php

$config = array();

$config['base_url'] = $_SERVER['HTTP_HOST'];
$config['host_name'] = 'Website Name';
$config['address'] = 'Address';
$config['phone'] = 'Phone Number';

// Google Analytics Web Property ID
$config['google_analytics_web_property_id'] = '';

if (!defined('SLASH')) {
    define('SLASH', DIRECTORY_SEPARATOR);
}

if (!defined('BASE_DIR_NAME')) {
    define('BASE_DIR_NAME', '../'.basename(dirname(__FILE__)));
}

if (!defined('SERVER_PROTOCOL')) {
    define('SERVER_PROTOCOL', (((isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) || (isset($_SERVER['SERVER_PORT']) && ($_SERVER['SERVER_PORT'] == 443))
        || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && ($_SERVER['HTTP_X_FORWARDED_PROTO']=='https')) || (isset($_SERVER['HTTP_X_LIMETRAY_PROTO']) && ($_SERVER['HTTP_X_LIMETRAY_PROTO']=='https'))) ? "https" : "http"));
}

if (!defined('DIR_PATH')) {
    define('DIR_PATH', BASE_DIR_NAME.SLASH);
}

if(!defined('PARTIAL_PATH')){
	define('PARTIAL_PATH','layouts/partials'.SLASH);
}