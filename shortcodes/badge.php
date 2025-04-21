<?php
add_shortcode('sh_pack_badge', function ($atts) {
    $atts = shortcode_atts([
        'text' => '',
        'color' => '#0073aa',
        'text_color' => '#fff',
        'size' => 'medium',
        'rounded' => 'true',
    ], $atts);

    if (empty($atts['text'])) return '';

    $class = 'sh_pack_badge sh_pack_badge_' . esc_attr($atts['size']);
    if ($atts['rounded'] === 'true') {
        $class .= ' sh_pack_badge_rounded';
    }

    return '<span class="' . $class . '" style="background-color:' . esc_attr($atts['color']) . '; color:' . esc_attr($atts['text_color']) . ';">' . esc_html($atts['text']) . '</span>';
});
