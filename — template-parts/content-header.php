<?php

/**
 * Template part for displaying page header
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package www
 */

?>

<section class="hero">
  <div class="container">
    <div class="flexgrid">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <div class="headline">
          <div class="headline__label"> <?php echo do_shortcode('[wpseo_breadcrumb]'); ?></div>
          <h1 class="headline__title"><?php echo qodeum_page_title(); ?></h1>
        </div>

      </div>
    </div>
  </div>
</section>