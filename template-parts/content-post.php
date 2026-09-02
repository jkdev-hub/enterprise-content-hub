<?php
/**
 * Template part for displaying a single post.
 *
 * @package Enterprise_Content_Hub
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-content' ); ?>>

	<header class="single-post__header">
		<p class="single-post__meta">
			<?php echo esc_html( get_the_date() ); ?>
		</p>

		<h1 class="single-post__title">
			<?php the_title(); ?>
		</h1>
	</header>

	<div class="single-post__content">
		<?php the_content(); ?>
	</div>

</article>