<?php
/**
 * Pagination template.
 *
 * @package Enterprise_Content_Hub
 */
?>

<?php
the_posts_pagination(
	array(
		'mid_size'  => 1,
		'prev_text' => esc_html__( 'Previous', 'enterprise-content-hub' ),
		'next_text' => esc_html__( 'Next', 'enterprise-content-hub' ),
	)
);
?>