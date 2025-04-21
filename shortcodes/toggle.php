<?php
add_shortcode('sh_pack_toggle', function ($atts, $content = null) {
    $atts = shortcode_atts([
        'title' => 'FAQ Title',
        'icon' => 'angle-down',
        'color' => '#0073aa'
    ], $atts);

    $uid = 'sh_pack_toggle_' . uniqid();
    $icon = '<i class="fa fa-' . esc_attr($atts['icon']) . '" style="margin-right: 10px;"></i>';

    return '
    <div class="sh_pack_toggle_wrapper">
        <button class="sh_pack_toggle_button" type="button" data-toggle-target="' . esc_attr($uid) . '" style="background-color:' . esc_attr($atts['color']) . ';">
            ' . $icon . '<span>' . esc_html($atts['title']) . '</span>
        </button>
        <div id="' . esc_attr($uid) . '" class="sh_pack_toggle_panel">
            ' . wpautop(do_shortcode($content)) . '
        </div>
    </div>';
});
