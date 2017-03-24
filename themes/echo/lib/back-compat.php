<?php
/**
 * Echods back compat functionality
 *
 * Prevents Echods from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * @package WordPress
 * @subpackage Echods
 * @since Echods 1.0
 */

/**
 * Prevent switching to Echods on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Echods 1.0
 */
function echods_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'echods_upgrade_notice' );
}
add_action( 'after_switch_theme', 'echods_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Echods on WordPress versions prior to 4.4.
 *
 * @since Echods 1.0
 *
 * @global string $wp_version WordPress version.
 */
function echods_upgrade_notice() {
	$message = sprintf( __( 'Echods requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'echods' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @since Echods 1.0
 *
 * @global string $wp_version WordPress version.
 */
function echods_customize() {
	wp_die( sprintf( __( 'Echods requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'echods' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'echods_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @since Echods 1.0
 *
 * @global string $wp_version WordPress version.
 */
function echods_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Echods requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'echods' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'echods_preview' );
