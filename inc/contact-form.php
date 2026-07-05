<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Max upload size for CVs/documents in bytes. 512 KB, per site requirement.
 */
define( 'KT_MAX_UPLOAD_BYTES', 512 * 1024 );

/**
 * Handle contact form submissions via admin-ajax.php
 * Works on any WordPress install (XAMPP local or live hosting) — no plugin required.
 */
function kt_handle_contact_form() {

	check_ajax_referer( 'kt_contact_nonce', 'nonce' );

	// Honeypot field — bots fill it, humans never see it (hidden via CSS)
	if ( ! empty( $_POST['kt_website'] ) ) {
		wp_send_json_success( array( 'message' => 'Thank you!' ) ); // silently pretend success to the bot
	}

	$name    = isset( $_POST['name'] )    ? sanitize_text_field( wp_unslash( $_POST['name'] ) )    : '';
	$email   = isset( $_POST['email'] )   ? sanitize_email( wp_unslash( $_POST['email'] ) )         : '';
	$phone   = isset( $_POST['phone'] )   ? sanitize_text_field( wp_unslash( $_POST['phone'] ) )    : '';
	$subject = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) )  : 'New Inquiry';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	$errors = array();
	if ( empty( $name ) )                       $errors[] = 'Please enter your name.';
	if ( empty( $email ) || ! is_email( $email ) ) $errors[] = 'Please enter a valid email address.';
	if ( empty( $message ) )                    $errors[] = 'Please enter a message.';

	// Optional file attachment (CV or any supporting document)
	$attachment_url = '';
	if ( ! empty( $_FILES['kt_attachment'] ) && ! empty( $_FILES['kt_attachment']['name'] ) ) {
		$upload = kt_handle_pdf_upload( 'kt_attachment' );
		if ( is_wp_error( $upload ) ) {
			$errors[] = $upload->get_error_message();
		} else {
			$attachment_url = $upload;
		}
	}

	if ( ! empty( $errors ) ) {
		wp_send_json_error( array( 'message' => implode( ' ', $errors ) ) );
	}

	$to      = get_theme_mod( 'kt_email', get_option( 'admin_email' ) );
	$subject_line = '[KutkiTech Website] ' . $subject;

	$body  = "You have a new inquiry from the KutkiTech website:\n\n";
	$body .= "Name: {$name}\n";
	$body .= "Email: {$email}\n";
	if ( $phone ) $body .= "Phone: {$phone}\n";
	$body .= "\nMessage:\n{$message}\n";
	if ( $attachment_url ) $body .= "\nAttachment: {$attachment_url}\n";

	$headers = array( 'Content-Type: text/plain; charset=UTF-8', "Reply-To: {$name} <{$email}>" );

	$sent = wp_mail( $to, $subject_line, $body, $headers );

	// Also store the submission as a private post so nothing is lost if mail fails (common on local XAMPP setups without SMTP)
	$lead_id = wp_insert_post( array(
		'post_type'    => 'kt_lead',
		'post_status'  => 'private',
		'post_title'   => sprintf( '%s — %s', $name, $email ),
		'post_content' => $body,
	) );
	if ( $lead_id && $attachment_url ) {
		update_post_meta( $lead_id, 'kt_attachment_url', $attachment_url );
	}

	if ( $sent ) {
		wp_send_json_success( array( 'message' => "Thanks {$name}! Your message has been sent — we'll be in touch soon." ) );
	} else {
		// Mail may fail on local XAMPP without an SMTP plugin configured — but the lead is still saved above.
		wp_send_json_success( array( 'message' => "Thanks {$name}! Your message has been received and logged." ) );
	}
}
add_action( 'wp_ajax_kt_contact_form', 'kt_handle_contact_form' );
add_action( 'wp_ajax_nopriv_kt_contact_form', 'kt_handle_contact_form' );

/**
 * Handle Careers job-application submissions (name, email, phone, job title, required CV)
 */
function kt_handle_job_application() {

	check_ajax_referer( 'kt_contact_nonce', 'nonce' );

	if ( ! empty( $_POST['kt_website'] ) ) {
		wp_send_json_success( array( 'message' => 'Thank you!' ) );
	}

	$name  = isset( $_POST['name'] )     ? sanitize_text_field( wp_unslash( $_POST['name'] ) )     : '';
	$email = isset( $_POST['email'] )    ? sanitize_email( wp_unslash( $_POST['email'] ) )          : '';
	$phone = isset( $_POST['phone'] )    ? sanitize_text_field( wp_unslash( $_POST['phone'] ) )     : '';
	$job   = isset( $_POST['job_title'] )? sanitize_text_field( wp_unslash( $_POST['job_title'] ) ) : 'General Application';
	$note  = isset( $_POST['message'] )  ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	$errors = array();
	if ( empty( $name ) )                          $errors[] = 'Please enter your name.';
	if ( empty( $email ) || ! is_email( $email ) )  $errors[] = 'Please enter a valid email address.';

	if ( empty( $_FILES['kt_cv'] ) || empty( $_FILES['kt_cv']['name'] ) ) {
		$errors[] = 'Please attach your CV (PDF, under 512KB).';
	}

	$cv_url = '';
	if ( empty( $errors ) ) {
		$upload = kt_handle_pdf_upload( 'kt_cv' );
		if ( is_wp_error( $upload ) ) {
			$errors[] = $upload->get_error_message();
		} else {
			$cv_url = $upload;
		}
	}

	if ( ! empty( $errors ) ) {
		wp_send_json_error( array( 'message' => implode( ' ', $errors ) ) );
	}

	$application_id = wp_insert_post( array(
		'post_type'    => 'kt_application',
		'post_status'  => 'private',
		'post_title'   => sprintf( '%s — %s', $name, $job ),
		'post_content' => $note,
	) );

	if ( $application_id ) {
		update_post_meta( $application_id, 'kt_applicant_email', $email );
		update_post_meta( $application_id, 'kt_applicant_phone', $phone );
		update_post_meta( $application_id, 'kt_job_title', $job );
		update_post_meta( $application_id, 'kt_cv_url', $cv_url );
	}

	$to = get_theme_mod( 'kt_email', get_option( 'admin_email' ) );
	$subject_line = '[KutkiTech Careers] New application — ' . $job;
	$body  = "New job application received:\n\n";
	$body .= "Name: {$name}\nEmail: {$email}\n";
	if ( $phone ) $body .= "Phone: {$phone}\n";
	$body .= "Role: {$job}\nCV: {$cv_url}\n";
	if ( $note ) $body .= "\nNote:\n{$note}\n";
	wp_mail( $to, $subject_line, $body, array( 'Content-Type: text/plain; charset=UTF-8', "Reply-To: {$name} <{$email}>" ) );

	wp_send_json_success( array( 'message' => "Thanks {$name}! Your application for \"{$job}\" has been received." ) );
}
add_action( 'wp_ajax_kt_job_application', 'kt_handle_job_application' );
add_action( 'wp_ajax_nopriv_kt_job_application', 'kt_handle_job_application' );

/**
 * Securely validate and store a PDF upload (CV or supporting document).
 * Enforces: PDF only (extension + real MIME sniff), size <= KT_MAX_UPLOAD_BYTES.
 * Files are stored outside the Media Library in a dedicated, non-executable uploads folder.
 *
 * @param string $field_key $_FILES key.
 * @return string|WP_Error Public URL of the stored file, or WP_Error on failure.
 */
function kt_handle_pdf_upload( $field_key ) {
	if ( empty( $_FILES[ $field_key ] ) ) {
		return new WP_Error( 'kt_upload', 'No file was received.' );
	}

	$file = $_FILES[ $field_key ];

	if ( ! empty( $file['error'] ) && $file['error'] !== UPLOAD_ERR_OK ) {
		return new WP_Error( 'kt_upload', 'The file could not be uploaded. Please try again.' );
	}

	if ( $file['size'] <= 0 || $file['size'] > KT_MAX_UPLOAD_BYTES ) {
		return new WP_Error( 'kt_upload', 'File must be a PDF under 512KB.' );
	}

	// Extension check
	$filetype = wp_check_filetype( $file['name'], array( 'pdf' => 'application/pdf' ) );
	if ( empty( $filetype['ext'] ) || 'pdf' !== $filetype['ext'] ) {
		return new WP_Error( 'kt_upload', 'Only PDF files are accepted.' );
	}

	// Real MIME sniff — don't trust the extension or the browser-supplied content-type
	if ( function_exists( 'finfo_open' ) ) {
		$finfo = finfo_open( FILEINFO_MIME_TYPE );
		$real_mime = finfo_file( $finfo, $file['tmp_name'] );
		finfo_close( $finfo );
		if ( 'application/pdf' !== $real_mime ) {
			return new WP_Error( 'kt_upload', 'The uploaded file is not a valid PDF.' );
		}
	}

	// Store outside the public Media Library, in wp-content/uploads/kutkitech-files/
	add_filter( 'upload_dir', 'kt_custom_upload_dir' );
	kt_protect_upload_dir();

	$overrides = array(
		'test_form' => false,
		'mimes'     => array( 'pdf' => 'application/pdf' ),
	);

	require_once ABSPATH . 'wp-admin/includes/file.php';

	// Randomize filename to avoid collisions/enumeration while keeping it human-recognizable
	$original_name = sanitize_file_name( pathinfo( $file['name'], PATHINFO_FILENAME ) );
	$file['name']  = substr( $original_name, 0, 40 ) . '-' . wp_generate_password( 8, false ) . '.pdf';

	$moved = wp_handle_upload( $file, $overrides );

	remove_filter( 'upload_dir', 'kt_custom_upload_dir' );

	if ( isset( $moved['error'] ) ) {
		return new WP_Error( 'kt_upload', 'Upload failed: ' . $moved['error'] );
	}

	return $moved['url'];
}

/**
 * Redirect uploads handled by kt_handle_pdf_upload() into their own subfolder.
 */
function kt_custom_upload_dir( $dirs ) {
	$dirs['subdir'] = '/kutkitech-files';
	$dirs['path']   = $dirs['basedir'] . $dirs['subdir'];
	$dirs['url']    = $dirs['baseurl'] . $dirs['subdir'];
	return $dirs;
}

/**
 * Ensure the CV/document upload folder exists and can't execute PHP or be listed.
 * Runs once (guarded by a transient) rather than on every upload.
 */
function kt_protect_upload_dir() {
	if ( get_transient( 'kt_upload_dir_protected' ) ) return;

	$upload_dir = wp_upload_dir();
	$dir = $upload_dir['basedir'] . '/kutkitech-files';

	if ( ! file_exists( $dir ) ) {
		wp_mkdir_p( $dir );
	}

	$htaccess = $dir . '/.htaccess';
	if ( ! file_exists( $htaccess ) ) {
		file_put_contents( $htaccess, "php_flag engine off\n<FilesMatch \"\\.(php|php\\d|phtml|pl|py|cgi|asp|aspx)$\">\nDeny from all\n</FilesMatch>\nOptions -Indexes\n" );
	}

	$index = $dir . '/index.php';
	if ( ! file_exists( $index ) ) {
		file_put_contents( $index, "<?php\n// Silence is golden.\n" );
	}

	set_transient( 'kt_upload_dir_protected', 1, DAY_IN_SECONDS );
}

/**
 * Private CPT to log leads/submissions (visible only in wp-admin)
 */
function kt_register_lead_cpt() {
	register_post_type( 'kt_lead', array(
		'labels'       => array( 'name' => 'Contact Leads', 'singular_name' => 'Lead' ),
		'public'       => false,
		'show_ui'      => true,
		'show_in_menu' => true,
		'menu_icon'    => 'dashicons-email-alt',
		'supports'     => array( 'title', 'editor' ),
		'capabilities' => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap' => true,
	) );

	register_post_meta( 'kt_lead', 'kt_attachment_url', array(
		'type' => 'string', 'single' => true, 'show_in_rest' => true,
	) );
}
add_action( 'init', 'kt_register_lead_cpt' );

/**
 * Show the attachment link on the Lead edit screen
 */
function kt_lead_attachment_meta_box() {
	add_meta_box( 'kt_lead_attachment', 'Attachment', function ( $post ) {
		$url = get_post_meta( $post->ID, 'kt_attachment_url', true );
		echo $url ? '<p><a href="' . esc_url( $url ) . '" target="_blank" rel="noopener">Download attachment (PDF)</a></p>' : '<p>No attachment.</p>';
	}, 'kt_lead', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'kt_lead_attachment_meta_box' );
