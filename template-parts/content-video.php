<?php
/*
@package sunsettheme

    ===================
        VIDEO POST FORMAT
    ===================
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunset-format-video'); ?> >


    <header class="entry-header text-center">

        <div class="embed-responsive embed-responsive-16by9">
            <?php 
                echo sunset_get_embedded_media( array('video', 'iframe'));
            ?>
        </div>

        <?php the_title('<h1 class="entry-title"><a href="'. esc_url(get_permalink() ) .'" rel="bookmark">', '</a></h1>'); ?>

        <div class="entry-meta">
            <?php echo sunset_posted_meta(); ?>
        </div>

    </header>

    <div class="entry-content">

        <?php 
            if( has_post_thumbnail() ):
                $featured_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); 
        ?> 
            <a class="standard-featured-link" href="<?php the_permalink(); ?>">
                <div class="standard-featured background-image" style="background-image:url(<?php echo $featured_image; ?>);">
                </div>
            </a>

        <?php endif; ?>

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