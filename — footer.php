<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package www
 */

?>

<footer id="site-footer" class="colophon">
	<div class="container">

		<div class="flexgrid">

			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<a class="logo" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
					<?php // component: logo
					get_template_part('template-parts/components/logo'); ?>
				</a>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

				<?php // sidebar: colophon
				dynamic_sidebar('sidebar-colophon'); ?>

			</div>

		</div>

		<hr class="separator separator--white" />

		<div class="flexgrid">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

				<div class="colophon__panel">
					<p class="colophon__copyright"><?php echo '© ' . date('Y'); ?> <?php echo bloginfo('name'); ?></p>
				</div>

				<div class="colophon__panel">
					<a class="colophon__copyright" href="https://qodeum.com/" target="_blank"><?php echo __("by Qodeum"); ?></a>
				</div>

			</div>
		</div>

	</div>

</footer>

</div><!-- #page -->

<!------------------------------------------------------------------------->
<div id="modal-" class="modal">
	<a data-fancybox data-src="#modal-">Модальное окно</a>
</div>
<!------------------------------------------------------------------------->

<script>
	AOS.init();
</script>

<?php wp_footer(); ?>

</body>

</html>