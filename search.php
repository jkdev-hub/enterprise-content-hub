<?php
/**
 * The template for displaying search results.
 *
 * @package Enterprise_Content_Hub
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="ech-container search-page">
		<header class="search-page__header">
			<h1 class="hero__title">
				<?php
				printf(
					esc_html__( 'Search results for: %s', 'enterprise-content-hub' ),
					esc_html( get_search_query() )
				); ?>
			</h1>
		</header>

		<?php if ( have_posts() ) { ?>
			<div class="content-list">
				<?php
				while ( have_posts() ) {
					the_post();

					get_template_part( 'template-parts/content' );
				} ?>
			</div>
		<?php } else { ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php } ?>
	</div>
</main>

<?php
get_footer();