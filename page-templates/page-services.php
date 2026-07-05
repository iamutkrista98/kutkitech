<?php
/* Template Name: Services */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>
<main id="primary" class="kt-main">

	<?php kt_page_header( 'What We Offer', 'Services', 'Odoo ERP, custom software, digital platforms, and consulting &mdash; engineered around your actual workflow.' ); ?>

	<section class="kt-section">
		<div class="kt-container">
			<div class="kt-services-grid kt-services-grid-detailed">
				<?php
				$services = new WP_Query( array( 'post_type' => 'kt_service', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
				$i = 0;
				if ( $services->have_posts() ) :
					while ( $services->have_posts() ) : $services->the_post();
						$icon = get_post_meta( get_the_ID(), 'kt_icon', true ) ?: 'check';
						$i++;
						?>
						<article class="kt-service-card kt-service-card-lg reveal-up" style="--d:<?php echo esc_attr( $i % 4 ); ?>">
							<div class="kt-service-icon"><?php echo kt_icon( $icon ); ?></div>
							<h3><?php the_title(); ?></h3>
							<div class="kt-service-body"><?php the_content(); ?></div>
						</article>
					<?php endwhile; wp_reset_postdata();
				endif;
				?>
			</div>
		</div>
	</section>

	<section class="kt-section kt-section-panel">
		<div class="kt-container">
			<?php kt_section_heading( 'Industries', 'Odoo ERP tailored to your sector', 'Our tailored solutions serve a wide range of industries.', 'left' ); ?>
			<div class="kt-tag-cloud reveal-up">
				<?php
				$industries = new WP_Query( array( 'post_type' => 'kt_industry', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
				if ( $industries->have_posts() ) :
					while ( $industries->have_posts() ) : $industries->the_post();
						echo '<span class="kt-tag">' . esc_html( get_the_title() ) . '</span>';
					endwhile; wp_reset_postdata();
				else : ?>
					<p class="kt-admin-note">Add entries via <strong>wp-admin &rarr; Industries &rarr; Add New</strong>.</p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="kt-section">
		<div class="kt-container kt-why-grid">
			<div class="reveal-up">
				<span class="kt-eyebrow">Our Approach</span>
				<h2>Listen. Analyze. Design. Execute.</h2>
				<p class="kt-lead">We follow a clear and purposeful process to ensure every solution we deliver is reliable, impactful, and future-ready &mdash; combining technical expertise with a multidisciplinary approach so every project aligns with your goals.</p>
			</div>
			<div class="kt-why-list reveal-up" style="--d:1">
				<div class="kt-why-item"><?php echo kt_icon( 'consult' ); ?><div><h4>Requirement Analysis</h4><p>Extensive research during requirement collection ensures flexibility and customizability.</p></div></div>
				<div class="kt-why-item"><?php echo kt_icon( 'web' ); ?><div><h4>Tailored Design</h4><p>Solutions shaped around your unique workflows, not a fixed template.</p></div></div>
				<div class="kt-why-item"><?php echo kt_icon( 'erp' ); ?><div><h4>Precise Execution</h4><p>More efficient, cost-effective business processes with increased productivity.</p></div></div>
				<div class="kt-why-item"><?php echo kt_icon( 'security' ); ?><div><h4>Ongoing Support</h4><p>An enhanced user experience, backed by continued support after go-live.</p></div></div>
			</div>
		</div>
	</section>

	<section class="kt-cta">
		<div class="kt-container kt-cta-inner reveal-up">
			<h2>Not sure which service fits?</h2>
			<p>Tell us what you're trying to solve &mdash; we'll recommend the right approach.</p>
			<a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="kt-btn kt-btn-primary kt-btn-lg">
				<span>Talk to Us</span><?php echo kt_icon( 'arrow' ); ?>
			</a>
		</div>
	</section>

</main>
<?php get_footer(); ?>
