<?php
/**
 * Theme footer
 *
 * @package Postali Child
 * @author Postali LLC
**/
?>
<footer>
    <div class="row-1">
        <div class="container">
            <div class="columns">
                <div class="column-75 block">
                    <div class="row-1">
                        <div class="logo">
                            <?php the_custom_logo(); ?>
                        </div>
                        <p class="footer-copy"><?php the_field('footer_copy', 'options'); ?></p>
                    </div>
                    <div class="row-2">
                        <p class="sm-title">Site Navigation</p>
                        <nav role="navigation">
                        <?php wp_nav_menu( ['theme_location' => 'footer-nav'] ); ?>
                        </nav>
                    </div>
                    <div class="row-3">
                        <p class="sm-title">Get in Touch</p>
                        <div class="contact">
                            <div>
                                <span>Phone:</span><a href="tel:<?php echo get_field('phone_number','options') ?>"><?php the_field('phone_number','options'); ?></a>
                            </div>
                            <div>
                                <span>Fax:</span><span><?php the_field('fax_number','options'); ?></span>
                            </div>
                            <div>
                                <a href="mailto:<?php echo get_field('email','options') ?>"><?php the_field('email','options'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column-25 block">
                    <p class="sm-title">Office</p>
                    <div class="responsive-iframe">
                        <iframe src="<?php the_field('map_embed_url', 'options'); ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <p class="address"><?php the_field('address', 'options'); ?></p>
                    <a target="_blank" href="<?php the_field('map_directions_link', 'options'); ?>">Directions</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row-2">
        <div class="container">
            <div class="columns">
                <div class="social-list">
                    <?php $social_links_arr = get_field('social_media', 'options'); 
                        $social_active = $social_links_arr['socials_activate'];
                        $social_urls = $social_links_arr['social_urls'];
                
                        foreach ($social_active as $social => $active) {
                            $active_url = $social_urls[$social . '_url'];
                            if( $active ) {
                                echo "<a target='_blank' class='social-icon {$social}-icon' href='{$active_url}' class='social-link'></a>";
                            }
                        }
                    ?>
                </div>
                <div class="site-links">
                    <?php 
                    $privacy_link = get_field('footer_privacy_policy', 'options');
                    if( $privacy_link ) { echo "<a class='site-link' href='{$privacy_link['url']}'>{$privacy_link['title']}</a>"; }
                    $sitemap_link = get_field('footer_sitemap', 'options'); 
                    if( $sitemap_link ) { echo "<a class='site-link' href='{$sitemap_link['url']}'>{$sitemap_link['title']}</a>"; } 
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>


