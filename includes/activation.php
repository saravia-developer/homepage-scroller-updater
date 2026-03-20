<?php

namespace HomepageScrollerUpdater\Includes;

require_once HSU_ADMIN_PATH . 'class-admin.php';
require_once HSU_PUBLIC_PATH . 'class-public.php';

use HomepageScrollerUpdater\Admin\Admin;
use HomepageScrollerUpdater\Public\Class_Public;

class Activation
{

  public $class_admin;
  public $class_public;

  public function __construct()
  {
    $this->class_admin = new Admin;
    $this->class_public = new Class_Public;

    $this->load_dependencies();
  }

  public function load_dependencies()
  {
    $this->class_admin->run();
    $this->class_public->run();
  }

}