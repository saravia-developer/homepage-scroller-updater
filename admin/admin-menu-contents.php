<?php

namespace HomepageScrollerUpdater\Admin;

class AdminMenuContents
{

  public function homepage_scroller_updater_contents()
  {

    global $wpdb;

    $table_name = $wpdb->prefix . 'custom_sliders';


    if (isset($_POST['save_slider'])) {

      $slides_raw = $_POST['slides'] ?? [];

      $slides_clean = array_map(function ($slide) {
        return [
          'image' => isset($slide['image']) ? (string) $slide['image'] : '',
          'title' => isset($slide['title']) ? (string) $slide['title'] : '',
          'description' => isset($slide['description']) ? (string) $slide['description'] : '',
          'button' => isset($slide['button']) ? (string) $slide['button'] : '',
          'link' => isset($slide['link']) ? (string) $slide['link'] : '',
        ];
      }, $slides_raw);

      $slides_json = json_encode($slides_clean);

      $existing = $wpdb->get_var(
        "SELECT id FROM $table_name WHERE name = 'slider_principal' LIMIT 1"
      );

      if ($existing) {
        $wpdb->update(
          $table_name,
          ['slides' => $slides_json],
          ['id' => $existing]
        );
      } else {
        $wpdb->insert(
          $table_name,
          [
            'name' => 'slider_principal',
            'slides' => $slides_json
          ]
        );
      }
    }


    $slider = $wpdb->get_row(
      "SELECT * FROM $table_name WHERE name = 'slider_principal' ORDER BY id DESC LIMIT 1"
    );

    $slides = [];

    if ($slider) {
      $slides = json_decode($slider->slides, true);
    }

    ?>
    <form method="POST" class="update-slider-form">
      <div id="slides-container">
        <?php if (!empty($slides)): ?>
          <?php foreach ($slides as $index => $slide): ?>

            <div class="slide-item" style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">

              <h2>Formulario de Slide</h2>

              <div class="admin-form-group-slider">
                <label>URL Imagen</label>
                <input type="text" class="image-input" id="image-input-<?= $index ?>" name="slides[<?= $index ?>][image]"
                  value="<?= esc_attr($slide['image']) ?>" />

                <button type="button" class="select-image-button">
                  Seleccionar imagen
                </button>
              </div>

              <div class="admin-form-group-slider">
                <label>Título</label>
                <input type="text" name="slides[<?= $index ?>][title]" value="<?= esc_attr($slide['title']) ?>"
                  id="title-input-<?= $index ?>">
              </div>

              <div class="admin-form-group-slider">
                <label>Descripción</label>
                <textarea name="slides[<?= $index ?>][description]"
                  id="description-input-<?= $index ?>"><?= esc_textarea($slide['description']) ?></textarea>
              </div>

              <div class="admin-form-group-slider">
                <label>HTML Botón</label>
                <textarea name="slides[<?= $index ?>][button]"
                  id="button-input-<?= $index ?>"><?= esc_textarea($slide['button']) ?></textarea>
              </div>

              <div class="admin-form-group-slider">
                <label>Link</label>
                <input type="text" name="slides[<?= $index ?>][link]" value="<?= esc_attr($slide['link']) ?>"
                  id="link-input-<?= $index ?>">
              </div>

              <button type="button" onclick="this.parentElement.remove()">Eliminar</button>
            </div>

          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <button type="button" id="add-slide">+ Añadir Slide</button>
      <br><br>
      <input type="submit" name="save_slider" value="Guardar">
    </form>

    <script>
      const addFormGroupButton = document.getElementById('add-slide');

      addFormGroupButton.addEventListener('click', function () {
        const container = document.getElementById('slides-container');

        const index = container.children.length;

        const html = `
        <div class="slide-item" style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">

            <h2>Formulario de Slide</h2>
            
            <div class="admin-form-group-slider">
              <label for="admin-form-image-slider-${index}">URL Imagen</label>                  
              <input
                type="text"
                class="image-input"
                name="slides[${index}][image]"
                placeholder="URL Imagen"
                value="slides[${index}][image]"
                id="image-input-${index}"
              />

              <button type="button" class="select-image-button">
                Seleccionar imagen
              </button>
            </div>
            
            <div class="admin-form-group-slider">
              <label for="admin-form-title-slider-${index}">Título</label>
              <input
                  type="text"
                  name="slides[${index}][title]"
                  placeholder="Título"
                  id="admin-form-title-slider-${index}"
              >
            </div>

            <div class="admin-form-group-slider">
              <label for="admin-form-description-slider-${index}">Descripción</label>
              <textarea
                  name="slides[${index}][description]"
                  placeholder="Descripción"
                  id="admin-form-description-slider-${index}"
              ></textarea>
            </div>
            
            <div class="admin-form-group-slider">
              <label for="admin-form-button-slider-${index}">HTML Botón</label>
              <textarea
                  name="slides[${index}][button]"
                  placeholder="HTML Botón"
                  id="admin-form-button-slider-${index}"
              ></textarea>
            </div>

            <div class="admin-form-group-slider">
              <label for="admin-form-link-slider-${index}">Link del botón</label>
              <input
                  type="text"
                  name="slides[${index}][link]"
                  placeholder="Link del botón"
                  id="admin-form-link-slider-${index}"
              >
            </div>
            
            <button
                type="button"
                onclick="this.parentElement.remove()"
            >
              Eliminar
            </button>
        </div>
    `;

        container.insertAdjacentHTML('beforeend', html);
      });

      document.addEventListener('click', function (e) {

        if (!e.target.classList.contains('select-image-button')) return;

        const button = e.target;
        const input = button.previousElementSibling;

        const frame = wp.media({
          title: 'Seleccionar imagen',
          button: {
            text: 'Usar esta imagen'
          },
          multiple: false
        });

        frame.on('select', function () {
          const attachment = frame.state().get('selection').first().toJSON();

          input.value = attachment.url; 
        });

        frame.open();
      });

    </script>
    <?php
  }
}