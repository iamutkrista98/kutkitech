<?php
/* Template Name: Our Team */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>
<main id="primary" class="kt-main">

	<?php kt_page_header( 'The People', 'Our Team', 'A multidisciplinary team of 30+ professionals across technology, consulting, and creative solutions.' ); ?>

	<section class="kt-section">
		<div class="kt-container">
			<div class="kt-team-grid">
				<?php
				$team = new WP_Query( array( 'post_type' => 'kt_team', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
				$i = 0;
				if ( $team->have_posts() ) :
					while ( $team->have_posts() ) : $team->the_post();
						$role = get_post_meta( get_the_ID(), 'kt_role', true );
						$linkedin = get_post_meta( get_the_ID(), 'kt_linkedin', true );
						$i++;
						?>
						<article class="kt-team-card reveal-up" style="--d:<?php echo esc_attr( $i % 4 ); ?>">
							<div class="kt-team-photo">
								<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'medium' ); else : ?>
									<span class="kt-avatar-initials kt-avatar-lg"><?php echo esc_html( kt_initials( get_the_title() ) ); ?></span>
								<?php endif; ?>
							</div>
							<h3><?php the_title(); ?></h3>
							<?php if ( $role ) : ?><p class="kt-team-role"><?php echo esc_html( $role ); ?></p><?php endif; ?>
							<?php if ( $linkedin ) : ?>
								<a href="<?php echo esc_url( $linkedin ); ?>" class="kt-team-linkedin" target="_blank" rel="noopener" aria-label="LinkedIn"><?php echo kt_icon( 'linkedin', 'kt-icon-sm' ); ?></a>
							<?php endif; ?>
						</article>
					<?php endwhile; wp_reset_postdata();
				endif;
				?>
			</div>
			<p class="kt-admin-note">Add team members from <strong>wp-admin &rarr; Our Team &rarr; Add New</strong>. Each entry supports a photo, role/title and LinkedIn link.</p>
		</div>
	</section>

	<section class="kt-section kt-section-panel">
		<div class="kt-container kt-why-grid">
			<div class="reveal-up">
				<span class="kt-eyebrow">Culture</span>
				<h2>Young minds, wide experience</h2>
				<p class="kt-lead">Our team consists of young, energetic and highly disciplined individuals. Their experience spans multiple industries, which is exactly what lets us adapt to any technological demand without missing a beat.</p>
			</div>
			<div class="kt-why-list reveal-up" style="--d:1">
				<div class="kt-why-item"><?php echo kt_icon( 'team' ); ?><div><h4>Collaboration Over Hierarchy</h4><p>Employee satisfaction comes from support, not org charts.</p></div></div>
				<div class="kt-why-item"><?php echo kt_icon( 'target' ); ?><div><h4>Customer-Centered</h4><p>Every decision keeps the client's outcome in view.</p></div></div>
			</div>
		</div>
	</section>

	<section class="kt-cta">
		<div class="kt-container kt-cta-inner reveal-up">
			<h2>Want to work with us?</h2>
			<p>We're always looking for disciplined, curious people.</p>
			<a href="<?php echo esc_url( home_url( '/careers' ) ); ?>" class="kt-btn kt-btn-primary kt-btn-lg">
				<span>View Careers</span><?php echo kt_icon( 'arrow' ); ?>
			</a>
		</div>
	</section>

</main>
<?php get_footer(); ?>
