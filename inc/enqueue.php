<?php

/*

@package sunsettheme

    ===================
        ADMIN ENQUEUE FUNCTIONS  
    ===================
*/

function sunset_load_admin_scripts( $hook )
{
    // echo $hook; //check your file hook page administration

    if('toplevel_page_triabagus_sunset' != $hook){
        return;
    }

    wp_register_style('sunset_admin', get_template_directory_uri(). '/css/sunset.admin.css', array(), '1.0.0', 'all');

    wp_enqueue_style('sunset_admin');

}

add_action('admin_enqueue_scripts', 'sunset_load_admin_scripts');