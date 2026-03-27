<?php

namespace HomepageScrollerUpdater\Public;

class Load_Dependencies
{
  public function load_scripts()
  {
    $base_uri = HSU_PUBLIC_URI . 'js/';
    $base_path = HSU_PUBLIC_PATH . 'js/';

    $scripts = [
      'hsu_swiper_config' => [
        'url' => $base_uri . 'swiper-config.js',
        'deps' => ['jquery'],
        'version' => file_exists($base_path . 'swiper-config.js'),
        'load_page' => ['home', 'home-test']
      ],
      'swiper_bundle_js' => [
        'url' => $base_uri . 'swiper-bundle.min.js',
        'version' => file_exists($base_path . 'swiper-bundle.min.js')
      ],
    ];

    if (empty($scripts)) {
      return;
    }

    foreach ($scripts as $handle => $script) {
      if (!$this->should_load_on_current_page($script)) {
        continue;
      }

      $uri = $script['url'] ?? '';
      $deps = $script['deps'] ?? [];
      $version = $script['version'] ? filemtime($base_path . basename($uri)) : false;
      $args = $script['args'] ?? [];

      wp_enqueue_script(
        $handle,
        $uri,
        $deps,
        $version,
        array_merge(['in_footer' => true], $args)
      );
    }
  }

  public function load_styles()
  {
    wp_enqueue_style(
      'hsu_public_style',
      HSU_PUBLIC_URI . 'css/style.css',
      [],
      filemtime(HSU_PUBLIC_PATH . 'css/style.css'),
      'all'
    );

    wp_enqueue_style(
      'swiper_bundle_css',
      HSU_PUBLIC_URI . 'css/swiper-bundle.min.css',
      [],
      filemtime(HSU_PUBLIC_PATH . 'css/swiper-bundle.min.css'),
      'all'
    );
  }

  public function load_libraries()
  {
  }

  private function should_load_on_current_page(array $script): bool
  {
    // No existe la clave → cargar en todas
    if (!isset($script['load_page'])) {
      return true;
    }

    $pages = $script['load_page'];

    // Existe pero vacío → cargar en todas
    if (empty($pages)) {
      return true;
    }

    // Normalizar a array (por si viene string)
    if (!is_array($pages)) {
      $pages = [$pages];
    }

    // Validar contra slug(s)
    return is_page($pages);
  }
}