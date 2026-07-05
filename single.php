<?php if ( ! defined( 'ABSPATH' ) ) exit; get_header(); ?>
<main id="primary" class="kt-main">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php kt_page_header( get_post_type() === 'kt_job' ? 'Careers' : 'KutkiTech', get_the_title() ); ?>
		<section class="kt-section">
			<div class="kt-container kt-prose reveal-up">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="kt-single-thumb"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>
				<?php the_content(); ?>
			</div>
		</section>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
