<?php

function upsell_products(){
	return get_post_meta(get_the_ID(), '_upsell_ids')[0];
}

function get_upsell_products( $limit = 4 ){
	$args = array();
	$args['orderby'] = 'rand';
	$args['post_type'] = 'product';
	$args['posts_per_page'] = $limit;
	$args['post__in'] = upsell_products();
	return $args;
}

function crosssell_products(){
	return get_post_meta(get_the_ID(), '_crosssell_ids')[0];
}

function get_crosssell_products( $limit = 4 ){
	$args = array();
	$args['orderby'] = 'rand';
	$args['post_type'] = 'product';
	$args['posts_per_page'] = $limit;
	$args['post__in'] = crosssell_products();
	return $args;
}

function viewed_products(){
	$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
	$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );
	return $viewed_products;
}

function get_viewed_products( $limit = 4 ){
	$args = array();
	$args['orderby'] = 'rand';
	$args['post_type'] = 'product';
	$args['posts_per_page'] = $limit;
	$args['post__in'] = viewed_products();
	return $args;
}

function related_products( $limit = 4 ){
	global $woocommerce;
	$id = get_the_ID();

	$tags_array = array(0);
	$cats_array = array(0);

	$terms = wp_get_post_terms($id, 'product_cat');
	foreach ( $terms as $term ) $cats_array[] = $term->term_id;

	if ( sizeof($cats_array)==1 && sizeof($tags_array)==1 ) return array();

	$meta_query = array();
	$meta_query[] = $woocommerce->query->visibility_meta_query();
	$meta_query[] = $woocommerce->query->stock_status_meta_query();

	$related_posts = get_posts( apply_filters('woocommerce_product_related_posts', array(
	'orderby' => 'rand',
	'posts_per_page' => $limit,
	'post_type' => 'product',
	'fields' => 'ids',
	'meta_query' => $meta_query,
	'tax_query' => array(
	'relation' => 'OR',
	array(
	'taxonomy' => 'product_cat',
	'field' => 'id',
	'terms' => $cats_array
	),
	array(
	'taxonomy' => 'product_tag',
	'field' => 'id',
	'terms' => $tags_array
	)
	)
	) ) );
	$related_posts = array_diff( $related_posts, array( $id ));
	return $related_posts;
}

function get_related_products( $limit = 4 ){
	$args = array();
	$args['orderby'] = 'rand';
	$args['post_type'] = 'product';
	$args['posts_per_page'] = $limit;
	$args['post__in'] = related_products($limit);
	return $args;
}

add_action('wp', 'login_redirect');
function login_redirect() {
	global $post;
	if(!is_user_logged_in() && ( $post->post_name === 'my-orders' || $post->post_name === 'my-data')) { wp_redirect( site_url().'/my-account' ); exit; }
}

add_action('template_redirect', 'head_hook');
function head_hook_(){
	if(WC()->cart->cart_contents_count != 0 && is_page('cart')){
		wp_redirect(home_url('/checkout'));
		exit();
	}
}

function get_product_variation_price($variation_id) {
	global $woocommerce;
	$product = new WC_Product_Variation($variation_id);
	return $product->get_price_html();
}

add_action('jx_update_user', 'update_user');
function update_user($jx){
		$user_id = wp_update_user( array(
			'ID' => get_current_user_id(),
			'first_name' => $jx->data['first_name'],
			'last_name' => $jx->data['last_name'],
			'user_email' => $jx->data['user_email'],
		));
	if(!is_wp_error($user_id)){
		$jx->script("$('[name=update_user]').siblings('.w-form-done').fadeIn().delay(3000).fadeOut();");
	} else {
		$jx->script("$('[name=update_user]').siblings('.w-form-fail').fadeIn().delay(3000).fadeOut();");
	}
}

add_action('jx_update_password', 'update_password');
function update_password($jx){
$user = get_userdata(get_current_user_id());
if($jx->data['password_1'] != $jx->data['password_2']){
	$jx->script("$('[name=update_password]').siblings('.w-form-fail').text('Ошибка! Пароли не одинаковы.').fadeIn().delay(3000).fadeOut();");
}elseif($jx->data['password_1'] === ''){
	$jx->script("$('[name=update_password]').siblings('.w-form-fail').text('Ошибка! Пароли не задан.').fadeIn().delay(3000).fadeOut();");
}elseif(!wp_check_password($jx->data['password_current'], $user->data->user_pass)){
	$jx->script("$('[name=update_password]').siblings('.w-form-fail').text('Ошибка! Текущий пароль указан не верно.').fadeIn().delay(3000).fadeOut();");
}else{
	wp_set_password($jx->data['password_1'], get_current_user_id());
	$jx->script("$('[name=update_password]').siblings('.w-form-done').fadeIn().delay(3000).fadeOut();");
}
}

add_action('jx_update_billing', 'update_billing');
function update_billing($jx){
	foreach($jx->data['form'] as $field => $value) update_user_meta(get_current_user_id(), $field, $value);
	$jx->script("$('[name=update_billing]').siblings('.w-form-done').fadeIn().delay(3000).fadeOut();");
}

add_action('jx_update_shipping', 'update_shipping');
function update_shipping($jx){
	foreach($jx->data['form'] as $field => $value) update_user_meta(get_current_user_id(), $field, $value);
	$jx->script("$('[name=update_shipping]').siblings('.w-form-done').fadeIn().delay(3000).fadeOut();");
}

add_action('pre_get_posts','custom_posts_per_page');
function custom_posts_per_page($query){
    if($_GET['perpage'] == ''){
    	if(get_query_var('posts_per_page') === get_option('posts_per_page')){
    		$query->set('posts_per_page', get_option('posts_per_page'));
    	}
    }else{
    	if(get_query_var('posts_per_page') === get_option('posts_per_page')){
    		$query->set('posts_per_page', $_GET['perpage']);
    	}
    }
}

add_action('jx_add_to_cart', 'add_to_cart');
function add_to_cart($jx){
	WC()->cart->add_to_cart($jx->data['id'], $jx->data['qty']);
  $jx->html('[data-wc=cart_count]', WC()->cart->cart_contents_count);
  $jx->html('[data-wc=cart_total]', WC()->cart->get_cart_total());
	ob_start(); get_template_part('mini_cart', '');
  $jx->html('[data-wc=mini_cart]', ob_get_clean());
	$jx->script('change_cart_qty();	remove_from_cart();');
}

add_action('jx_add_to_wl', 'add_to_wl');
function add_to_wl($jx){
	YITH_WCWL()->details['add_to_wishlist'] = $jx->data['id'];
  YITH_WCWL()->add();
  $jx->html('[data-wc=wl_count]', YITH_WCWL()->count_products());
}

add_action('jx_wl_remove', 'wl_remove');
function wl_remove($jx){
	$query_args[ 'is_default' ] = 1;
  $wishlist_items = YITH_WCWL()->get_products( $query_args );
  foreach ( $wishlist_items as $item ) {
    if(in_array($item['prod_id'], $jx->data['id'])){
      YITH_WCWL()->details['remove_from_wishlist'] = $item['prod_id'];
      YITH_WCWL()->remove();
    }
  }
	ob_start(); get_template_part('full_wishlist', '');
  $jx->html('[data-wc=full_wishlist]', ob_get_clean());
	$jx->script('wl_remove();wl_move();wl_copy();');
}

add_action('jx_wl_move', 'wl_move');
function wl_move($jx){
	$query_args[ 'is_default' ] = 1;
  $wishlist_items = YITH_WCWL()->get_products( $query_args );
  foreach ( $wishlist_items as $item ) {
    if(in_array($item['prod_id'], $jx->data['id'])){
			WC()->cart->add_to_cart($item['prod_id']);
      YITH_WCWL()->details['remove_from_wishlist'] = $item['prod_id'];
      YITH_WCWL()->remove();
    }
  }
	ob_start(); get_template_part('full_wishlist', '');
  $jx->html('[data-wc=full_wishlist]', ob_get_clean());

	$jx->html('[data-wc=cart_count]', WC()->cart->cart_contents_count);
  $jx->html('[data-wc=cart_total]', WC()->cart->get_cart_total());
	ob_start(); get_template_part('mini_cart', '');
  $jx->html('[data-wc=mini_cart]', ob_get_clean());
	$jx->script('wl_remove();wl_move();wl_copy();');
}

add_action('jx_wl_copy', 'wl_copy');
function wl_copy($jx){
	$jx->console($jx->data);
	$query_args[ 'is_default' ] = 1;
  $wishlist_items = YITH_WCWL()->get_products( $query_args );
  foreach ( $wishlist_items as $item ) {
    if(in_array($item['prod_id'], $jx->data['id'])){
			WC()->cart->add_to_cart($item['prod_id']);
    }
  }
	ob_start(); get_template_part('full_wishlist', '');
  $jx->html('[data-wc=full_wishlist]', ob_get_clean());

	$jx->html('[data-wc=cart_count]', WC()->cart->cart_contents_count);
  $jx->html('[data-wc=cart_total]', WC()->cart->get_cart_total());
	ob_start(); get_template_part('mini_cart', '');
  $jx->html('[data-wc=mini_cart]', ob_get_clean());
	$jx->script('wl_remove();wl_move();wl_copy();');
}

add_action('jx_change_cart_qty', 'change_cart_qty');
function change_cart_qty($jx){
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
    if($cart_item['variation_id'] == 0){ $product_id = $cart_item['product_id']; } else { $product_id = $cart_item['variation_id']; }
		if($product_id == $jx->data['id']){
      WC()->cart->set_quantity( $cart_item_key, $jx->data['qty'] );
    }
  }
  $jx->html('[data-wc=cart_count]', WC()->cart->cart_contents_count);
  $jx->html('[data-wc=cart_total]', WC()->cart->get_cart_total());
	ob_start(); get_template_part('full_cart', '');
  $jx->html('[data-wc=full_cart]', ob_get_clean());
	ob_start(); get_template_part('order_cart', '');
  $jx->html('[data-wc=order_cart]', ob_get_clean());
	ob_start(); get_template_part('mini_cart', '');
  $jx->html('[data-wc=mini_cart]', ob_get_clean());
	$jx->script('change_cart_qty();	remove_from_cart();');
}

add_filter( 'woocommerce_currencies', 'add_my_currency' );
function add_my_currency( $currencies ) {
     $currencies['RUB1'] = __( 'Российский рубль 1', 'woocommerce' );
     $currencies['RUB2'] = __( 'Российский рубль 2', 'woocommerce' );
     return $currencies;
}

add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);
function add_my_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'RUB1': $currency_symbol = 'Р.'; break;
          case 'RUB2': $currency_symbol = 'руб'; break;
      }
     return $currency_symbol;
}

?>
