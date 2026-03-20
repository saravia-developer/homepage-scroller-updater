<?php

namespace HomepageScrollerUpdater\Admin;

class AddTableInDB {
    
    public function table_slider() {
        
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'custom_sliders';
        
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            slides LONGTEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
}