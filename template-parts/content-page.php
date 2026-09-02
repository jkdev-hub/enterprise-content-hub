<?php
/**
 * Template part for displaying a page.
 *
 * @package Enterprise_Content_Hub
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-content' ); ?>>
	<header class="page-content__header">
		<h1 class="page-content__title">
			<?php the_title(); ?>
		</h1>
	</header>

	<div class="page-content__body">
		<?php the_content(); ?>
	</div>
</article>