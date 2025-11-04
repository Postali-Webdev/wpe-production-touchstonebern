<?php get_header(); 

$application_email = get_field('job_application_email') ? get_field('job_application_email') : get_field('email', 'options');

?>

<section id="banner">
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <p class="blue-title"><?php the_field('position_type'); ?></p>
                <h1><?php the_field('job_title'); ?></h1>
                <a href="tel:<?php the_field('phone_number','options') ?>" class="btn"><?php the_field('phone_number','options'); ?></a>
            </div>
        </div>
    </div>
</section>

<section id="body">
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <?php the_field('job_description_full'); ?>
                <a href="mailto:<?php echo $application_email; ?>?subject=Application for <?php the_field('job_title'); ?>" class="btn">Apply Today</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>