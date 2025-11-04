<?php
/**
 * Template Name: Attorneys Landing
 * @package Postali Child
 * @author Postali LLC
**/
get_header();

$attorney_args = [
    'post_type' => 'attorneys',
    'posts_per_page' => -1,
    'orderby' => 'meta_value',
    'meta_key' => 'last_name',
    'order' => 'ASC',
    'meta_query' => [
        [
            'key' => 'in_memoriam',
            'value' => true,
            'compare' => '!='
        ]
    ]
];

$occupations_list = [];

$occupation_terms = get_terms(array(
    'taxonomy' => 'attorney_occupation',
    'hide_empty' => true,
));

if (!empty($occupation_terms) && !is_wp_error($occupation_terms)) {
    foreach ($occupation_terms as $term) {
        $occupations_list[$term->name] = $term->slug;
    }
}

$services_list = [];

$services_terms = get_terms(array(
    'taxonomy' => 'attorney_services',
    'hide_empty' => true,
));

if (!empty($services_terms) && !is_wp_error($services_terms)) {
    foreach ($services_terms as $term) {
        $services_list[$term->name] = $term->slug;
    }
}
?>

<section id="banner">
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <h1><?php the_field('banner_title'); ?></h1>
                <div class="mobile-wrapper">
                    <p class="yellow-title mobile-title mobile-filter-accordion">Search And Filter &nbsp;</p>
                    <div class="filters">
                        <div class="name-filter">
                            <p class="yellow-title">Search By Name</p>
                            <div class="form-wrapper">
                                <input type="text" placeholder="Name" id="name-filter">
                                <button form="name-filter" class="btn" id="name-filter-btn">Search</button>
                            </div>
                        </div>
                        <div class="title-filter">
                            <p class="yellow-title">Filter By:</p>
                            <div class="select-wrapper">
                                <select name="title-filter" id="title">
                                    <option selected disabled  value="">Title</option>
                                    <?php foreach( $occupations_list as $title => $slug ): ?>
                                        <option value="<?php echo $slug; ?>" for="title"><?php echo $title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="services-filter">
                            <div class="select-wrapper">
                                <select name="services-filter" id="services">
                                    <option selected disabled value="">Industry/Service</option>
                                    <?php foreach( $services_list as $title => $slug ): ?>
                                        <option value="<?php echo $slug; ?>" for="services"><?php echo $title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="clear-filters">
                            <p id="clear-filters">Clear Filters</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="attorneys">
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <?php 
                $attorney_query = new WP_Query($attorney_args);
                if( $attorney_query->have_posts() ) : ?>
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
                    <?php echo wp_get_attachment_image( $team_img['id'], 'full', "", ["class" => "team-img"]); ?>
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

<?php get_footer();?>