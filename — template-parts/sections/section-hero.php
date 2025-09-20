<?php

/* section hero */
$section = get_field('section_hero'); ?>

<div class="container">
  <div class="flexgrid">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="headline">
        <?php if (!empty($headline_label = get_field('section_hero_headline_label'))) {
          echo '<p class="headline__label">' . $headline_label . '</p>';
        } elseif (!is_home() && !is_front_page()) {
          echo '<div class="headline__label">' . do_shortcode('[wpseo_breadcrumb]') . '</div>';
        } ?>
        <?php if (!empty($headline_title = get_field('section_hero_headline_title'))) {
          echo '<h1 class="headline__title headline__title--lg">' . $headline_title . '</h1>';
        } else {
          echo '<h1 class="headline__title headline__title--lg">' . qodeum_page_title() . '</h1>';
        } ?>
        <?php if (!empty($headline_textarea = get_field('section_hero_headline_textarea'))) {
          echo '<div class="headline__textarea editor">' . $headline_textarea . '</div>';
        } ?>
      </div>
    </div>

  </div>
</div>