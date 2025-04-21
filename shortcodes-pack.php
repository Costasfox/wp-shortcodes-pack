<?php

/**
 * Plugin Name: WordPress Shortcodes Pack
 * Description: Adds useful shortcodes for buttons, alerts, and grids with modern styling.
 * Version: 1.0
 * Author: CostasCh
 * Author URI: https://costasch.xyz
 * Text Domain: shortcodes-pack
 * Requires at least: 5.0
 * Tested up to: 6.8
 * Requires PHP: 8.2
 * Copyright: © 2025 CostasCh
 */

if (!defined('ABSPATH')) exit;

// Enqueue CSS

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('shortcodes-pack-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');
    add_action('wp_footer', function () {
?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const buttons = document.querySelectorAll('.sh_pack_tab_button');
                buttons.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const parent = this.closest('.sh_pack_tabs_wrapper');
                        const contents = parent.querySelectorAll('.sh_pack_tab_content');
                        const allButtons = parent.querySelectorAll('.sh_pack_tab_button');

                        allButtons.forEach(b => b.classList.remove('active'));
                        contents.forEach(c => c.classList.remove('active'));

                        this.classList.add('active');
                        const target = parent.querySelector('#' + this.dataset.tab);
                        if (target) target.classList.add('active');
                    });
                });
            });
        </script>
    <?php
    });
    add_action('wp_footer', function () {
    ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.sh_pack_toggle_button').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const target = document.getElementById(this.dataset.toggleTarget);
                        if (target.style.display === "block") {
                            target.style.display = "none";
                        } else {
                            target.style.display = "block";
                        }
                    });
                });
            });
        </script>
    <?php
    });
});

// Include shortcodes
foreach (glob(plugin_dir_path(__FILE__) . 'shortcodes/*.php') as $file) {
    require_once $file;
}

// Add admin menu
add_action('admin_menu', function () {
    add_menu_page(
        'Shortcodes Pack',
        'Shortcodes Pack',
        'manage_options',
        'sh-pack-shortcodes',
        'sh_pack_admin_page',
        'dashicons-editor-code',
        56
    );
});

function sh_pack_admin_page()
{
    $categories = [
        'buttons' => 'Buttons',
        'alerts' => 'Alerts',
        'badges' => 'Badges',
        "grid" => "Grid Layout",
        'divider' => 'Divider',
        'icon' => 'Icons',
        'box' => 'Box',
        'tabs' => 'Tabs',
        'testimonial' => 'Testimonials',
        'countdown' => 'Countdown Timer',
        'progress' => 'Progress Bars',
        'pricing' => 'Pricing Boxes',
        'button_group' => 'Button Groups',
        'toggle' => 'Toggles / FAQ',







    ];
    ?>
    <div class="wrap">
        <h1>Shortcodes Pack</h1>
        <p>Select a category to view available shortcodes and how to use them.</p>

        <select id="sh_pack_category_dropdown">
            <option value="">-- Select Category --</option>
            <?php foreach ($categories as $key => $label) : ?>
                <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($label); ?></option>
            <?php endforeach; ?>
        </select>

        <div id="sh_pack_output" style="margin-top: 30px; padding: 20px; background: #fff; border: 1px solid #ccc;"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.getElementById('sh_pack_category_dropdown');
            const output = document.getElementById('sh_pack_output');

            const content = {
                'buttons': `
                    <h2>[sh_pack_button]</h2>
                    <p><strong>Usage:</strong></p>
                    <pre>[sh_pack_button url="https://example.com" color="#0073aa" size="large"]Click me[/sh_pack_button]</pre>
                    <p><strong>Attributes:</strong></p>
                    <ul>
                        <li><code>url</code> – The button link</li>
                        <li><code>color</code> – Background color</li>
                        <li><code>size</code> – small / medium / large</li>
                        <li><code>target</code> – _blank or _self</li>
                    </ul>
                `,
                'alerts': `
                    <h2>[sh_pack_alert]</h2>
                    <p><strong>Usage:</strong></p>
                    <pre>[sh_pack_alert type="success"]This is a success alert[/sh_pack_alert]</pre>
                    <ul>
                        <li><code>type</code> – info / success / error</li>
                    </ul>
                `,
                'badges': `
                    <h2>[sh_pack_badge]</h2>
                    <p><strong>Usage:</strong></p>
                    <pre>[sh_pack_badge text="Beta" color="#f39c12" size="small" rounded="true"]</pre>
                    <ul>
                        <li><code>text</code> – Badge content</li>
                        <li><code>color</code> – Background color</li>
                        <li><code>text_color</code> – Text color</li>
                        <li><code>size</code> – small / medium / large</li>
                        <li><code>rounded</code> – true / false</li>
                    </ul>
                `,
                'grid': `
    <h2>[sh_pack_grid] & [sh_pack_column]</h2>
    <p><strong>Usage:</strong></p>
    <pre>[sh_pack_grid columns="3"]
[sh_pack_column]
🎯 Feature One
Lorem ipsum dolor sit amet.
[/sh_pack_column]

[sh_pack_column]
🚀 Feature Two
Consectetur adipiscing elit.
[/sh_pack_column]

[sh_pack_column]
💡 Feature Three
Sed do eiusmod tempor incididunt.
[/sh_pack_column]
[/sh_pack_grid]</pre>
    <ul>
        <li><code>columns</code> – Number of columns: 2, 3, or 4</li>
    </ul>
`,
                'divider': `
    <h2>[sh_pack_divider]</h2>
    <p><strong>Usage:</strong></p>
    <pre>[sh_pack_divider style="dashed" color="#ccc" width="50%" margin="30px"]</pre>
    <ul>
        <li><code>style</code> – solid / dashed / dotted</li>
        <li><code>color</code> – Any color value</li>
        <li><code>width</code> – e.g. 100%, 50%</li>
        <li><code>margin</code> – e.g. 20px, 40px</li>
    </ul>
`,
                'icon': `
    <h2>[sh_pack_icon]</h2>
    <p><strong>Usage (Dashicons):</strong></p>
    <pre>[sh_pack_icon name="star-filled" size="24px" color="#ffcc00"]</pre>
    <p><strong>Usage (FontAwesome):</strong></p>
    <pre>[sh_pack_icon name="user" type="fa" size="20px" color="#000"]</pre>
    <ul>
        <li><code>name</code> – Icon name (dashicon or fa)</li>
        <li><code>type</code> – dashicons or fa</li>
        <li><code>size</code> – Font size (px)</li>
        <li><code>color</code> – Icon color</li>
    </ul>
`,
                'box': `
    <h2>[sh_pack_box]</h2>
    <p><strong>Usage:</strong></p>
    <pre>[sh_pack_box title="Secure Checkout" icon="lock" type="fa" background="#fef9f0" color="#d35400"]
Your data is protected.
[/sh_pack_box]
</pre>
    <ul>
        <li><code>title</code> – Box heading</li>
        <li><code>icon</code> – Dashicon class (optional)</li>
        <li><code>background</code> – Background color</li>
        <li><code>color</code> – Text color</li>
    </ul>
`,
                'tabs': `
    <h2>[sh_pack_tabs]</h2>
    <p><strong>Usage:</strong></p>
    <pre>[sh_pack_tabs]
[sh_pack_tab title="Overview"]
Tab content here
[/sh_pack_tab]
[sh_pack_tab title="More Info"]
Another tab content
[/sh_pack_tab]
[/sh_pack_tabs]</pre>
    <ul>
        <li><code>title</code> – Tab label</li>
    </ul>
`,
                'testimonial': `
    <h2>[sh_pack_testimonial]</h2>
    <p><strong>Usage:</strong></p>
    <pre>[sh_pack_testimonial name="Costas Ch." role="Founder at Startup" avatar="https://costasch.xyz/wp-content/uploads/2023/03/avatar-1-1-1.webp"]
This plugin is amazing. It solved all our delivery problems!
[/sh_pack_testimonial]</pre>
    <ul>
        <li><code>name</code> – Person's name</li>
        <li><code>role</code> – Job title / company</li>
        <li><code>avatar</code> – Image URL (optional)</li>
    </ul>
`,
                'countdown': `
    <h2>[sh_pack_countdown]</h2>
    <p><strong>Usage:</strong></p>
    <pre>[sh_pack_countdown until="2025-05-01 23:59" label="Offer ends in:" color="#0073aa"]</pre>
    <ul>
        <li><code>until</code> – Target date/time in format YYYY-MM-DD HH:MM</li>
        <li><code>label</code> – Optional label above the timer</li>
        <li><code>color</code> – Text color of the countdown</li>
    </ul>
`,
                'progress': `
    <h2>[sh_pack_progress]</h2>
    <p><strong>Usage:</strong></p>
    <pre>[sh_pack_progress label="Learning WordPress" percent="70" color="#00c851"]</pre>
    <ul>
        <li><code>label</code> – Optional title above the bar</li>
        <li><code>percent</code> – Value from 0 to 100</li>
        <li><code>color</code> – Fill color</li>
    </ul>
`,
                'pricing': `
    <h2>[sh_pack_pricing]</h2>
    <p><strong>Usage:</strong></p>
<pre>
[sh_pack_pricing title="Pro Plan" price="€19.99/month" button_text="Get Started" button_url="https://example.com/checkout"]
✔ Unlimited Access &lt;br&gt;
✔ Priority Support &lt;br&gt;
✔ Free Updates
[/sh_pack_pricing]
</pre>

    <ul>
        <li><code>title</code> – Pricing title</li>
        <li><code>price</code> – Price display text</li>
        <li><code>button_text</code> – CTA button label</li>
        <li><code>button_url</code> – Button link</li>
        <li><code>background</code> – Background color (optional)</li>
        <li><code>text_color</code> – Text color (optional)</li>
    </ul>
`,
                'button_group': `
    <h2>[sh_pack_button_group] & [sh_pack_button_item]</h2>
    <p><strong>Usage:</strong></p>
    <pre>[sh_pack_button_group align="center"]
[sh_pack_button_item text="Download" url="https://example.com/download" color="#28a745"]
[sh_pack_button_item text="Learn More" url="https://example.com/learn" color="#0073aa"]
[/sh_pack_button_group]</pre>
    <ul>
        <li><code>align</code> (group) – left / center / right</li>
        <li><code>text</code> (button) – Text of the button</li>
        <li><code>url</code> (button) – Link destination</li>
        <li><code>color</code> – Button background color</li>
        <li><code>target</code> – _blank / _self</li>
    </ul>
`,
                'toggle': `
    <h2>[sh_pack_toggle]</h2>
    <p><strong>Usage:</strong></p>
    <pre>[sh_pack_toggle title="What is your refund policy?"]
We offer a 14-day money-back guarantee for all purchases.
[/sh_pack_toggle]</pre>
    <ul>
        <li><code>title</code> – The clickable heading</li>
        <li>Content inside will toggle show/hide</li>
    </ul>
`









            };

            dropdown.addEventListener('change', function() {
                const selected = this.value;
                output.innerHTML = content[selected] || '';
            });
        });
    </script>
<?php
}

// Donate link , Documentation and Support
add_action('admin_notices', function () {
    $screen = get_current_screen();
    if ($screen->id === 'toplevel_page_sh-pack-shortcodes') {
        echo '<div class="notice notice-info is-dismissible">';
        echo '<p>If you like this plugin, consider <a href="https://costasch.xyz/donate" target="_blank">donating</a> to support its development.</p>';
        echo '<p>For documentation and support, visit <a href="https://costasch.xyz/documentation" target="_blank">our website</a>.</p>';
        echo '</div>';
    }
});
