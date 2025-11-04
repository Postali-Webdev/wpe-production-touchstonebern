<?php get_header(); ?>

    <section id="banner">
        <div class="banner-background">
            <?php echo wp_get_attachment_image( '352', 'full', "", ["class" => "banner-img"]); ?>
        </div>
        <div class="container">
            <div class="columns">
                <div class="column-50 block">
                    <p class="blue-title">You Searched For: </p>
                    <h1>"<?php the_search_query(); ?>"</h1>
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
                <div class="column-75 block has-sidebar">
                    <?php
                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post();
                            ?>
                            <div class="result">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p><?php the_excerpt(); ?></p>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<p>No results found.</p>';
                    } ?>
                    <div class="pagination-wrapper">
                        <?php 
                        global $wp_query;
                        $big = 999999999; // need an unlikely integer
                        $translated = __( 'Page', 'textdomain' ); // Supply translatable text
                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                        $total_pages = $wp_query->max_num_pages; // Display the pagination links
                        if ($total_pages > 1) :
                            echo paginate_links(array(
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format' => '?paged=%#%',
                            'current' => $paged,
                            'total' => $total_pages,
                            'prev_text' => __(''),
                            'next_text' => __('')
                        ));
                        endif;
                        ?>
                    </div>
                </div>
                <div class="column-25 sidebar">
                    <?php get_template_part('block', 'sidebar'); ?>
                </div>
            </div>
        </div>
    </section>

    <?php $contact_block = get_field('default_contact_block', 'options'); get_template_part('block', 'contact', ['data' =>  $contact_block]); ?>

<?php get_footer(); ?>