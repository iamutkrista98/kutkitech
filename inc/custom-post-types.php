<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * CPT: Service
 */
function kt_register_service_cpt() {
	register_post_type( 'kt_service', array(
		'labels' => array(
			'name'          => 'Services',
			'singular_name' => 'Service',
			'add_new_item'  => 'Add New Service',
			'edit_item'     => 'Edit Service',
			'menu_name'     => 'Services',
		),
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-admin-tools',
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
		'rewrite'      => array( 'slug' => 'service' ),
	) );
}
add_action( 'init', 'kt_register_service_cpt' );

/**
 * CPT: Testimonial
 */
function kt_register_testimonial_cpt() {
	register_post_type( 'kt_testimonial', array(
		'labels' => array(
			'name'          => 'Testimonials',
			'singular_name' => 'Testimonial',
			'add_new_item'  => 'Add New Testimonial',
			'edit_item'     => 'Edit Testimonial',
			'menu_name'     => 'Testimonials',
		),
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-format-quote',
		'supports'     => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'rewrite'      => array( 'slug' => 'testimonial' ),
	) );

	register_post_meta( 'kt_testimonial', 'kt_client_role', array(
		'type' => 'string', 'single' => true, 'show_in_rest' => true,
	) );
	register_post_meta( 'kt_testimonial', 'kt_rating', array(
		'type' => 'integer', 'single' => true, 'show_in_rest' => true, 'default' => 5,
	) );
}
add_action( 'init', 'kt_register_testimonial_cpt' );

/**
 * CPT: Team Member
 */
function kt_register_team_cpt() {
	register_post_type( 'kt_team', array(
		'labels' => array(
			'name'          => 'Team Members',
			'singular_name' => 'Team Member',
			'add_new_item'  => 'Add New Team Member',
			'edit_item'     => 'Edit Team Member',
			'menu_name'     => 'Our Team',
		),
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-groups',
		'supports'     => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'rewrite'      => array( 'slug' => 'team' ),
	) );

	register_post_meta( 'kt_team', 'kt_role', array(
		'type' => 'string', 'single' => true, 'show_in_rest' => true,
	) );
	register_post_meta( 'kt_team', 'kt_linkedin', array(
		'type' => 'string', 'single' => true, 'show_in_rest' => true,
	) );
}
add_action( 'init', 'kt_register_team_cpt' );

/**
 * CPT: Job Opening (Careers)
 */
function kt_register_job_cpt() {
	register_post_type( 'kt_job', array(
		'labels' => array(
			'name'          => 'Job Openings',
			'singular_name' => 'Job Opening',
			'add_new_item'  => 'Add New Job Opening',
			'edit_item'     => 'Edit Job Opening',
			'menu_name'     => 'Careers',
		),
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-businessman',
		'supports'     => array( 'title', 'editor', 'page-attributes' ),
		'rewrite'      => array( 'slug' => 'job' ),
	) );

	register_post_meta( 'kt_job', 'kt_job_type', array(
		'type' => 'string', 'single' => true, 'show_in_rest' => true, 'default' => 'Full-time',
	) );
	register_post_meta( 'kt_job', 'kt_job_location', array(
		'type' => 'string', 'single' => true, 'show_in_rest' => true, 'default' => 'Kathmandu, Nepal',
	) );
}
add_action( 'init', 'kt_register_job_cpt' );

/**
 * CPT: Download (brochures, docs)
 */
function kt_register_download_cpt() {
	register_post_type( 'kt_download', array(
		'labels' => array(
			'name'          => 'Downloads',
			'singular_name' => 'Download',
			'add_new_item'  => 'Add New Download',
			'edit_item'     => 'Edit Download',
			'menu_name'     => 'Downloads',
		),
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-download',
		'supports'     => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'rewrite'      => array( 'slug' => 'download' ),
	) );

	register_post_meta( 'kt_download', 'kt_file_url', array(
		'type' => 'string', 'single' => true, 'show_in_rest' => true,
	) );
	register_post_meta( 'kt_download', 'kt_file_size', array(
		'type' => 'string', 'single' => true, 'show_in_rest' => true,
	) );
}
add_action( 'init', 'kt_register_download_cpt' );

/**
 * CPT: FAQ (homepage accordion)
 */
function kt_register_faq_cpt() {
	register_post_type( 'kt_faq', array(
		'labels' => array(
			'name'          => 'FAQs',
			'singular_name' => 'FAQ',
			'add_new_item'  => 'Add New FAQ',
			'edit_item'     => 'Edit FAQ',
			'menu_name'     => 'FAQs',
		),
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-editor-help',
		'supports'     => array( 'title', 'editor', 'page-attributes' ),
		'rewrite'      => array( 'slug' => 'faq' ),
	) );
}
add_action( 'init', 'kt_register_faq_cpt' );

/**
 * CPT: Value / Perk card — reused on About ("Foundation" grid) and
 * Careers ("Why KutkiTech" grid), distinguished by the kt_context field.
 */
function kt_register_value_cpt() {
	register_post_type( 'kt_value', array(
		'labels' => array(
			'name'          => 'Values & Perks',
			'singular_name' => 'Value / Perk',
			'add_new_item'  => 'Add New Value / Perk',
			'edit_item'     => 'Edit Value / Perk',
			'menu_name'     => 'Values & Perks',
		),
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-star-filled',
		'supports'     => array( 'title', 'editor', 'page-attributes' ),
		'rewrite'      => array( 'slug' => 'value' ),
	) );

	register_post_meta( 'kt_value', 'kt_context', array(
		'type' => 'string', 'single' => true, 'show_in_rest' => true, 'default' => 'about',
	) );
	register_post_meta( 'kt_value', 'kt_icon', array(
		'type' => 'string', 'single' => true, 'show_in_rest' => true, 'default' => 'check',
	) );
}
add_action( 'init', 'kt_register_value_cpt' );

/**
 * CPT: Timeline entry (About "Our Journey")
 */
function kt_register_timeline_cpt() {
	register_post_type( 'kt_timeline', array(
		'labels' => array(
			'name'          => 'Timeline',
			'singular_name' => 'Timeline Entry',
			'add_new_item'  => 'Add New Timeline Entry',
			'edit_item'     => 'Edit Timeline Entry',
			'menu_name'     => 'Timeline',
		),
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-clock',
		'supports'     => array( 'title', 'editor', 'page-attributes' ),
		'rewrite'      => array( 'slug' => 'timeline' ),
	) );
}
add_action( 'init', 'kt_register_timeline_cpt' );

/**
 * CPT: "Why choose us" item (homepage)
 */
function kt_register_why_cpt() {
	register_post_type( 'kt_why', array(
		'labels' => array(
			'name'          => 'Why Choose Us Items',
			'singular_name' => 'Why Choose Us Item',
			'add_new_item'  => 'Add New Item',
			'edit_item'     => 'Edit Item',
			'menu_name'     => 'Why Choose Us',
		),
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-thumbs-up',
		'supports'     => array( 'title', 'editor', 'page-attributes' ),
		'rewrite'      => array( 'slug' => 'why-us' ),
	) );

	register_post_meta( 'kt_why', 'kt_icon', array(
		'type' => 'string', 'single' => true, 'show_in_rest' => true, 'default' => 'check',
	) );
}
add_action( 'init', 'kt_register_why_cpt' );

/**
 * CPT: Industry tag (Services page tag cloud)
 */
function kt_register_industry_cpt() {
	register_post_type( 'kt_industry', array(
		'labels' => array(
			'name'          => 'Industries',
			'singular_name' => 'Industry',
			'add_new_item'  => 'Add New Industry',
			'edit_item'     => 'Edit Industry',
			'menu_name'     => 'Industries',
		),
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-tag',
		'supports'     => array( 'title', 'page-attributes' ),
		'rewrite'      => array( 'slug' => 'industry' ),
	) );
}
add_action( 'init', 'kt_register_industry_cpt' );

/**
 * CPT: Job Application — private, stores CV upload + applicant details
 */
function kt_register_application_cpt() {
	register_post_type( 'kt_application', array(
		'labels'       => array( 'name' => 'Job Applications', 'singular_name' => 'Application' ),
		'public'       => false,
		'show_ui'      => true,
		'show_in_menu' => true,
		'menu_icon'    => 'dashicons-media-document',
		'supports'     => array( 'title', 'editor' ),
		'capabilities' => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap' => true,
	) );

	register_post_meta( 'kt_application', 'kt_applicant_email', array( 'type' => 'string', 'single' => true, 'show_in_rest' => true ) );
	register_post_meta( 'kt_application', 'kt_applicant_phone', array( 'type' => 'string', 'single' => true, 'show_in_rest' => true ) );
	register_post_meta( 'kt_application', 'kt_job_title', array( 'type' => 'string', 'single' => true, 'show_in_rest' => true ) );
	register_post_meta( 'kt_application', 'kt_cv_url', array( 'type' => 'string', 'single' => true, 'show_in_rest' => true ) );
}
add_action( 'init', 'kt_register_application_cpt' );

/**
 * Meta boxes for the custom fields above (simple, no plugin dependency)
 */
function kt_add_meta_boxes() {
	add_meta_box( 'kt_service_meta', 'Icon', 'kt_render_service_meta', 'kt_service', 'normal', 'high' );
	add_meta_box( 'kt_testimonial_meta', 'Testimonial Details', 'kt_render_testimonial_meta', 'kt_testimonial', 'normal', 'high' );
	add_meta_box( 'kt_team_meta', 'Team Member Details', 'kt_render_team_meta', 'kt_team', 'normal', 'high' );
	add_meta_box( 'kt_job_meta', 'Job Details', 'kt_render_job_meta', 'kt_job', 'normal', 'high' );
	add_meta_box( 'kt_download_meta', 'File Details', 'kt_render_download_meta', 'kt_download', 'normal', 'high' );
	add_meta_box( 'kt_value_meta', 'Display Settings', 'kt_render_value_meta', 'kt_value', 'normal', 'high' );
	add_meta_box( 'kt_why_meta', 'Icon', 'kt_render_why_meta', 'kt_why', 'normal', 'high' );
	add_meta_box( 'kt_application_meta', 'Application Details', 'kt_render_application_meta', 'kt_application', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'kt_add_meta_boxes' );

function kt_render_testimonial_meta( $post ) {
	wp_nonce_field( 'kt_save_meta', 'kt_meta_nonce' );
	$role   = get_post_meta( $post->ID, 'kt_client_role', true );
	$rating = get_post_meta( $post->ID, 'kt_rating', true ) ?: 5;
	?>
	<p><label>Client Role / Company<br>
	<input type="text" name="kt_client_role" value="<?php echo esc_attr( $role ); ?>" class="widefat" placeholder="CEO at Crystal Cleanser Pvt. Ltd." /></label></p>
	<p><label>Rating (1-5)<br>
	<input type="number" min="1" max="5" name="kt_rating" value="<?php echo esc_attr( $rating ); ?>" /></label></p>
	<p><em>Use the main content editor above for the testimonial quote. Featured image = client/company logo (optional).</em></p>
	<?php
}

function kt_render_team_meta( $post ) {
	wp_nonce_field( 'kt_save_meta', 'kt_meta_nonce' );
	$role     = get_post_meta( $post->ID, 'kt_role', true );
	$linkedin = get_post_meta( $post->ID, 'kt_linkedin', true );
	?>
	<p><label>Role / Title<br>
	<input type="text" name="kt_role" value="<?php echo esc_attr( $role ); ?>" class="widefat" placeholder="Lead Software Engineer" /></label></p>
	<p><label>LinkedIn URL<br>
	<input type="url" name="kt_linkedin" value="<?php echo esc_attr( $linkedin ); ?>" class="widefat" placeholder="https://linkedin.com/in/..." /></label></p>
	<?php
}

function kt_render_job_meta( $post ) {
	wp_nonce_field( 'kt_save_meta', 'kt_meta_nonce' );
	$type     = get_post_meta( $post->ID, 'kt_job_type', true ) ?: 'Full-time';
	$location = get_post_meta( $post->ID, 'kt_job_location', true ) ?: 'Kathmandu, Nepal';
	?>
	<p><label>Job Type<br>
	<input type="text" name="kt_job_type" value="<?php echo esc_attr( $type ); ?>" class="widefat" placeholder="Full-time / Internship / Contract" /></label></p>
	<p><label>Location<br>
	<input type="text" name="kt_job_location" value="<?php echo esc_attr( $location ); ?>" class="widefat" /></label></p>
	<?php
}

function kt_render_download_meta( $post ) {
	wp_nonce_field( 'kt_save_meta', 'kt_meta_nonce' );
	$url  = get_post_meta( $post->ID, 'kt_file_url', true );
	$size = get_post_meta( $post->ID, 'kt_file_size', true );
	?>
	<p><label>File URL (upload via Media Library, then paste the link)<br>
	<input type="url" name="kt_file_url" value="<?php echo esc_attr( $url ); ?>" class="widefat" /></label></p>
	<p><label>File Size Label<br>
	<input type="text" name="kt_file_size" value="<?php echo esc_attr( $size ); ?>" class="widefat" placeholder="2.4 MB" /></label></p>
	<?php
}

function kt_render_service_meta( $post ) {
	wp_nonce_field( 'kt_save_meta', 'kt_meta_nonce' );
	$icon = get_post_meta( $post->ID, 'kt_icon', true ) ?: 'check';
	?>
	<p><label>Icon<br>
	<select name="kt_icon" class="widefat"><?php kt_icon_options( $icon ); ?></select></label></p>
	<p><em>Use the Excerpt field for the short card summary shown on the homepage grid.</em></p>
	<?php
}

function kt_render_value_meta( $post ) {
	wp_nonce_field( 'kt_save_meta', 'kt_meta_nonce' );
	$context = get_post_meta( $post->ID, 'kt_context', true ) ?: 'about';
	$icon    = get_post_meta( $post->ID, 'kt_icon', true ) ?: 'check';
	?>
	<p><label>Show On<br>
	<select name="kt_context" class="widefat">
		<option value="about" <?php selected( $context, 'about' ); ?>>About Us &mdash; Foundation grid</option>
		<option value="careers" <?php selected( $context, 'careers' ); ?>>Careers &mdash; Why KutkiTech grid</option>
	</select></label></p>
	<p><label>Icon<br>
	<select name="kt_icon" class="widefat"><?php kt_icon_options( $icon ); ?></select></label></p>
	<?php
}

function kt_render_why_meta( $post ) {
	wp_nonce_field( 'kt_save_meta', 'kt_meta_nonce' );
	$icon = get_post_meta( $post->ID, 'kt_icon', true ) ?: 'check';
	?>
	<p><label>Icon<br>
	<select name="kt_icon" class="widefat"><?php kt_icon_options( $icon ); ?></select></label></p>
	<?php
}

function kt_render_application_meta( $post ) {
	$email = get_post_meta( $post->ID, 'kt_applicant_email', true );
	$phone = get_post_meta( $post->ID, 'kt_applicant_phone', true );
	$job   = get_post_meta( $post->ID, 'kt_job_title', true );
	$cv    = get_post_meta( $post->ID, 'kt_cv_url', true );
	?>
	<p><strong>Applying for:</strong> <?php echo esc_html( $job ?: '—' ); ?></p>
	<p><strong>Email:</strong> <?php echo esc_html( $email ?: '—' ); ?></p>
	<p><strong>Phone:</strong> <?php echo esc_html( $phone ?: '—' ); ?></p>
	<p><strong>CV:</strong> <?php echo $cv ? '<a href="' . esc_url( $cv ) . '" target="_blank" rel="noopener">Download CV (PDF)</a>' : '—'; ?></p>
	<p><em>These fields are set automatically when a candidate submits the Careers application form.</em></p>
	<?php
}

/**
 * Shared <option> list of icons available via kt_icon()
 */
function kt_icon_options( $selected = 'check' ) {
	$options = array( 'target', 'bulb', 'clock', 'security', 'team', 'check', 'briefcase', 'consult', 'web', 'erp', 'mis', 'ai', 'quote', 'download', 'file', 'phone', 'mail', 'pin' );
	foreach ( $options as $opt ) {
		echo '<option value="' . esc_attr( $opt ) . '"' . selected( $selected, $opt, false ) . '>' . esc_html( ucfirst( $opt ) ) . '</option>';
	}
}

function kt_save_meta_boxes( $post_id ) {
	if ( ! isset( $_POST['kt_meta_nonce'] ) || ! wp_verify_nonce( $_POST['kt_meta_nonce'], 'kt_save_meta' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	$fields = array( 'kt_client_role', 'kt_rating', 'kt_role', 'kt_linkedin', 'kt_job_type', 'kt_job_location', 'kt_file_url', 'kt_file_size', 'kt_icon', 'kt_context' );
	foreach ( $fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
		}
	}
}
add_action( 'save_post', 'kt_save_meta_boxes' );
