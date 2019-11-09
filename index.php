<?php 
/*
    @package sunsettheme
*/
    get_header(); 
?>
    
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <div class="container sunset-posts-container">

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
            
            <form method="post">
                <div class="container text-center">
                    <a class="btn btn-lg btn-primary sunset-load-more" data-page="1" data-url="<?= admin_url('admin-ajax.php');?>">
                        <span class="sunset-icon sunset-loading"> Load More</span>
                    </a>
                </div><!-- .container -->
            </form>
        </main>
    </div><!-- #primary -->

<?php get_footer(); ?>