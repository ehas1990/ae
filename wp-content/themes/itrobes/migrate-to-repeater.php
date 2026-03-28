<?php
/**
 * One-time migration: Old ACF group fields → Repeater fields
 *
 * Usage: Visit yoursite.com/wp-admin/ then run via:
 *   WP Admin > Tools > or simply visit:
 *   yoursite.com/?itrobes_migrate=1&key=migrate2026
 *
 * This script:
 * - Reads old group fields (service_1, service_2, etc.)
 * - Writes them into new repeater fields (services_list, etc.)
 * - Does NOT delete old data
 * - Skips migration if repeater already has data
 * - Safe to run multiple times
 */

add_action('init', function () {
    if (!isset($_GET['itrobes_migrate']) || $_GET['key'] !== 'migrate2026') return;
    if (!current_user_can('manage_options')) wp_die('Unauthorized');

    $page_id = get_option('page_on_front');
    if (!$page_id) wp_die('No front page set.');

    $migrated = array();
    $skipped = array();

    // Migration map: repeater_name => [old_prefix, old_count, field_key, sub_field_keys_map]
    $migrations = array(
        'stats_list' => array(
            'prefix' => 'stat', 'count' => 4,
            'repeater_key' => 'field_stats_list',
            'sub_keys' => array('number' => 'field_stat_number', 'label' => 'field_stat_label'),
        ),
        'services_list' => array(
            'prefix' => 'service', 'count' => 6,
            'repeater_key' => 'field_services_list',
            'sub_keys' => array('icon' => 'field_sl_icon', 'title' => 'field_sl_title', 'description' => 'field_sl_description', 'link' => 'field_sl_link', 'image' => 'field_sl_image'),
        ),
        'projects_list' => array(
            'prefix' => 'project', 'count' => 4,
            'repeater_key' => 'field_projects_list',
            'sub_keys' => array('title' => 'field_pl_title', 'description' => 'field_pl_description', 'image' => 'field_pl_image'),
        ),
        'whychoose_list' => array(
            'prefix' => 'whychoose', 'count' => 4,
            'repeater_key' => 'field_whychoose_list',
            'sub_keys' => array('icon' => 'field_wl_icon', 'title' => 'field_wl_title', 'description' => 'field_wl_description'),
        ),
        'products_list' => array(
            'prefix' => 'product', 'count' => 8,
            'repeater_key' => 'field_products_list',
            'sub_keys' => array('icon' => 'field_prl_icon', 'title' => 'field_prl_title', 'description' => 'field_prl_description', 'image' => 'field_prl_image', 'link' => 'field_prl_link'),
        ),
        'testimonials_list' => array(
            'prefix' => 'testimonial', 'count' => 3,
            'repeater_key' => 'field_testimonials_list',
            'sub_keys' => array('photo' => 'field_tl_photo', 'name' => 'field_tl_name', 'role' => 'field_tl_role', 'quote' => 'field_tl_quote'),
        ),
        'industries_list' => array(
            'prefix' => 'industry', 'count' => 5,
            'repeater_key' => 'field_industries_list',
            'sub_keys' => array('title' => 'field_il_title', 'icon' => 'field_il_icon', 'hover_image' => 'field_il_hover'),
        ),
        'faqs_list' => array(
            'prefix' => 'faq', 'count' => 5,
            'repeater_key' => 'field_faqs_list',
            'sub_keys' => array('question' => 'field_fl_question', 'answer' => 'field_fl_answer'),
        ),
    );

    foreach ($migrations as $repeater_name => $config) {
        // Skip if repeater already has data
        $existing = get_post_meta($page_id, $repeater_name, true);
        if ($existing && intval($existing) > 0) {
            $skipped[] = "{$repeater_name} (already has {$existing} rows)";
            continue;
        }

        // Collect old group data
        $old_items = array();
        for ($i = 1; $i <= $config['count']; $i++) {
            $item = get_field("{$config['prefix']}_{$i}", $page_id);
            if ($item && !empty(array_filter((array)$item))) {
                $old_items[] = $item;
            }
        }

        if (empty($old_items)) {
            $skipped[] = "{$repeater_name} (no old data found)";
            continue;
        }

        // Write repeater row count
        $row_count = count($old_items);
        update_post_meta($page_id, $repeater_name, $row_count);
        update_post_meta($page_id, "_{$repeater_name}", $config['repeater_key']);

        // Write each row
        foreach ($old_items as $idx => $item) {
            foreach ($config['sub_keys'] as $sub_name => $sub_key) {
                $meta_key = "{$repeater_name}_{$idx}_{$sub_name}";
                $value = $item[$sub_name] ?? '';

                // For image fields, store attachment ID (not array)
                if (is_array($value) && isset($value['ID'])) {
                    $value = $value['ID'];
                }

                update_post_meta($page_id, $meta_key, $value);
                update_post_meta($page_id, "_{$meta_key}", $sub_key);
            }
        }

        $migrated[] = "{$repeater_name} ({$row_count} rows)";
    }

    // Migrate logos separately (different structure)
    $logos_existing = get_post_meta($page_id, 'logos_list', true);
    if (!$logos_existing || intval($logos_existing) === 0) {
        $logo_items = array();
        for ($i = 1; $i <= 15; $i++) {
            $logo = get_field("client_logo_{$i}", $page_id);
            if ($logo) $logo_items[] = $logo;
        }
        if (!empty($logo_items)) {
            $row_count = count($logo_items);
            update_post_meta($page_id, 'logos_list', $row_count);
            update_post_meta($page_id, '_logos_list', 'field_logos_list');
            foreach ($logo_items as $idx => $logo) {
                $meta_key = "logos_list_{$idx}_logo";
                update_post_meta($page_id, $meta_key, $logo['ID']);
                update_post_meta($page_id, "_{$meta_key}", 'field_ll_image');
            }
            $migrated[] = "logos_list ({$row_count} rows)";
        } else {
            $skipped[] = "logos_list (no old data)";
        }
    } else {
        $skipped[] = "logos_list (already has {$logos_existing} rows)";
    }

    // Output results
    echo '<h1>Migration Complete</h1>';
    echo '<h2>Migrated:</h2><ul>';
    foreach ($migrated as $m) echo "<li>✅ {$m}</li>";
    echo '</ul>';
    echo '<h2>Skipped:</h2><ul>';
    foreach ($skipped as $s) echo "<li>⏭️ {$s}</li>";
    echo '</ul>';
    echo '<p><strong>Old data is NOT deleted.</strong> Once you verify everything works, you can remove old fields from ACF admin.</p>';
    exit;
});
