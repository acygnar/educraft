<?php $permalink = get_permalink(); ?>
<a href="<?= $permalink ?>" class="m-tile">
    <div class="m-tile__image">
        <?php if (has_post_thumbnail($id)) : ?>
            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'single-post-thumbnail'); ?>
            <img loading="lazy" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
        <?php endif; ?>
    </div>
    <div class="m-tile__content">
        <h3 class="m-tile__title"><?php the_title(); ?></h3>
        <div class="m-tile__excerpt"><?php the_excerpt(); ?></div>
    </div>
</a>