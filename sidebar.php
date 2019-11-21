<?php 
/*	
@package sunsettheme
*/
    if(! is_active_sidebar( 'sunset-sidebar')){
        return;
    }
?>
<aside id="secondary" class="widget-area" role="complementary">

    <div class="d-xs-block navbar-collapse">
        <?php 
            wp_nav_menu( array(
                'theme_location'    => 'primary',
                'container'         => false,
                'menu_class'        => 'navbar-nav mr-auto mt-2 mt-lg-0',
                'fallback_cb'       => '__return_false',
                'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'             => 2,
                'walker'            => new Sunset_Walker_Nav_Primary()
            ) );
        ?>
    </div>

    <?php dynamic_sidebar( 'sunset-sidebar'); ?>

</aside><!-- #secondary -->