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
    register_setting('sunset-settings-group', 'last_name');
    register_setting('sunset-settings-group', 'user_description');
    register_setting('sunset-settings-group', 'twitter_handler', 'sunset_sanitize_twitter_handler');
    register_setting('sunset-settings-group', 'fb_handler');
    register_setting('sunset-settings-group', 'ig_handler');

    add_settings_section('sunset-sidebar-options', 'Sidebar Options', 'sunset_sidebar_options', 'triabagus_sunset');

    add_settings_field('sidebar-name', 'Full Name', 'sunset_sidebar_name', 'triabagus_sunset', 'sunset-sidebar-options');
    add_settings_field('sidebar-description', 'Description', 'sunset_sidebar_description', 'triabagus_sunset', 'sunset-sidebar-options');
    add_settings_field('sidebar-twitter', 'Twitter handler', 'sunset_sidebar_twitter', 'triabagus_sunset', 'sunset-sidebar-options');
    add_settings_field('sidebar-fb', 'Facebook handler', 'sunset_sidebar_fb', 'triabagus_sunset', 'sunset-sidebar-options');
    add_settings_field('sidebar-ig', 'Instagram handler', 'sunset_sidebar_ig', 'triabagus_sunset', 'sunset-sidebar-options');
}

function sunset_sidebar_options()
{
    echo 'Customize your Sidebar Information';
}

function sunset_sidebar_name()
{
    $firstName  = esc_attr( get_option('first_name') );
    $lastName   = esc_attr( get_option('last_name') );

    echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="Tria" /> <input type="text" name="last_name" value="'.$lastName.'" placeholder="Bagus" />';
}

function sunset_sidebar_description()
{
    $description   = esc_attr( get_option('user_description') );
    echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" /><p>Write something smart. </p>';
}

function sunset_sidebar_twitter()
{
    $twitter   = esc_attr( get_option('twitter_handler') );
    echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="ho22912902" /><p>Input your Twitter username without the @ character.</p>';
}

function sunset_sidebar_fb()
{
    $fb   = esc_attr( get_option('fb_handler') );
    echo '<input type="text" name="fb_handler" value="'.$fb.'" placeholder="tria.b.n.t" />';
}

function sunset_sidebar_ig()
{
    $ig   = esc_attr( get_option('ig_handler') );
    echo '<input type="text" name="ig_handler" value="'.$ig.'" placeholder="triabagus.official" />';
}

//Sanitization Settings
function sunset_sanitize_twitter_handler( $input )
{
    $output = sanitize_text_field( $input );
    $output = str_replace('@', '', $output);
    return $output;
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

