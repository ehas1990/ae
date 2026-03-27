<footer class="site-footer">
    <div class="footer-container">

        <!-- Company Info -->
        <div class="footer-col footer-about">
            <div class="footer-logo">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo-white.svg" alt="iTrobes" class="footer-logo-img">
            </div>
            <div class="footer-contact-info">
                <p><strong>UAE Office :</strong> Shams Business Center,<br>Sharjah Media City Free Zone,<br>Al Messaned, Sharjah.</p>
                <p><strong>Phone :</strong> <a href="tel:+971581623688">+971 58 162 3688</a></p>
                <p><strong>Email :</strong> <a href="mailto:sales@itrobes.ae">sales@itrobes.ae</a></p>
            </div>
        </div>

        <!-- Services (Column 2) -->
        <div class="footer-services-wrapper">
            <h3 class="footer-heading">Services</h3>
            <div class="footer-services-grid">
                <div class="footer-col footer-services">
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/branding')); ?>">Branding</a></li>
                        <li><a href="<?php echo esc_url(home_url('/website-development')); ?>">Website Development</a></li>
                        <li><a href="<?php echo esc_url(home_url('/e-commerce-websites')); ?>">E-commerce Websites</a></li>
                        <li><a href="<?php echo esc_url(home_url('/search-engine-marketing')); ?>">Search Engine Marketing</a></li>
                        <li><a href="<?php echo esc_url(home_url('/social-media-marketing')); ?>">Social Media Marketing (SMM)</a></li>
                        <li><a href="<?php echo esc_url(home_url('/pay-per-click')); ?>">Pay-Per-Click (PPC)</a></li>
                    </ul>
                </div>
                <div class="footer-col footer-services">
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/software-development')); ?>">Software Development</a></li>
                        <li><a href="<?php echo esc_url(home_url('/mobile-applications')); ?>">Mobile Applications</a></li>
                        <li><a href="<?php echo esc_url(home_url('/business-intelligence')); ?>">Business Intelligence (BI)</a></li>
                        <li><a href="<?php echo esc_url(home_url('/email-solutions')); ?>">Email Solutions</a></li>
                        <li><a href="<?php echo esc_url(home_url('/cloud-hosting')); ?>">Cloud Hosting</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="footer-bottom-container">
            <p>&copy; <?php echo date('Y'); ?> UAE iTrobes. All Rights Reserved.</p>
        </div>
    </div>

    <!-- Watermark -->
    <div class="footer-watermark" aria-hidden="true">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/footer-watermark.svg" alt="">
    </div>
</footer>

<div class="custom-cursor"><img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/mo.png')); ?>" alt=""></div>
<?php wp_footer(); ?>
</body>
</html>
