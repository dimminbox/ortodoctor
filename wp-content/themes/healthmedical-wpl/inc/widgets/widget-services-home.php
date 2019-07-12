<?php
/*
 * Plugin Name: Services
 * Plugin URI: https://www.wplook.com
 * Description: Add Services to the home page
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: https://www.wplook.com
*/

add_action('widgets_init', function(){return register_widget("wplook_services_widget");});
class wplook_services_widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/

	public function __construct() {
		parent::__construct(
	 		'wplook_services_widget',
			__( 'WPlook Services (Front page)', 'healthmedical-wpl' ),
			array( 'description' => __( 'A widget for displaying Services on the front page', 'healthmedical-wpl' ), )
		);
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/

	public function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
		}
		else {
			$title = __( 'Our services', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$subtitle = esc_attr( $instance[ 'subtitle' ] );
		}
		else {
			$subtitle = __( 'Services at a glance', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$icon = esc_attr( $instance[ 'icon' ] );
		}
		else {
			$icon = __( '', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$description = esc_attr( $instance[ 'description' ] );
		}
		else {
			$description = __( '', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$link = esc_url( $instance[ 'link' ] );
		}
		else {
			$link = __( '', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$linktext = esc_attr( $instance[ 'linktext' ] );
		}
		else {
			$linktext = __( 'Find out more', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$categories = esc_attr( $instance[ 'categories' ] );
		}
		else {
			$categories = __( 'All', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$nr_posts = esc_attr( $instance[ 'nr_posts' ] );
		}
		else {
			$nr_posts = __( '10', 'healthmedical-wpl' );
		}

		if ( $instance ) {
			$display_type = esc_attr( $instance[ 'display_type' ] );
		}
		else {
			$display_type = 'latest';
		}
		?>

			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('subtitle'); ?>"> <?php _e('Subtitle:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo $subtitle; ?>" />
			</p>

			<div class="icon-picker-parent">

				<p>
					<label for="<?php echo $this->get_field_id('icon'); ?>"> <?php _e('Icon:', 'healthmedical-wpl'); ?> </label>
					<input class="widefat icon-picker-input" id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo $icon; ?>" />
				</p>

				<?php echo wplook_return_icon_picker( wplook_return_medical_icon_array(), $icon, 'widget_editor' ); ?>

			</div>

			<p>
				<label for="<?php echo $this->get_field_id('description'); ?>"> <?php _e('Description:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" type="text" value="<?php echo $description; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:', 'healthmedical-wpl'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="url" value="<?php echo $link; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('linktext'); ?>"><?php _e('Link text:', 'healthmedical-wpl'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('linktext'); ?>" name="<?php echo $this->get_field_name('linktext'); ?>" type="text" value="<?php echo $linktext; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('categories'); ?>">
					<?php _e('Category:', 'healthmedical-wpl'); ?>
					<br />
				</label>

				<?php wp_dropdown_categories(
					array(
						'name'	=> $this->get_field_name("categories"),
						'show_option_all'    => __('All', 'healthmedical-wpl'),
						'show_count'	=> 1,
						'selected' => $categories,
						'taxonomy'  => 'wpl_services_category'
					)
				); ?>

			</p>

			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of posts:', 'healthmedical-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The number of posts you want to display.', 'healthmedical-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('display_type'); ?>"> <?php _e('Order by:', 'healthmedical-wpl'); ?> <br /> </label>
				<select id="<?php echo $this->get_field_id('display_type'); ?>" name="<?php echo $this->get_field_name('display_type'); ?>">
					<option value="random" <?php selected( 'random', $display_type ); ?>><?php _e('Random', 'healthmedical-wpl'); ?></option>
					<option value="latest" <?php selected( 'latest', $display_type ); ?>><?php _e('Latest', 'healthmedical-wpl'); ?></option>
				</select>
			</p>

		<?php
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['subtitle'] = sanitize_text_field($new_instance['subtitle']);
		$instance['icon'] = sanitize_text_field($new_instance['icon']);
		$instance['description'] = sanitize_text_field($new_instance['description']);
		$instance['link'] = sanitize_text_field($new_instance['link']);
		$instance['linktext'] = sanitize_text_field($new_instance['linktext']);
		$instance['categories'] = sanitize_text_field($new_instance['categories']);
		$instance['nr_posts'] = sanitize_text_field($new_instance['nr_posts']);
		$instance['display_type'] = sanitize_text_field($new_instance['display_type']);
		return $instance;
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );

		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$subtitle = isset( $instance['subtitle'] ) ? esc_attr( $instance['subtitle'] ) : '';
		$icon = isset( $instance['icon'] ) ? esc_attr( $instance['icon'] ) : '';
		$description = isset( $instance['description'] ) ? esc_attr( $instance['description'] ) : '';
		$link = apply_filters( 'widget_text', empty( $instance['link'] ) ? '' : $instance['link'], $instance );
		$linktext = apply_filters( 'widget_text', empty( $instance['linktext'] ) ? '' : $instance['linktext'], $instance );
		$categories = isset( $instance['categories'] ) ? esc_attr( $instance['categories'] ) : '';
		$nr_posts = isset( $instance['nr_posts'] ) ? esc_attr( $instance['nr_posts'] ) : '';
		$display_type = isset( $instance['display_type'] ) ? esc_attr( $instance['display_type'] ) : '';
		?>

		<?php
			if ( $categories < '1' ) {
				if ( $display_type == 'random') {
					$args = array(
						'post_type' => 'wpl_post_services',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts,
						'orderby' => 'rand'
					);
				} else {
					$args = array(
						'post_type' => 'wpl_post_services',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts
					);
				}
			} else {
				if ( $display_type == 'random') {
					$args = array(
						'post_type' => 'wpl_post_services',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts,
						'orderby' => 'rand',
						'tax_query' => array(
							array(
								'taxonomy' => 'wpl_services_category',
								'field' => 'id',
								'terms' => $categories
							)
						)
					);
				} else {
					$args = array(
						'post_type' => 'wpl_post_services',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts,
						'tax_query' => array(
							array(
								'taxonomy' => 'wpl_services_category',
								'field' => 'id',
								'terms' => $categories
							)
						)
					);
				}
			}

			$services = null;
			$services = new WP_Query( $args );
		?>

			<?php if( $services->have_posts() ) : ?>

				<?php echo $before_widget; ?>
			<div class="section-services-bg">
				<div class="row">
					<?php if($icon) { ?>
						<div class="section-ribbon">
							<i class="<?php echo esc_attr($icon); ?>"></i>
						</div><!-- /.section-ribbon -->
					<?php } ?>
					<div class="columns large-12 medium-12">
						<section class="section-features">
							<h2>Преимущества Формтотикс</h2>
							<div style="height: 30px;"></div>
								<ul class="list-features small-block-grid-1 medium-block-grid-2 large-block-grid-3">
									<li>
										<p class="service-title" itemprop="name">Удобство и комфорт</p>
										<div class="service-image"><img src="/wp-content/uploads/2019/07/comfort.jpg" /></div>
										<p>При повседневной ходьбе наши стельки разгрузят стопу и вы будете с комфортом проводить время.</p>
									</li>
									
									<li>
										<p class="service-title" itemprop="name">Безопасность</p>
										<div class="service-image"><img src="/wp-content/uploads/2019/07/safity.jpg" /></div>
										<p>При занятиях спортом и туризмом стельки за счёт более точного контроля движений, снизят риск травм и помогут улучшить результаты.</p>
									</li>
									
									<li>
										<p class="service-title" itemprop="name">Качество</p>
										<div class="service-image"><img src="/wp-content/uploads/2019/07/quality.jpg" /></div>
										<p>Технология Formotics из Новой Зеландии развивается уже более 40 лет, помогая людям по всему миру. Стельки при правильном обращении смогут выполнять свои функции более 5 лет.</p>
									</li>
								</ul>
							</div>
						</section><!-- /.section-features -->
					</div><!-- /.columns .large-6 -->
				</div>
			</div>
			<?php echo $after_widget; ?>

			<?php endif; ?>
		<?php
	}
}
?>
