<?php
/**
 * Template Name: Practice Landing
 * @package Postali Child
 * @author Postali LLC
**/
get_header(); 

$services_args = [
    'post_type' => 'page',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    'meta_query' => [
        [
            'key' => '_wp_page_template',
            'value' => 'practice-parent.php',
        ],
    ],
];
$services_query = new WP_Query($services_args);
$services_categories = [ 'insurance', 'litigation', 'liability', 'labor' ];
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
            <div class="column-full center block">
                <h1 class="blue-header"><?php the_field('banner_title'); ?></h1>
                <p class="large-title"><?php the_field('banner_subtitle'); ?></p>
                <p><?php the_field('banner_copy'); ?></p>
                <a class="btn" href="tel:<?php the_field('phone_number','options') ?>"><?php the_field('phone_number','options'); ?></a>
            </div>
        </div>
    </div>
</section>

<?php if( $services_query->have_posts() ) : ?>
<section id="services">
    <div class="container">
        <div class="columns wrapper">
            <div class="column-full block">
                <?php 
                $broad_cat_icons = get_field('broad_category_icons', 'options');
                foreach( $services_categories as $category ) {
                    $icon = $broad_cat_icons[$category]['icon'];
                    echo '<div class="practice-area-block">';
                    echo '<div class="title-row">';
                    echo '<h3>'.$category.'</h3>';
                    echo wp_get_attachment_image( $icon, 'full', "", ["class" => "icon"]);
                    echo '</div>';
                    echo '<div class="practice-area-list">';
                    while( $services_query->have_posts() ) {
                        $services_query->the_post(); 
                        $broad_category = get_field('category', $post->ID);
                    if( $broad_category == $category ) {    
                            $link = get_the_permalink($post->ID);
                            $title = get_field('banner_title', $post->ID);
                            echo "<a href='{$link}'>{$title}</a>";
                        }
                        
                    }
                    echo '</div></div>';
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php endif; wp_reset_postdata(); ?>

<section id="why">
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <h2><?php the_field('why_section_title'); ?></h2>
                <?php if( have_rows('why_reasons') ) : ?>
                    <div class="reasons-list">
                        <?php while( have_rows('why_reasons') ) : the_row(); ?>
                            <div class="reason">
                                <h3><?php the_sub_field('title'); ?></h3>
                                <p><?php the_sub_field('copy'); ?></p>
                                <?php $reason_link = get_sub_field('button'); ?>
                                <a href="<?php echo $reason_link['url']; ?>" class="btn"><?php echo $reason_link['title']; ?></a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer();?>