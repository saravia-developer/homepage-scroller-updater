<?php

namespace HomepageScrollerUpdater\Admin;

require_once HSU_ADMIN_PATH . 'admin-menu-contents.php';

class Admin_Menu {
    
    public AdminMenuContents $admin_menu_contents;
    
    public function __construct() {
        $this->admin_menu_contents = new AdminMenuContents();
    }
    
    public function add_menu_page() {
        add_menu_page(
            'BANNER HOMEPAGE',
            'BANNER HOMEPAGE',
            'manage_options',
            'homepage-scroller-updater',
            [$this->admin_menu_contents, 'homepage_scroller_updater_contents'],
            'dashicons-images-alt'
        );
    }
}