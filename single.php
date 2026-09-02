<?php
/**
 * The template for displaying single posts.
 *
 * @package Enterprise_Content_Hub
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); ?>
			<article <?php post_class( 'resource-single' ); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="single-post__hero">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>

				<div class="ech-container">
					<div class="single-post__body">
						<div class="post-single__meta">
							<span>
								<?php echo esc_html( get_the_date() ); ?>
							</span>
							<span>
								<?php echo esc_html( ech_get_reading_time() ); ?>
							</span>
						</div>
						<h1 class="post-single__title">
							<?php the_title(); ?>
						</h1>
						<div class="post-single__content">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</article>
		<?php }
	} ?>
</main>

<?php
get_footer();