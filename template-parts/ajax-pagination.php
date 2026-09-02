<?php
/**
 * AJAX pagination template.
 *
 * @package Enterprise_Content_Hub
 */

$total   = isset( $args['total'] ) ? absint( $args['total'] ) : 1;
$current = isset( $args['current'] ) ? absint( $args['current'] ) : 1;

if ( $total <= 1 ) {
	return;
}
?>

<nav class="pagination" aria-label="<?php esc_attr_e( 'Posts pagination', 'enterprise-content-hub' ); ?>">
	<?php if ( $current > 1 ) : ?>
		<a class="page-numbers prev"
			href="<?php echo esc_url( get_pagenum_link( $current - 1 ) ); ?>"
			data-page="<?php echo esc_attr( $current - 1 ); ?>">
			<?php esc_html_e( 'Previous', 'enterprise-content-hub' ); ?>
		</a>
	<?php endif; ?>
	<?php for ( $page = 1; $page <= $total; $page++ ) : ?>
		<?php if ( $page === $current ) : ?>
			<span class="page-numbers current" aria-current="page">
				<?php echo esc_html( $page ); ?>
			</span>
		<?php else : ?>
			<a class="page-numbers" href="<?php echo esc_url( get_pagenum_link( $page ) ); ?>" data-page="<?php echo esc_attr( $page ); ?>">
				<?php echo esc_html( $page ); ?>
			</a>
		<?php endif; ?>
	<?php endfor; ?>
	<?php if ( $current < $total ) : ?>
		<a class="page-numbers next" href="<?php echo esc_url( get_pagenum_link( $current + 1 ) ); ?>"
			data-page="<?php echo esc_attr( $current + 1 ); ?>">
			<?php esc_html_e( 'Next', 'enterprise-content-hub' ); ?>
		</a>
	<?php endif; ?>
</nav>