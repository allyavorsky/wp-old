<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package www
 */

?>

<?php if (have_rows('templates')) : while (have_rows('templates')) : the_row();

    // layout
    $layout = get_row_layout();

    // layouts
    switch ($layout) {

      // section flexgrid
      case 'section_flexgrid':
        get_template_part('template-parts/sections/section', 'flexgrid');
        break;

      // section gallery
      case 'section_gallery':
        get_template_part('template-parts/sections/section', 'gallery');
        break;

      // section contact
      case 'section_contact':
        get_template_part('template-parts/sections/section', 'contact');
        break;

      // section service
      case 'section_service':
        get_template_part('template-parts/sections/section', 'service');
        break;
    }

  endwhile; ?>

<?php else : ?>

  <?php while (have_posts()) : the_post(); ?>

    <section>
      <div class="container">

        <div class="flexgrid">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <div class="editor">
              <?php the_content(); ?>
            </div>

          </div>
        </div>

        <?php /* single */ if (is_single()) : ?>
          <div class="flexgrid">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

              <?php the_post_navigation(); ?>

            </div>
          </div>
        <?php /* single */ endif; ?>

      </div>
    </section>

  <?php endwhile; ?>

<?php endif; ?>