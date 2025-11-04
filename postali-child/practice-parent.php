<?php
/**
 * Template Name: Practice Parent
 * @package Postali Child
 * @author Postali LLC
**/
get_header();?>

<section id="banner">
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <div class="row-1">
                    <div class="left-col">
                        <h1 class="blue-header"><?php the_field('banner_title'); ?></h1>
                        <div class="inner-wrapper">
                            <p class="large-title"><?php the_field('banner_subtitle'); ?></p>
                            <a class="btn" href="tel:<?php the_field('phone_number','options') ?>"><?php the_field('phone_number','options'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="row-2">
                    <div class="left-col">
                        <?php $banner_img = get_field('banner_image'); 
                        if($banner_img) {
                            echo wp_get_attachment_image( $banner_img['id'], 'full', "", ["class" => "banner-img"]);
                        }
                         ?>
                    </div>
                    <div class="right-col">
                        <?php the_field('banner_copy'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="body">
    <div class="container">
        <div class="columns wrapper">
            <div class="column-full block">
                <?php the_field('body_copy_section_i'); 
                $process_block = get_field('body_process'); 
                $process_list = $process_block['processes']; 
                if( $process_list ) : ?>
                <h4 class="process-title"><?php echo $process_block['section_title']; ?></h4>
                <div class="process-list">
                    <?php foreach( $process_list as $process ) : ?>
                        <div class="process">
                            <p class="yellow-title"><?php echo $process['title']; ?></p>
                            <p><?php echo $process['copy']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php the_field('body_copy_section_ii'); ?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('block', 'contact', ['data' =>  get_field('contact_block')]); ?>

<?php get_footer();?>