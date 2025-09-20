<?php

/**
 * Template name: Home
 * 
 * The template for displaying page-home.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package www
 */

get_header(); ?>

<main id="primary" class="site-main">

  <section class="hero">

    <?php // section: hero
    get_template_part('template-parts/sections/section-hero'); ?>

  </section>

  <?php // template part: page content
  get_template_part('template-parts/content-page'); ?>

</main>

<?php get_footer(); ?>