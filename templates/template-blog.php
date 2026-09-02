<?php
/**
 * Template Name: Blog
 *
 * A selectable page template for the blog post listing.
 *
 * @package Enterprise_Content_Hub
 */

get_header();

$blog_categories = get_categories(
	array(
		'hide_empty' => true,
	)
);

$paged = max( 1, get_query_var( 'paged' ) );

$blog_query = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => get_option( 'posts_per_page' ),
		'paged'               => $paged,
		'ignore_sticky_posts' => true,
	)
);
?>

<main id="primary" class="site-main">
	<section class="hero">
		<div class="ech-container">
			<header class="archive-header ech-pt-4">
				<h1 class="hero__title">
					<?php the_title(); ?>
				</h1>
			</header>
		</div>
	</section>
	<section class="listing_posts ech-pt-5 ech-pb-5">
		<div class="ech-container">
			<div class="filterable-list" data-filter-list data-action="ech_filter_posts" data-param="category">

				<?php if ( ! empty( $blog_categories ) && ! is_wp_error( $blog_categories ) ) : ?>
					<div class="archive-filter">
						<label class="archive-filter__label" for="blog-category-filter">
							<?php esc_html_e( 'Filter by category', 'enterprise-content-hub' ); ?>
						</label>
						<select id="blog-category-filter" class="archive-filter__select" data-filter-select>
							<option value="all">
								<?php esc_html_e( 'All Categories', 'enterprise-content-hub' ); ?>
							</option>
							<?php foreach ( $blog_categories as $category ) : ?>
								<option value="<?php echo esc_attr( $category->slug ); ?>">
									<?php echo esc_html( $category->name ); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
				<?php endif; ?>

				<div class="content-list" data-filter-results data-page="<?php echo esc_attr( $paged ); ?>">
					<?php if ( $blog_query->have_posts() ) : ?>
						<?php
						while ( $blog_query->have_posts() ) :
							$blog_query->the_post();

							get_template_part( 'template-parts/content' );

						endwhile; ?>
					<?php else : ?>
						<?php get_template_part( 'template-parts/content', 'none' ); ?>
					<?php endif; ?>
				</div>
				<div class="progress-loader" style="display: none;">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/progress-loader.svg' ); ?>" alt="Loading...">
				</div>
				<div data-filter-pagination>
					<?php
					get_template_part(
						'template-parts/ajax-pagination',
						null,
						array(
							'total'   => $blog_query->max_num_pages,
							'current' => $paged,
						)
					);?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
wp_reset_postdata();

get_footer();