<?php
    /**
     * This is the template for header
     * 
     * @package sunsettheme
     */
?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
    <head>

        <title><?php bloginfo('name'); wp_title(); ?></title>

        <meta name="description" content="<?php bloginfo('description')?>">
        <meta charset="<?php bloginfo('charset');?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500&display=swap" rel="stylesheet">
        <?php if(is_singular() && pings_open( get_queried_object() ) ): ?>
            <link rel="pingback" href="<?php bloginfo('pingback_url');?>">
        <?php endif;?>
        <?php wp_head(); ?>

        <?php
            $custom_css = esc_attr( get_option( 'sunset_css'));
            if(!empty( $custom_css)):
                echo '<style>'.$custom_css.'</style>';
            endif;
        ?>
    </head>
<body <?php body_class(); ?>>
    <!--  -->
    <div class="sunset-sidebar sidebar-closed">
        <div class="sunset-sidebar-container">
            
            <a class="js-toggleSidebar sidebar-close">
                <span class="sunset-icon sunset-close"></span>
            </a>
            
            <div class="sidebar-scroll">
                <?php get_sidebar(); ?>
            </div><!-- .sidebar-scroll -->
        
        </div><!-- .sunset-sidebar-container -->
    </div><!-- .sunset-sidebar -->

    <div class="sunset-overlay js-toggleSidebar"></div>
    
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12 px-0">
                <header class="header-container background-image text-center" style="background-image: url(<?php header_image(); ?>);">

                    <a class="js-toggleSidebar sidebar-open">
                        <span class="sunset-icon sunset-menu"></span>
                    </a>

                    <div class="header-content table">
                        <div class="table-cell">
                            <h1 class="site-title sunset-icon">
                                <span class="sunset-logo"></span>
                                <span style="display:none;"><?php bloginfo('name'); ?></span>
                            </h1>
                            <h2 class="site-description"><?php bloginfo('description'); ?></h2>
                        </div><!-- .table-cell -->
                    </div><!-- .header-content -->


                    <div class="nav-container d-xs-none">

                        <nav class="nav justify-content-center navbar-sunset">
                            <?php 
                                wp_nav_menu( array(
                                    'theme_location'    => 'primary',
                                    'container'         => false,
                                    'menu_class'        => 'nav nav-item',
                                    'fallback_cb'       => '__return_false',
                                    'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'depth'             => 2,
                                    'walker'            => new Sunset_Walker_Nav_Primary()
                                ) );
                            ?>
                        </nav>

                    </div><!-- .nav-container -->

                </header><!-- .header-container -->
                
            </div><!-- .col-12 -->
        </div><!-- .row -->

    </div><!-- .container-fluid -->