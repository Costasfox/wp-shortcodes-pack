<?php
add_shortcode('sh_pack_pricing', function ($atts, $content = null) {
    $atts = shortcode_atts([
        'title' => 'Pricing Plan',
        'price' => '',
        'button_text' => 'Buy Now',
        'button_url' => '#',
        'background' => '#ffffff',
        'text_color' => '#333',
    ], $atts);

    return '
    <div class="sh_pack_pricing_card" style="background:' . esc_attr($atts['background']) . '; color:' . esc_attr($atts['text_color']) . ';">
        <h3 class="sh_pack_pricing_title">' . esc_html($atts['title']) . '</h3>
        <div class="sh_pack_pricing_price">' . esc_html($atts['price']) . '</div>
        <div class="sh_pack_pricing_features">' . wpautop(wp_kses_post($content)) . '</div>
        <a href="' . esc_url($atts['button_url']) . '" class="sh_pack_pricing_button">' . esc_html($atts['button_text']) . '</a>
    </div>';
});
