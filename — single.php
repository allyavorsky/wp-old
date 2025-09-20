<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package www
 */

get_header(); ?>

<main id="primary" class="site-main">

	<?php // template part: page header
	get_template_part('template-parts/content-header'); ?>

	<?php // template part: page content
	get_template_part('template-parts/content-page'); ?>

	<?php // template part: page comments
	get_template_part('template-parts/content-comments'); ?>

</main>

<?php get_footer(); ?>