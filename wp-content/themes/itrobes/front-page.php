<?php get_header(); ?>

<?php
// Helper: get group field with fallback
function itrobes_field($name, $fallback = '') {
    $val = get_field($name);
    return $val ?: $fallback;
}

// Helper: get group items (for free ACF - no repeater)
function itrobes_group_items($prefix, $count) {
    $items = array();
    for ($i = 1; $i <= $count; $i++) {
        $item = get_field("{$prefix}_{$i}");
        if ($item && !empty(array_filter((array)$item))) {
            $items[] = $item;
        }
    }
    return $items;
}

$hero_bg = get_field('hero_background');
$hero_bg_url = $hero_bg ? $hero_bg['url'] : get_template_directory_uri() . '/assets/images/hero-bg.jpg';
$arrow_svg = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$arrow_sm = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
?>

<!-- Hero Section -->
<section class="hero-section" style="background-image: url('<?php echo esc_url($hero_bg_url); ?>');">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-left">
            <h1 class="hero-title"><?php echo itrobes_field('hero_title', 'Empowering UAE<br>Businesses with<br>Digital Brilliance.'); ?></h1>
            <div class="hero-buttons">
                <?php $b1 = get_field('hero_button_1'); $b2 = get_field('hero_button_2'); ?>
                <a href="<?php echo esc_url($b1['url'] ?? home_url('/contact-us')); ?>" class="btn-hero-primary"><?php echo esc_html($b1['label'] ?? 'Get a Quote'); ?></a>
                <a href="<?php echo esc_url($b2['url'] ?? home_url('/portfolio')); ?>" class="btn-hero-secondary"><?php echo esc_html($b2['label'] ?? 'See our Work'); ?></a>
            </div>
        </div>
        <div class="hero-right">
            <p class="hero-description"><?php echo itrobes_field('hero_description', 'At iTrobes.ae, we craft visually stunning, conversion-focused websites and drive growth with strategic digital marketing tailored for the UAE market.'); ?></p>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="stats-container">
        <?php
        $stats = itrobes_group_items('stat', 4);
        if ($stats) :
            foreach ($stats as $s) : ?>
                <div class="stats-item">
                    <span class="stats-number"><?php echo esc_html($s['number']); ?></span>
                    <span class="stats-label"><?php echo esc_html($s['label']); ?></span>
                </div>
            <?php endforeach;
        else : ?>
            <div class="stats-item"><span class="stats-number">50+</span><span class="stats-label">Awesome People</span></div>
            <div class="stats-item"><span class="stats-number">100+</span><span class="stats-label">Clients Worldwide</span></div>
            <div class="stats-item"><span class="stats-number">100+</span><span class="stats-label">Projects Deliver</span></div>
            <div class="stats-item"><span class="stats-number">8+</span><span class="stats-label">Years of Experiences</span></div>
        <?php endif; ?>
    </div>
    <div class="stats-description">
        <p><?php echo itrobes_field('stats_description', '<strong>iTrobes</strong> is a global web and digital marketing agency now expanding to serve the UAE. With a team of 100+ professionals and over 8 years of global experience, we\'ve helped 500+ businesses succeed online. Our UAE office is focused on offering region-specific solutions, blending global expertise with local market knowledge.'); ?></p>
    </div>
</section>

<!-- Our Services Section -->
<section class="services-section">
    <div class="services-container">
        <div class="services-header">
            <h2 class="section-title section-title--light"><?php echo itrobes_field('services_title', 'Our Services'); ?></h2>
            <div class="services-header__right">
                <p class="section-desc section-desc--light"><?php echo itrobes_field('services_description', 'We provide end-to-end IT solutions — from development and design to cloud, consulting, and security — empowering businesses with technology that drives growth and innovation.'); ?></p>
                <div class="services-nav">
                    <button class="services-nav__btn services-nav__prev" aria-label="Previous">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <button class="services-nav__btn services-nav__next" aria-label="Next">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="services-slider swiper">
        <div class="swiper-wrapper">
            <?php
            $services = itrobes_group_items('service', 6);
            if ($services) :
                foreach ($services as $svc) :
                    $icon = $svc['icon'] ?? null;
                    $img = $svc['image'] ?? null; ?>
                    <div class="swiper-slide">
                        <div class="service-card">
                            <div class="service-card__text">
                                <?php if ($icon) : ?><div class="service-card__icon"><img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>"></div><?php endif; ?>
                                <h3 class="service-card__title"><?php echo esc_html($svc['title'] ?? ''); ?></h3>
                                <p class="service-card__desc"><?php echo esc_html($svc['description'] ?? ''); ?></p>
                                <?php if (!empty($svc['link'])) : ?><a href="<?php echo esc_url($svc['link']); ?>" class="service-card__arrow" aria-label="Learn more"><?php echo $arrow_svg; ?></a><?php else : ?><span class="service-card__arrow"><?php echo $arrow_svg; ?></span><?php endif; ?>
                            </div>
                            <div class="service-card__image<?php echo !$img ? ' service-card__image--placeholder' : ''; ?>">
                                <?php if ($img) : ?><img src="<?php echo esc_url($img['url']); ?>" alt=""><?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            else :
                $defaults = array(
                    array('t' => 'Logo &<br>Brand Identity', 'd' => 'We create strong, memorable brand identities that connect with your audience and set you apart in the market.'),
                    array('t' => 'Website<br>Development', 'd' => 'Professional, secure, and scalable email services to keep your communication seamless and reliable.'),
                    array('t' => 'E-Commerce<br>Development', 'd' => 'Fast, secure, and scalable cloud hosting solutions to keep your business online 24/7.'),
                    array('t' => 'Digital<br>Marketing', 'd' => 'Smartly optimized ad campaigns that drive high-quality traffic and deliver measurable conversions.'),
                    array('t' => 'Social Media<br>Marketing', 'd' => 'Data-driven social media strategies that build brand awareness and engagement.'),
                    array('t' => 'SEO &<br>Content', 'd' => 'Search engine optimization and content marketing to drive organic growth.'),
                );
                foreach ($defaults as $svc) : ?>
                    <div class="swiper-slide">
                        <div class="service-card">
                            <div class="service-card__text">
                                <h3 class="service-card__title"><?php echo $svc['t']; ?></h3>
                                <p class="service-card__desc"><?php echo esc_html($svc['d']); ?></p>
                                <span class="service-card__arrow"><?php echo $arrow_svg; ?></span>
                            </div>
                            <div class="service-card__image service-card__image--placeholder"></div>
                        </div>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<!-- Our Projects Section -->
<section class="projects-section">
    <div class="projects-header">
        <h2 class="section-title"><?php echo itrobes_field('projects_title', 'Our Projects'); ?></h2>
        <p class="section-desc"><?php echo itrobes_field('projects_description', 'From intuitive design and seamless development to cloud integration, strategic consulting, and advanced security, our projects showcase end-to-end technology solutions'); ?></p>
    </div>
    <div class="projects-grid">
        <?php
        $projects = itrobes_group_items('project', 4);
        if ($projects) :
            foreach ($projects as $proj) :
                $img = $proj['image'] ?? null; ?>
                <div class="project-card">
                    <?php if ($img) : ?><div class="project-card__image"><img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt'] ?? ''); ?>"></div>
                    <?php else : ?><div class="project-card__image project-card__image--placeholder"></div><?php endif; ?>
                    <h3 class="project-card__title"><?php echo esc_html($proj['title'] ?? ''); ?></h3>
                    <p class="project-card__desc"><?php echo esc_html($proj['description'] ?? ''); ?></p>
                </div>
            <?php endforeach;
        else :
            foreach (array('Hogoco', 'Thunder 9', 'Lorozy', 'Jezben') as $p) : ?>
                <div class="project-card">
                    <div class="project-card__image project-card__image--placeholder"></div>
                    <h3 class="project-card__title"><?php echo esc_html($p); ?></h3>
                    <p class="project-card__desc">Branding a game-changer in sustainable marine luxury</p>
                </div>
            <?php endforeach;
        endif; ?>
    </div>
    <div class="projects-footer">
        <a href="<?php echo esc_url(itrobes_field('projects_link', home_url('/portfolio'))); ?>" class="link-arrow">View all Projects <?php echo $arrow_sm; ?></a>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="whychoose-section">
    <div class="whychoose-header">
        <div class="whychoose-header__left">
            <span class="whychoose-icon"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/sparkle-icon.svg" alt=""></span>
            <h2 class="section-title"><?php echo itrobes_field('whychoose_title', 'Why Choose Us'); ?></h2>
        </div>
        <p class="section-desc"><?php echo itrobes_field('whychoose_description', 'We provide end-to-end IT solutions — from development and design to cloud, consulting, and security — empowering businesses with technology that drives growth and innovation.'); ?></p>
    </div>
    <div class="whychoose-grid">
        <?php
        $features = itrobes_group_items('whychoose', 4);
        if ($features) :
            foreach ($features as $f) :
                $icon = $f['icon'] ?? null; ?>
                <div class="whychoose-card">
                    <?php if ($icon) : ?><div class="whychoose-card__icon"><img src="<?php echo esc_url($icon['url']); ?>" alt=""></div><?php endif; ?>
                    <h3 class="whychoose-card__title"><?php echo esc_html($f['title'] ?? ''); ?></h3>
                    <p class="whychoose-card__desc"><?php echo esc_html($f['description'] ?? ''); ?></p>
                </div>
            <?php endforeach;
        else :
            foreach (array(
                array('In-house Experts', 'Full-stack developers & certified marketers'),
                array('Transparent Pricing', 'No hidden charges'),
                array('Local Experience', 'UAE-specific campaign management'),
                array('Fast Turnaround', 'Full-stack developers & certified marketers'),
            ) as $f) : ?>
                <div class="whychoose-card">
                    <h3 class="whychoose-card__title"><?php echo esc_html($f[0]); ?></h3>
                    <p class="whychoose-card__desc"><?php echo esc_html($f[1]); ?></p>
                </div>
            <?php endforeach;
        endif; ?>
    </div>
</section>

<!-- Our Products Section -->
<section class="products-section">
    <div class="products-container">
        <h2 class="section-title section-title--light"><?php echo itrobes_field('products_title', 'Our Products'); ?></h2>
        <?php
        $products = itrobes_group_items('product', 8);
        $upload_url = home_url('/wp-content/uploads/2026/03/');
        $prod_defaults = array(
            array('title' => 'Project Management', 'icon' => $upload_url . 'icon-p1.svg'),
            array('title' => 'Inventory', 'icon' => $upload_url . 'icon-p2.svg'),
            array('title' => 'Estimation', 'icon' => $upload_url . 'icon-p3.svg'),
            array('title' => 'Procurement', 'icon' => $upload_url . 'icon-p4.svg'),
            array('title' => 'HRMS', 'icon' => $upload_url . 'icon-p5.svg'),
            array('title' => 'Finance & Accounts', 'icon' => $upload_url . 'icon-p6.svg'),
            array('title' => 'Stores', 'icon' => $upload_url . 'icon-p7.svg'),
            array('title' => 'Analytics', 'icon' => $upload_url . 'icon-p7.svg'),
        );
        $prod_descs = array(
            'Manage tasks, timelines, and resources with our intuitive project management platform.',
            'From tracking stock levels, managing purchases or monitoring sales to end-to-end inventory control, our platform helps you streamline operations and achieve the best outcomes.',
            'Create accurate project estimates with our powerful estimation tools.',
            'Streamline your procurement process from requisition to purchase order management.',
            'Complete human resource management system for attendance, payroll, and employee lifecycle.',
            'Manage your financial operations with comprehensive accounting and reporting tools.',
            'Multi-store management with centralized inventory and sales tracking.',
            'Data analytics and business reporting for informed decision-making.',
        );
        $has_products = !empty($products);
        $active_idx = $has_products ? 0 : 1;
        ?>
        <div class="products-layout">
            <div class="products-tabs">
                <?php if ($has_products) :
                    foreach ($products as $idx => $prod) :
                        $icon = $prod['icon'] ?? null; ?>
                        <button class="products-tab<?php echo $idx === 0 ? ' products-tab--active' : ''; ?>" data-tab="product-<?php echo $idx; ?>">
                            <?php if ($icon) : ?><span class="products-tab__icon"><img src="<?php echo esc_url($icon['url']); ?>" alt=""></span><?php endif; ?>
                            <span class="products-tab__title"><?php echo esc_html($prod['title'] ?? ''); ?></span>
                        </button>
                    <?php endforeach;
                else :
                    foreach ($prod_defaults as $idx => $tab) : ?>
                        <button class="products-tab<?php echo $idx === $active_idx ? ' products-tab--active' : ''; ?>" data-tab="product-<?php echo $idx; ?>">
                            <span class="products-tab__icon"><img src="<?php echo esc_url($tab['icon']); ?>" alt=""></span>
                            <span class="products-tab__title"><?php echo esc_html($tab['title']); ?></span>
                        </button>
                    <?php endforeach;
                endif; ?>
            </div>
            <div class="products-content">
                <?php if ($has_products) :
                    foreach ($products as $idx => $prod) :
                        $img = $prod['image'] ?? null; ?>
                        <div class="products-panel<?php echo $idx === 0 ? ' products-panel--active' : ''; ?>" id="product-<?php echo $idx; ?>">
                            <div class="products-panel__text">
                                <p class="products-panel__desc"><?php echo esc_html($prod['description'] ?? ''); ?></p>
                                <?php if (!empty($prod['link'])) : ?><a href="<?php echo esc_url($prod['link']); ?>" class="link-arrow link-arrow--light">Read more <?php echo $arrow_sm; ?></a><?php endif; ?>
                            </div>
                            <?php if ($img) : ?><img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt'] ?? ''); ?>" class="products-panel__img"><?php endif; ?>
                        </div>
                    <?php endforeach;
                else :
                    foreach ($prod_defaults as $idx => $tab) : ?>
                        <div class="products-panel<?php echo $idx === $active_idx ? ' products-panel--active' : ''; ?>" id="product-<?php echo $idx; ?>">
                            <div class="products-panel__text">
                                <p class="products-panel__desc"><?php echo esc_html($prod_descs[$idx]); ?></p>
                                <a href="#" class="link-arrow link-arrow--light">Read more <?php echo $arrow_sm; ?></a>
                            </div>
                        </div>
                    <?php endforeach;
                endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Trusted By Section -->
<section class="trusted-section">
    <div class="trusted-container">
        <p class="trusted-subtitle">&ldquo;Trusted by 500+ global clients across 10+ industries.&rdquo;</p>
        <div class="trusted-icon"><img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/Gift.svg')); ?>" alt="Trusted icon"></div>
        <h2 class="trusted-title"><?php echo itrobes_field('trusted_title', 'Trusted by Leaders in UAE & Beyond.'); ?></h2>
        <div class="trusted-logos">
            <?php
            $has_logos = false;
            for ($i = 1; $i <= 15; $i++) :
                $logo = get_field("client_logo_{$i}");
                if ($logo) : $has_logos = true; ?>
                    <div class="trusted-logo"><img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?? ''); ?>"></div>
                <?php endif;
            endfor;
            if (!$has_logos) :
                for ($i = 1; $i <= 15; $i++) : ?>
                    <div class="trusted-logo trusted-logo--placeholder"></div>
                <?php endfor;
            endif; ?>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="testimonials-container">
        <h2 class="section-title section-title--light"><?php echo itrobes_field('testimonials_title', 'Testimonials'); ?></h2>
        <div class="testimonials-slider">
            <?php
            $testimonials = itrobes_group_items('testimonial', 3);
            if ($testimonials) :
                foreach ($testimonials as $ti => $t) :
                    $photo = $t['photo'] ?? null; ?>
                    <div class="testimonial-card<?php echo $ti === 0 ? ' testimonial-card--active' : ''; ?>">
                        <div class="testimonial-card__image">
                            <?php if ($photo) : ?><img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($t['name'] ?? ''); ?>"><?php endif; ?>
                            <span class="testimonial-card__quote">&ldquo;</span>
                        </div>
                        <div class="testimonial-card__content">
                            <p class="testimonial-card__text"><?php echo esc_html($t['quote'] ?? ''); ?></p>
                            <h4 class="testimonial-card__name"><?php echo esc_html($t['name'] ?? ''); ?></h4>
                            <p class="testimonial-card__role"><?php echo esc_html($t['role'] ?? ''); ?></p>
                        </div>
                    </div>
                <?php endforeach;
            else : ?>
                <div class="testimonial-card testimonial-card--active">
                    <div class="testimonial-card__image">
                        <span class="testimonial-card__quote">&ldquo;</span>
                    </div>
                    <div class="testimonial-card__content">
                        <p class="testimonial-card__text">iTrobes is a global web and digital marketing agency now expanding to serve the UAE. With a team of 100+ professionals and over 8 years of global experience, we've helped 500+ businesses succeed online.</p>
                        <h4 class="testimonial-card__name">Michael</h4>
                        <p class="testimonial-card__role">Huda, Marketing | Manager, Dubai Clinic</p>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-card__image">
                        <span class="testimonial-card__quote">&ldquo;</span>
                    </div>
                    <div class="testimonial-card__content">
                        <p class="testimonial-card__text">Working with iTrobes has transformed our digital presence. Their team delivered a stunning website and effective marketing strategy that increased our leads by 300% in just 6 months.</p>
                        <h4 class="testimonial-card__name">Sarah Ahmed</h4>
                        <p class="testimonial-card__role">CEO | Al Noor Properties, Dubai</p>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-card__image">
                        <span class="testimonial-card__quote">&ldquo;</span>
                    </div>
                    <div class="testimonial-card__content">
                        <p class="testimonial-card__text">The team at iTrobes understood our vision perfectly. They built a custom e-commerce platform that handles thousands of daily transactions seamlessly. Highly recommended for any UAE business.</p>
                        <h4 class="testimonial-card__name">Ahmed Al Rashid</h4>
                        <p class="testimonial-card__role">Founder | Gulf Tech Solutions, Abu Dhabi</p>
                    </div>
                </div>
            <?php endif; ?>
            <div class="testimonials-nav">
                <button class="testimonials-nav__btn testimonials-nav__prev" aria-label="Previous"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                <button class="testimonials-nav__btn testimonials-nav__next" aria-label="Next"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
            </div>
        </div>
    </div>
</section>

<!-- Industries We Serve Section -->
<section class="industries-section">
    <div class="industries-header">
        <h2 class="section-title"><?php echo itrobes_field('industries_title', 'Industries We Serve'); ?></h2>
        <div class="industries-header__right">
            <p class="section-desc"><?php echo itrobes_field('industries_description', 'We provide end-to-end IT solutions from development and design to cloud, consulting, and security empowering businesses with technology that drives growth and innovation.'); ?></p>
            <div class="industries-nav">
                <button class="industries-nav__btn industries-nav__prev" aria-label="Previous">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <button class="industries-nav__btn industries-nav__next" aria-label="Next">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
        </div>
    </div>
    <div class="industries-slider swiper">
        <div class="swiper-wrapper">
            <?php
            $industries = itrobes_group_items('industry', 5);
            if ($industries) :
                foreach ($industries as $idx => $ind) :
                    $icon = $ind['icon'] ?? null;
                    $hover_img = $ind['image'] ?? null; ?>
                    <div class="swiper-slide">
                        <div class="industry-card">
                            <div class="industry-card__overlay" <?php if ($hover_img) : ?>style="background-image: url('<?php echo esc_url($hover_img['url']); ?>')"<?php endif; ?>></div>
                            <div class="industry-card__info">
                                <span class="industry-card__num"><?php echo str_pad($idx + 1, 2, '0', STR_PAD_LEFT); ?></span>
                                <h3 class="industry-card__title"><?php echo str_replace('&amp;', '&amp;<br>', esc_html($ind['title'] ?? '')); ?></h3>
                            </div>
                            <?php if ($icon) : ?><div class="industry-card__icon"><img src="<?php echo esc_url($icon['url']); ?>" alt=""></div><?php endif; ?>
                        </div>
                    </div>
                <?php endforeach;
            else :
                foreach (array('Real Estate &<br>Construction', 'Healthcare &<br>Clinics', 'E-Commerce &<br>Retail', 'Hospitality &<br>Tourism', 'Education &<br>EdTech') as $idx => $ind) : ?>
                    <div class="swiper-slide">
                        <div class="industry-card">
                            <div class="industry-card__overlay"></div>
                            <div class="industry-card__info">
                                <span class="industry-card__num"><?php echo str_pad($idx + 1, 2, '0', STR_PAD_LEFT); ?></span>
                                <h3 class="industry-card__title"><?php echo wp_kses_post($ind); ?></h3>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="faq-container">
        <div class="faq-left">
            <h2 class="section-title section-title--light"><?php echo itrobes_field('faq_title', 'Frequently<br>Asked Questions ?'); ?></h2>
            <div class="faq-illustration">
                <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/faq-image.svg')); ?>" alt="FAQ Illustration">
            </div>
        </div>
        <div class="faq-right">
            <?php
            $faqs = itrobes_group_items('faq', 5);
            if ($faqs) :
                foreach ($faqs as $fi => $faq) : ?>
                    <div class="faq-item<?php echo $fi === 0 ? ' faq-item--active' : ''; ?>">
                        <button class="faq-item__question">
                            <span><?php echo esc_html($faq['question'] ?? ''); ?></span>
                            <svg class="faq-item__chevron" width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>
                        <div class="faq-item__answer"><p><?php echo esc_html($faq['answer'] ?? ''); ?></p></div>
                    </div>
                <?php endforeach;
            else :
                $faq_defaults = array(
                    array('Do you offer bilingual websites?', 'Yes, we design and develop bilingual websites with seamless language integration, ensuring accessibility, cultural relevance, and user-friendly navigation.'),
                    array('Do you offer UAE-specific marketing?', 'Coming soon.'),
                    array('What are your pricing models?', 'Coming soon.'),
                    array('Do you offer UAE-specific marketing?', 'Coming soon.'),
                    array('Can you redesign or upgrade my existing website?', 'Coming soon.'),
                );
                foreach ($faq_defaults as $fi => $faq) : ?>
                    <div class="faq-item<?php echo $fi === 0 ? ' faq-item--active' : ''; ?>">
                        <button class="faq-item__question">
                            <span><?php echo esc_html($faq[0]); ?></span>
                            <svg class="faq-item__chevron" width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>
                        <div class="faq-item__answer"><p><?php echo esc_html($faq[1]); ?></p></div>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<!-- Latest Insights Section -->
<section class="insights-section">
    <div class="insights-container">
        <h2 class="section-title"><?php echo itrobes_field('insights_title', 'Latest Insights'); ?></h2>
        <div class="insights-grid">
            <?php
            $blog_query = new WP_Query(array('posts_per_page' => 4, 'post_status' => 'publish'));
            if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="insight-card">
                    <div class="insight-card__image">
                        <?php if (has_post_thumbnail()) :
                            the_post_thumbnail('medium_large');
                        else :
                            $fallback_img = get_template_directory_uri() . '/assets/images/blog-default.png';
                        ?>
                            <img src="<?php echo esc_url($fallback_img); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="insight-card__info">
                        <span class="insight-card__date"><?php echo get_the_date('M j Y'); ?></span>
                        <h3 class="insight-card__title"><?php the_title(); ?></h3>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata(); else :
                foreach (array(
                    array('May 8 2025', 'Top Web Design Trends in UAE – 2025 Edition'),
                    array('May 8 2025', 'Why SEO is Essential for Dubai Startups'),
                    array('May 8 2025', 'Digital Marketing Strategies That Work in the UAE'),
                    array('May 8 2025', 'Social Media Growth Hacks for UAE Businesses in 2025'),
                ) as $blog) : ?>
                    <div class="insight-card">
                        <div class="insight-card__image insight-card__image--placeholder"></div>
                        <div class="insight-card__info">
                            <span class="insight-card__date"><?php echo esc_html($blog[0]); ?></span>
                            <h3 class="insight-card__title"><?php echo esc_html($blog[1]); ?></h3>
                        </div>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
        <div class="insights-footer">
            <a href="<?php echo esc_url(itrobes_field('insights_link', home_url('/blogs'))); ?>" class="link-arrow">View all blogs <?php echo $arrow_sm; ?></a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section" style="background-image: url('http://localhost/ae.itrobes/wp-content/uploads/2026/03/background-scale.png');">
    <div class="cta-overlay"></div>
    <div class="cta-content">
        <h2 class="cta-title"><?php echo itrobes_field('cta_title', 'Ready to Scale<br>Your Business in the UAE?'); ?></h2>
        <p class="cta-desc"><?php echo itrobes_field('cta_description', 'Together, let\'s build your next success story with confidence, creativity, and unwavering dedication to success.'); ?></p>
        <div class="cta-buttons">
            <?php $cb1 = get_field('cta_button_1'); $cb2 = get_field('cta_button_2'); ?>
            <a href="<?php echo esc_url($cb1['url'] ?? home_url('/contact-us')); ?>" class="btn-hero-primary"><?php echo esc_html($cb1['label'] ?? 'Start a Project'); ?></a>
            <a href="<?php echo esc_url($cb2['url'] ?? home_url('/contact-us')); ?>" class="btn-hero-secondary"><?php echo esc_html($cb2['label'] ?? 'Get Free Consultation'); ?></a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
