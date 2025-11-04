<?php
/**
 * Template Name: Blog
 * 
 * @package Postali Child
 * @author Postali LLC
 */

get_header(); 
$archive_id = get_option( 'page_for_posts' );
?>


<section id="banner">
    <div class="banner-background">
        <?php $banner_background_img = get_field('banner_background_image', $archive_id); 
        if($banner_background_img) { 
            echo wp_get_attachment_image( $banner_background_img['id'], 'full', "", ["class" => "banner-img"]);  
        } ?>
    </div>
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <h1><?php the_field('banner_title', $archive_id); ?></h1>
                <a href="tel:<?php the_field('phone_number','options') ?>" class="btn"><?php the_field('phone_number','options'); ?></a>
            </div>
        </div>
    </div>
</section>

<?php if (have_posts()) : ?>
<section id="posts">
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <div class="posts-list">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="post">
                            <h3><?php the_field('banner_title'); ?></h3>
                            <p class="author">BY <?php echo get_field('author') ? get_field('author') : 'Touchstone Bernays'; ?></p>
                            <a class="blog-link" href="<?php the_permalink(); ?>" title="<?php the_field('banner_title'); ?>"></a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        <?php
        // Get the current page number
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        // Get the total number of pages
        $total_pages = $wp_query->max_num_pages; ?>
        <div class="pagination-wrapper">
            <?php // Display the pagination links
            if ($total_pages > 1) :
                echo paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => '?paged=%#%',
                    'current' => $paged,
                    'total' => $total_pages,
                    'prev_text' => __(''),
                    'next_text' => __(''),
                ));
            endif;
            ?>
        </div>
    </div>
</section>
<?php endif; ?>



<?php get_footer(); ?>