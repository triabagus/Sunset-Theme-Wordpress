<?php

/*
    ==================
        2   - Dashboard
        4   - Separator
        5   - Posts
        10  - Media
        15  - Links
        20  - Pages
        25  - Comments
        59  - Separator
        60  - Appearance
        65  - Plugin
        70  - Users
        75  - Tools
        80  - Settings
        99  - Separator
    ==================


@package sunsettheme

    ===================
        ADMIN PAGE  
    ===================
*/

function sunset_add_admin_page()
{
    //Generate Sunset Admin Page
    add_menu_page('Sunset Theme Options', 'Sunset', 'manage_options', 'triabagus_sunset', 'sunset_theme_create_page', 'dashicons-palmtree', 110 ); 
        // custom icon 'dashicons-palmtree' => get_template_directory_uri() . '/img/sunset-icon.png'

    //Generate Sunset Admin Sub Page
    add_submenu_page('triabagus_sunset', 'Sunset Theme Options', 'General', 'manage_options', 'triabagus_sunset', 'sunset_theme_create_page'); 
    add_submenu_page('triabagus_sunset', 'Sunset CSS Options', 'Custom CSS', 'manage_options', 'triabagus_sunset_css', 'sunset_theme_settings_page');

    //Active custom settings
    add_action('admin_init', 'sunset_custom_settings');


}

add_action('admin_menu', 'sunset_add_admin_page');

function sunset_custom_settings()
{
    register_setting('sunset-settings-group', 'first_name');
    add_settings_section('sunset-sidebar-options', 'Sidebar Options', 'sunset_sidebar_options', 'triabagus_sunset');
    add_settings_field('sidebar-name', 'Firts Name', 'sunset_sidebar_name', 'triabagus_sunset', 'sunset-sidebar-options');
}

function sunset_sidebar_options()
{
    echo 'Customize your Sidebar Information';
}

function sunset_sidebar_name()
{
    $firstName = esc_attr( get_option('first_name') );
    echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name" />';
}

function sunset_theme_create_page()
{
    // generate of our admin page
    require_once( get_template_directory() . '/inc/templates/sunset-admin.php' );
}

function sunset_theme_settings_page()
{
    // generate of our admin page settings
    echo '<h1>Sunset Custom CSS</h1>';

}

