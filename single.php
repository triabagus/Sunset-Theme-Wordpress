<?php
/*
    @package sunsettheme
*/

get_header();
?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            
            <div class="container px-5">
                    <div class="row">
                        <div class="col-xs-12 col-md-10 col-lg-8 offset-lg-2 offset-md-1">

                <?php
                    if( have_posts() ){

                        while( have_posts()): the_post();

                            get_template_part( 'template-parts/single', get_post_format() );
                            
                            echo sunset_post_navigation();
                            // the_post_navigation();

                            if( comments_open() ):
                                comments_template();
                            endif;

                        endwhile;
                    }
                ?>
                        </div>
                    </div>
            </div><!-- .container -->
        </main>
    </div><!-- #primary -->

<?php get_footer(); ?>