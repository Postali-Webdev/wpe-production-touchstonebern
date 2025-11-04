<?php
/**
 * Template Name: Single Attorney
 * @package Postali Child
 * @author Postali LLC
**/
get_header(); 

$job_title = get_the_terms($post->ID, 'attorney_occupation');
$email = get_field('email') ? get_field('email') : get_field('email', 'options');
$phone_number = get_field('phone') ? get_field('phone') : get_field('phone_number', 'options');
$accomplishments_list = get_field('accomplishments_list');
$cases_args = [
    'post_type' => 'cases',
    'posts_per_page' => -1,
    'offset' => 0,
    'orderby' => 'date',
    'order' => 'ASC',
    'meta_query' => [
        [
            'key' => 'case_representative_attorney',
            'value' => get_the_id(),
            'compare' => '='
        ]
    ]
];
$cases_query = new WP_Query($cases_args);
$in_memoriam = get_field('in_memoriam');

?>
  
<section id="banner">
    <div class="container">
        <div class="columns wrapper">
            <div class="column-50 block">
                <p class="large-title"><?php echo get_field('first_name') . ' ' . get_field('middle_initial_optional') . ' ' . get_field('last_name'); ?></p>
                <h1 class="blue-header"><?php echo $job_title[0]->name; echo $in_memoriam ? ' | In Memoriam' : ''; ?></h1>
                <?php if( !$in_memoriam ) : ?>
                <?php if( $email ) : ?>
                <p class="white-block">
                    <span>Email:&nbsp;</span> <a href="mailto:<?php echo $email; ?>" class="white-link"><?php echo $email; ?></a>
                </p>
                <?php endif; ?>
                <?php if( $phone_number ) : ?>
                <p class="white-block">
                    <span>Phone:&nbsp;</span> <a href="tel:<?php echo $phone_number; ?>" class="white-link"><?php echo $phone_number; ?></a>
                </p>
                <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="column-50">
                <?php $headshot = get_field('individual_headshot'); 
                if( $headshot ) : echo wp_get_attachment_image( $headshot['id'], 'full', "", ["class" => "headshot-img"]); endif; ?>
            </div>
        </div>
        <div class="columns">
            <div class="column-full block">
                <div class="experience-block">
                    <div class="row-1">
                        <h2><?php the_field('experience_block_title'); ?></h2>
                        <div class="line-filler"></div>
                    </div>
                    <div class="row-2 <?php echo $in_memoriam ? 'full-width' : ''; ?>">
                        <?php the_field('experience_copy_block'); ?>
                        <?php if( !$in_memoriam ) : ?>
                            <a href="mailto:<?php echo $email; ?>" class="btn">Contact <?php echo get_field('first_name'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $accomplishments_copy = get_field('accomplishments_copy_block'); ?>
<section id="body">
    <div class="container">
        <div class="columns wrapper">
            <div class="block <?php echo $accomplishments_list ? 'column-75 has-sidebar' : 'column-full no-sidebar'; ?>">
                <?php if( $accomplishments_copy ) : ?>
                    <h3>Notable Accomplishments</h3>
                <?php endif; ?>
                <?php the_field('accomplishments_copy_block'); ?>
            </div>
            <?php if( have_rows('accomplishments_list') ) : ?>
            <div class="column-25 block sidebar<?php echo !$accomplishments_copy ? ' sidebar-full-width' : ''; ?>">
                <?php while(  have_rows('accomplishments_list') ) : the_row(); ?>
                    <div class="accomplishment-block">
                        <h4><?php the_sub_field('section_title'); ?></h4>
                        <?php if( have_rows('list') ) : ?>
                        <ul>
                            <?php while( have_rows('list') ) : the_row(); ?>
                                <li><?php the_sub_field('list_item'); ?></li>
                            <?php endwhile; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>

            <?php $extra_content = get_the_content();
            if( $extra_content ) : ?>
            <div class="column-full block">
                <div class="spacer-60"></div>
                <?php echo $extra_content; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php 
if( $cases_query->have_posts() ) :  ?>
<section id="cases">
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <h2>Representative Cases</h2>
                <div class="cases-list">
                    <?php while( $cases_query->have_posts() ) : $cases_query->the_post(); 
                    	$services = get_the_terms($post->ID, 'attorney_services');
                        $services_name = $services[0]->name;
                    ?>
                        <div class="case">
                            <div class="inner-wrapper">
                                <p class="orange-title"><?php the_field('case_title', $post->ID); ?></p>
                                <p><?php the_field('case_details', $post->ID); ?></p>
                            </div>
                            <p class="case-type"><span>Case Type:</span> <span class="highlight"><?php echo $services_name; ?></span></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; wp_reset_postdata(); ?>

<?php get_template_part('block', 'contact', ['data' =>  get_field('attorney_contact_block')]); ?>

<?php get_footer(); ?>