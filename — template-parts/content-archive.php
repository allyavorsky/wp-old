<?php

/**
 * Template part for displaying archive content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package www
 */

?>

<section>
  <div class="container">

    <div class="flexgrid">
      <?php while (have_posts()) : the_post(); ?>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          <div class="card">

            <?php // component: component card [post type]
            get_template_part('template-parts/components/card-' . get_post_type()); ?>

          </div>
        </div>

      <?php endwhile; ?>
    </div>

    <div class="flexgrid">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <?php the_posts_pagination(); ?>

      </div>
    </div>

  </div>
</section>