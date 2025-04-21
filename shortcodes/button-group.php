<?php
add_shortcode('sh_pack_button_group', function ($atts, $content = null) {
    $atts = shortcode_atts([
        'align' => 'left', // left, center, right
    ], $atts);

    $class = 'sh_pack_button_group align_' . esc_attr($atts['align']);
    return '<div class="' . $class . '">' . do_shortcode($content) . '</div>';
});

add_shortcode('sh_pack_button_item', function ($atts) {
    $atts = shortcode_atts([
        'text' => 'Click',
        'url' => '#',
        'color' => '#0073aa',
        'target' => '_self'
    ], $atts);

    return '<a href="' . esc_url($atts['url']) . '" target="' . esc_attr($atts['target']) . '" class="sh_pack_button_item" style="background:' . esc_attr($atts['color']) . ';">' . esc_html($atts['text']) . '</a>';
});
