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

    add_menu_page('Sunset Theme Options', 'Sunset', 'manage_options', 'triabagus-sunset', 'sunset_theme_create_page', 'dashicons-palmtree', 110 );

    // custom icon 'dashicons-palmtree' => get_template_directory_uri() . '/img/sunset-icon.png'
}

add_action('admin_menu', 'sunset_add_admin_page');

function sunset_theme_create_page()
{
    // generate of our admin page
    echo '<h1>Sunset Theme Options</h1>';
}

