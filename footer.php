<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

	<footer id="colophon" class="kt-site-footer">
		<div class="kt-footer-wave" aria-hidden="true"></div>
		<div class="kt-container">
			<div class="kt-footer-grid">
				<div class="kt-footer-brand">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="kt-logo">
						<span class="kt-logo-mark" aria-hidden="true">
							<svg viewBox="0 0 40 40" width="34" height="34" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
								<circle cx="8" cy="8" r="3.2"/><circle cx="32" cy="8" r="3.2"/><circle cx="20" cy="34" r="3.2"/>
								<path d="M8 11.2V20a4 4 0 0 0 4 4h4M32 11.2V20a4 4 0 0 0-4 4h-4M20 24v6.8"/>
								<circle cx="20" cy="20" r="2.4" fill="currentColor" stroke="none"/>
							</svg>
						</span>
						<span class="kt-logo-text">Kutki<span>Tech</span></span>
					</a>
					<p class="kt-footer-tagline">Driving technological innovation through the motto <em>&ldquo;<?php echo esc_html( get_theme_mod( 'kt_tagline', 'Build Intrinsically' ) ); ?>&rdquo;</em></p>
					<div class="kt-social-links">
						<?php $fb = get_theme_mod( 'kt_facebook' ); $li = get_theme_mod( 'kt_linkedin' ); ?>
						<?php if ( $fb ) : ?><a href="<?php echo esc_url( $fb ); ?>" aria-label="Facebook" target="_blank" rel="noopener"><?php echo kt_icon( 'facebook' ); ?></a><?php endif; ?>
						<?php if ( $li ) : ?><a href="<?php echo esc_url( $li ); ?>" aria-label="LinkedIn" target="_blank" rel="noopener"><?php echo kt_icon( 'linkedin' ); ?></a><?php endif; ?>
					</div>
				</div>

				<div class="kt-footer-col">
					<h4 class="footer-widget-title">Services Offered</h4>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>">ERP / CRM Solutions</a></li>
						<li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>">AI Digital Marketing</a></li>
						<li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>">Software Development</a></li>
						<li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>">IT Consultation</a></li>
					</ul>
				</div>

				<div class="kt-footer-col">
					<h4 class="footer-widget-title">Resources</h4>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
						<li><a href="<?php echo esc_url( home_url( '/about-us' ) ); ?>">About Us</a></li>
						<li><a href="<?php echo esc_url( home_url( '/our-team' ) ); ?>">Our Team</a></li>
						<li><a href="<?php echo esc_url( home_url( '/careers' ) ); ?>">Careers</a></li>
						<li><a href="<?php echo esc_url( home_url( '/downloads' ) ); ?>">Downloads</a></li>
						<li><a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>">Contact Us</a></li>
					</ul>
				</div>

				<div class="kt-footer-col">
					<h4 class="footer-widget-title">Get In Touch</h4>
					<ul class="kt-footer-contact">
						<li><?php echo kt_icon( 'phone', 'kt-icon-sm' ); ?><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', get_theme_mod( 'kt_phone', '01-5904130' ) ) ); ?>"><?php echo esc_html( get_theme_mod( 'kt_phone', '01-5904130' ) ); ?></a></li>
						<li><?php echo kt_icon( 'mail', 'kt-icon-sm' ); ?><a href="mailto:<?php echo esc_attr( get_theme_mod( 'kt_email', 'info@kutkitech.com' ) ); ?>"><?php echo esc_html( get_theme_mod( 'kt_email', 'info@kutkitech.com' ) ); ?></a></li>
						<li><?php echo kt_icon( 'pin', 'kt-icon-sm' ); ?><span><?php echo esc_html( get_theme_mod( 'kt_address', 'Chamati, Kathmandu-16, Nepal' ) ); ?></span></li>
					</ul>
					<?php if ( is_active_sidebar( 'footer-1' ) ) dynamic_sidebar( 'footer-1' ); ?>
				</div>
			</div>

			<div class="kt-footer-bottom">
				<p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> KutkiTech Pvt. Ltd. All Rights Reserved.</p>
				<div class="kt-footer-legal">
					<a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>">Privacy Policy</a>
					<a href="<?php echo esc_url( home_url( '/terms-and-conditions' ) ); ?>">Terms of Service</a>
				</div>
			</div>
		</div>
	</footer>

	<button class="kt-back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'kutkitech' ); ?>" data-back-to-top>
		<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 15 7-7 7 7"/></svg>
	</button>

<?php wp_footer(); ?>
</body>
</html>
