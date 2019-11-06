<?php 
/*
    @package sunsettheme
*/
    get_header(); 
?>
    
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-10">
                    
                        <?php
                            if( have_posts() ):
                                
                                while( have_posts() ): the_post();
                                    get_template_part('template-parts/content', get_post_format() );
                                endwhile;
                                
                            endif;
                        ?>

                    </div><!-- .col-10 -->
                </div><!-- .row -->

            </div><!-- .container -->

        </main>
    </div><!-- #primary -->

<?php get_footer(); ?>