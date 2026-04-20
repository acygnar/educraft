<section class="o-grid">
    <div class="a-container o-grid__wrapper">
        <div class="o-grid__filter">
            <p class="o-grid__filter-title">Wybierz branżę:</p>
            <?php
            $args = array(
                'taxonomy' => 'branza',
                'orderby' => 'name',
                'order'   => 'ASC',
                'parent'  => 0
            );
            $industry = get_categories($args);
            foreach ($industry as $cat) : ?>
                <div class="o-grid__filter-checkbox">
                    <input id="<?php echo $cat->slug; ?>" type="checkbox" name="<?php echo $cat->slug; ?>" value="<?php echo $cat->slug; ?>" class="parent-sector">
                    <label for="<?php echo $cat->slug; ?>"><?php echo $cat->name; ?>&nbsp;<span>(<?php echo $cat->count; ?>)</span></label>
                </div>
            <?php endforeach; ?>
            <button id="clearAll" class="a-button a-button--clear">Wyczyść filtry</button>
        </div>
        <div class="o-grid__results">
        </div>
        <div class="loader js-loader"></div>
    </div>
</section>