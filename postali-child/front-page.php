<?php
/**
 * Template Name: Front Page
 * @package Postali Child
 * @author Postali LLC
**/
get_header(); ?>

<section id="banner">
    <div class="columns">
        <div class="column-50 block">
            <div class="container inner-wrapper">
                <h1 class="blue-header"><?php the_field('banner_title'); ?></h1>
                <p class="large-title"><?php the_field('banner_subtitle'); ?></p>
                <div class="bordered-block">
                    <?php $cta = get_field('banner_cta'); ?>
                    <p class="yellow-title"><?php echo $cta['title']; ?></p>
                    <p><?php echo $cta['copy']; ?></p>
                    <a class="btn" href="tel:<?php the_field('phone_number','options') ?>"><?php the_field('phone_number','options'); ?></a>
                </div>
            </div>
        </div>
        <div class="column-50 block">
            <div class="floating-squares"></div>
            <?php if( have_rows('banner_background') ) : ?>
                <div class="banner-slider desktop-banner">
                    <div class="inner-slider">
                        <?php while( have_rows('banner_background') ) : the_row(); ?>
                            <?php $banner_bg_arr = get_sub_field('banner_image'); ?>
                            <div class="banner-img">
                                <?php echo wp_get_attachment_image( $banner_bg_arr['id'], 'full', "", ["class" => "banner-img"]); ?>
                            </div>
                        
                        <?php endwhile; ?> 
                    </div>
                    <div class="slider-nav">
                        <?php while( have_rows('banner_background') ) : the_row(); ?>
                            <p>Serving clients in Texas from our Dallas Office</p>
                        <?php endwhile; ?>
                    </div>
                </div>

                <div class="banner-slider mobile-banner">
                    <div class="inner-slider">
                        <?php while( have_rows('banner_background') ) : the_row(); ?>
                            <?php $banner_bg_mobile_arr = get_sub_field('banner_image_mobile'); ?>
                            <div class="banner-img">
                                <?php echo wp_get_attachment_image( $banner_bg_mobile_arr['id'], 'full', "", ["class" => "banner-img"]); ?>
                            </div>
                        
                        <?php endwhile; ?> 
                    </div>
                    <div class="slider-nav">
                        <?php while( have_rows('banner_background') ) : the_row(); ?>
                            <p>Serving Clients In <?php the_sub_field('location'); ?></p>
                        <?php endwhile; ?>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    </div>
    
</section>

<section id="about">
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <h2><?php the_field('about_section_title'); ?></h2>
                <?php if( have_rows('about_highlights') ) : ?>
                    <div class="highlights-block">
                        <?php while( have_rows('about_highlights') ) : the_row(); ?>
                            <div class="highlight">
                                <p class="number"><?php the_sub_field('number'); ?>+</p>
                                <h3><?php the_sub_field('title'); ?></h3>
                                <p><?php the_sub_field('copy'); ?></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="columns history wrapper">
            <?php $history_group = get_field('about_history'); 
            $history_left = $history_group['left_column']; 
            $history_right = $history_group['right_column'];?>
            <div class="column-50 block">
                <div class="white-block">
                    <p class="orange-title"><?php echo $history_left['copy']; ?></p>
                    <?php if( have_rows('awards','options') ) : ?>
                        <div class="awards-list">
                            <?php while(have_rows('awards','options')) : the_row(); $award_img = get_sub_field('award_image'); ?>
                                <div class="award">
                                    <?php echo wp_get_attachment_image( $award_img['id'], 'full', "", ["class" => "award-img"]); ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="column-50 block">
                <?php echo $history_right['copy']; ?>
                <a class="btn" href="<?php echo $history_right['button']['url']; ?>"><?php echo $history_right['button']['title']; ?></a>
            </div>
        </div>
        <div class="columns reasons">
            <?php $why_us = get_field('about_why_us'); ?>
            <div class="column-25 block">
                <?php echo $why_us['left_column']['copy']; ?>
                <a href="<?php echo $why_us['left_column']['button']['url']; ?>" class="btn"><?php echo $why_us['left_column']['button']['title']; ?></a>
            </div>
            <div class="column-75 block">
                <?php $reasons = $why_us['right_column']['reasons']; ?>
                <div class="reasons-list">
                    <?php foreach( $reasons as $reason ) : ?>
                        <div class="reason">
                            <p><?php echo $reason['copy']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="attorneys">
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <h2><?php the_field('attorneys_section_title'); ?></h2>
                <?php $attorney_args = [
                    'post_type' => 'attorneys',
                    'posts_per_page' => 12,
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'meta_query' => [
                        [
                            'key' => 'in_memoriam',
                            'value' => true,
                            'compare' => '!='
                        ]
                    ]
                ];
                $attorney_query = new WP_Query($attorney_args);
                if( $attorney_query->have_posts() ) : ?>
                    <h3>Our Attorneys</h3>
                    <div class="attorney-list">
                        <?php while( $attorney_query->have_posts() ) : $attorney_query->the_post(); ?>
                            <div class="attorney">
                                <a class="attorney-link" href="<?php the_permalink(); ?>"></a>
                                <?php $headshot = get_field('headshot', $post->ID); ?>
                                <div class="img-wrapper">
                                    <?php echo wp_get_attachment_image( $headshot['id'], 'full', "", ["class" => "headshot-img"]); ?>
                                    <div class="arrow"></div>
                                </div>
                                <h4 class="name yellow"><?php echo get_field('first_name', $post->ID) . ' ' . get_field('last_name', $post->ID); ?></h4>
                                <?php $job_title = get_the_terms($post->ID, 'attorney_occupation') ?>
                                <p><?php echo $job_title[0]->name; ?></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; wp_reset_postdata(); ?>
                <a class="all-attorney-link" href="/our-attorneys/">View All Attorneys</a>
            </div>
        </div>
    </div>
</section>

<section id="services">
    <div class="container">
        <div class="columns wrapper">
            <div class="column-full block">
                <div class="inner-wrapper">
                    <h2><?php the_field('services_section_title'); ?></h2>
                    <p><?php the_field('services_intro_copy'); ?></p>
                </div>
                <?php if( have_rows('services') ) : ?>
                    <div class="services-list">
                        <?php while( have_rows('services') ) : the_row(); ?>
                            <div class="service-block">
                                <h3><?php the_sub_field('title'); ?></h3>
                                <?php the_sub_field('copy'); 
                                $services_link = get_sub_field('button'); ?>
                                <a title="learn more about <?php the_sub_field('title'); ?>" class="btn" href="<?php echo $services_link['url']; ?>"><?php echo $services_link['title']; ?></a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section id="join">
    <div class="full-width">
        <div class="columns">
            <div class="column-full block">
                <?php $team_img = get_field('join_section_image'); 
                if( $team_img ) : ?>
                <div class="team-img">
                    <?php echo wp_get_attachment_image( $team_img['id'], 'full', "", ["class" => "headshot-img"]); ?>
                </div>
                <?php endif; ?>
                <h2><?php the_field('join_section_title'); ?></h2>
                <?php $block_copy = get_field('join_block_copy'); ?>
                <div class="white-block">
                    <p class="orange-title"><?php echo $block_copy['orange_copy']; ?></p>
                    <p><?php echo $block_copy['standard_copy']; ?></p>
                    <?php $job_btn = $block_copy['button']; ?>
                    <a href="<?php echo $job_btn['url']; ?>" class="btn blue"><?php echo $job_btn['title']; ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('block', 'contact', ['data' =>  get_field('fp_contact_block')]); ?>

<?php get_footer();?>