<?php

/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package www
 */

?>

<section>
  <div class="container">
    <div class="flexgrid">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <?php if (is_search()) : ?>
          <p><?php echo __("Нічого не знайдено"); ?></p>
        <?php else : ?>
          <p><?php echo __("Записи відсутні"); ?></p>
        <?php endif; ?>

      </div>
    </div>
  </div>
</section>