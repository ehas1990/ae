<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600;700&family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-container">

        <!-- Logo -->
        <div class="site-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.svg" alt="iTrobes" class="logo-img">
            </a>
        </div>

        <!-- Navigation -->
        <nav class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => 'itrobes_fallback_menu',
            ));
            ?>
        </nav>

        <!-- CTA Button -->
        <div class="header-cta">
            <a href="<?php echo esc_url(home_url('/contact-us')); ?>" class="btn-start-project">Start Your Project</a>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="menu-toggle" aria-label="Toggle Menu" onclick="this.classList.toggle('active'); document.querySelector('.mobile-nav').classList.toggle('active')">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Mobile Navigation -->
        <div class="mobile-nav">
            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'fallback_cb'    => 'itrobes_fallback_menu',
                ));
                ?>
            </nav>
            <div class="header-cta">
                <a href="<?php echo esc_url(home_url('/contact-us')); ?>" class="btn-start-project">Start Your Project</a>
            </div>
        </div>

    </div>
</header>
