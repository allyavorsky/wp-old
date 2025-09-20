<?php

/**
 * =============================================================================
 * ACF Column Components Renderer
 * -----------------------------------------------------------------------------
 * This file acts as a layout dispatcher for rendering individual ACF components
 * inside Flexible Content columns. Each case corresponds to a layout key from
 * ACF and outputs the appropriate frontend markup.
 *
 * Expected: $args['data'] — array of layout sub_fields from flexible content.
 * =============================================================================
 */

$data   = $args['data'] ?? [];
$layout = $data['acf_fc_layout'] ?? null;

if (!$layout) return;

/**
 * -----------------------------------------------------------------------------
 * Internal helper: render_acf_mediafile()
 * -----------------------------------------------------------------------------
 * Reusable renderer for the Media File block (image, uploaded video, embed).
 * Used in column_mediafile and column_card to avoid duplication.
 * -----------------------------------------------------------------------------
 */
if (!function_exists('render_acf_mediafile')) {
  function render_acf_mediafile(array $media): void
  {
    $type     = $media['type'] ?? null;
    $size     = $media['size'] ?? 'md';
    $contain  = !empty($media['contain']) || $size === 'original';

    $size_class    = ($size !== 'original') ? ' thumbnail--' . esc_attr($size) : '';
    $contain_class = $contain ? ' thumbnail--contain' : '';
    $classes       = 'thumbnail' . $size_class . $contain_class;

    if ($type === 'image' && !empty($media['image'])) {
      $image = $media['image'];
?>
      <div class="<?= esc_attr($classes) ?>">
        <img class="thumbnail__media"
          src="<?= esc_url($image['url']) ?>"
          alt="<?= esc_attr($image['alt'] ?? '') ?>">
      </div>
    <?php
    } elseif ($type === 'video_file' && !empty($media['video'])) {
      $video = $media['video'];
    ?>
      <div class="<?= esc_attr($classes) ?>">
        <video class="thumbnail__media"
          src="<?= esc_url($video['url']) ?>"
          controls
          playsinline></video>
      </div>
    <?php
    } elseif ($type === 'video_embed' && !empty($media['embed'])) {
      $embed_raw = $media['embed'];
      $embed_tag = str_replace('<iframe', '<iframe class="thumbnail__media"', $embed_raw);
    ?>
      <div class="<?= esc_attr($classes) ?>">
        <?= $embed_tag ?>
      </div>
    <?php
    }
  }
}

/**
 * -----------------------------------------------------------------------------
 * Component: ACF Button Renderer
 * -----------------------------------------------------------------------------
 * Renders a button using ACF link field.
 * Applies escaping, optional target attribute, and clean markup.
 * Used in multiple components (Button, Card, Modal, etc.).
 *
 * @param array|null  $button — ACF link field array ['url', 'title', 'target']
 * @param string      $class  — Optional custom class for the anchor tag
 * -----------------------------------------------------------------------------
 */
if (!function_exists('render_acf_button')) {
  function render_acf_button(?array $button, string $class = 'button'): void
  {
    if (empty($button['url']) || empty($button['title'])) {
      return;
    }

    $target_attr = !empty($button['target']) ? ' target="' . esc_attr($button['target']) . '"' : '';
    ?>

    <a class="<?= esc_attr($class) ?>"
      href="<?= esc_url($button['url']) ?>"
      <?= $target_attr ?>>
      <?= esc_html($button['title']) ?>
    </a>

  <?php
  }
}

switch ($layout) {

  /* =========================================================================
     * Component: Accordion
     * -------------------------------------------------------------------------
     * A vertical list of expandable/collapsible items.
     * Commonly used for FAQs or structured content breakdown.
     * ========================================================================= */
  case 'column_accordion': ?>

    <?php if (!empty($data['title']) || !empty($data['content'])) : ?>
      <div class="accordion">

        <div class="accordion__button" data-accordion-button>
          <?php if (!empty($data['title'])) : ?>
            <?= esc_html($data['title']) ?>
          <?php endif; ?>
        </div>

        <div class="accordion__content" data-accordion-content>
          <?php if (!empty($data['content'])) : ?>
            <?= wp_kses_post($data['content']) ?>
          <?php endif; ?>
        </div>

      </div>
    <?php endif; ?>

  <?php break;

  /* =========================================================================
     * Component: Gallery
     * -------------------------------------------------------------------------
     * A responsive gallery of images with support for default or slider layout.
     * ========================================================================= */
  case 'column_gallery': ?>

    <?php if (!empty($data['gallery'])) :
      $display = $data['settings']['display'] ?? 'default';
      $data_fancybox_group = 'gallery-' . uniqid();

      $render_image = function ($image, $group) {
        $title       = $image['title'] ?? '';
        $description = $image['description'] ?? '';
        $caption     = trim($title) !== '' || trim($description) !== ''
          ? '<strong>' . esc_html($title) . '</strong><br>' . esc_html($description)
          : ''; ?>

        <a class="thumbnail thumbnail--uniform"
          data-fancybox="<?= esc_attr($group) ?>"
          data-src="<?= esc_url($image['url']) ?>"
          data-caption="<?= esc_attr($caption) ?>">
          <img class="thumbnail__media" src="<?= esc_url($image['url']) ?>" alt="image" />
        </a>

      <?php }; ?>

      <?php if ($display === 'default') : ?>

        <div class="flexgrid" style="--col-gap: 32px;">
          <?php foreach ((array) $data['gallery'] as $image) : ?>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
              <?php $render_image($image, $data_fancybox_group); ?>
            </div>
          <?php endforeach; ?>
        </div>

      <?php elseif ($display === 'slider') :
        $slider_id = 'gallery-slider-' . uniqid();
        $pagination_id = $slider_id . '__pagination'; ?>

        <div>
          <div id="<?= esc_attr($slider_id) ?>" class="swiper">
            <div class="swiper-wrapper">
              <?php foreach ((array) $data['gallery'] as $image) : ?>
                <div class="swiper-slide">
                  <?php $render_image($image, $data_fancybox_group); ?>
                </div>
              <?php endforeach; ?>
            </div>
            <div id="<?= esc_attr($pagination_id) ?>" class="swiper-pagination"></div>
          </div>

          <script>
            var swiper = new Swiper("#<?= esc_js($slider_id) ?>", {
              slidesPerView: 1,
              spaceBetween: 32,
              pagination: {
                el: "#<?= esc_js($pagination_id) ?>",
              },
            });
          </script>
        </div>

      <?php endif; ?>

    <?php endif; ?>

  <?php break;

  /* =========================================================================
     * Component: Content
     * -------------------------------------------------------------------------
     * A simple rich-text editor block using the WYSIWYG field.
     * Useful for static HTML content or mixed inline formatting.
     * ========================================================================= */
  case 'column_content': ?>

    <?php if (!empty($data['content'])) : ?>
      <div class="editor">
        <?= wp_kses_post($data['content']) ?>
      </div>
    <?php endif; ?>

  <?php break;

  /* =========================================================================
     * Component: Modal Window
     * -------------------------------------------------------------------------
     * A modal popup triggered by a button, containing rich WYSIWYG content.
     * Ideal for forms, descriptions, or additional details.
     * ========================================================================= */
  case 'column_modal':
    $modal_id = 'modal-' . uniqid(); ?>

    <?php if (!empty($data['button'])) : ?>
      <div class="button-group">
        <button class="button"
          data-fancybox
          data-src="#<?= esc_attr($modal_id); ?>">
          <?= esc_html($data['button']['title'] ?? __('Read more')) ?>
        </button>
      </div>
    <?php endif; ?>

    <?php if (!empty($data['content'])) : ?>
      <div class="modal" id="<?= esc_attr($modal_id); ?>">
        <div class="container-short">
          <div class="flexgrid">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="editor">
                <?= wp_kses_post($data['content']) ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

  <?php break;

  /* =========================================================================
     * Component: Button
     * -------------------------------------------------------------------------
     * A single CTA button linking to a custom URL.
     * Commonly used as a standalone action or part of other layouts.
     * ========================================================================= */
  case 'column_button': ?>

    <?php
    $text      = $data['text'] ?? '';
    $url       = $data['url'] ?? '';
    $data_attr = $data['data_attr'] ?? '';
    ?>

    <?php if ($text) : ?>
      <div class="button-group">
        <a <?= $url ? 'href="' . esc_url($url) . '"' : '' ?>
          class="button"
          <?= $data_attr ? $data_attr : ''; ?>>
          <?= esc_html($text); ?>
        </a>
      </div>
    <?php endif; ?>

  <?php break;


  /* =========================================================================
     * Component: Media File
     * -------------------------------------------------------------------------
     * Universal media block supporting image, uploaded video, or embedded video.
     * Style options: size, contain.
     * ========================================================================= */
  case 'column_mediafile': ?>

    <?php if (!empty($data['media'])) :
      render_acf_mediafile($data['media']);
    endif; ?>

  <?php break;

  /* =========================================================================
     * Component: Card
     * -------------------------------------------------------------------------
     * A media-content block with image, video or embed, title, text and optional button.
     * Frequently used in grids, features or promo sections.
     * ========================================================================= */
  case 'column_card': ?>

    <div class="card">

      <?php if (!empty($data['media'])) :
        render_acf_mediafile($data['media']);
      endif; ?>

      <div class="card__panel">
        <?php if (!empty($data['title'])) : ?>
          <p class="card__title"><?= esc_html($data['title']) ?></p>
        <?php endif; ?>

        <?php if (!empty($data['text'])) : ?>
          <div class="editor">
            <?= wp_kses_post($data['text']) ?>
          </div>
        <?php endif; ?>
      </div>

      <?php if (!empty($data['button'])) : ?>
        <?php render_acf_button($data['button']); ?>
      <?php endif; ?>

    </div>

  <?php break;


  /* =========================================================================
     * Fallback: Unknown Layout
     * -------------------------------------------------------------------------
     * Outputs an HTML comment if the layout key is not recognized.
     * ========================================================================= */
  default: ?>

    <?php echo '<!-- Unknown layout: ' . esc_html($layout) . ' -->'; ?>

<?php break;
}
