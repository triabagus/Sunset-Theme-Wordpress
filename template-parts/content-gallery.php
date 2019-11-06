<?php
/*
@package sunsettheme

    ===================
        GALLERY POST FORMAT
    ===================
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunset-format-gallery'); ?> >
    <header class="entry-header text-center">

        <?php 
            if( sunset_get_attachment() ):
                $attachments = sunset_get_attachment();
        ?> 
            <div id="postGallery<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
                
                <ul class="carousel-indicators">
                    <?php
                        $x = 0;
                        foreach($attachments as $attachment):
                        $active = ($x == 0 ? 'active' : '');
                    ?>
                    <li data-target="#postGallery<?php the_ID(); ?>" data-slide-to="<?php echo $x; ?>" class="<?php echo $active; ?>"></li>
                    <?php
                        $x++;
                        endforeach;
                    ?>
                </ul>

                <div class="carousel-inner">

                    <?php
                        $i = 0;
                        foreach($attachments as $attachment):
                        $active = ($i == 0 ? 'active' : '');
                    ?>
                        <div class="carousel-item <?php echo $active; ?> background-image standard-featured" style="background-image:url(<?php  echo $attachment; ?>);"></div><!-- .carousel-item -->
                    <?php
                        $i++;
                        endforeach;
                    ?>

                </div><!-- .carousel-inner -->
                    
                    <a class="carousel-control-prev" href="#postGallery<?php the_ID(); ?>" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#postGallery<?php the_ID(); ?>" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

            </div><!-- .carousel -->

        <?php endif; ?>


        <?php the_title('<h1 class="entry-title"><a href="'. esc_url(get_permalink() ) .'" rel="bookmark">', '</a></h1>'); ?>

        <div class="entry-meta">
            <?php echo sunset_posted_meta(); ?>
        </div>

    </header>

    <div class="entry-content">

        <div class="entry-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <div class="button-container text-center">
            <a href="<?php the_permalink(); ?>" class="btn btn-sunset">
                <?php _e( 'Read More'); ?>
            </a>
        </div>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php echo sunset_posted_footer(); ?>
    </footer>
</article>