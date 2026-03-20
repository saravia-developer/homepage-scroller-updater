<?php
/*
 * Plugin Name: Homepage scroller updater
 * Description: Extensión para advance custom field.
 * Version: 1.0.0
 * Author: Luis Saravia.
 */

defined('ABSPATH') || exit;

define('HSU_FILE_MAIN_PATH', plugin_dir_path(__FILE__));
define('HSU_PUBLIC_PATH', HSU_FILE_MAIN_PATH . 'public/');
define('HSU_ADMIN_PATH', HSU_FILE_MAIN_PATH . 'admin/');
define('HSU_INCLUDES_PATH', HSU_FILE_MAIN_PATH . 'includes/');

define('HSU_FILE_MAIN_URI', plugin_dir_url(__FILE__));
define('HSU_PUBLIC_URI', HSU_FILE_MAIN_URI . 'public/');
define('HSU_ADMIN_URI', HSU_FILE_MAIN_URI . 'admin/');
define('HSU_INCLUDES_URI', HSU_FILE_MAIN_URI . 'includes/');

if (!function_exists('is_plugin_active')) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

if (!is_plugin_active('advanced-custom-fields/acf.php')) {
	deactivate_plugins(plugin_basename(__FILE__));

	wp_die(
		'Este plugin requiere que Advanced Custom Fields esté activo. Por favor, actívalo primero.',
		'Dependencia faltante',
		['back_link' => true]
	);
}

require_once HSU_INCLUDES_PATH . 'activation.php';
require_once HSU_ADMIN_PATH . 'add-table-in-db.php';

use HomepageScrollerUpdater\Includes\Activation;
use HomepageScrollerUpdater\Admin\AddTableInDB;


function HSL_Activation()
{
	$tables = new AddTableInDB();
	$tables->table_slider();
}
register_activation_hook(__FILE__, 'HSL_Activation');

new Activation();
