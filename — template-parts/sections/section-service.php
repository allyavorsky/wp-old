<?php

/* section service */

// headline
$headline = get_sub_field('headline');

// settings
$settings = get_sub_field('settings');

// section id
$section_id = !empty($settings['section_id']) ? 'id="' . esc_attr($settings['section_id']) . '"' : '';

// section style
$section_style = !empty($settings['style']) ? 'style="' . $settings['style'] . '"' : '';

// display type
$display = $settings['display'] ?? 'default';

// post type
$post_type = "service";
$unique_id = $post_type . rand(100, 999); ?>

<section <?= $section_id ?> <?= $section_style ?>>

  <?php /* headline */ if (!empty($headline['label']) || !empty($headline['title']) || !empty($headline['textarea']) || $display === 'slider') : ?>
    <div class="container">
      <div class="flexgrid">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

          <div class="headline-group">

            <?php // component: headline
            include locate_template('template-parts/components/headline.php'); ?>

            <?php if ($display === "slider") : ?>
              <div id="<?php echo $unique_id; ?>-slider__control" class="button-group">
                <div class="button button--uniform button--outline button--round button-prev"><span class="iconify" data-icon="ri:arrow-left-line"></span></div>
                <div class="button button--uniform button--outline button--round button-next"><span class="iconify" data-icon="ri:arrow-right-line"></span></div>
              </div>
            <?php endif; ?>

          </div>

        </div>
      </div>
    </div>
  <?php /* headline */ endif; ?>

  <?php /* post */ if (!empty($posts = get_sub_field('posts') ?: get_posts(array('numberposts' => -1, 'post_type' => $post_type)))) : ?>

    <?php if ($display === 'default') : ?>

      <div class="container container--lg">
        <div class="flexgrid">

          <?php foreach ($posts as $post) : setup_postdata($post); ?>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">

              <div class="card card--<?php echo $post_type; ?>">
                <?php // component
                get_template_part('template-parts/components/card-' . $post_type); ?>
              </div>

            </div>
          <?php endforeach;
          wp_reset_postdata(); ?>

        </div>
      </div>

    <?php elseif ($display === 'slider') : ?>

      <div class="flexgrid">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display: block;">

          <div id="<?php echo $unique_id; ?>-slider" class="swiper swiper--endless">
            <div class="swiper-wrapper">

              <?php foreach ($posts as $post) : setup_postdata($post); ?>
                <div class="swiper-slide">

                  <div class="card card--<?php echo $post_type; ?>">
                    <?php // component
                    get_template_part('template-parts/components/card-' . $post_type); ?>
                  </div>

                </div>
              <?php endforeach;
              wp_reset_postdata(); ?>

            </div>
          </div>

          <script>
            var swiper = new Swiper("#<?php echo $unique_id; ?>-slider", {
              initialSlide: 0,
              slidesPerView: 1,
              spaceBetween: 32,
              navigation: {
                nextEl: "#<?php echo $unique_id; ?>-slider__control .button-next",
                prevEl: "#<?php echo $unique_id; ?>-slider__control .button-prev",
              },
              breakpoints: {
                640: {
                  slidesPerView: 2,
                  spaceBetween: 32,
                },
                768: {
                  slidesPerView: 3,
                  spaceBetween: 32,
                },
                1440: {
                  slidesPerView: 4,
                  spaceBetween: 32,
                },
              },
            });
          </script>

        </div>
      </div>

    <?php endif; ?>

  <?php /* post */ endif; ?>

  <?php // component: separators
  $separators = $settings['separator'] ?? null;
  include locate_template('template-parts/components/separators.php'); ?>
</section>