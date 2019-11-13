<?php
/*
@package sunsettheme

    ===================
        QUOTE POST FORMAT
    ===================
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunset-format-quote'); ?> >
    <header class="entry-header text-center">

        <div class="row">
            <div class="col-sm-10 col-md-8 offset-sm-1 offset-md-2">
                <h1 class="quote-content">
                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                        <?php echo get_the_content();?>
                    </a>
                </h1>
            </div><!-- .col-md-8 -->
        </div><!-- .row -->
        
        <?php the_title('<h2 class="quote-author">-','-</h1>'); ?>

    </header>

    <footer class="entry-footer">
        <?php echo sunset_posted_footer(); ?>
    </footer>
</article>