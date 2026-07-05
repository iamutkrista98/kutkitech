<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Minimal textarea control — core's Customizer API has no built-in multi-line text type.
 * Defined on customize_register (priority 1) so WP_Customize_Control is guaranteed to exist.
 */
function kt_register_textarea_control_class() {
	if ( ! class_exists( 'WP_Customize_Control' ) || class_exists( 'KT_Textarea_Control' ) ) return;

	class KT_Textarea_Control extends WP_Customize_Control {
		public $type = 'kt_textarea';

		public function render_content() {
			?>
			<label>
				<?php if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>
				<textarea rows="4" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}
}
add_action( 'customize_register', 'kt_register_textarea_control_class', 1 );

/**
 * Helper: batch-register text/textarea settings + controls for a section
 */
function kt_add_copy_settings( $wp_customize, $section, $items ) {
	foreach ( $items as $id => $config ) {
		list( $default, $type ) = $config;
		$wp_customize->add_setting( $id, array(
			'default'           => $default,
			'sanitize_callback' => $type === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field',
		) );

		if ( $type === 'textarea' && class_exists( 'KT_Textarea_Control' ) ) {
			$wp_customize->add_control( new KT_Textarea_Control( $wp_customize, $id, array(
				'label'    => ucwords( str_replace( array( 'kt_', '_' ), array( '', ' ' ), $id ) ),
				'section'  => $section,
				'settings' => $id,
			) ) );
		} else {
			$wp_customize->add_control( $id, array(
				'label'   => ucwords( str_replace( array( 'kt_', '_' ), array( '', ' ' ), $id ) ),
				'section' => $section,
				'type'    => 'text',
			) );
		}
	}
}

function kt_customize_register( $wp_customize ) {

	/* ---------------------------------------------------------
	   Contact info
	--------------------------------------------------------- */
	$wp_customize->add_section( 'kt_contact_section', array(
		'title'    => __( 'Company Contact Info', 'kutkitech' ),
		'priority' => 30,
	) );

	$fields = array(
		'kt_phone'      => '01-5904130',
		'kt_email'      => 'info@kutkitech.com',
		'kt_address'    => 'Chamati, Kathmandu-16, Nepal',
		'kt_facebook'   => 'https://www.facebook.com/profile.php?id=61587502587492',
		'kt_linkedin'   => 'https://www.linkedin.com/company/kutkitech/',
		'kt_tagline'    => 'Build Intrinsically',
	);

	foreach ( $fields as $id => $default ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => ucwords( str_replace( array( 'kt_', '_' ), array( '', ' ' ), $id ) ),
			'section' => 'kt_contact_section',
			'type'    => 'text',
		) );
	}

	// Map embed (Contact Us page) — no Google Maps API key required, uses the public embed endpoint
	$wp_customize->add_setting( 'kt_map_query', array(
		'default'           => 'Chamati, Kathmandu-16, Nepal',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'kt_map_query', array(
		'label'       => __( 'Map Location (address or "lat,lng")', 'kutkitech' ),
		'description' => __( 'Points the map on the Contact Us page. No API key needed.', 'kutkitech' ),
		'section'     => 'kt_contact_section',
		'type'        => 'text',
	) );

	/* ---------------------------------------------------------
	   Homepage stats
	--------------------------------------------------------- */
	$wp_customize->add_section( 'kt_stats_section', array(
		'title'    => __( 'Homepage Stats', 'kutkitech' ),
		'priority' => 31,
	) );

	$stats = array(
		'kt_stat_1_num' => '4+', 'kt_stat_1_label' => 'Clients Acquired',
		'kt_stat_2_num' => '99.9%', 'kt_stat_2_label' => 'Efficient Development',
		'kt_stat_3_num' => '24/7', 'kt_stat_3_label' => 'Service Availability',
	);

	foreach ( $stats as $id => $default ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => ucwords( str_replace( array( 'kt_', '_' ), array( '', ' ' ), $id ) ),
			'section' => 'kt_stats_section',
			'type'    => 'text',
		) );
	}

	/* ---------------------------------------------------------
	   Homepage copy (hero + why-choose-us heading + CTA)
	--------------------------------------------------------- */
	$wp_customize->add_section( 'kt_home_copy_section', array(
		'title'    => __( 'Homepage Copy', 'kutkitech' ),
		'priority' => 32,
	) );

	kt_add_copy_settings( $wp_customize, 'kt_home_copy_section', array(
		'kt_hero_eyebrow'   => array( 'Founded 2025 · A Pointer Holdings Company', 'text' ),
		'kt_hero_title'     => array( 'Empowering Businesses, Transforming Ideas', 'text' ),
		'kt_hero_highlight' => array( 'Into Reality', 'text' ),
		'kt_hero_desc'    => array( "We deliver innovative software, Odoo-based ERP solutions, and consulting services that help you grow with confidence. From startups to enterprises, our multidisciplinary team adapts to any technological demand — ensuring secure, scalable, future-ready solutions.", 'textarea' ),
		'kt_why_title'    => array( 'Insourcing, outsourcing, and everything an ERP rollout needs', 'text' ),
		'kt_why_desc'     => array( 'KutkiTech is experienced in insourcing and outsourcing software development, and the deployment of large IT systems — including ERP solutions and system integration — placing us in a position to deliver the best products and solutions without the high costs of doing business.', 'textarea' ),
		'kt_cta_title'    => array( 'Remember us for any IT-related services or consultation.', 'text' ),
		'kt_cta_desc'     => array( "We're available 24/7 at your service.", 'text' ),
	) );

	/* ---------------------------------------------------------
	   About page copy (mission/vision/values blurbs)
	--------------------------------------------------------- */
	$wp_customize->add_section( 'kt_about_copy_section', array(
		'title'       => __( 'About Page Copy', 'kutkitech' ),
		'priority'    => 33,
		'description' => __( 'The long-form About intro paragraphs are edited on the About Us page itself (Pages → About Us → Edit). These fields control the short mission/vision/values cards.', 'kutkitech' ),
	) );

	kt_add_copy_settings( $wp_customize, 'kt_about_copy_section', array(
		'kt_mission_text' => array( 'We develop and deliver client-centric software platforms backed by exceptional service, adding value to corporates, NGOs, INGOs, and government institutions.', 'textarea' ),
		'kt_vision_text'  => array( 'We provide innovative software solutions that empower organizations worldwide to reach their full potential.', 'textarea' ),
		'kt_values_text'  => array( 'We strive for perfection, perform with excellence, and continuously evolve — teamwork and collaboration are at the heart of how we innovate.', 'textarea' ),
	) );
}
add_action( 'customize_register', 'kt_customize_register' );
