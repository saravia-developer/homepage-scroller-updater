<?php

namespace HomepageScrollerUpdater\Admin;

class Shortcodes
{

    public function fn_custom_slider()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'custom_sliders';
        $slider = $wpdb->get_row("SELECT * FROM $table_name ORDER BY id DESC LIMIT 1");
        if (!$slider)
            return "No hay slider";

        $slides = json_decode($slider->slides, true);

        ob_start();
        ?>
        <div class="hsu-slider swiper">

            <div class="hsu-slides swiper-wrapper">
                <?php foreach ($slides as $index => $slide): ?>

                    <div class="hsu-slide swiper-slide">
                        <div class="hsu-bg" style="background-image: url('<?php echo esc_url($slide['image']) ?>')"></div>

                        <div class="hsu-overlay"></div>

                        <div class="hsu-content">
                            <h2><?php echo esc_html($slide['title']) ?></h2>
                            <p><?php echo esc_html($slide['description']) ?></p>
                            <a href="<?php echo esc_url($slide['link']) ?>" class="hsu-btn">
                                <?php echo esc_html($slide['button']) ?>
                            </a>
                        </div>

                    </div>

                <?php endforeach; ?>
            </div>

			<div class="swiper-pagination"></div>
            <div class="hsu-shape-divider"></div>

        </div>
        <?php

        return ob_get_clean();
    }

}