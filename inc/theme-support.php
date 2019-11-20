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

add_theme_support( 'post-thumbnails'); //add featured image post

//Activate Nav Menu Option
function sunset_register_nav_menu()
{
    register_nav_menu('primary', 'Header Navigation Menu');
}

add_action('after_setup_theme', 'sunset_register_nav_menu');

//Active Boostrap 4 nav menu
function add_link_atts($atts) {
    $atts['class'] = "nav-link";
    return $atts;
}

add_filter( 'nav_menu_link_attributes', 'add_link_atts');

//Active HTML5 feature
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption') );
/*

    ===================
        SIDEBAR FUNCTIONS
    ===================
*/
function sunset_sidebar_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sunset Sidebar', 'sunsettheme'),
            'id'            => 'sunset-sidebar',
            'description'   => 'Dynamic Sidebar Right',
            'before_widget' => '<section id="%1$s" class="sunset-widget %2$s">',
            'after_widget'  => '</section>',
            'before_widget' => '<h2 class="sunset-widget-title">',
            'after_widget'  => '</h2>'
        )
    );
}

add_action( 'widgets_init', 'sunset_sidebar_init');
/*

    ===================
        BLOG LOOP CUSTOM FUNCTIONS
    ===================
*/
function sunset_posted_meta()
{
    $posted_on      = human_time_diff( get_the_time('U'), current_time('timestamp') );
    $categories     = get_the_category();
    $separator      = ', ';
    $output         = '';
    $i = 1;

    if( !empty($categories)):
        foreach($categories as $category):

            if($i > 1): $output .= $separator; endif;
            $output .= '<a href="'. esc_url(get_category_link( $category->term_id ) ).'" alt="'. esc_attr('View all posts in%s', $category->name ) .'">'. esc_html($category->name ) .'</a>';

            $i++;
        endforeach;
    endif;

    return '<span class="posted-on">Posted <a href="'. esc_url(get_permalink() ) .'">'. $posted_on .'</a> ago </span><span class="posted-in">'. $output .'</span>';
}

function sunset_posted_footer($onlyComments = false)
{

    $comments_num   = get_comments_number();
    if( comments_open() ){
        if( $comments_num == 0){
            $comments = __('No Comments');
        }elseif($comments_num > 1){
            $comments = $comments_num . __(' Comments');
        }else{
            $comments = __('1 Comments');
        }

        $comments = '<a class="comments-link small text-caps" href="'.get_comments_link().'">'.$comments.' <span class="sunset-icon sunset-comment"></span></a>';
    }else{
        $comments = __('Comments are closed');
    }

    if($onlyComments){
        return $comments;
    }

    $tags       = get_the_tag_list('<div class="tags-list"><span class="sunset-icon sunset-tag"></span> ',' ','</div>');

    return '<div class="post-footer-container"><div class="row"><div class="col-12 col-sm-6">'.$tags.'</div><div class="col-12 col-sm-6 text-right">'.$comments.'</div></div></div>';
}

function sunset_get_attachment($num = 1){

    $output = '';

    if( has_post_thumbnail() && $num == 1 ):
        $output = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
    else:
        
        $post = get_post( get_the_ID() ); // get the post object
        $content = $post->post_content; // we need just the content
        $regex = '/src="([^"]*)"/'; // we need a expression to match things
        preg_match_all( $regex, $content, $matches ); // we want all matches
        
        $count = substr_count($content, '<img'); //count img how much
        
        if($count == 1){
            $matches = array_reverse($matches); // reversing the matches array
            $output = implode($matches[0]); //string to array
        }elseif($count > 1){
            $matches = array_reverse($matches); // reversing the matches array
            $implode = implode($matches[0]," ");// implode array to string
            $output = explode(" ",$implode);//explode string to array again
        }
        wp_reset_postdata();
    endif;
    
    return $output;
}

function sunset_get_embedded_media($type = array())
{
     // Customize style soundcloud
    $content    = do_shortcode( apply_filters('the_content', get_the_content() ) );
    $embed      = get_media_embedded_in_content($content, $type );

    if( in_array( 'audio', $type)):
        $output     = str_replace('?visual=true', '?visual=false', $embed[0] );
    else:
        $output     = $embed[0];
    endif;

    return $output;
}

function sunset_grab_url()
{
    if(! preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links) )
    {
        return false;
    }

    return esc_url_raw( $links[1]);
}

function sunset_grab_current_uri()
{
    $http           = ( isset( $_SERVER["HTTPS"] ) ? 'https://' : 'http://');
    $referer        = $http. $_SERVER["HTTP_HOST"];
    $archive_url    = $referer. $_SERVER["REQUEST_URI"];

    return $archive_url;
}

/*
	========================
		SINGLE POST CUSTOM FUNCTIONS
	========================
*/
function sunset_post_navigation()
{
    $nav     = '<div class="row">';
    $prev    = get_previous_post_link('<div class="post-link-nav"><span class="sunset-icon sunset-chevron-left" aria-hidden="true"></span> %link</div>', '%title');
    $nav    .= '<div class="col-xs-12 col-sm-6">'.$prev.'</div>';
    
    $next    = get_next_post_link('<div class="post-link-nav">%link <span class="sunset-icon sunset-chevron-right" aria-hidden="true"></span></div>', '%title');
    $nav    .= '<div class="col-xs-12 col-sm-6 text-right">'.$next.'</div>';

    $nav    .= '</div>';

    return $nav;
}
/*
	========================
		SHARE FILTER POST CUSTOM FUNCTIONS
	========================
*/
function sunset_share_this( $content )
{
    if( is_single()):
        $content        .= '<div class="sunset-shareThis"><h4>Share This</h4>';
        $title          = get_the_title();
        $permalink      = get_permalink();

        $twitterHandler = ( get_option( 'twitter_handler' ) ? '&amp;via='.esc_attr( get_option( 'twitter_handler') ) : '');

        $twitter        = 'https://twitter.com/intent/tweet?text=Hey ! read this: '.$title.'&amp;url='.$permalink.$twitterHandler.'';
        $facebook       = 'https://www.facebook.com/sharer/sharer.php?u='.$permalink;
        $google         = 'https://plus.google.com/share?url='.$permalink;

        $content        .='<ul>';
        $content        .='<li><a href="'.$twitter.'" target="_blank" rel="nofollow"><span class="sunset-icon sunset-twitter"></span></a></li>';
        $content        .='<li><a href="'.$facebook.'" target="_blank" rel="nofollow"><span class="sunset-icon sunset-facebook"></span></a></li>';
        $content        .='<li><a href="'.$google.'" target="_blank" rel="nofollow"><span class="sunset-icon sunset-googleplus"></span></a></li>';
        $content        .='</ul></div><!-- .sunset-shareThis -->';

        return $content;
    else:
        return $content;
    endif;
}
add_filter('the_content', 'sunset_share_this');

/*
	========================
	GET COMMENTS POST FUNCTIONS
	========================
*/
function sunset_get_post_navigation()
{
    // if( get_comment_pages_count() > 1 && get_option( 'page_comments') ): 
        require( get_template_directory(). '/inc/templates/sunset-comment-nav.php');
    // endif;
}

/*
	========================
	TRIAL MAILTRAP SMTP LOCAL FUNCTIONS
	========================
*/
function mailtrap($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = ''; //check your username in mailtrap
    $phpmailer->Password = ''; //check your password in mailtrap
}

add_action('phpmailer_init', 'mailtrap');