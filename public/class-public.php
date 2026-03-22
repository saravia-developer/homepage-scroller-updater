<?php

namespace HomepageScrollerUpdater\Public;

require_once HSU_INCLUDES_PATH . 'loader.php';
require_once HSU_PUBLIC_PATH . 'load_dependencies.php';

use HomepageScrollerUpdater\Includes\Loader;
use HomepageScrollerUpdater\Public\Load_Dependencies;

class Class_Public
{
  public Loader $loader;
  public Load_Dependencies $load_dependencies;
  public function __construct()
  {
    $this->loader = new Loader();
    $this->load_dependencies = new Load_Dependencies();
    $this->load_public_style();
  }

  public function load_public_style()
  {
    $this->loader->add_action('wp_enqueue_scripts', $this->load_dependencies, 'load_styles');
    $this->loader->add_action('wp_enqueue_scripts', $this->load_dependencies, 'load_scripts');
    $this->loader->add_action('wp_enqueue_scripts', $this->load_dependencies, 'load_libraries');
  }

  public function run()
  {
    $this->loader->run();
  }
}