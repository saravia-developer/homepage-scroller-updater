<?php

namespace HomepageScrollerUpdater\Public;

require_once HSU_INCLUDES_PATH . 'loader.php';

use HomepageScrollerUpdater\Includes\Loader;

class Class_Public
{
  public Loader $loader;

  public function __construct()
  {
    $this->loader = new Loader();
    $this->load_public_style();
  }

  public function load_public_style()
  {
    $this->loader->add_action('wp_enqueue_scripts', $this, 'load_style');
  }

  public function load_style()
  {
    wp_enqueue_style(
      'hsu_public_style',
      HSU_PUBLIC_URI . 'css/style.css',
      [],
      filemtime(HSU_PUBLIC_PATH . 'css/style.css'),
      'all'
    );
  }
  
  public function run() {
    $this->loader->run();
  }
}