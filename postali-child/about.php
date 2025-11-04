<?php
/**
 * Template Name: About
 * @package Postali Child
 * @author Postali LLC
**/
get_header();

$attorney_args = [
    'post_type' => 'attorneys',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    'meta_query' => [
        [
            'key' => 'in_memoriam',
            'value' => true,
            'compare' => '=='
        ]
    ]
];
$attorneys_query = new WP_Query($attorney_args);
?>

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
                <?php if( have_rows('awards', 'options') ) : ?>
                    <div class="awards-list">
                        <?php while( have_rows('awards', 'options') ) : the_row(); ?>
                            <div class="award">
                                <?php $award_img = get_sub_field('award_image'); ?>
                                <?php echo wp_get_attachment_image( $award_img['id'], 'full', "", ["class" => "award-img"]); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="column-25 block sidebar">
                <?php get_template_part('block', 'sidebar'); ?>
            </div>
        </div>
    </div>
</section>

<section id="attorneys">
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <h2><?php the_field('attorneys_title'); ?></h2>
                <?php if( $attorneys_query->have_posts() ) :  ?>
                    <div class="attorney-list in-memoriam-attorneys">
                        <?php while( $attorneys_query->have_posts() ) : $attorneys_query->the_post(); ?>
                            <div class="attorney">
                                
                                <?php $headshot = get_field('headshot', $post->ID); ?>
                                <div class="img-wrapper">
                                    <?php echo wp_get_attachment_image( $headshot['id'], 'full', "", ["class" => "headshot-img"]); ?>
                                    <div class="arrow"></div>
                                </div>
                                <h4 class="name yellow"><?php echo get_field('first_name', $post->ID) . ' ' . get_field('last_name', $post->ID); ?></h4>
                                <p><?php the_field('hiring_date', $post->ID); ?></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; wp_reset_postdata();?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('block', 'contact', ['data' =>  get_field('contact_block')]); ?>


<?php get_footer(); ?>