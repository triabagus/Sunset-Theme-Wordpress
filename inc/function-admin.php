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
    add_submenu_page('triabagus_sunset', 'Sunset Sidebar Options', 'Sidebar', 'manage_options', 'triabagus_sunset', 'sunset_theme_create_page'); 
    add_submenu_page('triabagus_sunset', 'Sunset Theme Options', 'Theme Options', 'manage_options', 'triabagus_sunset_theme', 'sunset_theme_support_page');
    add_submenu_page('triabagus_sunset', 'Sunset Contact Form', 'Contact Form', 'manage_options', 'triabagus_sunset_theme_contact', 'sunset_contact_form_page');
    add_submenu_page('triabagus_sunset', 'Sunset CSS Options', 'Custom CSS', 'manage_options', 'triabagus_sunset_css', 'sunset_theme_settings_page');

    
}

add_action('admin_menu', 'sunset_add_admin_page');

//Active custom settings
add_action('admin_init', 'sunset_custom_settings');

function sunset_custom_settings()
{
    //Sidebar Options
    register_setting('sunset-settings-group', 'profile_picture');
    register_setting('sunset-settings-group', 'first_name');
    register_setting('sunset-settings-group', 'last_name');
    register_setting('sunset-settings-group', 'user_description');
    register_setting('sunset-settings-group', 'twitter_handler', 'sunset_sanitize_twitter_handler');
    register_setting('sunset-settings-group', 'fb_handler');
    register_setting('sunset-settings-group', 'ig_handler');

    add_settings_section('sunset-sidebar-options', 'Sidebar Options', 'sunset_sidebar_options', 'triabagus_sunset');

    add_settings_field('sidebar-profile-picture', 'Profile Picture', 'sunset_sidebar_profile', 'triabagus_sunset', 'sunset-sidebar-options');
    add_settings_field('sidebar-name', 'Full Name', 'sunset_sidebar_name', 'triabagus_sunset', 'sunset-sidebar-options');
    add_settings_field('sidebar-description', 'Description', 'sunset_sidebar_description', 'triabagus_sunset', 'sunset-sidebar-options');
    add_settings_field('sidebar-twitter', 'Twitter handler', 'sunset_sidebar_twitter', 'triabagus_sunset', 'sunset-sidebar-options');
    add_settings_field('sidebar-fb', 'Facebook handler', 'sunset_sidebar_fb', 'triabagus_sunset', 'sunset-sidebar-options');
    add_settings_field('sidebar-ig', 'Instagram handler', 'sunset_sidebar_ig', 'triabagus_sunset', 'sunset-sidebar-options');

    //Theme Support Options
    register_setting('sunset-theme-support', 'post_formats');
    register_setting('sunset-theme-support', 'custom_header');
    register_setting('sunset-theme-support', 'custom_background');

    add_settings_section('sunset-theme-options', 'Theme Options', 'sunset_theme_options', 'triabagus_sunset_theme');

    add_settings_field('post-formats', 'Post Formats', 'sunset_post_formats', 'triabagus_sunset_theme', 'sunset-theme-options');
    add_settings_field('custom_header', 'Custom Header', 'sunset_custom_header', 'triabagus_sunset_theme', 'sunset-theme-options');
    add_settings_field('custom_background', 'Custom Background', 'sunset_custom_background', 'triabagus_sunset_theme', 'sunset-theme-options');

    //Contact Form Options
    register_setting('sunset-contact-options', 'activate_contact');

    add_settings_section('sunset-contact-section', 'Contact Form', 'sunset_contact_section', 'triabagus_sunset_theme_contact');

    add_settings_field('activate-form', 'Activate Contact Form', 'sunset_activate_contact', 'triabagus_sunset_theme_contact', 'sunset-contact-section');
}

function sunset_theme_options()
{
    echo 'Activate and Deactivated specific Theme Support Options';
}

function sunset_contact_section()
{
    echo 'Activate and Deactivated the Built-in Contact Form';
}

function sunset_activate_contact()
{
    $options = get_option('activate_contact');
    $checked = ( @$options == 1 ? 'checked': '');
    echo '<label><input type="checkbox" name="activate_contact" id="activate_contact" value="1" '.$checked.'/></label><br>';
}

function sunset_post_formats()
{
    $options = get_option('post_formats');
    $formats = array('aside', 'gallery', 'link', 'image', 'quotes', 'status', 'video', 'audio', 'chat');
    $output = '';

    foreach ($formats as $format) {
        $checked = ( @$options[$format] == 1 ? 'checked': '');
        $output .= '<label><input type="checkbox" name="post_formats['.$format.']" id="'.$format.'" value="1" '.$checked.'/>'.$format.'</label><br>';
    }

    echo $output;
}

function sunset_custom_header()
{
    $options = get_option('custom_header');
    $checked = ( @$options == 1 ? 'checked': '');
    echo '<label><input type="checkbox" name="custom_header" id="custom_header" value="1" '.$checked.'/>Activated the custom header</label><br>';
}

function sunset_custom_background()
{
    $options = get_option('custom_background');
    $checked = ( @$options == 1 ? 'checked': '');
    echo '<label><input type="checkbox" name="custom_background" id="custom_background" value="1" '.$checked.'/>Activated the custom background</label><br>';
}

//Sidebar Options Funstion
function sunset_sidebar_options()
{
    echo 'Customize your Sidebar Information';
}

function sunset_sidebar_profile()
{
    $picture  = esc_attr( get_option('profile_picture') );

    if(empty($picture)){

        echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture" value="" />';
    }else{

        echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'" />  <input type="button" class="button button-secondary" value="Remove" id="remove-picture">';
    }
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

//Template submenu function
function sunset_theme_support_page()
{
    // generate of our theme support page
    require_once( get_template_directory(). '/inc/templates/sunset-theme-support.php');
}

function sunset_contact_form_page()
{
    // generate of our theme support page
    require_once( get_template_directory(). '/inc/templates/sunset-contact-form.php');
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

