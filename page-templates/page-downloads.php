<?php
/* Template Name: Downloads */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>
<main id="primary" class="kt-main">

	<?php kt_page_header( 'Resources', 'Downloads', 'Brochures, company profiles, and reference documents.' ); ?>

	<section class="kt-section">
		<div class="kt-container">
			<div class="kt-downloads-list">
				<?php
				$downloads = new WP_Query( array( 'post_type' => 'kt_download', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
				if ( $downloads->have_posts() ) :
					while ( $downloads->have_posts() ) : $downloads->the_post();
						$url  = get_post_meta( get_the_ID(), 'kt_file_url', true );
						$size = get_post_meta( get_the_ID(), 'kt_file_size', true );
						?>
						<div class="kt-download-row reveal-up">
							<div class="kt-download-icon"><?php echo kt_icon( 'file' ); ?></div>
							<div class="kt-download-info">
								<h3><?php the_title(); ?></h3>
								<?php if ( get_the_excerpt() ) : ?><p><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
							</div>
							<?php if ( $url ) : ?>
								<a href="<?php echo esc_url( $url ); ?>" class="kt-btn kt-btn-outline kt-btn-sm" download>
									<?php echo kt_icon( 'download', 'kt-icon-sm' ); ?><span><?php echo $size ? esc_html( $size ) : 'Download'; ?></span>
								</a>
							<?php endif; ?>
						</div>
					<?php endwhile; wp_reset_postdata();
				else : ?>
					<p class="kt-admin-note">No downloads yet &mdash; add files via <strong>wp-admin &rarr; Downloads &rarr; Add New</strong> (upload the file to the Media Library first, then paste its URL into the File URL field).</p>
				<?php endif; ?>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>
