<?php

/**
 * =============================================================================
 * ACF Organisms — Page Sections Built from Atoms and Molecules
 * -----------------------------------------------------------------------------
 * This file defines complex, reusable page sections such as flex grids,
 * contact blocks, and galleries. Each section is built by composing
 * atomic fields and molecular components.
 * =============================================================================
 */

require_once __DIR__ . '/acf-atoms.php';
require_once __DIR__ . '/acf-molecules.php';

/**
 * -----------------------------------------------------------------------------
 * Flexgrid Column Generator
 * -----------------------------------------------------------------------------
 * Returns a group of columns depending on the selected flex layout type.
 * Dynamically assigns column widths and uses Molecules inside each.
 * -----------------------------------------------------------------------------
 * @param string $prefix           Unique key prefix for fields
 * @param int    $count            Number of columns in the layout
 * @param string $condition_value  Conditional logic value for layout match
 * @return array
 */
function get_flexgrid_columns_group_fields(string $prefix, int $count, string $condition_value): array
{
  $columns = [];

  for ($i = 1; $i <= $count; $i++) {
    $columns[] = [
      'key'          => $prefix . '_col_' . $i,
      'label'        => '',
      'name'         => 'column_' . $i,
      'type'         => 'flexible_content',
      'button_label' => 'Components',
      'layouts'      => get_acf_column_components(),
      'wrapper'      => [
        'width' => match ($condition_value) {
          '4_8'   => ($i === 1) ? '33' : '67',
          default => (string)(100 / $count),
        },
      ],
    ];
  }

  return [
    'key'               => $prefix . '_columns_group',
    'label'             => '',
    'name'              => 'content_' . $condition_value,
    'type'              => 'group',
    'layout'            => 'block',
    'conditional_logic' => [
      [
        [
          'field'    => 'field_flexgrid_row_layout',
          'operator' => '==',
          'value'    => $condition_value,
        ],
      ],
    ],
    'sub_fields' => $columns,
  ];
}

/**
 * -----------------------------------------------------------------------------
 * Section: Flexgrid
 * -----------------------------------------------------------------------------
 * A flexible multi-column content layout section.
 * Columns are configurable via select options and contain Molecule components.
 * -----------------------------------------------------------------------------
 */
function get_section_flexgrid_layout(): array
{
  return [
    'key'        => 'layout_section_flexgrid',
    'name'       => 'section_flexgrid',
    'label'      => 'Section Flexgrid',
    'display'    => 'block',
    'sub_fields' => [
      [
        'key'        => 'field_flexgrid_headline',
        'label'      => '',
        'name'       => 'headline',
        'type'       => 'group',
        'layout'     => 'row',
        'sub_fields' => get_acf_section_headline_fields('field_flexgrid_headline_'),
      ],
      [
        'key'          => 'field_flexgrid_rows',
        'label'        => '',
        'name'         => 'rows',
        'type'         => 'repeater',
        'button_label' => '+',
        'layout'       => 'block',
        'min'          => 1,
        'sub_fields'   => array_merge(
          [
            [
              'key'     => 'field_flexgrid_row_layout',
              'label'   => '',
              'name'    => 'layout_type',
              'type'    => 'select',
              'choices' => [
                '12'        => '1 column (100%)',
                '6_6'       => '2 columns (50% / 50%)',
                '4_8'       => '2 columns (33% / 67%)',
                '4_4_4'     => '3 columns (33% / 33% / 33%)',
                '3_3_3_3'   => '4 columns (25% / 25% / 25% / 25%)',
              ],
              'default_value' => '12',
              'ui'            => true,
              'allow_null'    => false,
            ],
          ],
          [
            get_flexgrid_columns_group_fields('field_flexgrid_row_12',      1, '12'),
            get_flexgrid_columns_group_fields('field_flexgrid_row_6_6',     2, '6_6'),
            get_flexgrid_columns_group_fields('field_flexgrid_row_4_8',     2, '4_8'),
            get_flexgrid_columns_group_fields('field_flexgrid_row_4_4_4',   3, '4_4_4'),
            get_flexgrid_columns_group_fields('field_flexgrid_row_3_3_3_3', 4, '3_3_3_3'),
          ]
        ),
      ],
      [
        'key'        => 'field_flexgrid_settings',
        'label'      => '',
        'name'       => 'settings',
        'type'       => 'group',
        'layout'     => 'block',
        'sub_fields' => get_acf_section_settings_fields('field_flexgrid_settings_'),
      ],
    ],
  ];
}

/**
 * -----------------------------------------------------------------------------
 * Section: Contact
 * -----------------------------------------------------------------------------
 * Marked for removal. Use Flexgrid with contact molecules instead.
 * -----------------------------------------------------------------------------
 */
function get_section_contact_layout(): array
{
  return [
    'key'        => 'layout_section_contact',
    'name'       => 'section_contact',
    'label'      => 'Section Contact',
    'display'    => 'block',
    'sub_fields' => [
      [
        'key'        => 'field_section_contact_headline',
        'label'      => '',
        'name'       => 'headline',
        'type'       => 'group',
        'layout'     => 'row',
        'sub_fields' => get_acf_section_headline_fields('field_section_contact_headline_'),
      ],
      [
        'key'        => 'field_section_contact_settings',
        'label'      => '',
        'name'       => 'settings',
        'type'       => 'group',
        'layout'     => 'block',
        'sub_fields' => get_acf_section_settings_fields('field_section_contact_settings_'),
      ],
    ],
  ];
}

/**
 * -----------------------------------------------------------------------------
 * Section: Gallery
 * -----------------------------------------------------------------------------
 * A basic image gallery with optional headline and settings.
 * Useful for showcasing media collections in-page.
 * -----------------------------------------------------------------------------
 */
function get_section_gallery_layout(): array
{
  return [
    'key'        => 'layout_section_gallery',
    'name'       => 'section_gallery',
    'label'      => 'Section Gallery',
    'display'    => 'block',
    'sub_fields' => [
      [
        'key'        => 'field_section_gallery_headline',
        'label'      => '',
        'name'       => 'headline',
        'type'       => 'group',
        'layout'     => 'row',
        'sub_fields' => get_acf_section_headline_fields('field_section_gallery_headline_'),
      ],
      [
        'key'           => 'field_section_gallery_images',
        'label'         => 'Gallery',
        'name'          => 'gallery',
        'type'          => 'gallery',
        'return_format' => 'array',
        'preview_size'  => 'medium',
        'insert'        => 'append',
        'library'       => 'all',
        'wrapper'       => ['width' => '100'],
      ],
      [
        'key'        => 'field_section_gallery_settings',
        'label'      => '',
        'name'       => 'settings',
        'type'       => 'group',
        'layout'     => 'block',
        'sub_fields' => get_acf_section_settings_fields('field_section_gallery_settings_'),
      ],
    ],
  ];
}

/**
 * -----------------------------------------------------------------------------
 * Section: Service
 * -----------------------------------------------------------------------------
 * Displays a services section with headline and section-wide settings.
 * Designed for showcasing specific service details or categories.
 * -----------------------------------------------------------------------------
 */
function get_section_service_layout(): array
{
  return [
    'key'        => 'layout_section_service',
    'name'       => 'section_service',
    'label'      => 'Section Service',
    'display'    => 'block',
    'sub_fields' => [
      [
        'key'        => 'field_section_service_headline',
        'label'      => '',
        'name'       => 'headline',
        'type'       => 'group',
        'layout'     => 'row',
        'sub_fields' => get_acf_section_headline_fields('field_section_service_headline_'),
      ],
      [
        'key'           => 'field_section_service_posts',
        'label'         => 'Послуги',
        'name'          => 'posts',
        'type'          => 'relationship',
        'post_type'     => ['service'],
        'filters'       => ['search'],
        'elements'      => ['featured_image'],
        'return_format' => 'object',
        'instructions'  => 'Якщо не обрано жодної послуги, автоматично всі додані послуги.',
        'wrapper'       => ['width' => '100'],
      ],
      [
        'key'        => 'field_section_service_settings',
        'label'      => '',
        'name'       => 'settings',
        'type'       => 'group',
        'layout'     => 'block',
        'sub_fields' => get_acf_section_settings_fields('field_section_service_settings_'),
      ],
    ],
  ];
}
