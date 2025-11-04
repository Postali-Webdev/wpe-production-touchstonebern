<?php
/**
 * Error 404
 * @package Postali Child
 * @author Postali LLC
**/
get_header();?>

<section id="banner">
    <div class="banner-background">
        <?php echo wp_get_attachment_image( '352', 'full', "", ["class" => "banner-img"]); ?>
    </div>
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <p class="blue-title">Oh No!</p>
                <h1>Error 404</h1>
                <p>We’re sorry - The page you are looking for does not exist or the URL has changed.</p>
                <a class="home-link" href="/">Take me back to the website</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer();?>