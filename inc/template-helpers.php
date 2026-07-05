<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Inline SVG icon set — no icon font/plugin dependency.
 * Matches the KutkiTech circuit-node brand motif (thin stroke, rounded joins).
 */
function kt_icon( $name, $class = 'kt-icon' ) {
	$icons = array(
		'erp' => '<path d="M4 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7Z"/><path d="M4 11h16M10 21V11"/>',
		'mis' => '<path d="M3 12h4l2-7 4 14 2-7h6"/>',
		'web' => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.7 3.8 6 3.8 9s-1.3 6.3-3.8 9c-2.5-2.7-3.8-6-3.8-9s1.3-6.3 3.8-9Z"/>',
		'ai' => '<circle cx="12" cy="12" r="2.4"/><circle cx="4.5" cy="6" r="1.7"/><circle cx="19.5" cy="6" r="1.7"/><circle cx="4.5" cy="18" r="1.7"/><circle cx="19.5" cy="18" r="1.7"/><path d="M9.9 10.5 6 7.4M14.1 10.5 18 7.4M9.9 13.5 6 16.6M14.1 13.5 18 16.6"/>',
		'consult' => '<path d="M8 10h8M8 14h5"/><path d="M4 5h16v11H9l-5 4V5Z"/>',
		'security' => '<path d="M12 3 4 6v6c0 5 3.4 8.4 8 9 4.6-.6 8-4 8-9V6l-8-3Z"/><path d="m9 12 2 2 4-4"/>',
		'phone' => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2C9.6 21 3 14.4 3 6a2 2 0 0 1 2-2Z"/>',
		'mail' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/>',
		'pin' => '<path d="M12 21s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12Z"/><circle cx="12" cy="9" r="2.5"/>',
		'arrow' => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'quote' => '<path d="M9 7c-2.8 0-4.5 2-4.5 4.6C4.5 14 6 15.5 8 15.5c0-2.8-.6-5-3.5-5.6M17 7c-2.8 0-4.5 2-4.5 4.6 0 2.4 1.5 3.9 3.5 3.9 0-2.8-.6-5-3.5-5.6"/>',
		'download' => '<path d="M12 3v12m0 0-4-4m4 4 4-4"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/>',
		'file' => '<path d="M6 2h9l5 5v15H6Z"/><path d="M15 2v5h5"/>',
		'briefcase' => '<rect x="3" y="8" width="18" height="12" rx="2"/><path d="M8 8V6a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 13h18"/>',
		'check' => '<path d="m5 12 5 5L20 7"/>',
		'linkedin' => '<rect x="3" y="3" width="18" height="18" rx="3"/><path d="M8 10v7M8 7.2v.1M12.5 17v-4a2.2 2.2 0 0 1 4.4 0v4M12.5 10v7"/>',
		'facebook' => '<circle cx="12" cy="12" r="9"/><path d="M14 8.5h-1.5c-.8 0-1.5.7-1.5 1.5v2h3l-.4 3H11v6"/>',
		'target' => '<circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="4"/><circle cx="12" cy="12" r=".7" fill="currentColor"/>',
		'bulb' => '<path d="M9 18h6M10 21h4M12 3a6 6 0 0 0-3.5 10.9c.5.4.8 1 .8 1.6v.5h5.4v-.5c0-.6.3-1.2.8-1.6A6 6 0 0 0 12 3Z"/>',
		'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/>',
		'team' => '<circle cx="8" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M2.5 20c.5-3.5 2.9-6 5.5-6s5 2.5 5.5 6M14 20c.3-2.6 1.7-4.6 3.5-5"/>',
		'sun' => '<circle cx="12" cy="12" r="4.2"/><path d="M12 2.5v2.4M12 19.1v2.4M4.6 4.6l1.7 1.7M17.7 17.7l1.7 1.7M2.5 12h2.4M19.1 12h2.4M4.6 19.4l1.7-1.7M17.7 6.3l1.7-1.7"/>',
		'moon' => '<path d="M20 14.5A8.5 8.5 0 1 1 9.5 4a7 7 0 0 0 10.5 10.5Z"/>',
	);

	if ( ! isset( $icons[ $name ] ) ) $name = 'check';

	return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $icons[ $name ] . '</svg>';
}

/**
 * Star rating renderer
 */
function kt_star_rating( $rating = 5 ) {
	$rating = max( 1, min( 5, intval( $rating ) ) );
	$out = '<div class="kt-stars" aria-label="' . esc_attr( $rating . ' out of 5 stars' ) . '">';
	for ( $i = 1; $i <= 5; $i++ ) {
		$filled = $i <= $rating ? ' is-filled' : '';
		$out .= '<svg class="kt-star' . $filled . '" viewBox="0 0 20 20" width="16" height="16"><path d="M10 1.5 12.6 7l6 .9-4.3 4.2 1 6-5.3-2.8L4.7 18l1-6L1.4 7.9l6-.9Z"/></svg>';
	}
	$out .= '</div>';
	return $out;
}

/**
 * Get a post's content as clean plain text, safe to drop inside our own
 * <p>/<h4>/etc. tags. get_the_content() alone returns the RAW stored content —
 * for posts edited in the block editor that includes literal block comments
 * like <!-- wp:paragraph --> which would otherwise show up as visible text.
 * This runs the same block-parsing the_content() does, then strips the
 * resulting HTML tags since our templates supply their own wrapper element.
 */
function kt_plain_content( $post_id = null ) {
	$content = $post_id ? get_post_field( 'post_content', $post_id ) : get_the_content();

	if ( function_exists( 'has_blocks' ) && has_blocks( $content ) ) {
		$content = do_blocks( $content );
	}

	$content = wp_strip_all_tags( $content );
	return trim( $content );
}

/**
 * Initials from a name, for avatar placeholders
 */
function kt_initials( $name ) {
	$words = preg_split( '/\s+/', trim( $name ) );
	$initials = '';
	foreach ( array_slice( $words, 0, 2 ) as $w ) {
		$initials .= mb_substr( $w, 0, 1 );
	}
	return mb_strtoupper( $initials );
}

/**
 * Embed a map pointing at the configured company location.
 * Uses Google's keyless embed endpoint — no API key/billing required.
 */
function kt_render_map( $height = 380 ) {
	$query = get_theme_mod( 'kt_map_query', 'Chamati, Kathmandu-16, Nepal' );
	$src = 'https://www.google.com/maps?q=' . rawurlencode( $query ) . '&output=embed';
	?>
	<div class="kt-map-embed">
		<iframe
			src="<?php echo esc_url( $src ); ?>"
			width="100%"
			height="<?php echo esc_attr( $height ); ?>"
			style="border:0;"
			allowfullscreen=""
			loading="lazy"
			referrerpolicy="no-referrer-when-downgrade"
			title="<?php esc_attr_e( 'KutkiTech Pvt. Ltd. location map', 'kutkitech' ); ?>">
		</iframe>
	</div>
	<?php
}

/**
 * Renders a CV-upload job application form.
 *
 * @param string $wrap_id     DOM id for the wrapping element (used by the apply-toggle button).
 * @param string $job_title   Pre-fills the hidden job_title field sent to the backend.
 * @param bool   $always_visible  If true, renders without the [hidden] attribute (used for the standalone General Application form).
 */
function kt_render_apply_form( $wrap_id, $job_title, $always_visible = false ) {
	$uid = esc_attr( $wrap_id );
	?>
	<div class="kt-job-apply" id="<?php echo $uid; ?>"<?php echo $always_visible ? '' : ' hidden'; ?>>
		<form class="kt-ajax-form kt-apply-form" data-ajax-action="kt_job_application">
			<input type="hidden" name="job_title" value="<?php echo esc_attr( $job_title ); ?>">

			<div class="kt-form-row">
				<div class="kt-form-field">
					<label for="<?php echo $uid; ?>-name">Full Name</label>
					<input type="text" id="<?php echo $uid; ?>-name" name="name" required>
				</div>
				<div class="kt-form-field">
					<label for="<?php echo $uid; ?>-email">Email Address</label>
					<input type="email" id="<?php echo $uid; ?>-email" name="email" required>
				</div>
			</div>
			<div class="kt-form-field">
				<label for="<?php echo $uid; ?>-phone">Phone Number</label>
				<input type="tel" id="<?php echo $uid; ?>-phone" name="phone">
			</div>
			<div class="kt-form-field">
				<label for="<?php echo $uid; ?>-cv">Upload CV <span class="kt-field-hint">(PDF, max 512KB)</span></label>
				<input type="file" id="<?php echo $uid; ?>-cv" name="kt_cv" accept="application/pdf" data-max-size="524288" required>
				<p class="kt-file-error" hidden></p>
			</div>
			<div class="kt-form-field">
				<label for="<?php echo $uid; ?>-message">Note <span class="kt-field-hint">(optional)</span></label>
				<textarea id="<?php echo $uid; ?>-message" name="message" rows="3"></textarea>
			</div>

			<div class="kt-hp-field" aria-hidden="true">
				<label for="<?php echo $uid; ?>-website">Website</label>
				<input type="text" id="<?php echo $uid; ?>-website" name="kt_website" tabindex="-1" autocomplete="off">
			</div>

			<button type="submit" class="kt-btn kt-btn-primary kt-form-submit">
				<span class="kt-btn-text">Submit Application</span>
				<span class="kt-btn-spinner" hidden></span>
			</button>
			<div class="kt-form-status" role="status" aria-live="polite"></div>
		</form>
	</div>
	<?php
}

/**
 * Reusable page header/banner for interior pages
 */
function kt_page_header( $eyebrow, $title, $subtitle = '' ) {
	?>
	<header class="kt-page-header reveal-up">
		<div class="kt-container">
			<span class="kt-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
			<h1><?php echo esc_html( $title ); ?></h1>
			<?php if ( $subtitle ) : ?>
				<p class="kt-page-subtitle"><?php echo esc_html( $subtitle ); ?></p>
			<?php endif; ?>
		</div>
	</header>
	<?php
}

/**
 * Section eyebrow + title block
 */
function kt_section_heading( $eyebrow, $title, $desc = '', $align = 'center' ) {
	?>
	<div class="kt-section-heading align-<?php echo esc_attr( $align ); ?> reveal-up">
		<span class="kt-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
		<h2><?php echo wp_kses_post( $title ); ?></h2>
		<?php if ( $desc ) : ?><p><?php echo esc_html( $desc ); ?></p><?php endif; ?>
	</div>
	<?php
}
