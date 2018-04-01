<?php
/*
Plugin Name: Post Widget
Description: Lista posgens de uma categoria em um destaque do tipo slider
Version: 1.0.0
Author: Tiago Góes
Author URI: tiago.goes2009@gmail.com
*/
// Exit if accessed directly
if(!defined('ABSPATH')){
    exit;
}
// Load Scripts
require_once(plugin_dir_path(__FILE__).'/includes/postwidget-scripts.php');

// Load Class
require_once(plugin_dir_path(__FILE__).'/includes/Post_Widget.php');
// Register Widget

function register_postwidget(){
    register_widget('Post_Widget');
}
// Hook in function
add_action('widgets_init', 'register_postwidget');