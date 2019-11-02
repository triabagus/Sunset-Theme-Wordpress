<?php

/*
@package sunsettheme

    ===================
        THEME SUPPORT OPTIONS  
    ===================
*/
$options = get_option('post_formats');
$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
$output  = array();
foreach($formats as $format){
    $output[] = ( @$options[$format] == 1 ? $format : '');
}    

if( !empty($options)){
    add_theme_support('post-formats', $output);
}

//Custom Header
$header = get_option('custom_header');
if(@$header == 1){
    add_theme_support('custom-header');
}

//Custom Background
$background = get_option('custom_background');
if(@$background == 1){
    add_theme_support('custom-background');
}

//Activate Nav Menu Option
function sunset_register_nav_menu()
{
    register_nav_menu('primary', 'Header Navigation Menu');
}

add_action('after_setup_theme', 'sunset_register_nav_menu');

function add_link_atts($atts) {
    $atts['class'] = "nav-link";
    return $atts;
}

add_filter( 'nav_menu_link_attributes', 'add_link_atts');