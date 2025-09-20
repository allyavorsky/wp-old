<?php

/**
 * =============================================================================
 * ACF Templates — Flexible Page Composition for Post Types
 * -----------------------------------------------------------------------------
 * Defines a flexible content field group named "Templates" for use on pages,
 * services, and the front page. Allows users to assemble pages from modular
 * ACF Organisms (sections like Flexgrid, Gallery, Contact).
 * =============================================================================
 */

require_once __DIR__ . '/acf-organisms.php';

add_action('acf/init', function () {
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group([
    'key'    => 'group_templates',
    'title'  => 'Templates',

    'fields' => [
      [
        'key'          => 'field_templates',
        'label'        => '',
        'name'         => 'templates',
        'type'         => 'flexible_content',
        'button_label' => 'Add Section',
        'layouts'      => [
          get_section_gallery_layout(),
          get_section_contact_layout(),
          get_section_flexgrid_layout(),
          get_section_service_layout(),
        ],
      ],
    ],

    'location' => [
      [
        [
          'param'    => 'page_template',
          'operator' => '==',
          'value'    => 'default',
        ],
      ],
      [
        [
          'param'    => 'post_type',
          'operator' => '==',
          'value'    => 'service',
        ],
      ],
      [
        [
          'param'    => 'page_type',
          'operator' => '==',
          'value'    => 'front_page',
        ],
      ],
    ],

    'position'              => 'acf_after_title',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
    'menu_order'            => 0,
    'active'                => true,
    'show_in_rest'          => false,
    'hide_on_screen'        => ['the_content'],
  ]);
});
