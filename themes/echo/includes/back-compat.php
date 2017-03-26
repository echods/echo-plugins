<?php
/**
 * Echo back compat functionality
 *
 * Prevents Echo from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package WordPress
 * @subpackage Echo
 * @since Echo 1.0
 */

/**
 * Prevent switching to Echo on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Echo 1.0
 */
function echo_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'echo_upgrade_notice' );
}
add_action( 'after_switch_theme', 'echo_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Echo on WordPress versions prior to 4.7.
 *
 * @since Echo 1.0
 *
 * @global string $wp_version WordPress version.
 */
function echo_upgrade_notice() {
	$message = sprintf( __( 'Echo requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'twentyseventeen' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since Echo 1.0
 *
 * @global string $wp_version WordPress version.
 */
function echo_customize() {
	wp_die( sprintf( __( 'Echo requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'twentyseventeen' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'echo_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since Echo 1.0
 *
 * @global string $wp_version WordPress version.
 */
function echo_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Echo requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'twentyseventeen' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'echo_preview' );