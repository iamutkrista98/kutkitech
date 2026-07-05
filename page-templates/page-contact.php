<?php
/* Template Name: Contact Us */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>
<main id="primary" class="kt-main">

	<?php kt_page_header( 'Reach Out', 'Contact Us', "We're available 24/7 at your service." ); ?>

	<section class="kt-section">
		<div class="kt-container kt-contact-grid">

			<div class="kt-contact-info reveal-up">
				<span class="kt-eyebrow">Get In Touch</span>
				<h2>Any queries? Let's talk.</h2>
				<p class="kt-lead">Whether it's an ERP rollout, a new web platform, or a general IT consultation &mdash; tell us what you're working on and we'll get back to you.</p>

				<ul class="kt-contact-details">
					<li>
						<?php echo kt_icon( 'phone' ); ?>
						<div><span>Phone</span><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', get_theme_mod( 'kt_phone', '01-5904130' ) ) ); ?>"><?php echo esc_html( get_theme_mod( 'kt_phone', '01-5904130' ) ); ?></a></div>
					</li>
					<li>
						<?php echo kt_icon( 'mail' ); ?>
						<div><span>Email</span><a href="mailto:<?php echo esc_attr( get_theme_mod( 'kt_email', 'info@kutkitech.com' ) ); ?>"><?php echo esc_html( get_theme_mod( 'kt_email', 'info@kutkitech.com' ) ); ?></a></div>
					</li>
					<li>
						<?php echo kt_icon( 'pin' ); ?>
						<div><span>Address</span><span><?php echo esc_html( get_theme_mod( 'kt_address', 'Chamati, Kathmandu-16, Nepal' ) ); ?></span></div>
					</li>
				</ul>

				<div class="kt-social-links kt-social-links-lg">
					<?php $fb = get_theme_mod( 'kt_facebook' ); $li = get_theme_mod( 'kt_linkedin' ); ?>
					<?php if ( $fb ) : ?><a href="<?php echo esc_url( $fb ); ?>" aria-label="Facebook" target="_blank" rel="noopener"><?php echo kt_icon( 'facebook' ); ?></a><?php endif; ?>
					<?php if ( $li ) : ?><a href="<?php echo esc_url( $li ); ?>" aria-label="LinkedIn" target="_blank" rel="noopener"><?php echo kt_icon( 'linkedin' ); ?></a><?php endif; ?>
				</div>
			</div>

			<div class="kt-contact-form-wrap reveal-up" style="--d:1">
				<form id="kt-contact-form" class="kt-contact-form kt-ajax-form" data-ajax-action="kt_contact_form" novalidate>
					<div class="kt-form-row">
						<div class="kt-form-field">
							<label for="kt-name">Full Name</label>
							<input type="text" id="kt-name" name="name" required>
						</div>
						<div class="kt-form-field">
							<label for="kt-email">Email Address</label>
							<input type="email" id="kt-email" name="email" required>
						</div>
					</div>
					<div class="kt-form-row">
						<div class="kt-form-field">
							<label for="kt-phone">Phone Number</label>
							<input type="tel" id="kt-phone" name="phone">
						</div>
						<div class="kt-form-field">
							<label for="kt-subject">Subject</label>
							<input type="text" id="kt-subject" name="subject" placeholder="e.g. ERP Consultation">
						</div>
					</div>
					<div class="kt-form-field">
						<label for="kt-message">Message</label>
						<textarea id="kt-message" name="message" rows="5" required></textarea>
					</div>

					<div class="kt-form-field">
						<label for="kt-attachment">Attach CV or Document <span class="kt-field-hint">(PDF, max 512KB — optional)</span></label>
						<input type="file" id="kt-attachment" name="kt_attachment" accept="application/pdf" data-max-size="524288">
						<p class="kt-file-error" hidden></p>
					</div>

					<!-- Honeypot: hidden from humans, catches bots -->
					<div class="kt-hp-field" aria-hidden="true">
						<label for="kt-website">Website</label>
						<input type="text" id="kt-website" name="kt_website" tabindex="-1" autocomplete="off">
					</div>

					<button type="submit" class="kt-btn kt-btn-primary kt-btn-lg kt-form-submit">
						<span class="kt-btn-text">Send Message</span>
						<span class="kt-btn-spinner" hidden></span>
					</button>

					<div class="kt-form-status" role="status" aria-live="polite"></div>
				</form>
			</div>
		</div>
	</section>

	<section class="kt-section kt-section-panel">
		<div class="kt-container">
			<?php kt_section_heading( 'Find Us', 'Our location', '', 'left' ); ?>
			<div class="reveal-up">
				<?php kt_render_map(); ?>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>
