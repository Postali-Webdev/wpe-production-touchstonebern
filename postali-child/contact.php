<?php
/**
 * Template Name: Contact Us
 * @package Postali Child
 * @author Postali LLC
**/
get_header();?>

<section id="banner">
    <div class="container">
        <div class="columns">
            <div class="column-50 block">
                <h1><?php the_field('title') ?></h1>
                <p class="blue-title"><?php the_field('subtitle'); ?></p>
                <div class="contact-info">
                    <p><span>Phone:</span> <a href="tel:<?php the_field('phone_number', 'options'); ?>"><?php the_field('phone_number', 'options'); ?></a></p>
                    <p><span>Fax:</span> <span style="color:#fff;"><?php the_field('fax_number', 'options'); ?></span></p>
                    <div class="map-embed">
                        <p class="address">Address:</p>
                        <div class="inner-wrapper">
                            <div class="responsive-iframe">
                                <iframe src="<?php the_field('map_embed_url', 'options'); ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            <div class="copy">
                                <p><?php the_field('address', 'options'); ?></p>
                                <a target="_blank" href="<?php the_field('map_directions_link', 'options'); ?>">Directions</a>
                            </div>
                        </div>
                        <p><?php the_field('parking_directions', 'options'); ?></p>
                    </div>
                </div>
            </div>
            <div class="column-50 block">
                <?php echo do_shortcode( get_field('form_embed') ); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer();?>