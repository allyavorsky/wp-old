<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package www
 */

get_header(); ?>

<main id="primary" class="site-main">

	<?php // template part: page header
	get_template_part('template-parts/content-header'); ?>

	<?php // template part: page content
	get_template_part('template-parts/content-page'); ?>

</main>

<?php get_footer(); ?>