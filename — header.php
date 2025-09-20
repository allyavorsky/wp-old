<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package qodeum
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head('body'); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">

		<header id="site-header" class="site-header">

			<div id="tophead" class="masthead">
				<div class="container">

					<div class="flexgrid">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<p>#tophead</p>
						</div>
					</div>

				</div>
			</div><!-- .tophead -->

			<div id="midhead" class="masthead">
				<div class="container">
					<div class="flexgrid">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

							<div class="masthead-panel">
								<a class="logo" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
									<?php // component: logo
									get_template_part('template-parts/components/logo'); ?>
								</a>
							</div>

							<div class="masthead-panel hide-1280">
								<nav id="masthead-navigation" class="masthead-navigation">
									<?php wp_nav_menu(array('container' => '', 'menu_class' => 'menu', 'theme_location' => 'menu-1', 'menu_id' => 'midhead-menu')); ?>
								</nav>
							</div>

							<div class="masthead-panel">
								<?php /* wpm */ if (function_exists('wpm_language_switcher')) : ?>
									<?php echo wpm_language_switcher($type = 'dropdown', $show = 'name'); ?>
								<?php /* wpm */ endif; ?>

								<div class="button-group">
									<button class="button button--uniform button--sidebar" component-sidebar="mastside"><span class="iconify" data-icon="mdi:menu"></span></button>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div><!-- .midhead -->

			<div class="sidebar" component-sidebar="mastside">

				<div class="sidebar-head">

				</div>

				<nav id="sidebar-navigation" class="sidebar-navigation">
					<?php wp_nav_menu(array('container' => '', 'menu_class' => 'menu', 'theme_location' => 'menu-1', 'menu_id' => 'sidebar-menu')); ?>
				</nav>

				<div class="sidebar-panel">

				</div>

			</div><!-- .mastside -->

		</header>