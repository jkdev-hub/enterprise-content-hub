<?php
/**
 * Resource archive template.
 *
 * @package Enterprise_Content_Hub
 */

get_header();

$resource_topics = get_terms(
	array(
		'taxonomy'   => 'resource_topic',
		'hide_empty' => true,
	)
);

$current_page = max( 1, get_query_var( 'paged' ) ); ?>

<main id="primary" class="site-main">

	<section class="hero">
		<div class="ech-container">
			<header class="archive-header ech-pt-4">
				<h1 class="hero__title">
					<?php post_type_archive_title(); ?>
				</h1>
				<p class="hero__description">
					<?php
					esc_html_e(
						'Insights, guides, reports and resources for modern enterprises.',
						'enterprise-content-hub'
					); ?>
				</p>
			</header>
		</div>
	</section>

	<section class="listing_posts ech-pt-5 ech-pb-5">
		<div class="ech-container">
			<?php if ( ! empty( $resource_topics ) && ! is_wp_error( $resource_topics ) ) : ?>
				<div class="resource-filter">
					<label class="resource-filter__label" for="resource-topic-filter">
						<?php esc_html_e( 'Filter by topic', 'enterprise-content-hub' ); ?>
					</label>

					<select id="resource-topic-filter" class="resource-filter__select" data-resource-filter>
						<option value="all">
							<?php esc_html_e( 'All Topics', 'enterprise-content-hub' ); ?>
						</option>
						<?php foreach ( $resource_topics as $topic ) : ?>
							<option value="<?php echo esc_attr( $topic->slug ); ?>">
								<?php echo esc_html( $topic->name ); ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>
			<?php endif; ?>
			<div class="content-list" data-resource-list>
				<?php if ( have_posts() ) : ?>
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'resource' );
					endwhile; ?>
				<?php else : ?>
					<?php get_template_part( 'template-parts/content', 'none' ); ?>
				<?php endif; ?>
			</div>
			<div class="progress-loader" style="display: none;">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/progress-loader.svg' ); ?>" alt="Loading...">
			</div>
			<div data-resource-pagination>
				<?php
				get_template_part(
					'template-parts/ajax-pagination',
					null,
					array(
						'total'   => $wp_query->max_num_pages,
						'current' => $current_page,
					)
				);?>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();