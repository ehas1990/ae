<?php

// Enqueue styles and scripts
function itrobes_enqueue_assets() {
    // Swiper.js
    wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0');
    wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0', true);

    // AOS (Animate On Scroll)
    wp_enqueue_style('aos', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css', array(), '2.3.4');
    wp_enqueue_script('aos', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js', array(), '2.3.4', true);

    wp_enqueue_style('itrobes-style', get_stylesheet_uri(), array('swiper', 'aos'), '1.5');
    wp_enqueue_script('itrobes-main', get_template_directory_uri() . '/assets/js/main.js', array('swiper', 'aos'), '1.5', true);
}
add_action('wp_enqueue_scripts', 'itrobes_enqueue_assets');

// Register navigation menu
function itrobes_register_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'itrobes'),
    ));
}
add_action('init', 'itrobes_register_menus');

// Theme support
function itrobes_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'itrobes_theme_setup');

// ACF is required - no fallback needed since plugin is installed

// Register ACF field groups (loads only when ACF is active)
add_action('acf/init', function () {
    require_once get_template_directory() . '/inc/acf-fields.php';
});

// Ensure ACF fields visible in Gutenberg editor
add_filter('acf/settings/show_in_rest', '__return_true');
add_filter('acf/settings/remove_wp_meta_box', '__return_false');

// Disable autosave to prevent "newer autosave" message
add_action('admin_enqueue_scripts', function () {
    wp_deregister_script('autosave');
});

// Enable SVG upload support
add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
});

// Fix SVG preview in Media Library
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext === 'svg') {
        $data['type'] = 'image/svg+xml';
        $data['ext'] = 'svg';
    }
    return $data;
}, 10, 4);

// Display SVG thumbnails in Media Library and ACF
add_action('admin_head', function () {
    echo '<style>
        .attachment-266x266, .thumbnail img[src$=".svg"],
        .acf-image-uploader img[src$=".svg"] {
            width: 100% !important;
            height: auto !important;
        }
    </style>';
});

// Fallback menu if no menu is assigned
function itrobes_fallback_menu() {
    $menu_items = array(
        'Home'       => home_url('/'),
        'About Us'   => home_url('/about-us'),
        'Services'   => home_url('/services'),
        'Products'   => home_url('/products'),
        'Blogs'      => home_url('/blogs'),
        'Contact Us' => home_url('/contact-us'),
    );

    echo '<ul>';
    foreach ($menu_items as $label => $url) {
        $current = (untrailingslashit($url) === untrailingslashit(home_url($_SERVER['REQUEST_URI']))) ? ' class="current-menu-item"' : '';
        echo '<li' . $current . '><a href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>';
    }
    echo '</ul>';
}
