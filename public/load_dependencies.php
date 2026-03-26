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
        'version' => file_exists($base_path . 'swiper-config.js'),
        'load_page' => ['test']
      ],
    ];

    if(empty($scripts)) { return; }
    foreach ($scripts as $handle => $script) {
      if (
        !is_array($script['load_page']) ||
        !is_page($script['load_page'])

      ) {
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
  }

  public function load_libraries()
  {}
}