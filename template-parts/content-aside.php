<?php
/*
@package sunsettheme

    ===================
        ASIDE POST FORMAT
    ===================
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sunset-format-aside'); ?> >

    <div class="aside-container">
    
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3 text-center">
                <?php 
                    $attachments = sunset_get_attachment(); 
                    if(! empty($attachments) && is_array($attachments) ):
                ?>
                    <div class="aside-featured background-image" style="background-image:url(<?php  echo $attachments[0]; ?>);">
                    </div>
                <?php   
                    elseif(! empty($attachments)):
                ?> 
                    <div class="aside-featured background-image" style="background-image:url(<?php  echo $attachments; ?>);">
                        </div>
                <?php endif; ?>
            </div><!-- .col-md-3 -->
            
            <div class="col-xs-12 col-sm-8 col-md-9">

                <header class="entry-header">
                    <div class="entry-meta">
                        <?php echo sunset_posted_meta(); ?>
                    </div>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <div class="entry-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div><!-- .entry-content -->

            </div><!-- .col-md-9 -->
        </div><!-- .row -->

        <footer class="entry-footer">

            <div class="row">
                <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2">
                    <?php echo sunset_posted_footer(); ?>
                </div><!-- .col-md-10 -->
            </div><!-- .row -->

        </footer><!-- .entry-footer -->

    </div><!-- .aside-container -->

</article>