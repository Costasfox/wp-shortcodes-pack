<?php
add_shortcode('sh_pack_grid', function ($atts, $content = null) {
    $atts = shortcode_atts([
        'columns' => '3',
    ], $atts);

    $class = 'sh_pack_grid sh_pack_grid_cols_' . intval($atts['columns']);

    return '<div class="' . esc_attr($class) . '">' . do_shortcode($content) . '</div>';
});

add_shortcode('sh_pack_column', function ($atts, $content = null) {
    return '<div class="sh_pack_column">' . do_shortcode($content) . '</div>';
});
