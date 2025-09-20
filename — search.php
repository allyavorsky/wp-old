<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package www
 */

get_header(); ?>

<main id="primary" class="site-main">

	<?php // template part: page header
	get_template_part('template-parts/content-header'); ?>

	<?php if (have_posts()) : ?>

		<?php // template part: content archive
		get_template_part('template-parts/content-archive'); ?>

	<?php else :

		// template part: content none
		get_template_part('template-parts/content-none'); ?>

	<?php endif; ?>

</main>

<?php get_footer(); ?>