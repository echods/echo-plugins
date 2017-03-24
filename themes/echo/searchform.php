<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * @package WordPress
 * @subpackage Echo
 * @since Echo 1.0
 */
?>

<form role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="form-inline">
	<div class="form-group">
	    <label for="search" class="sr-only">Search in <?php echo home_url( '/' ); ?></label>
	    <input type="text" name="s" class="form-control input-lg" id="search" value="<?php the_search_query(); ?>" />
	</div>

    <button type="submit" class="btn btn-pill btn-lg">Search</button>
</form>