<?php
add_shortcode('sh_pack_button', function ($atts, $content = null) {
    $atts = shortcode_atts([
        'url' => '#',
        'color' => 'blue',
        'size' => 'medium',
        'target' => '_self'
    ], $atts);

    $style = "background-color: {$atts['color']};";
    $class = 'sh_pack_button ' . esc_attr('sh_pack_size_' . $atts['size']);

    return '<a href="' . esc_url($atts['url']) . '" class="' . $class . '" target="' . esc_attr($atts['target']) . '" style="' . esc_attr($style) . '">' . do_shortcode($content) . '</a>';
});
