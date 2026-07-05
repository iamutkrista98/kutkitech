<?php if ( ! defined( 'ABSPATH' ) ) exit; get_header(); ?>
<main id="primary" class="kt-main">
	<section class="kt-section kt-404">
		<div class="kt-container reveal-up" style="text-align:center;">
			<span class="kt-eyebrow">Error 404</span>
			<h1 class="kt-404-code">Lost in the network.</h1>
			<p class="kt-lead">The page you're looking for doesn't exist or has moved.</p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="kt-btn kt-btn-primary kt-btn-lg">
				<span>Back to Home</span><?php echo kt_icon( 'arrow' ); ?>
			</a>
		</div>
	</section>
</main>
<?php get_footer(); ?>
