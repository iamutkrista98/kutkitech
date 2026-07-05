<?php if ( ! defined( 'ABSPATH' ) ) exit; ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<script>
(function(){
	try {
		var stored = localStorage.getItem('kt-theme');
		var theme = stored ? stored : ( window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark' );
		if ( theme === 'light' ) document.documentElement.setAttribute('data-theme', 'light');
	} catch (e) {}
})();
</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="kt-noise-overlay" aria-hidden="true"></div>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'kutkitech' ); ?></a>

<header id="masthead" class="kt-site-header" data-scroll-header>
	<div class="kt-container kt-header-inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="kt-logo" rel="home">
			<?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
				<span class="kt-logo-mark" aria-hidden="true">
					<svg viewBox="0 0 40 40" width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
						<circle cx="8" cy="8" r="3.2"/><circle cx="32" cy="8" r="3.2"/><circle cx="20" cy="34" r="3.2"/>
						<path d="M8 11.2V20a4 4 0 0 0 4 4h4M32 11.2V20a4 4 0 0 0-4 4h-4M20 24v6.8"/>
						<circle cx="20" cy="20" r="2.4" fill="currentColor" stroke="none"/>
					</svg>
				</span>
				<span class="kt-logo-text">Kutki<span>Tech</span></span>
			<?php endif; ?>
		</a>

		<nav id="site-navigation" class="kt-primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'kutkitech' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'nav-menu',
				) );
			} else {
				kt_fallback_menu();
			}
			?>
		</nav>

		<div class="kt-header-actions">
			<button type="button" class="kt-theme-toggle" aria-label="<?php esc_attr_e( 'Toggle dark/light mode', 'kutkitech' ); ?>" aria-pressed="false">
				<?php echo kt_icon( 'sun', 'kt-icon-sm kt-theme-icon-sun' ); ?>
				<?php echo kt_icon( 'moon', 'kt-icon-sm kt-theme-icon-moon' ); ?>
			</button>
			<a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="kt-btn kt-btn-primary kt-btn-sm">
				<span>Get Started</span>
				<?php echo kt_icon( 'arrow', 'kt-icon-sm' ); ?>
			</a>
			<button class="kt-menu-toggle" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle menu', 'kutkitech' ); ?>">
				<span></span><span></span><span></span>
			</button>
		</div>
	</div>
</header>
