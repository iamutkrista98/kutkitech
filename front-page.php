<?php if ( ! defined( 'ABSPATH' ) ) exit; get_header(); ?>

<main id="primary" class="kt-main">

	<!-- HERO -->
	<section class="kt-hero">
		<canvas id="kt-network-canvas" aria-hidden="true"></canvas>
		<div class="kt-hero-glow kt-hero-glow-1" aria-hidden="true"></div>
		<div class="kt-hero-glow kt-hero-glow-2" aria-hidden="true"></div>

		<div class="kt-container kt-hero-inner">
			<span class="kt-eyebrow reveal-up"><?php echo esc_html( get_theme_mod( 'kt_hero_eyebrow', 'Founded 2025 · A Pointer Holdings Company' ) ); ?></span>
			<h1 class="kt-hero-title reveal-up" style="--d:1"><?php echo esc_html( get_theme_mod( 'kt_hero_title', 'Empowering Businesses, Transforming Ideas' ) ); ?> <span class="kt-text-gradient"><?php echo esc_html( get_theme_mod( 'kt_hero_highlight', 'Into Reality' ) ); ?></span></h1>
			<p class="kt-hero-desc reveal-up" style="--d:2"><?php echo esc_html( get_theme_mod( 'kt_hero_desc', "We deliver innovative software, Odoo-based ERP solutions, and consulting services that help you grow with confidence. From startups to enterprises, our multidisciplinary team adapts to any technological demand — ensuring secure, scalable, future-ready solutions." ) ); ?></p>
			<div class="kt-hero-actions reveal-up" style="--d:3">
				<a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="kt-btn kt-btn-primary">
					<span>Get Started</span><?php echo kt_icon( 'arrow', 'kt-icon-sm' ); ?>
				</a>
				<a href="#services" class="kt-btn kt-btn-ghost">Learn More</a>
			</div>
		</div>

		<div class="kt-hero-stats reveal-up" style="--d:4">
			<div class="kt-container kt-stats-grid">
				<div class="kt-stat">
					<span class="kt-stat-num" data-count="<?php echo esc_attr( get_theme_mod( 'kt_stat_1_num', '4+' ) ); ?>"><?php echo esc_html( get_theme_mod( 'kt_stat_1_num', '4+' ) ); ?></span>
					<span class="kt-stat-label"><?php echo esc_html( get_theme_mod( 'kt_stat_1_label', 'Clients Acquired' ) ); ?></span>
				</div>
				<div class="kt-stat">
					<span class="kt-stat-num" data-count="<?php echo esc_attr( get_theme_mod( 'kt_stat_2_num', '99.9%' ) ); ?>"><?php echo esc_html( get_theme_mod( 'kt_stat_2_num', '99.9%' ) ); ?></span>
					<span class="kt-stat-label"><?php echo esc_html( get_theme_mod( 'kt_stat_2_label', 'Efficient Development' ) ); ?></span>
				</div>
				<div class="kt-stat">
					<span class="kt-stat-num" data-count="<?php echo esc_attr( get_theme_mod( 'kt_stat_3_num', '24/7' ) ); ?>"><?php echo esc_html( get_theme_mod( 'kt_stat_3_num', '24/7' ) ); ?></span>
					<span class="kt-stat-label"><?php echo esc_html( get_theme_mod( 'kt_stat_3_label', 'Service Availability' ) ); ?></span>
				</div>
			</div>
		</div>
	</section>

	<!-- SERVICES -->
	<section class="kt-section" id="services">
		<div class="kt-container">
			<?php kt_section_heading( 'What We Do', 'Efficient IT services across a wide range of domains', 'Odoo ERP, custom software, AI tooling and consulting &mdash; built around thorough requirement analysis so every solution actually fits.' ); ?>

			<div class="kt-services-grid">
				<?php
				$services = new WP_Query( array( 'post_type' => 'kt_service', 'posts_per_page' => 6, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
				$i = 0;
				if ( $services->have_posts() ) :
					while ( $services->have_posts() ) : $services->the_post();
						$icon = get_post_meta( get_the_ID(), 'kt_icon', true ) ?: 'check';
						$i++;
						?>
						<article class="kt-service-card reveal-up" style="--d:<?php echo esc_attr( $i % 4 ); ?>">
							<div class="kt-service-icon"><?php echo kt_icon( $icon ); ?></div>
							<h3><?php the_title(); ?></h3>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt() ? get_the_excerpt() : kt_plain_content(), 22 ) ); ?></p>
						</article>
					<?php endwhile; wp_reset_postdata();
				endif;
				?>
			</div>
		</div>
	</section>

	<!-- WHY CHOOSE US -->
	<section class="kt-section kt-section-panel">
		<div class="kt-container kt-why-grid">
			<div class="reveal-up">
				<span class="kt-eyebrow">Why Businesses Choose Us</span>
				<h2><?php echo esc_html( get_theme_mod( 'kt_why_title', 'Insourcing, outsourcing, and everything an ERP rollout needs' ) ); ?></h2>
				<p class="kt-lead"><?php echo esc_html( get_theme_mod( 'kt_why_desc', 'KutkiTech is experienced in insourcing and outsourcing software development, and the deployment of large IT systems — including ERP solutions and system integration — placing us in a position to deliver the best products and solutions without the high costs of doing business.' ) ); ?></p>
				<a href="<?php echo esc_url( home_url( '/about-us' ) ); ?>" class="kt-link-arrow">More about us <?php echo kt_icon( 'arrow', 'kt-icon-sm' ); ?></a>
			</div>
			<div class="kt-why-list reveal-up" style="--d:1">
				<?php
				$why_items = new WP_Query( array( 'post_type' => 'kt_why', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
				if ( $why_items->have_posts() ) :
					while ( $why_items->have_posts() ) : $why_items->the_post();
						$icon = get_post_meta( get_the_ID(), 'kt_icon', true ) ?: 'check';
						?>
						<div class="kt-why-item"><?php echo kt_icon( $icon ); ?><div><h4><?php the_title(); ?></h4><p><?php echo esc_html( kt_plain_content() ); ?></p></div></div>
					<?php endwhile; wp_reset_postdata();
				else : ?>
					<p class="kt-admin-note">Add entries via <strong>wp-admin &rarr; Why Choose Us &rarr; Add New</strong>.</p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- TESTIMONIALS -->
	<section class="kt-section">
		<div class="kt-container">
			<?php kt_section_heading( 'Client Testimonials', 'What our clients say', 'Real feedback from the corporates and organizations we work alongside.' ); ?>

			<div class="kt-testimonial-track reveal-up">
				<?php
				$testimonials = new WP_Query( array( 'post_type' => 'kt_testimonial', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
				if ( $testimonials->have_posts() ) :
					while ( $testimonials->have_posts() ) : $testimonials->the_post();
						$role = get_post_meta( get_the_ID(), 'kt_client_role', true );
						$rating = get_post_meta( get_the_ID(), 'kt_rating', true ) ?: 5;
						?>
						<article class="kt-testimonial-card">
							<?php echo kt_icon( 'quote', 'kt-quote-icon' ); ?>
							<?php echo kt_star_rating( $rating ); ?>
							<p class="kt-testimonial-quote">&ldquo;<?php echo esc_html( kt_plain_content() ); ?>&rdquo;</p>
							<div class="kt-testimonial-author">
								<span class="kt-avatar-initials"><?php echo esc_html( kt_initials( get_the_title() ) ); ?></span>
								<div>
									<strong><?php the_title(); ?></strong>
									<?php if ( $role ) : ?><span><?php echo esc_html( $role ); ?></span><?php endif; ?>
								</div>
							</div>
						</article>
					<?php endwhile; wp_reset_postdata();
				endif;
				?>
			</div>
		</div>
	</section>

	<!-- FAQ -->
	<section class="kt-section kt-section-panel">
		<div class="kt-container kt-faq-wrap">
			<?php kt_section_heading( 'FAQ', 'Frequently asked questions', '', 'left' ); ?>
			<div class="kt-accordion" id="kt-faq">
				<?php
				$faqs = new WP_Query( array( 'post_type' => 'kt_faq', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
				$i = 0;
				if ( $faqs->have_posts() ) :
					while ( $faqs->have_posts() ) : $faqs->the_post();
						?>
						<div class="kt-accordion-item">
							<button class="kt-accordion-trigger" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>">
								<span><?php the_title(); ?></span>
								<span class="kt-accordion-icon" aria-hidden="true"></span>
							</button>
							<div class="kt-accordion-panel"<?php echo $i === 0 ? '' : ' hidden'; ?>>
								<p><?php the_content(); ?></p>
							</div>
						</div>
					<?php $i++; endwhile; wp_reset_postdata();
				else : ?>
					<p class="kt-admin-note">Add questions via <strong>wp-admin &rarr; FAQs &rarr; Add New</strong>.</p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- CTA -->
	<section class="kt-cta">
		<div class="kt-container kt-cta-inner reveal-up">
			<h2><?php echo esc_html( get_theme_mod( 'kt_cta_title', 'Remember us for any IT-related services or consultation.' ) ); ?></h2>
			<p><?php echo esc_html( get_theme_mod( 'kt_cta_desc', "We're available 24/7 at your service." ) ); ?></p>
			<a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="kt-btn kt-btn-primary kt-btn-lg">
				<span>Get Started</span><?php echo kt_icon( 'arrow' ); ?>
			</a>
		</div>
	</section>

</main>

<?php get_footer(); ?>
