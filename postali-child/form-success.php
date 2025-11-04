<?php
/**
 * Template Name: Form Success
 * @package Postali Child
 * @author Postali LLC
**/
get_header();?>

<section id="banner">
    <div class="banner-background">
        <?php $banner_img_arr = get_field('banner_image');    
        $banner_id = get_field('banner_image') ? $banner_img_arr['id'] : '352';
        echo wp_get_attachment_image( $banner_id, 'full', "", ["class" => "banner-img"]);?>
    </div>
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <p class="blue-title"><?php the_field('banner_subtitle'); ?></p>
                <h1><?php the_field('banner_title') ?></h1>
                <p><?php the_field('banner_copy'); ?></p>
                <a href="tel:<?php the_field('phone_number','options') ?>" class="btn"><?php the_field('phone_number','options'); ?></a>
                <a class="home-link" href="/">Return To Website</a>
            </div>
        </div>
    </div>
</section>


<?php get_footer();?>