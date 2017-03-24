<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Echods
 * @since Echods 1.0
 */
?>

	</div><!-- .container-fluid -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'echods' ); ?>">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class'     => 'primary-menu',
					 ) );
				?>
			</nav><!-- .main-navigation -->
		<?php endif; ?>

		<?php if ( has_nav_menu( 'social' ) ) : ?>
			<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'echods' ); ?>">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
					) );
				?>
			</nav><!-- .social-navigation -->
		<?php endif; ?>

		<div class="site-info">
			<?php
				/**
				 * Fires before the echods footer text for footer customization.
				 *
				 * @since Echods 1.0
				 */
				do_action( 'echods_credits' );
			?>
			<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->

<?php wp_footer(); ?>
</body>
</html>