<?php

/**
 * =============================================================================
 * ACF Molecules — Reusable Field Combinations Based on Atoms
 * -----------------------------------------------------------------------------
 * This file defines grouped ACF layouts composed of atomic components.
 * These are used primarily inside column-based Flexible Content sections.
 * =============================================================================
 */

require_once __DIR__ . '/acf-atoms.php'; // Load all atomic layout definitions

/**
 * -----------------------------------------------------------------------------
 * Column Components (Molecules)
 * -----------------------------------------------------------------------------
 * Returns an array of reusable layout blocks for use in flexible columns.
 * Each layout is a pre-configured grouping of atomic components.
 * -----------------------------------------------------------------------------
 * @return array
 */
function get_acf_column_components(): array
{
  return [
    get_acf_column_layout_accordion(),   // Accordion
    get_acf_column_layout_gallery(),     // Gallery
    get_acf_column_layout_content(),     // Formatted Content
    get_acf_column_layout_modal(),       // Modal Window
    get_acf_column_layout_button(),      // Button
    get_acf_column_layout_mediafile(),   // Mediafile
    get_acf_column_layout_card(),        // Card
  ];
}
