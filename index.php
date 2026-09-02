<?php
/**
 * The main template file.
 *
 * @package Enterprise_Content_Hub
 */

get_header();
?>

<main id="primary" class="site-main">

	<div class="ech-container">
		<?php $posts_page_id = get_option( 'page_for_posts' );

		if ( $posts_page_id ) : ?>
			<header class="archive-header ech-mt-4">
				<h1 class="archive-title">
					<?php echo esc_html( get_the_title( $posts_page_id ) ); ?>
				</h1>
			</header>
			<?php
		endif; ?>
		<?php if ( have_posts() ) { ?>

			<div class="content-list ech-mt-4">

				<?php
				while ( have_posts() ) {
					the_post();

					get_template_part( 'template-parts/content' );
				}
				?>

			</div>

			<?php get_template_part( 'template-parts/pagination' ); ?>

		<?php } else { ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php } ?>

	</div>

</main>

<?php
get_footer();