<section id="wiecej" class="o-cs-content">
    <div class="a-container o-cs-content__wrapper">
        <div class="o-cs-content__intro">
            <p>Klient: <?= get_field('client') ?></p>
            <p>Branża: <?= get_field('industry') ?></p>
        </div>
        <div class="o-gutenberg">
            <?= get_field('short') ?>
        </div>
        <div class="o-cs-content__gallery">
            <!--
            FOR ACF PRO GALLERY FIELD
           <?php
            $images = get_field('gallery');
            if ($images): ?>
                <?php foreach ($images as $image): ?>
                     <img class="o-cs-content__gallery-item" src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php endforeach; ?>
            <?php endif; ?>-->

            <?php
            $image = get_field('img1');
            $image2 = get_field('img2');
            $image3 = get_field('img3');
            if (!empty($image)): ?>
                <img class="o-cs-content__gallery-item" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <?php endif; ?>
            <?php if (!empty($image2)): ?>
                <img class="o-cs-content__gallery-item" src="<?php echo esc_url($image2['url']); ?>" alt="<?php echo esc_attr($image2['alt']); ?>" />
            <?php endif; ?>
            <?php if (!empty($image3)): ?>
                <img class="o-cs-content__gallery-item" src="<?php echo esc_url($image3['url']); ?>" alt="<?php echo esc_attr($image3['alt']); ?>" />
            <?php endif; ?>
        </div>
        <a href="<?= get_field('url') ?>" class="a-button">Zobacz realizację</a>
    </div>
</section>