<?php

// logo
$logo = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full'); ?>

<?php if (has_custom_logo()) : ?>
  <img class="logo__img" src="<?= esc_url($logo[0]); ?>" alt="<?= esc_attr(get_bloginfo('name')); ?>" />

<?php else : ?>
  <span class="logo__name"><?= esc_html(get_bloginfo('name')); ?></span>

<?php endif; ?>