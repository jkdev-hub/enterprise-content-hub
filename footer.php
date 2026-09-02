<?php
/**
 * The footer template.
 *
 * @package Enterprise_Content_Hub
 */
?>

<footer id="colophon" class="site-footer">
	<div class="ech-container">

		<div class="site-footer__main">

			<div class="site-footer__brand">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else {
					?>
					<a class="site-footer__title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
					<?php
				}
				?>

				<p class="site-footer__description">
					<?php esc_html_e( 'A knowledge platform built to support better decisions and continuous growth', 'enterprise-content-hub' ); ?>
				</p>
			</div>

			<div class="site-footer__column">
				<h2 class="site-footer__heading">
					<?php esc_html_e( 'Content', 'enterprise-content-hub' ); ?>
				</h2>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_class'     => 'footer-menu',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</div>
		</div>

		<div class="site-footer__bottom">
			<p class="site-footer__copyright">
				&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?>
				<?php bloginfo( 'name' ); ?>.
				<?php esc_html_e( 'All rights reserved.', 'enterprise-content-hub' ); ?>
			</p>

			<div class="site-footer__bottom-links">
				<div class="site-footer__legal">
					<a href="#">
						<?php esc_html_e( 'Privacy', 'enterprise-content-hub' ); ?>
					</a>

					<a href="#">
						<?php esc_html_e( 'Terms', 'enterprise-content-hub' ); ?>
					</a>
				</div>

			</div>
		</div>

	</div>
</footer>
<div class="footer__back-to-top">
	<a class="back-top__btn" href="#masthead" data-back-to-top>
		<span aria-hidden="true">&uarr;</span>
	</a>
</div>

<?php wp_footer(); ?>

</body>
</html>