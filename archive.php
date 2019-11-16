<?php 
/*
    @package sunsettheme
*/
    get_header(); 
?>
    
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <header class="archive-header text-center mt-5">
                <?php  the_archive_title('<h1 class="page-title">','</h1>');?> 
            </header>

            <?php if( is_paged() ):?>

            <form method="post">
                <div class="container text-center container-load-previous">
                    <a class="btn-sunset-load sunset-load-more" data-prev="1" data-archive="<?=  sunset_grab_current_uri(); ?>" data-page="<?= sunset_check_paged(1); ?>" data-url="<?= admin_url('admin-ajax.php');?>">
                        <span class="sunset-icon sunset-loading"></span>
                        <span class="text">Load Previous</span>
                    </a>
                </div><!-- .container -->
            </form>    
            
            <?php endif;?>
            
            <div class="container sunset-posts-container px-5">
                    
                <?php
                    if( have_posts() ):
                        
                        echo '<div class="page-limit" data-page="'.$_SERVER["REQUEST_URI"].'">';

                        while( have_posts() ): the_post();
                        
                            // $class = 'reveal';
                            // set_query_var('post-class', $class);
                            
                            get_template_part('template-parts/content', get_post_format() );
                        endwhile;
                        
                        echo '</div>';

                    endif;
                ?>

            </div><!-- .container -->
            
            <form method="post">
                <div class="container text-center">
                    <a class="btn-sunset-load sunset-load-more" data-archive="<?= sunset_grab_current_uri(); ?>" data-page="<?= sunset_check_paged(1); ?>" data-url="<?= admin_url('admin-ajax.php');?>">
                        <span class="sunset-icon sunset-loading"></span>
                        <span class="text">Load More</span>
                    </a>
                </div><!-- .container -->
            </form>
        </main>
    </div><!-- #primary -->

<?php get_footer(); ?>