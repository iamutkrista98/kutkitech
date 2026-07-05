<?php if ( ! defined( 'ABSPATH' ) ) exit; get_header(); ?>
<main id="primary" class="kt-main">
	<?php kt_page_header( 'KutkiTech', is_search() ? 'Search Results' : 'Latest Updates' ); ?>
	<section class="kt-section">
		<div class="kt-container">
			<?php if ( have_posts() ) : ?>
				<div class="kt-blog-grid">
					<?php while ( have_posts() ) : the_post(); ?>
						<article class="kt-blog-card reveal-up">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" class="kt-blog-thumb"><?php the_post_thumbnail( 'medium_large' ); ?></a>
							<?php endif; ?>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
							<a href="<?php the_permalink(); ?>" class="kt-link-arrow">Read more <?php echo kt_icon( 'arrow', 'kt-icon-sm' ); ?></a>
						</article>
					<?php endwhile; ?>
				</div>
				<div class="kt-pagination"><?php the_posts_pagination(); ?></div>
			<?php else : ?>
				<p class="kt-admin-note">Nothing found.</p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>
