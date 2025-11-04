<?php
/**
 * Template Name: Careers
 * @package Postali Child
 * @author Postali LLC
**/
get_header();

$jobs_args = [
    'post_type' => 'Job Listings',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'ASC'
];
$jobs_query = new WP_Query($jobs_args);
?>

<section id="banner">
    <div class="container">
        <div class="columns">
            <div class="column-50 block">
                <h1><?php the_field('banner_title'); ?></h1>
                <p><?php the_field('banner_copy'); ?></p>
                <?php $anchor_link = get_field('banner_positions_anchor_link'); ?>
                <a href="<?php echo $anchor_link['url']; ?>"><?php echo $anchor_link['title']; ?></a>
            </div>
            <div class="column-50 block">
                <?php $banner_img = get_field('banner_image'); ?>
                <?php echo wp_get_attachment_image( $banner_img['id'], 'full', "", ["class" => "banner-img"]); ?>
            </div>
        </div>
    </div>
</section>

<section id="body">
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <div class="intro-copy wrapper">
                    <h2><?php the_field('body_section_title'); ?></h2>
                    <?php the_field('body_section_copy'); ?>
                </div>
                <?php $perks_group = get_field('body_perks_benefits');
                $perks_title = $perks_group['title'];
                $perks = $perks_group['perks'];
                if( $perks ) : ?>
                    <div class="perks-wrapper">
                        <h2><?php echo $perks_title; ?></h2>
                        <div class="perks-list">
                            <?php foreach( $perks as $perk ) : ?>
                                <div class="perk">
                                    <p class="yellow-title"><?php echo $perk['title']; ?></p>
                                    <p><?php echo $perk['copy']; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
    $jobs_group = get_field('body_job_openings');
    if( $jobs_query->have_posts() ) :
?>
<section id="jobs">
    <div class="container">
        <div class="columns wrapper">
            <div class="column-full block">
                <h2><?php echo $jobs_group['section_title']; ?></h2>
                <div class="jobs-list">
                    <?php while( $jobs_query->have_posts() ) : $jobs_query->the_post(); ?>
                        <div class="job">
                            <h3><?php the_field('job_title', $post->ID) ?></h3>
                            <p><?php the_field('position_type', $post->ID) ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn">Apply Now</a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; wp_reset_postdata(); ?>


<?php get_footer();?>