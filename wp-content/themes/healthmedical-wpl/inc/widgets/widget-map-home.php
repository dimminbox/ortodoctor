<?php
/**
 * A Google Map & address frontpage widget.
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.5
 */

add_action('widgets_init', function(){return register_widget("WPlook_Map_Home_Widget");});
class WPlook_Map_Home_Widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/

	public function __construct() {
		parent::__construct(
	 		'wplook_map_home_widget',
			__( 'WPlook Map (Front page)', 'healthmedical-wpl' ),
			array( 'description' => __( 'Display a Google Map and an address on the home page.', 'healthmedical-wpl' ), )
		);
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/

	public function form( $instance ) {

		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		$subtitle = isset( $instance[ 'subtitle' ] ) ? $instance[ 'subtitle' ] : '';
		$icon = isset( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : 'icon-medical-hospital';
		$address = isset( $instance[ 'address' ] ) ? $instance[ 'address' ] : '';
		$coordinates = isset( $instance[ 'coordinates' ] ) ? $instance[ 'coordinates' ] : '';
		$phone = isset( $instance[ 'phone' ] ) ? $instance[ 'phone' ] : '';
		$email = isset( $instance[ 'email' ] ) ? $instance[ 'email' ] : '';
		?>

			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'healthmedical-wpl'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle:', 'healthmedical-wpl'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
			</p>

			<div class="icon-picker-parent">

				<p>
					<label for="<?php echo $this->get_field_id('icon'); ?>"> <?php _e('Icon:', 'healthmedical-wpl'); ?> </label>
					<input class="widefat icon-picker-input" id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo esc_attr( $icon ); ?>" />
				</p>

				<?php echo wplook_return_icon_picker( wplook_return_medical_icon_array(), $icon, 'widget_editor' ); ?>

			</div>

			<p>
				<label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'healthmedical-wpl'); ?></label>
				<textarea cols="25" rows="4" class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text"><?php echo $address; ?></textarea>
				<span style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"><?php _e( 'Use this field to enter an address which will be used for the map, as well as displayed to the user.', 'healthmedical-wpl' ); ?></span>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('coordinates'); ?>"><?php _e('Coordinates:', 'healthmedical-wpl'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('coordinates'); ?>" name="<?php echo $this->get_field_name('coordinates'); ?>" type="text" value="<?php echo esc_attr( $coordinates ); ?>" />
				<span style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"><?php _e( 'If the pin on the map doesn\'t appear correctly based on the Address field, you can enter an alternative address or a set of coordinates here. This field is not required.', 'healthmedical-wpl' ); ?></span>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone number:', 'healthmedical-wpl'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email address:', 'healthmedical-wpl'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />
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
		$instance['address'] = wp_kses_data(wpautop($new_instance['address']));
		$instance['coordinates'] = sanitize_text_field($new_instance['coordinates']);
		$instance['phone'] = sanitize_text_field($new_instance['phone']);
		$instance['email'] = sanitize_text_field($new_instance['email']);

		return $instance;
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$subtitle = empty( $instance['subtitle'] ) ? '' : $instance['subtitle'];
		$icon = isset( $instance['icon'] ) ? esc_attr( $instance['icon'] ) : '';
		$address = apply_filters( 'widget_text', empty( $instance['address'] ) ? '' : $instance['address'], $instance );
		$coordinates = empty( $instance['coordinates'] ) ? '' : $instance['coordinates'];
		$phone = empty( $instance['phone'] ) ? '' : $instance['phone'];
		$email = empty( $instance['email'] ) ? '' : $instance['email'];

		echo $before_widget;
	?>
		<div class="section-map">
				<?php if( $address ) {
					$options = array(
						'api_key' => ot_get_option( 'wpl_maps_api_server_key' ),
					);

					$maps = new WPlook_Google_Maps( $options );

					$maps->generate_map( array(
						'maps_address' => $coordinates ? $coordinates : $address,
						'snazzymaps' => $this->snazzymaps(),
						// 'offsetX' => '-70%'
					) );
				} ?>

			<div class="row">
				<?php if( $icon ) : ?>
					<div class="section-ribbon">
						<i class="<?php echo esc_attr($icon); ?>"></i>
					</div><!-- /.section-ribbon -->
				<?php endif; ?>

				<div class="columns large-4 medium-6 small-12">
					<section class="section-map-address">
						<h2 class="title"><?php echo esc_attr( $title ); ?></h2>
						<h6 class="subtitle"><?php echo esc_attr( $subtitle ); ?></h6>

						<div class="address"><?php echo wpautop( $address ); ?></div>

						<p class="contact-phone">
							<a href="tel:<?php echo esc_attr( $phone ); ?>">
								<i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_attr( $phone ); ?>
							</a>
						</p>
						<p class="contact-email">
							<a href="mailto:<?php echo esc_attr( $email ); ?>">
								<i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo esc_attr( $email ); ?>
							</a>
						</p>
					</section><!-- /.section-about-us -->
				</div><!-- /.columns .large-6 -->
			</div>
		</div>
	<?php echo $after_widget;

	}

	private function snazzymaps() {
		ob_start(); ?>
		[
		    {
		        "featureType": "all",
		        "stylers": [
		            {
		                "saturation": 0
		            },
		            {
		                "hue": "#e7ecf0"
		            }
		        ]
		    },
		    {
		        "featureType": "road",
		        "stylers": [
		            {
		                "saturation": -70
		            }
		        ]
		    },
		    {
		        "featureType": "transit",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    },
		    {
		        "featureType": "poi",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    },
		    {
		        "featureType": "water",
		        "stylers": [
		            {
		                "visibility": "simplified"
		            },
		            {
		                "saturation": -60
		            }
		        ]
		    }
		]
		<?php return ob_get_clean();
	}
}

?>
