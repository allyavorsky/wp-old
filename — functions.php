<?php

/* Functions ------------------------------------------------------------------------------------------------------------------------ */

/**
 * Enqueue scripts and styles.
 */

// reset
wp_enqueue_style('www-reset', 'https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css');

// style
wp_enqueue_style('www-style', get_theme_file_uri('/style.css'), array(), '1.0.0');
wp_enqueue_style('www-qodeum', get_theme_file_uri('/assets/css/qodeum.css'), array(), '1.0.0');

// scripts
wp_enqueue_script('www-template', get_theme_file_uri('/assets/js/template.js'), array(), '1.0.0', true);

// typed
wp_enqueue_script('www-typed', 'https://cdn.jsdelivr.net/npm/typed.js@2.0.12');

// jQuery
wp_enqueue_script('www-jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js');

// swiper
wp_enqueue_style('www-swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css');
wp_enqueue_script('www-swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js');

// fancybox
wp_enqueue_style('www-fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
wp_enqueue_script('www-fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js');

// iconify
wp_enqueue_script('www-iconify', 'https://cdnjs.cloudflare.com/ajax/libs/iconify/3.1.1/iconify.min.js');

// AOS
wp_enqueue_style('www-aos', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css');
wp_enqueue_script('www-aos', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js');

// google font
wp_enqueue_style('www-sans-serif', 'https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap');

/**
 * Transliteration.
 */
require get_template_directory() . '/inc/transliteration.php';

/**
 * ACF Qodeum.
 */
require_once get_template_directory() . '/inc/acf/acf.php';

/**
 * Enqueue admin styles.
 */
function qodeum_admin_styles()
{
  wp_enqueue_style('qodeum-admin-custom-css', get_theme_file_uri('/assets/css/admin-custom.css'));
}
add_action('admin_enqueue_scripts', 'qodeum_admin_styles');
