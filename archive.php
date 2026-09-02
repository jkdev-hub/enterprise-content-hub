<?php
/**
 * The template for displaying archive pages.
 *
 * @package Enterprise_Content_Hub
 */

get_header();
?>

<main id="primary" class="site-main">

	<div class="ech-container">
		<header class="archive-header">
			<h1 class="hero__title">
				<?php the_archive_title(); ?>
			</h1>
			<?php if ( get_the_archive_description() ) : ?>
				<div class="archive-description">
					<?php the_archive_description(); ?>
				</div>
			<?php endif; ?>
		</header>
		<?php if ( have_posts() ) { ?>
			<div class="content-list">
				<?php
				while ( have_posts() ) {
					the_post();

					get_template_part( 'template-parts/content' );
				} ?>
			</div>
			<?php get_template_part( 'template-parts/pagination' ); ?>
		<?php } else { ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php } ?>
	</div>

</main>
<?php
get_footer();