<?php
/**
 * Page sidebar template
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */
?>

<?php
	$pid = get_option( 'woocommerce_shop_page_id' );
	$sidebar_position = get_post_meta( $pid, 'wpl_sidebar_position', true );
?>

<?php if ( $sidebar_position != 'disable') { ?>
	<div class="columns large-4 medium-12">
		<div class="sidebar">
			<div class="widgets">

				<?php
					$wpl_sidebar_select = get_post_meta( $pid, 'wpl_sidebar_select', true );

					if ( $wpl_sidebar_select == '' ) {
						$wpl_sidebar_select = 'shop-1';
					}

					dynamic_sidebar( $wpl_sidebar_select );
				?>

			</div><!-- /.widgets -->
		</div><!-- /.sidebar -->
	</div><!-- /.columns large-4 -->
<?php } ?>
