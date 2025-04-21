<?php
add_shortcode('sh_pack_divider', function ($atts) {
    $atts = shortcode_atts([
        'style' => 'solid',     // solid, dashed, dotted
        'color' => '#ccc',
        'width' => '100%',
        'margin' => '20px'
    ], $atts);

    $style = sprintf(
        'border-top: 2px %s %s; width: %s; margin: %s auto;',
        esc_attr($atts['style']),
        esc_attr($atts['color']),
        esc_attr($atts['width']),
        esc_attr($atts['margin'])
    );

    return '<hr style="' . $style . '">';
});
