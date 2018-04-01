<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 29/03/2018
 * Time: 18:39
 */

function register_scripts(){

    wp_enqueue_script("bootstrap-js","https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js", array('jquery'),'3.3.7',true);
}

add_action('wp_enqueue_scripts', 'register_scripts');

function register_styles(){
    wp_enqueue_style('bootstrap-css',"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");
}

add_action('wp_enqueue_scripts', 'register_styles');