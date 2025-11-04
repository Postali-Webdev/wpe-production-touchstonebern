<?php
/**
 * Template Name: Sitemap
 * @package Postali Child
 * @author Postali LLC
**/
get_header();

$page_args = array(
    'post_type' => array('page'),
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'post__not_in' => array( 59 ), //exclude blog archive
    'meta_query' => [
        [
            'key' => '_wp_page_template',
            'value' => 'ppc-landing.php',
            'compare' => '!='
        ], 
        [
            'key' => '_wp_page_template',
            'value' => 'ppc-landing-v2.php',
            'compare' => '!='
        ],
        [
            'key' => '_wp_page_template',
            'value' => 'ppc-landing-detailed.php',
            'compare' => '!='
        ],
        [
            'key' => '_wp_page_template',
            'value' => 'attorneys-landing.php',
            'compare' => '!='
        ]
    ],
    'hierarchical' => 1, // This is the key to include child pages under their parent
    'parent' => 0 // This is the parent page ID,
);
$page_query = new WP_Query($page_args);

$posts_args = [
    'post_type' => 'post',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
];
$posts_query = new WP_Query($posts_args);

$attorneys_args = [
    'post_type' => 'attorneys',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
];
$attorneys_query = new WP_Query($attorneys_args);
?>

<section id="banner">
    <div class="banner-background">
        <?php echo wp_get_attachment_image( '352', 'full', "", ["class" => "banner-img"]); ?>
    </div>
    <div class="container">
        <div class="columns">
            <div class="column-50 block">
                <p class="blue-title">Touchstone Website</p>
                <h1>Sitemap</h1>
            </div>
            <div class="column-50 block">
                <a class="btn" href="<?php the_field('phone_number', 'options') ?>"><?php the_field('phone_number', 'options'); ?></a>
            </div>
        </div>
    </div>
</section>

<section id="body">
    <div class="container">
        <div class="columns">
            <div class="column-50 block">
                
                <ul>
                    <li>
                        <a href="/our-attorneys/">Our Attorneys | Touchstone Bernays</a>
                        <ul>
                            <?php while ($attorneys_query->have_posts()) : $attorneys_query->the_post(); ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </li>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </ul>
                    </li>
                </ul>
                
                <?php
                if ($page_query->have_posts()) {
                    echo '<ul>';
                    while ($page_query->have_posts()) {
                        $page_query->the_post();
                        
                        // Display the parent page title
                        if( wp_get_post_parent_id($post->ID) == 0 ) {
                            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a>';   
                        }
                        
                        // Display the child pages under the parent page
                        echo '<ul>';
                        wp_list_pages(array(
                            'child_of' => get_the_ID(), // This is the ID of the parent page
                            'title_li' => '' // This removes the title of the child pages
                        ));
                        echo '</ul>';
                        echo '</li>';
                    }
                    echo '</ul>';
                    wp_reset_postdata();
                } else {
                    echo 'No published pages or attorneys found.';
                }
                
                ?>
            </div>
            <div class="column-50 block">                
                <ul>
                    <li>
                        <a href="/articles/">Articles | Touchstone Bernays</a>
                        <ul>
                            <?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </li>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php get_footer();?>