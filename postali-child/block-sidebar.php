<?php /* Sidebar Block */ 

$services_args = [
    'post_type' => 'page',
    'posts_per_page' => 9,
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
$attorney_highlight = get_field('attorney_highlight', 'options');
?>

<div class="sidebar-wrapper">
    <?php if( $services_query->have_posts() ) : ?> 
        <div class="services">
            <h4>Our Services</h4>
            <ul>
                <?php while( $services_query->have_posts() ) : $services_query->the_post(); ?>
                    <li><a class="sidebar-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile; ?>
            </ul>
            <a class="btn" href="/services/">View All Services</a>
        </div>
    <?php endif; wp_reset_postdata(); ?>

    <?php if( $attorney_highlight ) : $attorney_ID = $attorney_highlight->ID; ?>
        <div class="attorney-highlight">
            <h4>Attorney Highlight</h4>
            <p class="yellow-title"><?php the_field('highlight_title', $attorney_ID); ?></p>
            <p><?php the_field('highlight_excerpt', $attorney_ID); ?></p>
            <a class="btn" href="<?php the_permalink($attorney_ID); ?>">View <?php the_field('first_name', $attorney_ID); ?>'s Bio</a>
        </div>
    <?php endif; ?>
</div>