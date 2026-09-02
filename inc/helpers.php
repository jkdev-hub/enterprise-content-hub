<?php
/**
 * Theme helper functions.
 *
 * @package Enterprise_Content_Hub
 */

/**
 * Get estimated reading time for a post.
 *
 * @param int|null $post_id Post ID.
 * @return int
 */
function ech_get_reading_time( $post_id = null ) {

	$post_id = $post_id ? $post_id : get_the_ID();

	$content = get_post_field( 'post_content', $post_id );
	$content = wp_strip_all_tags( $content );

	$word_count   = str_word_count( $content );
	$reading_time = max( 1, (int) ceil( $word_count / 200 ) );

	return sprintf(
		_n(
			'%d min read',
			'%d mins read',
			$reading_time,
			'enterprise-content-hub'
		),
		$reading_time
	);
}