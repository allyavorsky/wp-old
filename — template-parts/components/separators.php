<?php

/**
 * -----------------------------------------------------------------------------
 * Component: Separators
 * -----------------------------------------------------------------------------
 * Outputs one or multiple <hr> elements based on separator styles.
 * Expects $separators (array) passed from the parent layout or section.
 * -----------------------------------------------------------------------------
 */

if (empty($separators) || !is_array($separators)) {
  return;
}
?>

<?php /* separator */ foreach ($separators as $separator) : ?>
  <hr class="separator separator--<?= esc_attr($separator) ?>">
<?php endforeach; ?>