<?php

/**
 * Filter Archive Titles.
 */
add_filter('get_the_archive_title', function ($title) {
  return preg_replace('~^[^:]+: ~', '', $title);
});

/**
 * Contact Form 7 remove <p> tag.
 */
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Disable Gutenberg.
 */
add_filter('use_block_editor_for_post', '__return_false');

/**
 * Disable Gutenberg for Widgets.
 */
function disable_gutenberg_for_widgets()
{
  // Disable Gutenberg for widgets
  remove_theme_support('widgets-block-editor');
}
add_action('after_setup_theme', 'disable_gutenberg_for_widgets');


/* -------------------------------------------------------------------------------------- */

/**
 * Get page title based on current page type.
 *
 * @return string The page title.
 */
function qodeum_page_title()
{
  if (is_singular()) {
    return get_the_title();
  }

  if (is_search()) {
    return __('Результати пошуку', 'qodeum');
  }

  if (is_archive() || is_home()) {
    return get_the_archive_title();
  }

  return '';
}

/**
 * Display page thumbnail URL.
 *
 * @return void
 */
function qodeum_page_thumbnail()
{
  $thumbnail = '';

  if (is_singular()) {
    $thumbnail = get_the_post_thumbnail_url();
  }

  if (is_archive() || is_category() || is_tag()) {
    $thumbnail = get_theme_file_uri('/assets/media/image-1.jpg');
  }

  if ($thumbnail) {
    echo esc_url($thumbnail);
  }
}

/**
 * Render contact information based on type.
 * 
 */
function qodeum_render_contacts($field_name, $atts, $type)
{
  $atts = shortcode_atts([
    'label' => true,
    'count' => false,
  ], $atts);

  $atts['label'] = filter_var($atts['label'], FILTER_VALIDATE_BOOLEAN);
  $items = get_field($field_name, 'option');
  if (empty($items)) return '';

  if ($atts['count'] !== false && is_numeric($atts['count'])) {
    $items = array_slice($items, 0, (int)$atts['count']);
  }

  $output = '<div class="contact-group">';

  foreach ($items as $item) {
    $output .= '<div class="contact contact-' . esc_attr($type) . '">';

    if ($atts['label'] && !empty($item['label'])) {
      $output .= '<span class="contact-label">' . esc_html($item['label']) . '</span>';
    }

    if ($type === 'phone' && !empty($item['number'])) {
      $output .= '<a href="tel:' . esc_attr($item['number']) . '" rel="noopener noreferrer">' . esc_html($item['number']) . '</a>';
    }

    if ($type === 'email' && !empty($item['address'])) {
      $output .= '<a href="mailto:' . esc_attr($item['address']) . '" rel="noopener noreferrer">' . esc_html($item['address']) . '</a>';
    }

    if ($type === 'location') {
      if (!empty($item['address'])) {
        $output .= '<div class="contact-address">' . $item['address'] . '</div>';
      }
      if (!empty($item['schedule'])) {
        $output .= '<div class="contact-schedule">' . $item['schedule'] . '</div>';
      }
    }

    $output .= '</div>';
  }

  $output .= '</div>';
  return $output;
}


//
function qodeum_render_icons($field_name, $atts)
{
  $atts = shortcode_atts(['count' => false], $atts);
  $items = get_field($field_name, 'option');
  if (empty($items)) return '';

  if ($atts['count'] !== false && is_numeric($atts['count'])) {
    $items = array_slice($items, 0, (int)$atts['count']);
  }

  $output = '<div class="contact-group contact-group--inline">';
  foreach ($items as $item) {
    $output .= '<a class="contact-social" href="' . $item['link'] . '" target="_blank" rel="noopener noreferrer">';
    $output .= '<span class="iconify" data-icon="' . esc_attr($item['icon']) . '"></span>';
    $output .= '</a>';
  }
  $output .= '</div>';

  return $output;
}


//
add_shortcode('qodeum_contact_phone', fn($atts) => qodeum_render_contacts('site_contact_phone', $atts, 'phone'));
add_shortcode('qodeum_contact_email', fn($atts) => qodeum_render_contacts('site_contact_email', $atts, 'email'));
add_shortcode('qodeum_contact_location', fn($atts) => qodeum_render_contacts('site_contact_location', $atts, 'location'));

//
add_shortcode('qodeum_contact_socialmedia', fn($atts) => qodeum_render_icons('site_contact_socialmedia', $atts));
add_shortcode('qodeum_contact_messenger', fn($atts) => qodeum_render_icons('site_contact_messenger', $atts));
