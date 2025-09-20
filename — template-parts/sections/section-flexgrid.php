<?php

/* section flexgrid */

// headline
$headline = get_sub_field('headline');

// settings
$settings = get_sub_field('settings');

// section id
$section_id = !empty($settings['section_id']) ? 'id="' . esc_attr($settings['section_id']) . '"' : '';

// section style
$section_style = !empty($settings['style']) ? 'style="' . $settings['style'] . '"' : ''; ?>

<section <?= $section_id ?> <?= $section_style ?>>
  <div class="container">

    <?php if (!empty($headline['label']) || !empty($headline['title']) || !empty($headline['textarea'])) : ?>
      <div class="flexgrid">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <?php // component: headline
          include locate_template('template-parts/components/headline.php'); ?>
        </div>
      </div>
    <?php endif; ?>

    <?php if (have_rows('rows')) : ?>
      <?php while (have_rows('rows')) : the_row();

        $layout = get_sub_field('layout_type');

        $content_key = 'content_' . $layout;
        $content     = get_sub_field($content_key);

        $columns = array_map(
          fn($i) => $content['column_' . $i] ?? [],
          range(1, count($content))
        );

        $column_classes = match ($layout) {
          '12'      => ['col-md-12 col-lg-12'],
          '6_6'     => ['col-md-6 col-lg-6', 'col-md-6 col-lg-6'],
          '4_8'     => ['col-md-4 col-lg-4', 'col-md-8 col-lg-8'],
          '4_4_4'   => ['col-md-4 col-lg-4', 'col-md-4 col-lg-4', 'col-md-4 col-lg-4'],
          '3_3_3_3' => ['col-md-3 col-lg-3', 'col-md-3 col-lg-3', 'col-md-3 col-lg-3', 'col-md-3 col-lg-3'],
          default   => ['col-md-12 col-lg-12'],
        };
      ?>

        <div class="flexgrid" <?= count($columns) === 2 ? 'style="--col-gap: var(--default-gap);"' : '' ?>>
          <?php foreach ($columns as $i => $column) : ?>
            <div class="col-xs-12 col-sm-12 <?= $column_classes[$i] ?? 'col-md-12 col-lg-12' ?>">
              <?php if (!empty($column) && is_array($column)) : ?>
                <?php foreach ($column as $component) :
                  if (!empty($component['acf_fc_layout'])) {
                    get_template_part('template-parts/components/acf-column-components', null, ['data' => $component]);
                  }
                endforeach; ?>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>

      <?php endwhile; ?>
    <?php endif; ?>

  </div>

  <?php // component: separators
  $separators = $settings['separator'] ?? null;
  include locate_template('template-parts/components/separators.php'); ?>
</section>