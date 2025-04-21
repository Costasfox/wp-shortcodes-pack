<?php
add_shortcode('sh_pack_box', function ($atts, $content = null) {
    $atts = shortcode_atts([
        'title' => '',
        'icon' => '', // π.χ. lock, truck, star
        'background' => '#ffffff',
        'color' => '#333',
    ], $atts);

    $icon_html = $atts['icon'] ? '<i class="fa fa-' . esc_attr($atts['icon']) . '" style="font-size: 22px; margin-right: 10px;"></i>' : '';

    return '<div class="sh_pack_box" style="background:' . esc_attr($atts['background']) . '; color:' . esc_attr($atts['color']) . '; padding: 20px; border-radius: 12px; margin-bottom: 20px;">
        <div class="sh_pack_box_header" style="display:flex; align-items:center; margin-bottom: 10px;">' . $icon_html . '<strong style="font-size: 18px;">' . esc_html($atts['title']) . '</strong></div>
        <div>' . wpautop(do_shortcode($content)) . '</div>
    </div>';
});
