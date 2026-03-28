<?php
/**
 * ACF Repeater Fields — separate field group that visually merges
 * with "Home Page Fields" using matching tab names
 * Old database fields remain untouched in group_home_page
 */

acf_add_local_field_group(array(
    'key' => 'group_home_repeaters',
    'title' => 'Add More Items',
    'fields' => array(
        // ── Stats tab ──
        array('key' => 'field_rep_tab_stats', 'label' => 'Stats Section', 'type' => 'tab'),
        array(
            'key' => 'field_stats_list', 'label' => 'Additional Stats', 'name' => 'stats_list',
            'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Stat',
            'sub_fields' => array(
                array('key' => 'field_st_number', 'label' => 'Number', 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_st_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text'),
            ),
        ),

        // ── Services tab ──
        array('key' => 'field_rep_tab_services', 'label' => 'Services', 'type' => 'tab'),
        array(
            'key' => 'field_services_list', 'label' => 'Additional Services', 'name' => 'services_list',
            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Service',
            'sub_fields' => array(
                array('key' => 'field_sl_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'wrapper' => array('width' => '50')),
                array('key' => 'field_sl_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'required' => 0, 'wrapper' => array('width' => '50')),
                array('key' => 'field_sl_description', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'wrapper' => array('width' => '100')),
                array('key' => 'field_sl_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url', 'wrapper' => array('width' => '50')),
                array('key' => 'field_sl_image', 'label' => 'Card Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'wrapper' => array('width' => '50')),
            ),
        ),

        // ── Projects tab ──
        array('key' => 'field_rep_tab_projects', 'label' => 'Projects', 'type' => 'tab'),
        array(
            'key' => 'field_projects_list', 'label' => 'Additional Projects', 'name' => 'projects_list',
            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Project',
            'sub_fields' => array(
                array('key' => 'field_pl_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'required' => 0, 'wrapper' => array('width' => '50')),
                array('key' => 'field_pl_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'wrapper' => array('width' => '50')),
                array('key' => 'field_pl_description', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'wrapper' => array('width' => '100')),
            ),
        ),

        // ── Why Choose Us tab ──
        array('key' => 'field_rep_tab_whychoose', 'label' => 'Why Choose Us', 'type' => 'tab'),
        array(
            'key' => 'field_whychoose_list', 'label' => 'Additional Features', 'name' => 'whychoose_list',
            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Feature',
            'sub_fields' => array(
                array('key' => 'field_wl_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'wrapper' => array('width' => '50')),
                array('key' => 'field_wl_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'required' => 0, 'wrapper' => array('width' => '50')),
                array('key' => 'field_wl_description', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 3, 'new_lines' => 'br', 'wrapper' => array('width' => '100')),
            ),
        ),

        // ── Products tab ──
        array('key' => 'field_rep_tab_products', 'label' => 'Products', 'type' => 'tab'),
        array(
            'key' => 'field_products_list', 'label' => 'Additional Products', 'name' => 'products_list',
            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Product',
            'sub_fields' => array(
                array('key' => 'field_prl_icon', 'label' => 'Tab Icon', 'name' => 'icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'wrapper' => array('width' => '50')),
                array('key' => 'field_prl_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'required' => 0, 'wrapper' => array('width' => '50')),
                array('key' => 'field_prl_description', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'wrapper' => array('width' => '100')),
                array('key' => 'field_prl_image', 'label' => 'Panel Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'wrapper' => array('width' => '50')),
                array('key' => 'field_prl_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url', 'wrapper' => array('width' => '50')),
            ),
        ),

        // ── Trusted By tab ──
        array('key' => 'field_rep_tab_logos', 'label' => 'Trusted By', 'type' => 'tab'),
        array(
            'key' => 'field_logos_list', 'label' => 'Additional Logos', 'name' => 'logos_list',
            'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Logo',
            'sub_fields' => array(
                array('key' => 'field_ll_image', 'label' => 'Logo', 'name' => 'logo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'),
            ),
        ),

        // ── Testimonials tab ──
        array('key' => 'field_rep_tab_testimonials', 'label' => 'Testimonials', 'type' => 'tab'),
        array(
            'key' => 'field_testimonials_list', 'label' => 'Additional Testimonials', 'name' => 'testimonials_list',
            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Testimonial',
            'sub_fields' => array(
                array('key' => 'field_tl_photo', 'label' => 'Photo', 'name' => 'photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'wrapper' => array('width' => '30')),
                array('key' => 'field_tl_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text', 'required' => 0, 'wrapper' => array('width' => '35')),
                array('key' => 'field_tl_role', 'label' => 'Role', 'name' => 'role', 'type' => 'text', 'wrapper' => array('width' => '35')),
                array('key' => 'field_tl_quote', 'label' => 'Quote', 'name' => 'quote', 'type' => 'textarea', 'rows' => 4, 'new_lines' => '', 'wrapper' => array('width' => '100')),
            ),
        ),

        // ── Industries tab ──
        array('key' => 'field_rep_tab_industries', 'label' => 'Industries', 'type' => 'tab'),
        array(
            'key' => 'field_industries_list', 'label' => 'Additional Industries', 'name' => 'industries_list',
            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Industry',
            'sub_fields' => array(
                array('key' => 'field_il_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'required' => 0, 'wrapper' => array('width' => '50')),
                array('key' => 'field_il_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'wrapper' => array('width' => '25')),
                array('key' => 'field_il_image', 'label' => 'Hover Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'wrapper' => array('width' => '25')),
            ),
        ),

        // ── FAQ tab ──
        array('key' => 'field_rep_tab_faq', 'label' => 'FAQ', 'type' => 'tab'),
        array(
            'key' => 'field_faqs_list', 'label' => 'Additional FAQs', 'name' => 'faqs_list',
            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add FAQ',
            'sub_fields' => array(
                array('key' => 'field_fl_question', 'label' => 'Question', 'name' => 'question', 'type' => 'text', 'required' => 0, 'wrapper' => array('width' => '100')),
                array('key' => 'field_fl_answer', 'label' => 'Answer', 'name' => 'answer', 'type' => 'textarea', 'rows' => 4, 'new_lines' => 'br', 'wrapper' => array('width' => '100')),
            ),
        ),
    ),
    'location' => array(array(array('param' => 'page_type', 'operator' => '==', 'value' => 'front_page'))),
    'menu_order' => 1,
    'position' => 'normal',
    'style' => 'default',
));
