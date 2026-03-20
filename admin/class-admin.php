<?php

namespace HomepageScrollerUpdater\Admin;

require_once HSU_INCLUDES_PATH . 'loader.php';
require_once HSU_ADMIN_PATH . 'admin-menu.php';
require_once HSU_ADMIN_PATH . 'add-table-in-db.php';
require_once HSU_ADMIN_PATH . 'shortcodes.php';

use HomepageScrollerUpdater\Includes\Loader;


class Admin {
    
    public Loader $loader;
    
    public function __construct() {
        $this->loader = new Loader();
        $this->load_administration_menu_tabs();
        $this->load_new_shortcodes();
        $this->load_admin_style();
    }
    
    public function load_administration_menu_tabs() {
        $admin_menu = new Admin_Menu();
        
        $this->loader->add_action('admin_menu', $admin_menu, 'add_menu_page');
    }
    
    public function load_new_shortcodes() {
        $class_shortcodes = new Shortcodes();
        
        add_shortcode('custom_slider', [$class_shortcodes, 'fn_custom_slider']);
    }


    public function load_admin_style() {
        $this->loader->add_action('admin_enqueue_scripts', $this, 'load_style');
    }

    public function load_style() {
        wp_enqueue_style(
            'hsu_admin_style',
            HSU_ADMIN_URI . 'css/style.css',
            [],
            filemtime(HSU_ADMIN_PATH . 'css/style.css'),
            'all'
        );
    }

    public function run() {
        $this->loader->run();
    }
}