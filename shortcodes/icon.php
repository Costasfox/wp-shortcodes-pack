<?php
add_shortcode('sh_pack_icon', function ($atts) {
    $atts = shortcode_atts([
        'name' => 'star-filled',
        'size' => '20px',
        'color' => '#000',
        'type' => 'dashicons' // or "fa" for fontawesome
    ], $atts);

    if ($atts['type'] === 'fa') {
        return '<i class="fa fa-' . esc_attr($atts['name']) . '" style="font-size:' . esc_attr($atts['size']) . '; color:' . esc_attr($atts['color']) . ';"></i>';
    }

    return '<span class="dashicons dashicons-' . esc_attr($atts['name']) . '" style="font-size:' . esc_attr($atts['size']) . '; color:' . esc_attr($atts['color']) . ';"></span>';
});
