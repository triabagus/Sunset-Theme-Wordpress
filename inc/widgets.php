<?php	
/*
	
@package sunsettheme
	
	========================
		WIDGET CLASS
	========================
*/

class Sunset_Profile_Widget extends WP_Widget
{
	//setup the widget name, description, etc... 

	public function __construct()
	{
		$widget_ops = array(
			'classname'		=> 'sunset-profile-widget',
			'description'	=> 'Custom Sunset Profile Widget'
		);
		parent::__construct( 'sunset_profile', 'Sunset Profile', $widget_ops);
	}

	//back-end display of widget
	public function form( $instance)
	{
		echo '<p><strong>No Options for this widget!</strong><br/>You can control the fields of this widget from <a href="./admin.php?page=triabagus_sunset">This Page</a></p>';
	}

	//front-end display widget
	public function widget($args, $instance)
	{	
		$picture    = esc_attr( get_option('profile_picture') );
		$firstName  = esc_attr( get_option('first_name') );
		$lastName   = esc_attr( get_option('last_name') );
		$fullName   = $firstName .' '.$lastName;
		$description   = esc_attr( get_option('user_description') );

		$twitter_icon = esc_attr( get_option( 'twitter_handler' ) );
		$facebook_icon = esc_attr( get_option( 'fb_handler' ) );
		$ig_icon = esc_attr( get_option( 'ig_handler' ) );

		echo $args['before_widget'];
		?>
		<div class="text-center">
			<div class="image-container">
				<div id="profile-picture-preview" class="profile-picture" style="background-image:url(<?php print $picture; ?>);"></div>
			</div>

			<h1 class="sunset-username"><?php print $fullName; ?></h1>
			<h2 class="sunset-description"><?php print $description; ?></h2>
			<div class="icons-wrapper">
				<?php if( !empty( $twitter_icon ) ): ?>
					<a href="https://twitter.com/<?= $twitter_icon; ?>" target="_blank" class="sunset-icon-sidebar sunset-icon sunset-twitter"></a>
				<?php endif; 
				if( !empty( $ig_icon ) ): ?>
					<a href="https://instagram.com/<?= $ig_icon; ?>" target="_blank" class="sunset-icon-sidebar sunset-icon icon-instagram"></a>
				<?php endif; 
				if( !empty( $facebook_icon ) ): ?>
					<a href="https://facebook.com/<?= $facebook_icon; ?>" target="_blank" class="sunset-icon-sidebar sunset-icon sunset-facebook"></a>
				<?php endif; ?>
			</div>
		</div>
		<?php

		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Sunset_Profile_Widget');
});