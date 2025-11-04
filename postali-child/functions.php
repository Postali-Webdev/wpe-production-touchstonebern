<?php
/**
 * Theme functions.
 *
 * @package Postali Child
 * @author Postali LLC
 */
	require_once dirname( __FILE__ ) . '/includes/admin.php';
	require_once dirname( __FILE__ ) . '/includes/utility.php';
	require_once dirname( __FILE__ ) . '/includes/attorneys-cpt.php'; // Custom Post Type Attorneys
	require_once dirname( __FILE__ ) . '/includes/cases-cpt.php'; // Custom Post Type Cases
	require_once dirname( __FILE__ ) . '/includes/job-listings-cpt.php'; // Custom Post Type Job Listings
	


	add_action('wp_enqueue_scripts', 'postali_parent');
	function postali_parent() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/assets/css/styles.css' ); // Enqueue parent theme styles
	
	}  

	add_action('wp_enqueue_scripts', 'postali_child');
	function postali_child() {

		wp_enqueue_style( 'child-styles', get_stylesheet_directory_uri() . '/style.css' ); // Enqueue Child theme style sheet (theme info)
		wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/assets/css/styles.css'); // Enqueue child theme styles.css
		wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/assets/css/slick.css'); // Enqueue child theme styles.css
		
		// wp_register_style( 'google-fonts-montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap', array() );
		// wp_enqueue_style('google-fonts-montserrat');
		
		// wp_register_style( 'google-fonts-quicksand', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap', array() );
		// wp_enqueue_style('google-fonts-quicksand');

		// Compiled .js using Grunt.js
		wp_register_script('custom-scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.min.js',array('jquery'), null, true); 
		wp_enqueue_script('custom-scripts');		
		
		wp_register_script('slick-scripts', get_stylesheet_directory_uri() . '/assets/js/slick.min.js',array('jquery'), null, true); 
		wp_enqueue_script('slick-scripts');		
		
		wp_register_script('slick-custom-scripts', get_stylesheet_directory_uri() . '/assets/js/slick-custom.min.js',array('jquery'), null, true); 
		wp_enqueue_script('slick-custom-scripts');		

		wp_register_script('cookie-scripts', get_stylesheet_directory_uri() . '/assets/js/cookie.min.js',array('jquery'), null, true); 
		wp_enqueue_script('cookie-scripts');		

		if( is_page_template('attorneys-landing.php') ) {
			wp_register_script( 'ajax-script', get_stylesheet_directory_uri() . '/assets/js/ajax-scripts.min.js', array('jquery'), '1.3' );
			wp_localize_script( 'ajax-script', 'ajax_filter_attorneys', array('ajaxurl' => admin_url( 'admin-ajax.php' )));
			wp_enqueue_script( 'ajax-script' );
		}
	}

	// Register Site Navigations
	function postali_child_register_nav_menus() {
		register_nav_menus(
			array(
				'header-nav' => __( 'Header Navigation', 'postali' ),
				'footer-nav' => __( 'Footer Navigation', 'postali' ),
			)
		);
	}
	add_action( 'init', 'postali_child_register_nav_menus' );

	// Add Custom Logo Support
	add_theme_support( 'custom-logo' );

	function postali_custom_logo_setup() {
		$defaults = array(
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		);
		add_theme_support( 'custom-logo', $defaults );
	}
	add_action( 'after_setup_theme', 'postali_custom_logo_setup' );

	// ACF Options Pages
	if( function_exists('acf_add_options_page') ) {
		
		acf_add_options_page(array(
			'page_title'    => 'Instructions',
			'menu_title'    => 'Instructions',
			'menu_slug'     => 'theme-instructions',
			'capability'    => 'edit_posts',
			'icon_url'      => 'dashicons-smiley', // Add this line and replace the second inverted commas with class of the icon you like
			'redirect'      => false
		));

		acf_add_options_page(array(
			'page_title'    => 'Customizations',
			'menu_title'    => 'Customizations',
			'menu_slug'     => 'customizations',
			'capability'    => 'edit_posts',
			'icon_url'      => 'dashicons-admin-customizer', // Add this line and replace the second inverted commas with class of the icon you like
			'redirect'      => false
		));

		acf_add_options_page(array(
			'page_title'    => 'Awards',
			'menu_title'    => 'Awards',
			'menu_slug'     => 'awards',
			'capability'    => 'edit_posts',
			'icon_url'      => 'dashicons-awards', // Add this line and replace the second inverted commas with class of the icon you like
			'redirect'      => false
		));

        acf_add_options_page(array(
			'page_title'    => 'Global Schema',
			'menu_title'    => 'Global Schema',
			'menu_slug'     => 'global_schema',
			'capability'    => 'edit_posts',
			'icon_url'      => 'dashicons-media-code',
			'redirect'      => false
		));

	}

	// Save newly created fields to child theme
	add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
	function my_acf_json_save_point( $path ) {
		
		// update path
		$path = get_stylesheet_directory() . '/acf-json';
		
		// return
		return $path;
	
	}
	
	// Add ability to add SVG to Wordpress Media Library
	function cc_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');
	
	//add SVG to allowed file uploads
	function add_file_types_to_uploads($file_types){

		$new_filetypes = array();
		$new_filetypes['svg'] = 'image/svg+xml';
		$file_types = array_merge($file_types, $new_filetypes );

		return $file_types;
	}
	add_action('upload_mimes', 'add_file_types_to_uploads');


	// Widget Logic Conditionals
	function is_child($parent) {
		global $post;
			return $post->post_parent == $parent;
		}
		
		// Widget Logic Conditionals (ancestor) 
		function is_tree( $pid ) {
		global $post;
		
		if ( is_page($pid) )
		return true;
		
		$anc = get_post_ancestors( $post->ID );
		foreach ( $anc as $ancestor ) {
			if( is_page() && $ancestor == $pid ) {
				return true;
				}
		}
		return false;
	}

	// Display Current Year as shortcode - [year]
	function year_shortcode () {
		$year = date_i18n ('Y');
		return $year;
		}
	add_shortcode ('year', 'year_shortcode');
	
	// WP Backend Menu area taller
	add_action('admin_head', 'taller_menus');

	function taller_menus() {
	echo '<style>
		.posttypediv div.tabs-panel {
			max-height:500px !important;
		}
	</style>';
	}

	// Customize the logo on the wp-login.php page
	function my_login_logo() { ?>
		<style type="text/css">
			#login h1 a, .login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.png);
			height:45px;
			width:204px;
			background-size: 204px 45px;
			background-repeat: no-repeat;
			padding-bottom: 30px;
			}
		</style>
	<?php }
	add_action( 'login_enqueue_scripts', 'my_login_logo' );
	// Contact Form 7 Submission Page Redirect
	add_action( 'wp_footer', 'mycustom_wp_footer' );
	
	function mycustom_wp_footer() {
	?>
	<script type="text/javascript">
	document.addEventListener( 'wpcf7mailsent', function( event ) {
		location = '/form-success/';
	}, false );
	</script>
	<?php
	}

	// Add Search Bar to Top Nav
	function mainmenu_navsearch($items, $args) {
		if ($args->theme_location == 'header-nav') {
			ob_start();
			?>
			<li class="menu-item menu-item-search search-holder">
				<form class="navbar-form-search" role="search" method="get" action="/">
					<div class="search-form-container hdn" id="search-input-container">
						<div class="search-input-group">
							<div class="form-group">
							<input type="text" name="s" placeholder="search..." id="search-input-5cab7fd94d469" value="" class="form-control">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-search" id="search-button"><span class="icon-magnifying-glass" aria-hidden="true"></span></button>
				</form>	
			</li>

			<?php
			$new_items = ob_get_clean();

			$items .= $new_items;
		}
		return $items;
	}
	add_filter('wp_nav_menu_items', 'mainmenu_navsearch', 10, 2);

	// Add template column to page list in wp-admin
	function page_column_views( $defaults ) {
		$defaults['page-layout'] = __('Template');
		return $defaults;
	}
	add_filter( 'manage_pages_columns', 'page_column_views' );

	function page_custom_column_views( $column_name, $id ) {
		if ( $column_name === 'page-layout' ) {
			$set_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
			if ( $set_template == 'default' ) {
				echo 'Default';
			}
			$templates = get_page_templates();
			ksort( $templates );
			foreach ( array_keys( $templates ) as $template ) :
				if ( $set_template == $templates[$template] ) echo $template;
			endforeach;
		}
	}
	add_action( 'manage_pages_custom_column', 'page_custom_column_views', 5, 2 );

	// Register Services Taxonomy
function register_services_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Service', 'Services' ),
		'singular_name'              => _x( 'Service', 'Service' ),
		'menu_name'                  => __( 'Services' ),
		'all_items'                  => __( 'All Services' ),
		'new_item_name'              => __( 'New Service' ),
		'add_new_item'               => __( 'Add Service' ),
		'edit_item'                  => __( 'Edit Service' ),
		'update_item'                => __( 'Update Service' ),
		'view_item'                  => __( 'View Service' ),
		'separate_items_with_commas' => __( 'Separate Services with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Services' ),
		'popular_items'              => __( 'Popular Services' ),
		'search_items'               => __( 'Search Services' ),
		'not_found'                  => __( 'Not Found' ),
		'no_terms'                   => __( 'No Services' ),
	);
    $args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
    );

    register_taxonomy( 'attorney_services', array( 'attorneys', 'cases'), $args );
}
add_action( 'init', 'register_services_taxonomy' );


// Exclude pages on PPC templates from Yoast XML sitemap
function exclude_posts_from_xml_sitemaps() {
	$templates = array(
		'page-ppc-landing.php',
		'page-ppc-detailed-landing.php',
        'page-ppc-landing_v2.php',
        'page-ppc-landing_v3.php',
        'page-ppc-landing-pmax.php',
        'ppc-block.php'
	);

	$ppc_ids = array();
	foreach ( $templates as $template ) {
		//get_page_id_by_template($template);
		$args = [
			'post_type'  => 'page',
			'fields'     => 'ids',
			'nopaging'   => true,
			'meta_key'   => '_wp_page_template',
			'meta_value' => $template
		];

		$ppc_pages = get_posts( $args );
		$ppc_ids = array_merge($ppc_ids, $ppc_pages);
	}
	return ($ppc_ids);
}
add_filter( 'wpseo_exclude_from_sitemap_by_post_ids', 'exclude_posts_from_xml_sitemaps' );

function phone_number_callback() {
    $phone_number = get_field('phone_number','options');
    echo $phone_number;
    wp_die();
}
add_action( 'wp_ajax_get_phone_number', 'phone_number_callback' );
add_action( 'wp_ajax_nopriv_get_phone_number', 'phone_number_callback' );

function custom_mce_buttons($buttons) {
    // Add your custom button to the array
    $buttons[] = 'phone_number_button';
    return $buttons;
}
add_filter('mce_buttons', 'custom_mce_buttons');

function custom_mce_external_plugins($plugins) {
    // Add a JavaScript file that will handle the custom button functionality
    $plugins['phone_number_button'] = get_stylesheet_directory_uri() . '/assets/js/mce-phone-btn.min.js';
    return $plugins;
}
add_filter('mce_external_plugins', 'custom_mce_external_plugins');

// Filter attorneys by name
function attorney_name_filter() {
	global $wp_query;
	$name = $_POST['name'];
	$attorney_args = [
		'post_type' => 'attorneys',
		'posts_per_page' => -1,
		'orderby' => 'meta_value',
    	'meta_key' => 'last_name',
		'order' => 'ASC',
		'meta_query' => [
			[
				'relation' => 'OR',
				[
					'key' => 'first_name',
					'value' => $name,
					'compare' => 'LIKE'
				],
				[
					'key' => 'last_name',
					'value' => $name,
					'compare' => 'LIKE'
				]
			],
			[
				'relation' => 'AND',
				[
					'key' => 'in_memoriam',
					'value' => true,
					'compare' => '!='
				]
			]
		]
	];

	$attorney_query = new WP_Query($attorney_args);
	if( $attorney_query->have_posts() ) : while( $attorney_query->have_posts() ) : $attorney_query->the_post();
	$permalink = get_the_permalink();
	$headshot = get_field('headshot', $post->ID);
	$headshot_url = $headshot['url'];;
	$headshot_alt = $headshot['alt'];
	$first_name = get_field('first_name', $post->ID);
	$last_name = get_field('last_name', $post->ID);
	$job_title = get_the_terms($post->ID, 'attorney_occupation');
	$job_title_name = $job_title[0]->name;
	$response .= "{$results_count}
		<div class='attorney'>
			<a class='attorney-link' href='{$permalink}'></a>
			<div class='img-wrapper'>
				<img src='{$headshot_url}' alt='{$headshot_alt}'>
				<div class='arrow'></div>
			</div>
			<h4 class='name yellow'>{$first_name} {$last_name}</h4>
			<p>{$job_title_name}</p>
		</div>
	";

	endwhile; 

	else : $response = '<p>No attorneys found with that name.</p>';

	endif; wp_reset_postdata();
	echo $response;
	wp_die();

}
add_action('wp_ajax_nopriv_filter_by_name', 'attorney_name_filter');
add_action('wp_ajax_filter_by_name', 'attorney_name_filter');

// Filter attorneys by job title
function attorney_occupation_filter() {
	global $wp_query;
	$occupation = $_POST['occupation'];
	$attorney_args = [
		'post_type' => 'attorneys',
		'posts_per_page' => -1,
		'orderby' => 'meta_value',
    	'meta_key' => 'last_name',
		'order' => 'ASC',
		'tax_query' => [
			[
				'taxonomy' => 'attorney_occupation',
				'field' => 'slug',
				'terms' => $occupation
			]
		],
		'meta_query' => [
			[
				'relation' => 'AND',
				[
					'key' => 'in_memoriam',
					'value' => true,
					'compare' => '!='
				]
			]
		]
	];

	$attorney_query = new WP_Query($attorney_args);
	if( $attorney_query->have_posts() ) : while( $attorney_query->have_posts() ) : $attorney_query->the_post();
	$permalink = get_the_permalink();
	$headshot = get_field('headshot', $post->ID);
	$headshot_url = $headshot['url'];;
	$headshot_alt = $headshot['alt'];
	$first_name = get_field('first_name', $post->ID);
	$last_name = get_field('last_name', $post->ID);
	$job_title = get_the_terms($post->ID, 'attorney_occupation');
	$job_title_name = $job_title[0]->name;
	$response .= "
		<div class='attorney'>
			<a class='attorney-link' href='{$permalink}'></a>
			<div class='img-wrapper'>
				<img src='{$headshot_url}' alt='{$headshot_alt}'>
				<div class='arrow'></div>
			</div>
			<h4 class='name yellow'>{$first_name} {$last_name}</h4>
			<p>{$job_title_name}</p>
		</div>
	";

	endwhile; 

	else : $response = '<p>No attorneys found with that job title.</p>';

	endif; wp_reset_postdata();
	echo $response;
	wp_die();

}
add_action('wp_ajax_nopriv_filter_by_title', 'attorney_occupation_filter');
add_action('wp_ajax_filter_by_title', 'attorney_occupation_filter');

// Filter attorneys by service
function attorney_service_filter() {
	global $wp_query;
	$service = $_POST['service'];
	$attorney_args = [
		'post_type' => 'attorneys',
		'posts_per_page' => -1,
		'orderby' => 'meta_value',
    	'meta_key' => 'last_name',
		'order' => 'ASC',
		'tax_query' => [
			[
				'taxonomy' => 'attorney_services',
				'field' => 'slug',
				'terms' => $service
			]
		],
		'meta_query' => [
			'relation' => 'AND',
			[
				'key' => 'in_memoriam',
				'value' => true,
				'compare' => '!='
			]
		]
	];

	$attorney_query = new WP_Query($attorney_args);
	if( $attorney_query->have_posts() ) : while( $attorney_query->have_posts() ) : $attorney_query->the_post();
	$permalink = get_the_permalink();
	$headshot = get_field('headshot', $post->ID);
	$headshot_url = $headshot['url'];;
	$headshot_alt = $headshot['alt'];
	$first_name = get_field('first_name', $post->ID);
	$last_name = get_field('last_name', $post->ID);
	$job_title = get_the_terms($post->ID, 'attorney_occupation');
	$job_title_name = $job_title[0]->name;
	$response .= "
		<div class='attorney'>
			<a class='attorney-link' href='{$permalink}'></a>
			<div class='img-wrapper'>
				<img src='{$headshot_url}' alt='{$headshot_alt}'>
				<div class='arrow'></div>
			</div>
			<h4 class='name yellow'>{$first_name} {$last_name}</h4>
			<p>{$job_title_name}</p>
		</div>
	";

	endwhile; 

	else : $response = '<p>No attorneys found with that service.</p>';

	endif; wp_reset_postdata();
	echo $response;
	wp_die();

}
add_action('wp_ajax_nopriv_filter_by_service', 'attorney_service_filter');
add_action('wp_ajax_filter_by_service', 'attorney_service_filter');

// Clear filters
function attorney_clear_filter() {
	global $wp_query;
	$service = $_POST['service'];
	$attorney_args = [
		'post_type' => 'attorneys',
		'posts_per_page' => -1,
		'orderby' => 'meta_value',
    	'meta_key' => 'last_name',
		'order' => 'ASC',
		'meta_query' => [
			'relation' => 'AND',
			[
				'key' => 'in_memoriam',
				'value' => true,
				'compare' => '!='
			]
		]
	];

	$attorney_query = new WP_Query($attorney_args);
	if( $attorney_query->have_posts() ) : while( $attorney_query->have_posts() ) : $attorney_query->the_post();
	$permalink = get_the_permalink();
	$headshot = get_field('headshot', $post->ID);
	$headshot_url = $headshot['url'];;
	$headshot_alt = $headshot['alt'];
	$first_name = get_field('first_name', $post->ID);
	$last_name = get_field('last_name', $post->ID);
	$job_title = get_the_terms($post->ID, 'attorney_occupation');
	$job_title_name = $job_title[0]->name;
	$response .= "
		<div class='attorney'>
			<a class='attorney-link' href='{$permalink}'></a>
			<div class='img-wrapper'>
				<img src='{$headshot_url}' alt='{$headshot_alt}'>
				<div class='arrow'></div>
			</div>
			<h4 class='name yellow'>{$first_name} {$last_name}</h4>
			<p>{$job_title_name}</p>
		</div>
	";

	endwhile; endif; wp_reset_postdata();
	echo $response;
	wp_die();

}
add_action('wp_ajax_nopriv_clear_filters', 'attorney_clear_filter');
add_action('wp_ajax_clear_filters', 'attorney_clear_filter');

function retrieve_latest_gform_submissions() {
    $site_url = get_site_url();
    $search_criteria = [
        'status' => 'active'
    ];
    $form_ids = 1; //search all forms
    $sorting = [
        'key' => 'date_created',
        'direction' => 'DESC'
    ];
    $paging = [
        'offset' => 0,
        'page_size' => 5
    ];
    
    $submissions = GFAPI::get_entries($form_ids, null, $sorting, $paging);
    $start_date = date('Y-m-d H:i:s', strtotime('-5 day'));
    $end_date = date('Y-m-d H:i:s');
    $entry_in_last_5_days = false;
    
    foreach ($submissions as $submission) {
        if( $submission['date_created'] > $start_date  && $submission['date_created'] <= $end_date ) {
            $entry_in_last_5_days = true;
        } 
    }
    if( !$entry_in_last_5_days ) {
        wp_mail('webdev@postali.com', 'Submission Status', "No submissions in last 5 days on $site_url");
    }
}
add_action('check_form_entries', 'retrieve_latest_gform_submissions');

?>