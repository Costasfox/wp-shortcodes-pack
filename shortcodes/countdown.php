<?php
add_shortcode('sh_pack_countdown', function ($atts) {
    $atts = shortcode_atts([
        'until' => '2025-12-31 23:59',
        'label' => '',
        'color' => '#000'
    ], $atts);

    $id = 'countdown_' . uniqid();
    $until = date('Y/m/d H:i:s', strtotime($atts['until'])); // JS friendly format

    ob_start(); ?>
    <div class="sh_pack_countdown_wrapper">
        <?php if (!empty($atts['label'])) : ?>
            <p class="sh_pack_countdown_label"><?php echo esc_html($atts['label']); ?></p>
        <?php endif; ?>
        <div id="<?php echo esc_attr($id); ?>" class="sh_pack_countdown" style="color:<?php echo esc_attr($atts['color']); ?>;"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countdownEl = document.getElementById('<?php echo esc_js($id); ?>');
            const targetDate = new Date('<?php echo esc_js($until); ?>').getTime();

            function updateCountdown() {
                const now = new Date().getTime();
                const distance = targetDate - now;

                if (distance <= 0) {
                    countdownEl.innerHTML = "Expired";
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                countdownEl.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
            }

            updateCountdown();
            setInterval(updateCountdown, 1000);
        });
    </script>
<?php
    return ob_get_clean();
});
