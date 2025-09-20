<?php

/**
 * =============================================================================
 * ACF Builder Entry Point
 * -----------------------------------------------------------------------------
 * This file serves as the central entry point for registering all ACF field
 * groups used in the theme. It loads modular definitions based on Atomic Design:
 * Atoms, Molecules, Organisms, and Templates.
 * =============================================================================
 */

// -----------------------------------------------------------------------------
// Load ACF Field Definitions (Atomic Design Structure)
// -----------------------------------------------------------------------------

require_once __DIR__ . '/acf-atoms.php';       // Basic building blocks (text, image, link, etc.)
require_once __DIR__ . '/acf-molecules.php';   // Small reusable groups of fields
require_once __DIR__ . '/acf-organisms.php';   // Larger composite structures
require_once __DIR__ . '/acf-templates.php';   // Flexible layouts and page templates
