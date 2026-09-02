<?php
/**
 * The template for displaying pages.
 *
 * @package Enterprise_Content_Hub
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="ech-container">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();

				get_template_part( 'template-parts/content', 'page' );
			}
		}
		?>
	</div>
</main>

<?php
get_footer();