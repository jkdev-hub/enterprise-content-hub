<?php
/**
 * Resource card template.
 *
 * @package Enterprise_Content_Hub
 */
?>

<article <?php post_class( 'content-card' ); ?>>

	<?php if ( has_post_thumbnail() ) { ?>
		<div class="content-card__image">
			<?php if ( get_field( 'featured_resource' ) ) : ?>
				<span class="content-card__featured">
					<?php esc_html_e( 'Featured', 'enterprise-content-hub' ); ?>
				</span>
			<?php endif; ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php
				the_post_thumbnail(
					'medium_large',
					array(
						'class' => 'content-card__thumbnail',
					)
				); ?>
			</a>
		</div>
	<?php } ?>

	<div class="content-card__content">

		<header class="content-card__header">

			<div class="content-card__meta">
				<p class="content-card__date">
					<?php echo esc_html( get_the_date() ); ?>
				</p>
				<p class="content-card__reading-time">
					<?php echo esc_html( ech_get_reading_time() ); ?>
				</p>
			</div>
			<h2 class="content-card__title">
				<a href="<?php echo esc_url( get_permalink() ); ?>">
					<?php the_title(); ?>
				</a>
			</h2>

		</header>

		<div class="content-card__excerpt">
			<?php the_excerpt(); ?>
		</div>

		<a class="btn btn--link" href="<?php echo esc_url( get_permalink() ); ?>">
			<?php esc_html_e( 'Read more', 'enterprise-content-hub' ); ?>
		</a>

	</div>

</article>