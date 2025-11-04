<?php get_header(); 

$banner_img_arr = get_field('banner_background_image');
$background_banner_img = get_field('banner_background_image') ? $banner_img_arr['id'] : '352';

?>

<section id="banner">
    <div class="banner-background">
        <?php echo wp_get_attachment_image( $background_banner_img, 'full', "", ["class" => "banner-img"]); ?>
    </div>
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <p class="blue-title">WRITTEN BY <?php echo get_field('author') ? get_field('author') : 'Touchstone Bernays'; ?></p>
                <h1><?php the_field('banner_title'); ?></h1>
                <a href="tel:<?php the_field('phone_number','options') ?>" class="btn"><?php the_field('phone_number','options'); ?></a>
            </div>
        </div>
        <div class="columns">
            <div class="column-full">
                <?php if( get_field('related_case') ) : $case = get_field('related_case'); $case_ID = $case->ID;?>
                    <p class="related-case"><?php the_field('case_details', $case_ID);?></p>
                <?php endif; ?>
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

<?php get_footer(); ?>
