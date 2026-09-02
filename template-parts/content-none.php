<?php
/**
 * Template part for displaying a message when no content is found.
 *
 * @package Enterprise_Content_Hub
 */
?>

<section class="no-content">

	<header class="no-content__header">
		<h1 class="no-content__title">
			<?php esc_html_e( 'Nothing found', 'enterprise-content-hub' ); ?>
		</h1>
	</header>

	<div class="no-content__message">
		<p>
			<?php esc_html_e( 'It looks like there is no content available here yet.', 'enterprise-content-hub' ); ?>
		</p>
	</div>

</section>