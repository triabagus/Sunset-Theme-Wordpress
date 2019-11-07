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
            <div id="postGallery<?php the_ID(); ?>" class="carousel slide sunset-carousel-thumb" data-ride="carousel">
                
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
                        $count = count($attachments)-1;
                        for($i = 0;$i <= $count;$i++):
                            $active = ($i == 0 ? 'active' : '');
                            
                            $n = ($i == $count ? 0 : $i+1);
                            $nextImage = $attachments[$n];
                            $p = ($i == 0 ? $count : $i-1);
                            $prevImage = $attachments[$p];
                    ?>
                        <div class="carousel-item <?php echo $active; ?> background-image standard-featured" style="background-image:url(<?php  echo $attachments[$i]; ?>);">
                            
                            <div class="carousel-caption d-none d-md-block">
                                <h5> 
                                <?php 
                                    $postCaption = get_post( get_the_ID() ); // get the post object
                                    $contentCaption = $postCaption->post_content; // we need just the content
                                    $regexCaption = '/<figcaption[\w\s]*[^>]*>(.*?)<\/figcaption>/'; // we need a expression to match things
                                    preg_match_all( $regexCaption, $contentCaption, $matchesCaption );
                                    print_r($matchesCaption[1][$i]);
                                ?> 
                                </h5>
                            </div>

                            <div class="hide next-image-preview" data-image="<?php echo $nextImage; ?>"></div>
                            <div class="hide prev-image-preview" data-image="<?php echo $prevImage; ?>"></div>
                        </div><!-- .carousel-item -->                    
                    <?php                        
                        endfor;
                    ?>

                </div><!-- .carousel-inner -->
                
                <!-- Carousel Control -->
                <a class="left carousel-control-prev" href="#postGallery<?php the_ID(); ?>" role="button" data-slide="prev">
                    <div class="preview-container">
                        <span class="thumbnail-container background-image"></span>
                        <span class="sunset-icon sunset-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </div><!-- .preview-container prev-->
                </a>

                <a class="right carousel-control-next" href="#postGallery<?php the_ID(); ?>" role="button" data-slide="next">
                    <div class="preview-container">
                        <span class="thumbnail-container background-image"></span>
                        <span class="sunset-icon sunset-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </div><!-- .preview-container next-->
                </a>
                <!-- End Carousel Control -->
                        
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