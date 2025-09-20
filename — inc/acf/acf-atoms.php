<?php

/**
 * =============================================================================
 * ACF Atoms — Elementary UI Components
 * -----------------------------------------------------------------------------
 * This file defines reusable atomic ACF field structures, such as simple text,
 * image, button, map, video, and other layout primitives.
 * These are the smallest composable units used to build more complex Molecules
 * and Organisms within the theme's ACF structure.
 * =============================================================================
 */

/**
 * -----------------------------------------------------------------------------
 * Atom: Settings
 * -----------------------------------------------------------------------------
 * Provides layout customization fields such as custom CSS class, section ID,
 * display type, and optional visual separators (top/bottom lines).
 * Used as utility configuration attached to most sections.
 * -----------------------------------------------------------------------------
 */
function get_acf_section_settings_fields(string $prefix = ''): array
{
  return [
    [
      'key'   => $prefix . 'accordion',
      'label' => 'Settings',
      'name'  => '',
      'type'  => 'accordion',
    ],
    [
      'key'    => $prefix . 'section_id',
      'label'  => 'Section ID',
      'name'   => 'section_id',
      'type'   => 'text',
      'wrapper' => [
        'width' => '25',
      ],
    ],
    [
      'key'    => $prefix . 'style',
      'label'  => 'Custom CSS',
      'name'   => 'style',
      'type'   => 'text',
      'wrapper' => [
        'width' => '25',
      ],
    ],
    [
      'key'     => $prefix . 'separator',
      'label'   => 'Separator',
      'name'    => 'separator',
      'type'    => 'checkbox',
      'choices' => [
        'top'    => 'Top',
        'bottom' => 'Bottom',
      ],
      'layout'  => 'horizontal',
      'wrapper' => [
        'width' => '25',
      ],
    ],
    [
      'key'     => $prefix . 'display',
      'label'   => 'Display Type',
      'name'    => 'display',
      'type'    => 'radio',
      'choices' => [
        'default' => 'Default',
        'slider'  => 'Slider',
      ],
      'layout'  => 'horizontal',
      'wrapper' => [
        'width' => '25',
      ],
    ],
  ];
}

/**
 * -----------------------------------------------------------------------------
 * Atom: Media File Sub Fields
 * -----------------------------------------------------------------------------
 * Reusable sub-fields group for embedding media (image / video / oEmbed) with
 * settings like size and containment. Intended for use inside other layouts.
 * -----------------------------------------------------------------------------
 *
 * @param string $prefix Field key prefix
 * @return array
 */
function get_acf_mediafile_sub_fields(string $prefix = ''): array
{
  return [
    [
      'key'        => $prefix . 'group',
      'name'       => 'media',
      'type'       => 'group',
      'label'      => '',
      'layout'     => 'block',
      'wrapper'    => ['width' => '100'],
      'sub_fields' => [
        [
          'key'           => $prefix . 'type',
          'name'          => 'type',
          'type'          => 'radio',
          'label'         => 'Media Type',
          'choices'       => [
            'image'       => 'Image',
            'video_file'  => 'Video File',
            'video_embed' => 'YouTube / Vimeo',
          ],
          'default_value' => 'image',
          'layout'        => 'horizontal',
          'wrapper'       => ['width' => '100'],
        ],
        [
          'key'               => $prefix . 'embed',
          'name'              => 'embed',
          'type'              => 'oembed',
          'label'             => 'Embed Video',
          'placeholder'       => 'Paste YouTube or Vimeo link here',
          'wrapper'           => ['width' => '100'],
          'conditional_logic' => [
            [['field' => $prefix . 'type', 'operator' => '==', 'value' => 'video_embed']],
          ],
        ],
        [
          'key'               => $prefix . 'image',
          'name'              => 'image',
          'type'              => 'image',
          'label'             => 'Image File',
          'return_format'     => 'array',
          'preview_size'      => 'full',
          'library'           => 'all',
          'wrapper'           => ['width' => '100'],
          'conditional_logic' => [
            [['field' => $prefix . 'type', 'operator' => '==', 'value' => 'image']],
          ],
        ],
        [
          'key'               => $prefix . 'video',
          'name'              => 'video',
          'type'              => 'file',
          'label'             => 'Video File',
          'return_format'     => 'array',
          'library'           => 'all',
          'mime_types'        => 'mp4,webm',
          'wrapper'           => ['width' => '100'],
          'conditional_logic' => [
            [['field' => $prefix . 'type', 'operator' => '==', 'value' => 'video_file']],
          ],
        ],
        [
          'key'           => $prefix . 'settings_accordion',
          'name'          => '',
          'type'          => 'accordion',
          'label'         => 'Settings',
          'open'          => false,
          'multi_expand'  => false,
          'wrapper'       => ['width' => '100'],
        ],
        [
          'key'           => $prefix . 'contain',
          'name'          => 'contain',
          'type'          => 'true_false',
          'label'         => 'Contain',
          'default_value' => false,
          'ui'            => true,
          'wrapper'       => ['width' => '30'],
        ],
        [
          'key'           => $prefix . 'size',
          'name'          => 'size',
          'type'          => 'select',
          'label'         => 'Size',
          'choices'       => [
            'original' => 'Original Size',
            'xs'       => 'Extra Small',
            'sm'       => 'Small',
            'md'       => 'Medium',
            'lg'       => 'Large',
          ],
          'default_value' => 'md',
          'allow_null'    => false,
          'multiple'      => false,
          'ui'            => false,
          'ajax'          => false,
          'wrapper'       => ['width' => '70'],
        ],
      ],
    ],
  ];
}

/**
 * -----------------------------------------------------------------------------
 * Component: Headline
 * -----------------------------------------------------------------------------
 * Outputs a basic heading group with label, title, and description.
 * Includes alignment control directly in the field group.
 * -----------------------------------------------------------------------------
 */
function get_acf_section_headline_fields(string $prefix = ''): array
{
  return [
    [
      'key'   => $prefix . 'accordion',
      'label' => 'Headline',
      'name'  => '',
      'type'  => 'accordion',
    ],
    [
      'key'   => $prefix . 'label',
      'label' => 'Subheadline',
      'name'  => 'label',
      'type'  => 'text',
    ],
    [
      'key'       => $prefix . 'title',
      'label'     => 'Title',
      'name'      => 'title',
      'type'      => 'textarea',
      'new_lines' => 'br',
    ],
    [
      'key'          => $prefix . 'textarea',
      'label'        => 'Text Area',
      'name'         => 'textarea',
      'type'         => 'wysiwyg',
      'tabs'         => 'visual',
      'toolbar'      => 'full',
      'media_upload' => false,
    ],
    [
      'key'     => $prefix . 'alignment',
      'label'   => 'Headline Alignment',
      'name'    => 'alignment',
      'type'    => 'radio',
      'choices' => [
        'start'   => 'Start',
        'center'  => 'Center',
        'end'     => 'End',
      ],
      'layout'        => 'horizontal',
      'default_value' => 'left',
    ],
  ];
}

/**
 * -----------------------------------------------------------------------------
 * Component: Content
 * -----------------------------------------------------------------------------
 * Provides a simple WYSIWYG content block with full editor capabilities.
 * Used as a basic content region within columns or standalone areas.
 * -----------------------------------------------------------------------------
 */
function get_acf_column_layout_content(): array
{
  return [
    'key'     => 'layout_column_content',
    'name'    => 'column_content',
    'label'   => 'Content',
    'display' => 'block',

    'sub_fields' => [
      [
        'key'          => 'field_column_content',
        'name'         => 'content',
        'type'         => 'wysiwyg',
        'label'        => '',
        'tabs'         => 'visual',
        'toolbar'      => 'full',
        'media_upload' => true,
        'delay'        => false,
        'wrapper'      => [
          'width' => '100',
        ],
      ],
    ],
  ];
}

/**
 * -----------------------------------------------------------------------------
 * Component: Accordion
 * -----------------------------------------------------------------------------
 * Allows for collapsible item sections within a column layout.
 * Useful for FAQ blocks or structured expandable content.
 * -----------------------------------------------------------------------------
 */

function get_acf_column_layout_accordion(): array
{
  return [
    'key'     => 'layout_column_accordion',
    'name'    => 'column_accordion',
    'label'   => 'Accordion',
    'display' => 'block',

    'sub_fields' => [
      [
        'key'        => 'field_column_accordion_title',
        'name'       => 'title',
        'type'       => 'text',
        'label'      => 'Title',
        'wrapper'    => [
          'width' => '100',
        ],
      ],
      [
        'key'          => 'field_column_accordion_content',
        'name'         => 'content',
        'type'         => 'wysiwyg',
        'label'        => 'Content',
        'tabs'         => 'visual',
        'toolbar'      => 'basic',
        'media_upload' => false,
        'wrapper'      => [
          'width' => '100',
        ],
      ],
    ],
  ];
}

/**
 * -----------------------------------------------------------------------------
 * Component: Button (Text-based)
 * -----------------------------------------------------------------------------
 * A simple button with manual text, URL and data attribute fields.
 * Useful for granular control in layouts and CTA blocks.
 * -----------------------------------------------------------------------------
 */
function get_acf_column_layout_button(): array
{
  return [
    'key'     => 'layout_column_button',
    'name'    => 'column_button',
    'label'   => 'Button',
    'display' => 'block',

    'sub_fields' => [
      [
        'key'         => 'field_column_button_text',
        'name'        => 'text',
        'type'        => 'text',
        'placeholder' => 'Button Text',
        'wrapper'     => ['width' => '100'],
      ],
      [
        'key'         => 'field_column_button_url',
        'name'        => 'url',
        'type'        => 'text',
        'placeholder' => 'https://example.com',
        'wrapper'     => ['width' => '50'],
      ],
      [
        'key'         => 'field_column_button_data_attr',
        'name'        => 'data_attr',
        'type'        => 'text',
        'placeholder' => 'data-modal="id"',
        'wrapper'     => ['width' => '50'],
      ],
    ],
  ];
}


/**
 * -----------------------------------------------------------------------------
 * Component: Gallery
 * -----------------------------------------------------------------------------
 * A visual image gallery field with multiple images and optional display mode.
 * Can be rendered as a static gallery or an interactive slider.
 * -----------------------------------------------------------------------------
 */
function get_acf_column_layout_gallery(): array
{
  return [
    'key'     => 'layout_column_gallery',
    'name'    => 'column_gallery',
    'label'   => 'Gallery',
    'display' => 'block',

    'sub_fields' => [
      [
        'key'           => 'field_column_gallery_images',
        'name'          => 'gallery',
        'type'          => 'gallery',
        'label'         => '',
        'return_format' => 'array',
        'preview_size'  => 'thumbnail',
        'insert'        => 'append',
        'library'       => 'all',
        'wrapper'       => ['width' => '100'],
      ],
      [
        'key'        => 'field_column_gallery_settings',
        'name'       => 'settings',
        'label'      => '',
        'type'       => 'group',
        'layout'     => 'block',
        'wrapper'    => ['width' => '100'],
        'sub_fields' => [
          [
            'key'   => 'field_column_gallery_settings_accordion',
            'label' => 'Gallery Settings',
            'name'  => '',
            'type'  => 'accordion',
          ],
          [
            'key'     => 'field_column_gallery_display',
            'name'    => 'display',
            'type'    => 'radio',
            'label'   => 'Display Type',
            'layout'  => 'horizontal',
            'choices' => [
              'default' => 'Default',
              'slider'  => 'Slider',
            ],
            'default_value' => 'default',
            'wrapper'       => ['width' => '100'],
          ],
        ],
      ],
    ],
  ];
}

/**
 * -----------------------------------------------------------------------------
 * Component: Modal
 * -----------------------------------------------------------------------------
 * Creates a modal popup window with a trigger button and WYSIWYG content.
 * Ideal for embedded forms, detailed descriptions, or multimedia content.
 * -----------------------------------------------------------------------------
 */
function get_acf_column_layout_modal(): array
{
  return [
    'key'     => 'layout_column_modal',
    'name'    => 'column_modal',
    'label'   => 'Modal Window',
    'display' => 'block',

    'sub_fields' => [
      [
        'key'    => 'field_column_modal_button',
        'name'   => 'button',
        'type'   => 'group',
        'label'  => '',
        'layout' => 'block',
        'wrapper' => ['width' => '100'],

        'sub_fields' => [
          [
            'key'     => 'field_column_modal_button_accordion',
            'name'    => '',
            'type'    => 'accordion',
            'label'   => 'Button',
            'wrapper' => ['width' => '100'],
          ],
          [
            'key'     => 'field_column_modal_button_title',
            'name'    => 'title',
            'type'    => 'text',
            'label'   => '',
            'placeholder' => 'Enter button text',
            'wrapper' => ['width' => '100'],
          ],
        ],
      ],
      [
        'key'          => 'field_column_modal_content',
        'name'         => 'content',
        'type'         => 'wysiwyg',
        'label'        => '',
        'tabs'         => 'visual',
        'toolbar'      => 'full',
        'media_upload' => false,
        'wrapper'      => ['width' => '100'],
      ],
    ],
  ];
}

/**
 * -----------------------------------------------------------------------------
 * Component: Card
 * -----------------------------------------------------------------------------
 * A content card component including media (image/video), title, text, and button.
 * Built using embedded Media File atom to support full flexibility.
 * -----------------------------------------------------------------------------
 */
function get_acf_column_layout_card(): array
{
  return [
    'key'     => 'layout_column_card',
    'name'    => 'column_card',
    'label'   => 'Card',
    'display' => 'block',

    'sub_fields' => array_merge(
      get_acf_mediafile_sub_fields('field_column_card_mediafile_'),
      [
        [
          'key'         => 'field_column_card_title',
          'name'        => 'title',
          'type'        => 'text',
          'label'       => 'Title',
          'placeholder' => 'Enter title',
          'wrapper'     => ['width' => '100'],
        ],
        [
          'key'          => 'field_column_card_text',
          'name'         => 'text',
          'type'         => 'wysiwyg',
          'label'        => '',
          'tabs'         => 'visual',
          'toolbar'      => 'basic',
          'media_upload' => false,
          'wrapper'      => ['width' => '100'],
        ],
        [
          'key'     => 'field_column_card_button',
          'name'    => 'button',
          'type'    => 'link',
          'label'   => 'Button',
          'wrapper' => ['width' => '100'],
        ],
      ]
    ),
  ];
}


/**
 * -----------------------------------------------------------------------------
 * Component: Media File
 * -----------------------------------------------------------------------------
 * Flexible media component that supports image, uploaded video file, or embedded video.
 * Includes built-in display settings like contain and size.
 * -----------------------------------------------------------------------------
 */
function get_acf_column_layout_mediafile(): array
{
  return [
    'key'     => 'layout_column_mediafile',
    'name'    => 'column_mediafile',
    'label'   => 'Media File',
    'display' => 'block',

    'sub_fields' => get_acf_mediafile_sub_fields('field_column_mediafile_'),
  ];
}
