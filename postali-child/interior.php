<?php
/**
 * Template Name: Interior
 * @package Postali Child
 * @author Postali LLC
**/
get_header();?>

<section id="banner">
    <div class="banner-background">
        <?php $banner_background_img = get_field('banner_background_image'); 
        if($banner_background_img) { 
            echo wp_get_attachment_image( $banner_background_img['id'], 'full', "", ["class" => "banner-img"]);  
        } ?>
    </div>
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <p class="blue-title"><?php the_field('banner_subtitle'); ?></p>
                <h1><?php the_field('banner_title'); ?></h1>
                <a href="tel:<?php the_field('phone_number','options') ?>" class="btn"><?php the_field('phone_number','options'); ?></a>
            </div>
        </div>
    </div>
</section>

<section id="body">
    <div class="container">
        <div class="columns">
            <div class="column-75 block has-sidebar">
                <?php the_field('body_copy'); ?>
            </div>
            <div class="column-25 block sidebar">
                <?php get_template_part('block', 'sidebar'); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer();?>