<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package www
 */

?>

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
			<?php /* single end */ endif; ?>

		</div>
	</section>

<?php endwhile; ?>