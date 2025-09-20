<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package www
 */

get_header(); ?>

<main id="primary" class="site-main">

	<?php // template part: page header
	get_template_part('template-parts/content-header'); ?>

	<section>
		<div class="container">
			<div class="flexgrid">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

					<h1><?php echo __("404"); ?></h1>

					<p><?php echo __("Запитуваної сторінки не існує. Ми вже знаємо про це та працюємо над усуненням проблеми."); ?></p>

					<div class="button-group">
						<a class="button" href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php echo __("Головна сторінка"); ?></a>
					</div>

				</div>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>