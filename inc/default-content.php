<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Runs once when the theme is activated. Safe to run multiple times (checks a flag).
 */
function kt_seed_default_content() {
	if ( get_option( 'kt_content_seeded' ) ) return;

	// ---- Services ----
	$services = array(
		array(
			'title'   => 'Odoo Based ERP Solutions',
			'excerpt' => 'End-to-end Odoo ERP implementation tailored to pharmacies, hospitality, retail, NGOs and manufacturing — from setup to staff training.',
			'icon'    => 'erp',
		),
		array(
			'title'   => 'Custom Tailored MIS & MS Systems',
			'excerpt' => 'Purpose-built management information systems designed around how your teams actually work, not the other way around.',
			'icon'    => 'mis',
		),
		array(
			'title'   => 'Web Application & Hosting',
			'excerpt' => 'Interactive, secure web applications with reliable hosting — built for ease of access and long-term maintainability.',
			'icon'    => 'web',
		),
		array(
			'title'   => 'Generative AI Based Solutions',
			'excerpt' => 'AI-powered digital marketing, automation and content tooling that expands your reach without expanding your headcount.',
			'icon'    => 'ai',
		),
		array(
			'title'   => 'IT & Business Consultation',
			'excerpt' => 'Tech and business consultation that promotes efficiency and growth — grounded in real requirement analysis, not templates.',
			'icon'    => 'consult',
		),
		array(
			'title'   => 'Security & Compliance',
			'excerpt' => 'GDPR-compliant solutions engineered with data protection built in from day one, for added peace of mind.',
			'icon'    => 'security',
		),
	);

	foreach ( $services as $i => $s ) {
		$id = wp_insert_post( array(
			'post_type'    => 'kt_service',
			'post_status'  => 'publish',
			'post_title'   => $s['title'],
			'post_content' => $s['excerpt'],
			'post_excerpt' => $s['excerpt'],
			'menu_order'   => $i,
		) );
		if ( $id ) update_post_meta( $id, 'kt_icon', $s['icon'] );
	}

	// ---- Testimonials ----
	$testimonials = array(
		array( 'Raju Ram Adhikari', 'CEO, Crystal Cleanser Pvt. Ltd.', 'KutkiTech has been the go-to for AI based digital marketing, website development and ERP solutions.' ),
		array( 'Madan Khadka', 'CEO, Pointer Holdings Pvt. Ltd.', 'As a subsidiary IT company of Pointer Holdings, KutkiTech has been the go-to for all our technological needs with in-house development and efficient solutions.' ),
		array( 'Rabin Subedi', 'CEO, Sustainable Appliances Pvt. Ltd.', 'KutkiTech has been providing effective AI based digital marketing and advertisement solutions, expanding our reach to customers.' ),
	);
	foreach ( $testimonials as $i => $t ) {
		$id = wp_insert_post( array(
			'post_type'    => 'kt_testimonial',
			'post_status'  => 'publish',
			'post_title'   => $t[0],
			'post_content' => $t[2],
			'menu_order'   => $i,
		) );
		if ( $id ) {
			update_post_meta( $id, 'kt_client_role', $t[1] );
			update_post_meta( $id, 'kt_rating', 5 );
		}
	}

	// ---- Team (placeholder — replace via wp-admin) ----
	$team = array(
		array( 'Leadership Team', 'Founding & Executive Leadership' ),
	);
	foreach ( $team as $i => $m ) {
		$id = wp_insert_post( array(
			'post_type'    => 'kt_team',
			'post_status'  => 'publish',
			'post_title'   => $m[0],
			'post_content' => 'Add each team member as a separate entry under Our Team in wp-admin.',
			'menu_order'   => $i,
		) );
		if ( $id ) update_post_meta( $id, 'kt_role', $m[1] );
	}

	// ---- Careers ----
	$jobs = array(
		array( 'Software Engineer (Odoo/ERP)', 'Full-time', 'We\'re looking for an engineer comfortable across the stack to build and customize Odoo based ERP deployments for our clients.' ),
		array( 'Digital Marketing Associate', 'Full-time', 'Drive AI-assisted digital marketing campaigns for our client portfolio across corporates, NGOs and INGOs.' ),
	);
	foreach ( $jobs as $i => $j ) {
		$id = wp_insert_post( array(
			'post_type'    => 'kt_job',
			'post_status'  => 'publish',
			'post_title'   => $j[0],
			'post_content' => $j[2],
			'menu_order'   => $i,
		) );
		if ( $id ) {
			update_post_meta( $id, 'kt_job_type', $j[1] );
			update_post_meta( $id, 'kt_job_location', 'Kathmandu, Nepal' );
		}
	}

	// ---- FAQs ----
	$faqs = array(
		array( 'What is Kutki Tech Pvt. Ltd.?', 'We are an IT services, consulting, and business solutions provider established in 2025. Our focus is on software development, ERP solutions, and business process outsourcing. With over eight years of combined experience in innovation, we deliver reliable, client-centric platforms that support corporates, NGOs, INGOs, and government institutions.' ),
		array( 'What industries do you provide ERP and software solutions for?', 'Our Odoo-based ERP and tailored solutions serve a wide range of industries, including pharmacies, clothing stores, hotels and hospitality, NGOs/INGOs, restaurants, electronics stores, groceries, gyms, bars and lounges, architecture consultancies, food delivery platforms, HR agencies, manufacturing, and trading businesses.' ),
		array( 'What technologies and platforms do you work with?', 'We are not limited by any single programming language or platform. Our team adapts to diverse technological demands through thorough requirement analysis and solution design — whether that means modern frameworks, enterprise databases, or complex system integrations.' ),
		array( 'How do your values shape the way you work?', 'We approach every project with humility and discipline, keeping customers at the center of every decision. We foster collaboration over hierarchy, and balance speed with uncompromising quality — driven by passion, integrity and responsibility.' ),
		array( 'Who is on your team?', 'We are a multidisciplinary team of 30+ professionals across technology, cybersecurity, business consulting, project management, creative solutions and administration — combining technical precision with strategic insight.' ),
	);
	foreach ( $faqs as $i => $faq ) {
		wp_insert_post( array(
			'post_type'    => 'kt_faq',
			'post_status'  => 'publish',
			'post_title'   => $faq[0],
			'post_content' => $faq[1],
			'menu_order'   => $i,
		) );
	}

	// ---- Values & Perks (About "Foundation" grid) ----
	$about_values = array(
		array( 'Humility & Customer Focus', 'We believe in humility, always striving to improve while keeping customers and colleagues at the center of every decision.', 'target' ),
		array( 'People First', 'We value our people as our greatest asset, fostering satisfaction through collaboration and support rather than hierarchy.', 'team' ),
		array( 'Speed Without Compromise', 'Speed and efficiency drive us — but never at the expense of quality.', 'clock' ),
		array( 'Passion & Integrity', 'Passion and integrity fuel our work, motivating us to go the extra mile while remaining consistent, honest and fair.', 'bulb' ),
		array( 'Discipline', 'We accept responsibility, honor commitments, and deliver results that empower businesses and institutions to thrive.', 'check' ),
		array( 'Future-Ready', 'We continue to innovate, adapt, and provide future-ready solutions across every industry we serve.', 'security' ),
	);
	foreach ( $about_values as $i => $v ) {
		$id = wp_insert_post( array(
			'post_type'    => 'kt_value',
			'post_status'  => 'publish',
			'post_title'   => $v[0],
			'post_content' => $v[1],
			'menu_order'   => $i,
		) );
		if ( $id ) { update_post_meta( $id, 'kt_context', 'about' ); update_post_meta( $id, 'kt_icon', $v[2] ); }
	}

	// ---- Values & Perks (Careers "Why KutkiTech" grid) ----
	$careers_values = array(
		array( 'Collaborative Culture', 'We value people as our greatest asset — support over hierarchy.', 'team' ),
		array( 'Real Ownership', 'Work across ERP, AI, and web platforms for real clients from day one.', 'bulb' ),
		array( 'Balanced Pace', 'Speed and efficiency, without ever compromising on quality.', 'clock' ),
	);
	foreach ( $careers_values as $i => $v ) {
		$id = wp_insert_post( array(
			'post_type'    => 'kt_value',
			'post_status'  => 'publish',
			'post_title'   => $v[0],
			'post_content' => $v[1],
			'menu_order'   => $i,
		) );
		if ( $id ) { update_post_meta( $id, 'kt_context', 'careers' ); update_post_meta( $id, 'kt_icon', $v[2] ); }
	}

	// ---- Timeline (About "Our Journey") ----
	$timeline = array(
		array( '2019', 'Began as a leading distribution service of home appliances from the KHIND (Malaysia) brand, through Sustainable Appliance Nepal.' ),
		array( '2023', 'Expanded our service network through Pointer Holdings, strengthening our reach and capabilities.' ),
		array( '2024', 'Launched eco-friendly bio-chemical cleaning products under the Crystal Cleanser brand, supporting healthier homes and communities.' ),
		array( '2025', 'Established Kutki Tech Pvt. Ltd. as a dedicated company for consulting, business process outsourcing, and software development.' ),
	);
	foreach ( $timeline as $i => $t ) {
		wp_insert_post( array(
			'post_type'    => 'kt_timeline',
			'post_status'  => 'publish',
			'post_title'   => $t[0],
			'post_content' => $t[1],
			'menu_order'   => $i,
		) );
	}

	// ---- Homepage "Why Choose Us" items ----
	$why_items = array(
		array( 'Effective Solutions', 'Tailored to real requirements, not templates.', 'target' ),
		array( 'Timed Delivery', 'Disciplined project execution, on schedule.', 'clock' ),
		array( 'Effective Pricing', 'Enterprise-grade delivery without enterprise overhead.', 'bulb' ),
		array( 'Efficient Support', '24/7 availability when things need attention.', 'security' ),
	);
	foreach ( $why_items as $i => $w ) {
		$id = wp_insert_post( array(
			'post_type'    => 'kt_why',
			'post_status'  => 'publish',
			'post_title'   => $w[0],
			'post_content' => $w[1],
			'menu_order'   => $i,
		) );
		if ( $id ) update_post_meta( $id, 'kt_icon', $w[2] );
	}

	// ---- Industries (Services page tag cloud) ----
	$industries = array( 'Pharmacies', 'Clothing Stores', 'Hotels & Hospitality', 'NGOs / INGOs', 'Restaurants', 'Electronics Stores', 'Groceries', 'Gyms', 'Bars & Lounges', 'Architecture Consultancies', 'Food Delivery Platforms', 'HR Agencies', 'Manufacturing', 'Trading Businesses' );
	foreach ( $industries as $i => $ind ) {
		wp_insert_post( array(
			'post_type'   => 'kt_industry',
			'post_status' => 'publish',
			'post_title'  => $ind,
			'menu_order'  => $i,
		) );
	}

	// ---- Pages ----
	$about_intro_content = "<p class=\"kt-lead\">At Kutki Tech Pvt. Ltd., we believe innovation and collective knowledge can transform the future with greater purpose. Founded in 2025 as a sister company to Sustainable Appliance Nepal and Pointer Holdings, we bring over eight years of combined experience in IT services, consulting, and business solutions.</p>\n"
		. "<p>We specialize in developing reliable, client-centric software platforms, ERP solutions, and business process outsourcing that empower corporates, NGOs, INGOs, and government institutions to achieve their full potential. Our multidisciplinary team of 30+ professionals combines expertise in technology, business consulting, project management, and creative solutions to deliver secure, scalable, and future-ready systems.</p>\n"
		. "<p>Guided by values of humility, customer focus, integrity, and passion, we continuously innovate while fostering teamwork and collaboration. From software development to enterprise integration, we adapt to any technological demand through thorough requirement analysis, ensuring solutions that are tailored, impactful, and sustainable.</p>\n"
		. "<p class=\"kt-highlight\">At Kutki Tech, we don't just build software — we build intrinsically, with purpose and confidence.</p>";

	$pages = array(
		'home'     => array( 'Home', '', 'front-page.php' ),
		'about'    => array( 'About Us', $about_intro_content, 'page-templates/page-about.php' ),
		'services' => array( 'Services', '', 'page-templates/page-services.php' ),
		'team'     => array( 'Our Team', '', 'page-templates/page-team.php' ),
		'careers'  => array( 'Careers', '', 'page-templates/page-careers.php' ),
		'downloads'=> array( 'Downloads', '', 'page-templates/page-downloads.php' ),
		'contact'  => array( 'Contact Us', '', 'page-templates/page-contact.php' ),
	);

	$page_ids = array();
	foreach ( $pages as $key => $p ) {
		$existing_query = new WP_Query( array(
			'post_type'              => 'page',
			'title'                  => $p[0],
			'posts_per_page'         => 1,
			'post_status'            => 'any',
			'no_found_rows'          => true,
			'update_post_term_cache' => false,
		) );
		if ( $existing_query->have_posts() ) {
			$page_ids[ $key ] = $existing_query->posts[0]->ID;
			wp_reset_postdata();
			continue;
		}
		$id = wp_insert_post( array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => $p[0],
			'post_content' => $p[1],
		) );
		if ( $id && ! empty( $p[2] ) ) {
			update_post_meta( $id, '_wp_page_template', $p[2] );
		}
		$page_ids[ $key ] = $id;
	}

	if ( ! empty( $page_ids['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $page_ids['home'] );
	}

	// ---- Primary nav menu ----
	if ( ! wp_get_nav_menu_object( 'Main Menu' ) ) {
		$menu_id = wp_create_nav_menu( 'Main Menu' );

		$menu_items = array(
			array( 'title' => 'Home',      'page' => 'home' ),
			array( 'title' => 'About Us',  'page' => 'about' ),
			array( 'title' => 'Services',  'page' => 'services' ),
			array( 'title' => 'Our Team',  'page' => 'team' ),
			array( 'title' => 'Careers',   'page' => 'careers' ),
			array( 'title' => 'Downloads', 'page' => 'downloads' ),
			array( 'title' => 'Contact Us','page' => 'contact' ),
		);

		foreach ( $menu_items as $item ) {
			if ( empty( $page_ids[ $item['page'] ] ) ) continue;
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'     => $item['title'],
				'menu-item-object-id' => $page_ids[ $item['page'] ],
				'menu-item-object'    => 'page',
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			) );
		}

		$locations = get_theme_mod( 'nav_menu_locations' );
		$locations['primary'] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	update_option( 'kt_content_seeded', 1 );
}
add_action( 'after_switch_theme', 'kt_seed_default_content' );
