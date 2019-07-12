<?php
/**
 * The header template file
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
	<meta http-equiv="x-ua-compatible" content="IE=edge" >
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="wrapper">
	<header class="header">
		

		<div class="row">
			<div class="columns large-3 medium-12">
				<?php if ( ot_get_option('wpl_logo') ) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
						<img src="<?php echo esc_url(ot_get_option('wpl_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>">
					</a>
				<?php } else { ?>
				<div class="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('description'); ?>"><h3><?php bloginfo('name'); ?></h3></a>
				</div>
				<?php } ?>
			</div><!-- /.columns large-3 -->

			<div class="columns large-7 medium-8">
				<a href="#" class="btn-menu">
					<span></span>
				</a>

				<?php if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container' => 'nav',
						'container_class' => 'nav',
						'menu_class' => 'clearfix',
						'menu_id' => '',
						'walker' => new wplook_Page_Navigation_Walker(),
						'depth' => '4'
						)
					);
				} ?><!-- /.nav -->
			</div><!-- /.columns large-6 -->

			<?php if ( ot_get_option('wpl_phone_number') != "") { ?>
				<div class="columns large-2 medium-4">
					<div class="phone">
						<i class="fa fa-mobile"></i>
						<small><?php _e('Телефон', 'healthmedical-wpl'); ?></small>
						<a href="tel:<?php echo esc_attr('+79209771661'); ?>"><?php echo esc_attr('+79209771661'); ?></a>
					</div><!-- /.phone -->
				</div><!-- /.columns large-3 -->
			<?php } ?>
		</div><!-- /.row -->
	</header><!-- /.header -->
