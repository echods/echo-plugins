<?php
/**
 * The template part for displaying a header theme image
 *
 * @package WordPress
 * @subpackage Echods
 * @since Echods 1.0
 */
?>
<header id="masthead" class="site-header" role="banner">
    <?php
        /**
         * Filter the default echods custom header sizes attribute.
         *
         * @since Echods 1.0
         *
         * @param string $custom_header_sizes sizes attribute
         * for Custom Header. Default '(max-width: 709px) 85vw,
         * (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px'.
         */
        $custom_header_sizes = apply_filters( 'echods_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px' );
    ?>
    <div class="header-image">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
        </a>
    </div><!-- .header-image -->
</header><!-- .site-header -->