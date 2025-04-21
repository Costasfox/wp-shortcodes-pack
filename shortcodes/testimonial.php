<?php
add_shortcode('sh_pack_testimonial', function ($atts, $content = null) {
    $atts = shortcode_atts([
        'name' => 'Anonymous',
        'role' => '',
        'avatar' => '',
    ], $atts);

    $avatar_html = $atts['avatar'] ? '<img src="' . esc_url($atts['avatar']) . '" class="sh_pack_testimonial_avatar" alt="' . esc_attr($atts['name']) . '">' : '';

    return '
    <div class="sh_pack_testimonial">
        ' . $avatar_html . '
        <div class="sh_pack_testimonial_content">
            <p class="sh_pack_testimonial_text">' . wp_kses_post(wpautop($content)) . '</p>
            <p class="sh_pack_testimonial_author"><strong>' . esc_html($atts['name']) . '</strong><br><span>' . esc_html($atts['role']) . '</span></p>
        </div>
    </div>';
});
