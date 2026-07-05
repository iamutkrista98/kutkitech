<?php
/* Template Name: About Us */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>
<main id="primary" class="kt-main">

	<?php kt_page_header( 'Who We Are', 'About KutkiTech', 'Innovation and collective knowledge, built into every solution we ship.' ); ?>

	<section class="kt-section">
		<div class="kt-container kt-about-intro">
			<div class="reveal-up kt-prose">
				<?php
				// Editable from wp-admin → Pages → About Us → Edit Page
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					the_content();
				endwhile; endif;
				?>
			</div>
		</div>
	</section>

	<section class="kt-section kt-section-panel">
		<div class="kt-container">
			<?php kt_section_heading( 'Foundation', 'Business overview', '', 'left' ); ?>
			<div class="kt-values-grid">
				<?php
				$values = new WP_Query( array(
					'post_type'      => 'kt_value',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
					'meta_key'       => 'kt_context',
					'meta_value'     => 'about',
				) );
				$i = 0;
				if ( $values->have_posts() ) :
					while ( $values->have_posts() ) : $values->the_post();
						$icon = get_post_meta( get_the_ID(), 'kt_icon', true ) ?: 'check';
						$i++;
						?>
						<div class="kt-value-card reveal-up" style="--d:<?php echo esc_attr( $i % 4 ); ?>">
							<?php echo kt_icon( $icon ); ?>
							<h4><?php the_title(); ?></h4>
							<p><?php echo esc_html( kt_plain_content() ); ?></p>
						</div>
					<?php endwhile; wp_reset_postdata();
				else : ?>
					<p class="kt-admin-note">Add entries via <strong>wp-admin &rarr; Values &amp; Perks &rarr; Add New</strong> (set "Show On" to About Us).</p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="kt-section">
		<div class="kt-container">
			<?php kt_section_heading( 'Our Journey', 'A history rooted in innovation', 'From appliance distribution to eco-friendly products, and now to cutting-edge IT services.', 'left' ); ?>
			<div class="kt-timeline reveal-up">
				<?php
				$timeline = new WP_Query( array( 'post_type' => 'kt_timeline', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
				if ( $timeline->have_posts() ) :
					while ( $timeline->have_posts() ) : $timeline->the_post();
						?>
						<div class="kt-timeline-item">
							<span class="kt-timeline-year"><?php the_title(); ?></span>
							<p><?php echo esc_html( kt_plain_content() ); ?></p>
						</div>
					<?php endwhile; wp_reset_postdata();
				else : ?>
					<p class="kt-admin-note">Add entries via <strong>wp-admin &rarr; Timeline &rarr; Add New</strong> (use the year as the title).</p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="kt-section kt-section-panel">
		<div class="kt-container kt-process-grid">
			<div class="kt-process-card reveal-up" style="--d:0">
				<span class="kt-eyebrow">Mission</span>
				<p><?php echo esc_html( get_theme_mod( 'kt_mission_text', 'We develop and deliver client-centric software platforms backed by exceptional service, adding value to corporates, NGOs, INGOs, and government institutions.' ) ); ?></p>
			</div>
			<div class="kt-process-card reveal-up" style="--d:1">
				<span class="kt-eyebrow">Vision</span>
				<p><?php echo esc_html( get_theme_mod( 'kt_vision_text', 'We provide innovative software solutions that empower organizations worldwide to reach their full potential.' ) ); ?></p>
			</div>
			<div class="kt-process-card reveal-up" style="--d:2">
				<span class="kt-eyebrow">Values</span>
				<p><?php echo esc_html( get_theme_mod( 'kt_values_text', 'We strive for perfection, perform with excellence, and continuously evolve — teamwork and collaboration are at the heart of how we innovate.' ) ); ?></p>
			</div>
		</div>
	</section>

	<section class="kt-cta">
		<div class="kt-container kt-cta-inner reveal-up">
			<h2>Let's build something intrinsically better.</h2>
			<p>Tell us about your project and we'll take it from there.</p>
			<a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="kt-btn kt-btn-primary kt-btn-lg">
				<span>Get Started</span><?php echo kt_icon( 'arrow' ); ?>
			</a>
		</div>
	</section>

</main>
<?php get_footer(); ?>
