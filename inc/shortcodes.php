<?php

/*

@package sunsettheme

    ===================
        SHORTCODES FUNCTIONS  
    ===================
*/

function sunset_tooltip( $atts, $content = null)
{
    //[tooltip placement="top" title="This is the title"]This is the content[/tooltip] 

    //get attribute
    $atts = shortcode_atts(
        array(
            'placement' => 'top',
            'title'     => '',
        ),
        $atts,
        'tooltip'
    );

    $title = ( $atts['title'] == '' ? $content: $atts['title'] );

    // return HTML
    return '<span class="sunset-tooltip" data-toggle="tooltip" data-placement="'.$atts['placement'].'" title="'.$title.'">'.$content.'</span>';
}

add_shortcode( 'tooltip', 'sunset_tooltip' );

function sunset_popover( $atts, $content = null)
{
    //[popover title="Popover title" placement="top" trigger="click" content="This is popover content"]This is click able popover[/popover]

    //get attribute
    $atts = shortcode_atts(
        array(
            'placement'     => 'top',
            'title'         => '',
            'trigger'       => 'click',
            'content'       => '',
        ),
        $atts,
        'popover'
    );

    //return HTML
    return '<span class="sunset-popover" data-toggle="popover" data-placement="'.$atts['placement'].'" data-title="'.$atts['title'].'" data-trigger="'.$atts['trigger'].'" data-content="'.$atts['content'].'">'.$content.'</span>';
}

add_shortcode( 'popover', 'sunset_popover');
