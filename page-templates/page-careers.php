<?php
/* Template Name: Careers */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>
<main id="primary" class="kt-main">

	<?php kt_page_header( 'Join Us', 'Careers at KutkiTech', 'Build intrinsically with a team that values discipline, curiosity, and collaboration over hierarchy.' ); ?>

	<section class="kt-section">
		<div class="kt-container">
			<div class="kt-jobs-list">
				<?php
				$jobs = new WP_Query( array( 'post_type' => 'kt_job', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
				if ( $jobs->have_posts() ) :
					while ( $jobs->have_posts() ) : $jobs->the_post();
						$type      = get_post_meta( get_the_ID(), 'kt_job_type', true ) ?: 'Full-time';
						$loc       = get_post_meta( get_the_ID(), 'kt_job_location', true ) ?: 'Kathmandu, Nepal';
						$apply_id  = 'apply-' . get_the_ID();
						?>
						<article class="kt-job-card reveal-up">
							<div class="kt-job-icon"><?php echo kt_icon( 'briefcase' ); ?></div>
							<div class="kt-job-info">
								<h3><?php the_title(); ?></h3>
								<div class="kt-job-meta">
									<span><?php echo esc_html( $type ); ?></span>
									<span><?php echo kt_icon( 'pin', 'kt-icon-xs' ); ?><?php echo esc_html( $loc ); ?></span>
								</div>
								<div class="kt-job-desc"><?php the_content(); ?></div>

								<?php kt_render_apply_form( $apply_id, get_the_title() ); ?>
							</div>
							<button type="button" class="kt-btn kt-btn-outline kt-btn-sm kt-apply-toggle" data-target="<?php echo esc_attr( $apply_id ); ?>">Apply Now</button>
						</article>
					<?php endwhile; wp_reset_postdata();
				else : ?>
					<p class="kt-admin-note">No open roles right now &mdash; check back soon, or add openings via <strong>wp-admin &rarr; Careers &rarr; Add New</strong>.</p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="kt-section kt-section-panel">
		<div class="kt-container">
			<?php kt_section_heading( 'Why KutkiTech', 'A place to grow, not just work', '', 'left' ); ?>
			<div class="kt-values-grid">
				<?php
				$perks = new WP_Query( array(
					'post_type'      => 'kt_value',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
					'meta_key'       => 'kt_context',
					'meta_value'     => 'careers',
				) );
				$i = 0;
				if ( $perks->have_posts() ) :
					while ( $perks->have_posts() ) : $perks->the_post();
						$icon = get_post_meta( get_the_ID(), 'kt_icon', true ) ?: 'check';
						$i++;
						?>
						<div class="kt-value-card reveal-up" style="--d:<?php echo esc_attr( $i % 3 ); ?>">
							<?php echo kt_icon( $icon ); ?>
							<h4><?php the_title(); ?></h4>
							<p><?php echo esc_html( kt_plain_content() ); ?></p>
						</div>
					<?php endwhile; wp_reset_postdata();
				endif;
				?>
			</div>
		</div>
	</section>

	<section class="kt-section" id="general-application">
		<div class="kt-container kt-contact-grid">
			<div class="reveal-up">
				<span class="kt-eyebrow">Open Application</span>
				<h2>Don't see the right role?</h2>
				<p class="kt-lead">Send us your CV anyway &mdash; we're growing quickly and always keen to meet disciplined, curious people.</p>
			</div>
			<div class="kt-contact-form-wrap reveal-up" style="--d:1">
				<?php kt_render_apply_form( 'apply-general', 'General Application', true ); ?>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>
