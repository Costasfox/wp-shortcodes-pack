<?php
add_shortcode('sh_pack_progress', function ($atts) {
    $atts = shortcode_atts([
        'label' => '',
        'percent' => 0,
        'color' => '#0073aa',
    ], $atts);

    $percent = min(max((int)$atts['percent'], 0), 100); // Ensure 0–100%

    return '
    <div class="sh_pack_progress_wrapper">
        ' . ($atts['label'] ? '<div class="sh_pack_progress_label">' . esc_html($atts['label']) . '</div>' : '') . '
        <div class="sh_pack_progress_outer">
            <div class="sh_pack_progress_inner" style="width:' . esc_attr($percent) . '%; background:' . esc_attr($atts['color']) . ';"></div>
        </div>
        <div class="sh_pack_progress_percent">' . esc_html($percent) . '%</div>
    </div>';
});
