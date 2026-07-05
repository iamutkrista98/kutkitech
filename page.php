<?php if ( ! defined( 'ABSPATH' ) ) exit; get_header(); ?>
<main id="primary" class="kt-main">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php kt_page_header( 'KutkiTech', get_the_title() ); ?>
		<section class="kt-section">
			<div class="kt-container kt-prose reveal-up">
				<?php the_content(); ?>
			</div>
		</section>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
