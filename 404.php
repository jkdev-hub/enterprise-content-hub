<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Enterprise_Content_Hub
 */

get_header();
?>
<?php 
$home_page_id = get_option( 'page_on_front' );
$cta_banner      = get_field( 'cta_banner', $home_page_id);
$cta_sub_heading = $cta_banner['cta_sub_heading'] ?? [];
$cta_heading     = $cta_banner['cta_heading'] ?? [];
$cta_content     = $cta_banner['cta_content'] ?? [];
$cta_button      = $cta_banner['cta_button'] ?? [];
$cta_bg_image    = $cta_banner['cta_bg_image'] ?? [];

$cta_style = '';

if ( ! empty( $cta_bg_image ) ) {
	$cta_style = 'background-image: url(' . $cta_bg_image . ');';
} ?>

<main id="primary" class="site-main">
	<section class="error-hero no-content">
		<div class="ech-container">
			<header class="no-content__header">
				<h1 class="no-content__title">
					<?php esc_html_e( 'Page not found', 'enterprise-content-hub' ); ?>
				</h1>
			</header>
			<div class="no-content__message">
				<p>
					<?php esc_html_e( 'The page you are looking for does not exist or may have been moved. Try a search below.', 'enterprise-content-hub' ); ?>
				</p>
			</div>
			<div class="section-actions ech-pt-4">
				<a class="btn btn--primary" href="<?php echo home_url( '/resources/' ); ?>" target="_self">
					<?php esc_html_e( 'See All Resources', 'enterprise-content-hub' ); ?>
				</a>
			</div>
		</div>
	</section>

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
