<?php
/*
Plugin Name: Wordpress plugin for academics
Plugin URI: 
Description: Wordpress plugin for academics
Version: 1.0
Author: Asbjørn Thom
Author URI: 
License: GPL
*/

define('PFA_PATH', plugin_dir_path(__FILE__));// The filesystem directory path
define ('PFA_PLUGIN_PATH', plugin_basename(__FILE__)); //the plugin base path
define('PFA_URL_PATH', plugin_dir_url(__FILE__)); 

require_once PFA_PATH.'functions.php'; //Include functions.php
require_once PFA_PATH.'admin/index.php'; //Include admin pages

if (is_admin()){
	add_action('admin_menu', 'addMenu'); //Action that adds the sidemenu for the plugin
}

function myplugin_activate() {
	addTables();
	addPubIdTable();
}
register_activation_hook( __FILE__, 'myplugin_activate' );

function list_js_script() {
	wp_enqueue_script( 'script-name', PFA_URL_PATH . 'js/list.js', array(), '1.1.1', true );
}
add_action( 'wp_enqueue_scripts', 'list_js_script' );

?>