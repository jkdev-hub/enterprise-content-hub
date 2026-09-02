<?php
/**
 * Search form template.
 *
 * @package Enterprise_Content_Hub
 */
?>

<form role="search" method="get" class="site-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="site-search-field">
		<?php esc_html_e( 'Search for:', 'enterprise-content-hub' ); ?>
	</label>

	<input type="search"
		id="site-search-field"
		class="site-search__field"
		placeholder="<?php esc_attr_e( 'Search content...', 'enterprise-content-hub' ); ?>"
		value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	<button type="submit" class="site-search__submit">
		<?php esc_html_e( 'Search', 'enterprise-content-hub' ); ?>
	</button>
</form>