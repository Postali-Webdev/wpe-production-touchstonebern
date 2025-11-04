<?php $block_data = $args['data']; ?>
<section id="contact-block">
    <div class="container">
        <div class="columns">
            <div class="column-full block">
                <div class="row-1">
                    <h2><?php echo $block_data['contact_block_title']; ?></h2>
                    <div class="line-filler"></div>
                </div>
                <div class="row-2">
                    <div class="left-col">
                        <p class="blue-title"><?php echo $block_data['contact_block_blue_copy'] ?></p>
                        <?php echo $block_data['contact_block_standard_copy']; ?>
                    </div>
                    <div class="right-col">
                        <a href="<?php echo get_field('phone_number', 'options'); ?>" class="btn"><?php echo get_field('phone_number', 'options'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>