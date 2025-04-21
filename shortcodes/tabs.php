<?php
add_shortcode('sh_pack_tabs', function ($atts, $content = null) {
    static $tab_id = 0;
    $tab_id++;

    // Capture all [sh_pack_tab] shortcodes
    preg_match_all('/\[sh_pack_tab(.*?)\](.*?)\[\/sh_pack_tab\]/s', $content, $matches, PREG_SET_ORDER);

    if (empty($matches)) return '';

    $tab_nav = '';
    $tab_content = '';

    $uid = 'sh_pack_tabs_' . $tab_id;

    foreach ($matches as $index => $tab) {
        $title_attr = shortcode_parse_atts($tab[1]);
        $title = $title_attr['title'] ?? 'Tab ' . ($index + 1);
        $is_active = $index === 0 ? 'active' : '';

        $tab_nav .= '<button class="sh_pack_tab_button ' . $is_active . '" data-tab="' . $uid . '_tab_' . $index . '">' . esc_html($title) . '</button>';
        $tab_content .= '<div id="' . $uid . '_tab_' . $index . '" class="sh_pack_tab_content ' . $is_active . '">' . do_shortcode($tab[2]) . '</div>';
    }

    return '<div class="sh_pack_tabs_wrapper">
        <div class="sh_pack_tab_nav">' . $tab_nav . '</div>
        <div class="sh_pack_tabs_content">' . $tab_content . '</div>
    </div>';
});
