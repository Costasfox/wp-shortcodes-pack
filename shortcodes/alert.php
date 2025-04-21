<?php
add_shortcode('sh_pack_alert', function ($atts, $content = null) {
    $atts = shortcode_atts([
        'type' => 'info', // info, success, error
    ], $atts);

    return '<div class="sh_pack_alert ' . esc_attr('sh_pack_alert_' . $atts['type']) . '">' . do_shortcode($content) . '</div>';
});
