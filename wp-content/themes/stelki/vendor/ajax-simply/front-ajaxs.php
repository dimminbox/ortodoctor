<?php
/**
 * WordPress AJAX handler for the front-end
 */

define( 'DOING_AJAX', true );

// ! IMPORTANT: set correct path
require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';

send_origin_headers();

if ( empty( $_REQUEST['action'] ) )
	wp_die( '0', 400 );

@header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
@header( 'X-Robots-Tag: noindex' );

send_nosniff_header();
nocache_headers();

if ( is_user_logged_in() )
	$action = 'wp_ajax_' . $_REQUEST['action'];
else
	$action = 'wp_ajax_nopriv_' . $_REQUEST['action'];

if ( ! has_action( $action ) )
	wp_die( '0', 400 );

do_action( $action );

die( '0' );
