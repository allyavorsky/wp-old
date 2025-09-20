<?php

/* section contact */

// headline
$headline = get_sub_field('headline');

// settings
$settings = get_sub_field('settings');

// section id
$section_id = !empty($settings['section_id']) ? 'id="' . esc_attr($settings['section_id']) . '"' : '';

// section style
$section_style = !empty($settings['style']) ? 'style="' . $settings['style'] . '"' : ''; ?>

<section <?= $section_id ?> <?= $section_style ?> class="flowaround">
  <div class="container">

    <div class="flexgrid">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <div class="contact-group">
          <?= do_shortcode('[qodeum_contact_phone]') ?>
          <?= do_shortcode('[qodeum_contact_email]') ?>
          <?= do_shortcode('[qodeum_contact_location]') ?>
        </div>

      </div>
    </div>

    <?= /* contact form 7 */ do_shortcode(''); ?>
  </div>

  <?php // component: separators
  $separators = $settings['separator'] ?? null;
  include locate_template('template-parts/components/separators.php'); ?>

</section>