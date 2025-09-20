<?php

/**
 * -----------------------------------------------------------------------------
 * Component: Headline
 * -----------------------------------------------------------------------------
 * Displays a unified headline block with optional label, title, description,
 * and alignment control.
 * Requires $headline (array) passed from parent layout or section.
 * -----------------------------------------------------------------------------
 */

if (empty($headline) || !is_array($headline)) {
  return;
}

// alignment (directly in $headline)
$alignment = $headline['alignment'] ?? 'start';
$align_class = in_array($alignment, ['center', 'end'], true)
  ? ' headline--x-' . esc_attr($alignment)
  : ''; // start is default, no class
?>

<div class="headline<?= $align_class ?>">

  <?php /* label */ if (!empty($headline['label'])) : ?>
    <p class="headline__label"><?= $headline['label']; ?></p>
  <?php endif; ?>

  <?php /* title */ if (!empty($headline['title'])) : ?>
    <h2 class="headline__title"><?= $headline['title']; ?></h2>
  <?php endif; ?>

  <?php /* textarea */ if (!empty($headline['textarea'])) : ?>
    <div class="headline__textarea editor">
      <?= $headline['textarea']; ?>
    </div>
  <?php endif; ?>

</div>