<?php

// title
$title = get_the_title();

// excerpt
$excerpt = get_the_excerpt();

// permalink
$permalink = get_the_permalink();

// image
$image = get_the_post_thumbnail_url(); ?>


<?php /* image */ if (!empty($image)) : ?>
  <a class="thumbnail" href="<?php echo $permalink; ?>">
    <img class="thumbnail__media" src="<?php echo $image; ?>" alt="image" />
  </a>
<?php /* image */ endif; ?>

<div class="card__panel">
  <a class="card__title" href="<?php echo $permalink; ?>"><?php echo $title; ?></a>

  <?php /* excerpt */ if (!empty($excerpt)) : ?>
    <p class="card__excerpt"><?php echo $excerpt ?></p>
  <?php /* excerpt */ endif; ?>
</div>