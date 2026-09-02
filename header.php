<?php
/**
 * The header template.
 *
 * @package Enterprise_Content_Hub
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header<?php echo is_front_page() ? ' site-header--front-page' : ''; ?>">

	<div class="ech-container site-header__inner">

		<div class="site-header__top">

			<div class="site-branding">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else {
					?>
					<p class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php bloginfo( 'name' ); ?>
						</a>
					</p>
					<?php
				}
				?>
			</div>

			<button
				class="menu-toggle"
				type="button"
				aria-controls="primary-menu"
				aria-expanded="false"
			>
				<span class="menu-toggle__line"></span>
				<span class="menu-toggle__line"></span>
				<span class="menu-toggle__line"></span>

				<span class="screen-reader-text">
					<?php esc_html_e( 'Toggle navigation', 'enterprise-content-hub' ); ?>
				</span>
			</button>

		</div>

		<nav
			class="main-navigation"
			aria-label="<?php esc_attr_e( 'Primary navigation', 'enterprise-content-hub' ); ?>"
		>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'primary-menu',
					'menu_id'        => 'primary-menu',
					'container'      => false,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>

		<div class="site-header__search">
			<?php get_search_form(); ?>
		</div>

		<button
			class="navigation-overlay"
			type="button"
			aria-label="<?php esc_attr_e( 'Close navigation', 'enterprise-content-hub' ); ?>"
		></button>

	</div>

</header>