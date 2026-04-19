<section class="o-cs-hero" style="background-image: url(<?= get_field('main_img') ?>);">
    <div class="a-container o-cs-hero__wrapper">
        <h1 class="o-cs-hero__title a-title--white"><?php if (is_single('case-studies')): ?><?= get_the_title() ?><?php else: ?>Case Studies<?php endif; ?></h1>
        <a href="#wiecej" class="a-button a-button--white">Sprawdź naszą pracę</a>
        <?php get_template_part('parts/m-breadcrumbs'); ?>
    </div>
</section>