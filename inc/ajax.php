<?php

/*

    @package sunsettheme

    ===================
        AJAX FUNCTION 
    ===================

 */

add_action('wp_ajax_nopriv_sunset_load_more', 'sunset_load_more');
add_action('wp_ajax_sunset_load_more', 'sunset_load_more');

function sunset_load_more()
{
    $paged = $_POST["page"] + 1;
    $prev = $_POST["prev"];
    $archive = $_POST["archive"];

    if( $prev == 1 && $_POST["page"] != 1){
        $paged = $_POST["page"] - 1;
    }

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged'     => $paged 
    );

    if( $archive != '0'){

        $archVal = explode( '/', $archive);
        $type = ( $archVal[2] == "category" ? "category_name" : $archVal[2] );
        $args[$type] = $archVal[3];
        $page_trail = '/'. $archVal[1].'/'. $archVal[2].'/'.$archVal[3].'/';
        
    }else{
        $page_trail = get_site_url().'/';
    }

    $query = new WP_Query($args);

    if( $query->have_posts() ):
        
        echo '<div class="page-limit" data-page="'.$page_trail.'page/'.$paged.'">';

        while( $query->have_posts() ): $query->the_post();
            get_template_part('template-parts/content', get_post_format() );
        endwhile;
        
        echo '</div>';
    else:

        echo 0;
    
    endif;

    wp_reset_postdata();

    die();
}

function sunset_check_paged($num = null)
{
    $output = '';
	
	if( is_paged() ){ $output = 'page/' . get_query_var( 'paged' ); }
	
	if( $num == 1 ){
		$paged = ( get_query_var( 'paged' ) == 0 ? 1 : get_query_var( 'paged' ) );
		return $paged;
	} else {
		return $output;
	}
	
    
}