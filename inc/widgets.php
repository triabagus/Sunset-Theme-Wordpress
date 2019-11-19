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

/*
	Edit default WordPress widgets
*/

function sunset_tag_cloud_font_change( $args)
{
	$args['smallest']	= 10;
	$args['largest']	= 10;

	return $args;
} 

add_filter( 'widget_tag_cloud_args', 'sunset_tag_cloud_font_change');

/*
	Save Posts View
*/
function sunset_save_post_views( $postID)
{
	$metaKey		= 'sunset_post_views';
	$views			= get_post_meta( $postID, $metaKey, true);

	$count			= ( empty($views) ? 0 : $views);
	$count++;

	update_post_meta( $postID, $metaKey, $count);
}

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


/*
	Popular Posts Widget
*/

class Sunset_Popular_Posts_Widget extends WP_Widget
{
	//Setup the widget name , description and etc ...
	public function __construct()
	{
		$widget_ops = array(
			'classname'		=> 'sunset-popular-posts-widget',
			'description'	=> 'Popular Posts Widget',
		);

		parent::__construct( 'sunset_popular_posts', 'Sunset Popular Posts', $widget_ops);
	}

	//back-end display of widget
	public function form( $instance)
	{
		$title		 = ( !empty( $instance['title'] ) ? $instance['title'] : "Popular Posts");
		$sum		 = ( !empty( $instance['sum'] ) ? absint( $instance['sum'] ) : 4 );

		$output		 = '<p>';
		$output		.= '<label for="'.esc_attr( $this->get_field_id('title') ).'">Title :</label>';
		$output		.= '<input type="text" class="widefat" id="'.esc_attr( $this->get_field_id('title')).'" name="'.esc_attr( $this->get_field_name('title') ).'" value="'.esc_attr($title).'">';
		$output		.= '</p>';
		
		$output		.= '<label for="'.esc_attr( $this->get_field_id('sum') ).'">Number of Posts :</label>';
		$output		.= '<input type="number" class="widefat" id="'.esc_attr( $this->get_field_id('sum')).'" name="'.esc_attr( $this->get_field_name('sum') ).'" value="'.esc_attr($sum).'">';
		$output		.= '</p>';

		echo $output;
	}

	//update widget
	public function update( $new_instance, $old_instance)
	{
		$instance			= array();
		$instance['title']	= ( !empty($new_instance['title']) ? strip_tags( $new_instance['title']): '');
		$instance['sum']	= ( !empty($new_instance['sum']) ? absint(strip_tags( $new_instance['sum'])): 0);

		return $instance;
	}

	//front-end of widget
	public function widget( $args, $instance)
	{
		$sum		= absint( $instance['sum']);

		$posts_args = array(
			'post_type'			=> 'post',
			'posts_per_page'	=> $sum,
			'meta_key'			=> 'sunset_post_views',
			'orderby'			=> 'meta_value_num',
			'order'				=> 'DESC'
		);

		$posts_query			= new WP_Query( $posts_args);

		echo $args['before_widget'];
			if( !empty( $instance['title'] ) ):
				echo $args['before_title'].apply_filters('widget_title', $instance['title']). $args['after_title'];
			endif;

			if( $posts_query->have_posts()):
				echo '<ul>';
					while($posts_query->have_posts()) : $posts_query->the_post();
						echo '<li>'.get_the_title().'</li>';
					endwhile;
				echo '</ul>';
			endif;
		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Sunset_Popular_Posts_Widget');
});