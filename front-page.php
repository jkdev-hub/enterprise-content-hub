<?php
/**
 * Front page template.
 *
 * @package Enterprise_Content_Hub
 */

get_header();
?>
<?php
$hero_banner     = get_field( 'hero_banner' );
$hero_sub_heading = $hero_banner['hero_sub_heading'] ?? '';
$hero_heading     = $hero_banner['hero_heading'] ?? '';
$hero_content     = $hero_banner['hero_content'] ?? '';
$hero_link        = $hero_banner['hero_cta_button'] ?? [];

$articles             = get_field( 'articles' );
$articles_sub_heading = $articles['articles_sub_heading'] ?? '';
$articles_heading     = $articles['articles_heading'] ?? '';
$articles_cta_button  = $articles['articles_cta_button'] ?? [];

$resources             = get_field( 'resources' );
$resources_sub_heading = $resources['resources_sub_heading'] ?? '';
$resources_heading     = $resources['resources_heading'] ?? '';
$resources_cta_button  = $resources['resources_cta_button'] ?? [];

$cta_banner      = get_field( 'cta_banner' );
$cta_sub_heading = $cta_banner['cta_sub_heading'] ?? '';
$cta_heading     = $cta_banner['cta_heading'] ?? '';
$cta_content     = $cta_banner['cta_content'] ?? '';
$cta_button      = $cta_banner['cta_button'] ?? [];
$cta_bg_image    = $cta_banner['cta_bg_image'] ?? '';

$cta_style = '';

if ( ! empty( $cta_bg_image ) ) {
	$cta_style = 'background-image: url(' . $cta_bg_image . ');';
}
?>

<main id="primary" class="site-main">

	<section class="hero">
		<div class="ech-container">
			<div class="hero__content">
				<?php if ( ! empty( $hero_sub_heading ) ) : ?>
					<p class="hero__eyebrow">
						<?php echo esc_html( $hero_sub_heading ); ?>
					</p>
				<?php endif; ?>
				<?php if ( ! empty( $hero_heading ) ) : ?>
					<h1 class="hero__title">
						<?php echo esc_html( $hero_heading ); ?>
					</h1>
				<?php endif; ?>
				<?php if ( ! empty( $hero_content ) ) : ?>
					<p class="hero__description">
						<?php echo wp_kses_post( $hero_content ); ?>
					</p>
				<?php endif; ?>
				<?php if ( ! empty( $hero_link['url'] ) ) : ?>
					<a class="btn btn--primary ech-mt-4" href="<?php echo esc_url( $hero_link['url'] ); ?>"
						target="<?php echo esc_attr( ! empty( $hero_link['target'] ) ? $hero_link['target'] : '_self' ); ?>">
						<?php echo esc_html( $hero_link['title'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<?php 
	$latest_articles = new WP_Query(
		array(
			'post_type'           => 'post',
			'posts_per_page'      => 3,
			'ignore_sticky_posts' => true,
			'post_status'         => 'publish',
		)
	); ?>

	<?php if ( $latest_articles->have_posts() ) : ?>
		<section id="latest-articles" class="latest-articles ech-pt-5 ech-pb-5">
			<div class="ech-container">
				<div class="section-header">
					<div class="section-heading">
						<?php if ( ! empty( $articles_sub_heading ) ) : ?>
							<p class="section-heading__eyebrow">
								<?php echo esc_html( $articles_sub_heading ); ?>
							</p>
						<?php endif; ?>
						<?php if ( ! empty( $articles_heading ) ) : ?>
							<h2 class="section-heading__title">
								<?php echo esc_html( $articles_heading ); ?>
							</h2>
						<?php endif; ?>
					</div>
					<?php if ( ! empty( $articles_cta_button['url'] ) ) : ?>
						<div class="section-actions">
							<a class="btn btn--primary" href="<?php echo esc_url( $articles_cta_button['url'] ); ?>"
								target="<?php echo esc_attr( ! empty( $articles_cta_button['target'] ) ? $articles_cta_button['target'] : '_self' ); ?>">
								<?php echo esc_html( $articles_cta_button['title'] ); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>
				<div class="content-list">
					<?php
					while ( $latest_articles->have_posts() ) :
						$latest_articles->the_post();

						get_template_part( 'template-parts/content' );

					endwhile; ?>
				</div>

			</div>
		</section>

		<?php wp_reset_postdata(); ?>

	<?php endif; ?>

	<?php
	$featured_resources = new WP_Query(
		array(
			'post_type'      => 'resource',
			'posts_per_page' => 3,
			'post_status'    => 'publish',
			'meta_query'     => array(
				array(
					'key'     => 'featured_resource',
					'value'   => '1',
					'compare' => '=',
				),
			),
		)
	);
	?>

	<?php if ( $featured_resources->have_posts() ) : ?>

		<section id="featured-resources" class="featured-resources content-section ech-pb-5">
			<div class="ech-container">
				<div class="section-header">
					<div class="section-heading">
						<?php if ( ! empty( $resources_sub_heading ) ) : ?>
							<p class="section-heading__eyebrow">
								<?php echo esc_html( $resources_sub_heading ); ?>
							</p>
						<?php endif; ?>

						<?php if ( ! empty( $resources_heading ) ) : ?>
							<h2 class="section-heading__title">
								<?php echo esc_html( $resources_heading ); ?>
							</h2>
						<?php endif; ?>
					</div>
					<?php if ( ! empty( $resources_cta_button['url'] ) ) : ?>
						<div class="section-actions">
							<a class="btn btn--primary" href="<?php echo esc_url( $resources_cta_button['url'] ); ?>"
								target="<?php echo esc_attr( ! empty( $resources_cta_button['target'] ) ? $resources_cta_button['target'] : '_self' ); ?>">
								<?php echo esc_html( $resources_cta_button['title'] ); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>

				<div class="content-list">
					<?php
					while ( $featured_resources->have_posts() ) :
						$featured_resources->the_post();
						get_template_part( 'template-parts/content', 'resource' );
					endwhile; ?>
				</div>
			</div>
		</section>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>

	<section id="cta-banner" class="cta-section" <?php if ( ! empty( $cta_style ) ) : ?> style="<?php echo esc_attr( $cta_style ); ?>" <?php endif; ?>>
		<div class="ech-container">
			<div class="cta-section__content">
				<?php if ( ! empty( $cta_sub_heading ) ) : ?>
					<p class="cta-section__sub-heading">
						<?php echo esc_html( $cta_sub_heading ); ?>
					</p>
				<?php endif; ?>
				<?php if ( ! empty( $cta_heading ) ) : ?>
					<h2 class="cta-section__heading">
						<?php echo esc_html( $cta_heading ); ?>
					</h2>
				<?php endif; ?>
				<?php if ( ! empty( $cta_content ) ) : ?>
					<div class="cta-section__description">
						<?php echo wp_kses_post( $cta_content ); ?>
					</div>
				<?php endif; ?>
				<?php
				if (! empty( $cta_button['url'] )) :?>
					<a class="btn btn--primary"
						href="<?php echo esc_url( $cta_button['url'] ); ?>" target="<?php echo esc_attr( ! empty( $cta_button['target'] ) ? $cta_button['target'] : '_self' ); ?>">
						<?php echo esc_html( $cta_button['title'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();