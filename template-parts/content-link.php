<?php
/*
@package sunsettheme

    ===================
        LINK POST FORMAT
    ===================
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunset-format-link'); ?> >
    <header class="entry-header text-center">

        <?php 
            $links = sunset_grab_url();
            the_title('<h1 class="entry-title"><a href="'.$links.'" target="_blank">','<div class="link-icon"><span class="sunset-icon sunset-link"></span></div></a></h1>'); 
        ?>

    </header>
</article>