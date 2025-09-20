<?php

/* section gallery */

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

// gallery
$gallery = get_sub_field('gallery');
$unique_id = 'gallery_' . rand(100, 999); ?>

<section <?= $section_id ?> <?= $section_style ?>>

  <?php /* headline & slider control */ if (!empty($headline['label']) || !empty($headline['title']) || !empty($headline['textarea']) || $display === 'slider') : ?>
    <div class="container">
      <div class="flexgrid">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

          <div class="headline-group">

            <?php // component: headline
            include locate_template('template-parts/components/headline.php'); ?>

            <?php if ($display === "slider") : ?>
              <div id="<?= $unique_id ?>-slider__control" class="button-group">
                <div class="button button--uniform button--outline button--round button-prev"><span class="iconify" data-icon="ri:arrow-left-line"></span></div>
                <div class="button button--uniform button--outline button--round button-next"><span class="iconify" data-icon="ri:arrow-right-line"></span></div>
              </div>
            <?php endif; ?>

          </div>

        </div>
      </div>
    </div>
  <?php /* headline & slider control */ endif; ?>

  <?php /* gallery */ if (!empty($gallery)) : ?>

    <?php if ($display === 'default') : ?>

      <div class="container">
        <div class="flexgrid">

          <?php foreach ($gallery as $image) : ?>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">

              <a class="thumbnail thumbnail--md" data-fancybox="<?= $unique_id ?>" data-src="<?php echo $image['url']; ?>" data-caption="<?php echo __($image['caption']); ?>">
                <?php // component
                include locate_template('template-parts/components/card-gallery.php'); ?>
              </a>

            </div>
          <?php endforeach; ?>

        </div>
      </div>

    <?php elseif ($display === 'slider') : ?>

      <div class="flexgrid">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display: block;">

          <div id="<?= $unique_id ?>-slider" class="swiper swiper--endless">
            <div class="swiper-wrapper">

              <?php foreach ($gallery as $image) : ?>
                <div class="swiper-slide">

                  <a class="thumbnail thumbnail--md" data-fancybox="<?= $unique_id ?>" data-src="<?php echo $image['url']; ?>" data-caption="<?php echo __($image['caption']); ?>">
                    <?php // component
                    include locate_template('template-parts/components/card-gallery.php'); ?>
                  </a>

                </div>
              <?php endforeach; ?>

            </div>

            <div id="<?= $unique_id ?>-slider__pagination" class="swiper-pagination"></div>
          </div>

          <script>
            var swiper = new Swiper("#<?= $unique_id ?>-slider", {
              initialSlide: 0,
              slidesPerView: 1,
              spaceBetween: 32,
              // pagination: {
              //   el: "#<?= $unique_id ?>-slider__pagination",
              //   clickable: true,
              // },
              navigation: {
                nextEl: "#<?= $unique_id ?>-slider__control .button-next",
                prevEl: "#<?= $unique_id ?>-slider__control .button-prev",
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

  <?php /* gallery */ endif; ?>

  <?php // component: separators
  $separators = $settings['separator'] ?? null;
  include locate_template('template-parts/components/separators.php'); ?>
</section>