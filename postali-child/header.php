<?php
/**
 * Theme header.
 *
 * @package Postali Child
 * @author Postali LLC
**/
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>


<!-- Sentry JS Reporting -->
<script
  src="https://js.sentry-cdn.com/fc61f7e8820d4206e58c373e4bf0142e.min.js"
  crossorigin="anonymous"
></script>
<!-- /Sentry JS Reporting -->

<link rel="preload" type="font/woff2" as="font" crossorigin href="/wp-content/themes/postali-child/assets/fonts/montserrat/montserrat-regular.woff2">
<link rel="preload" type="font/woff2" as="font" crossorigin href="/wp-content/themes/postali-child/assets/fonts/montserrat/montserrat-italic.woff2">
<link rel="preload" type="font/woff2" as="font" crossorigin href="/wp-content/themes/postali-child/assets/fonts/montserrat/montserrat-medium.woff2">
<link rel="preload" type="font/woff2" as="font" crossorigin href="/wp-content/themes/postali-child/assets/fonts/montserrat/montserrat-mediumitalic.woff2">
<link rel="preload" type="font/woff2" as="font" crossorigin href="/wp-content/themes/postali-child/assets/fonts/montserrat/montserrat-semibold.woff2">
<link rel="preload" type="font/woff2" as="font" crossorigin href="/wp-content/themes/postali-child/assets/fonts/montserrat/montserrat-semibolditalic.woff2">
<link rel="preload" type="font/woff2" as="font" crossorigin href="/wp-content/themes/postali-child/assets/fonts/montserrat/montserrat-bold.woff2">
<link rel="preload" type="font/woff2" as="font" crossorigin href="/wp-content/themes/postali-child/assets/fonts/montserrat/montserrat-bolditalic.woff2">
<link rel="preload" type="font/woff2" as="font" crossorigin href="/wp-content/themes/postali-child/assets/fonts/quicksand/quicksand-light.woff2">
<link rel="preload" type="font/woff2" as="font" crossorigin href="/wp-content/themes/postali-child/assets/fonts/quicksand/quicksand-regular.woff2">
<link rel="preload" type="font/woff2" as="font" crossorigin href="/wp-content/themes/postali-child/assets/fonts/quicksand/quicksand-medium.woff2">
<link rel="preload" type="font/woff2" as="font" crossorigin href="/wp-content/themes/postali-child/assets/fonts/quicksand/quicksand-semibold.woff2">
<link rel="preload" type="font/woff2" as="font" crossorigin href="/wp-content/themes/postali-child/assets/fonts/quicksand/quicksand-bold.woff2">
<link rel="preload" type="font/woff2" as="font" href="/wp-content/themes/postali-child/assets/fonts/icomoon/icomoon.woff2">

<!-- Google Tag Manager -->
<!-- End Google Tag Manager -->

<!-- Add JSON Schema here -->
<?php 
// Global Schema
$global_schema = get_field('global_schema', 'options');
if ( !empty($global_schema) ) :
    echo '<script type="application/ld+json">' . $global_schema . '</script>';
endif;

// Single Page Schema
$single_schema = get_field('single_schema');
if ( !empty($single_schema) ) :
    echo '<script type="application/ld+json">' . $single_schema . '</script>';
endif; ?>

<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php if( get_field('enable_splash_screen', 'options') ) : 
		$splash_image = get_field('splash_screen_logo', 'options'); ?>
	<div class="splash-screen">
		<?php for( $i = 1; $i <= 12; $i++) :  ?>
		<div class="block block-<?php echo $i; ?>"></div>
		
		<?php endfor; ?>
		<div class="logo-wrapper">
			<?php echo wp_get_attachment_image( $splash_image['id'], 'full', "", ["class" => "logo-img"] ) ?>
		</div>
	</div>
	<?php endif; ?>
	<!-- Google Tag Manager (noscript) -->

	<!-- End Google Tag Manager (noscript) -->

	<header>
		<div id="header-top" class="container">
			<div id="header-top_left">
				<?php the_custom_logo(); ?>
			</div>
			
			<div id="header-top_right">
				<div id="header-top_right_menu">
                    <?php
                        $args = array(
                            'container' => false,
                            'theme_location' => 'header-nav'
                        );
                        wp_nav_menu( $args );
                    ?>	
					<div id="header-top_mobile">
						<div id="menu-icon" class="toggle-nav">
							<span class="line line-1"></span>
							<span class="line line-2"></span>
							<span class="line line-3"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
