<?php
/**
 * @package UnderstrapThemer
 * @version 1.0.0
 */

/*
Plugin Name: Understrap Themer
Plugin URI: https://github.com/revnoah/wordpress-understrap-themer#readme
Description: Plugin to download a customized understrap-based child theme
Author: Noah Stewart
Version: 1.0.0
Author URI: http://noahjstewart.com/
*/

//load required includes
require_once realpath(__DIR__) . '/includes/helpers.inc.php';
require_once realpath(__DIR__) . '/includes/form.inc.php';
require_once realpath(__DIR__) . '/includes/admin.inc.php';

//register rewrite hook
register_activation_hook(__FILE__, 'understrap_themer_rewrite_activation');
register_deactivation_hook(__FILE__, 'understrap_themer_rewrite_activation');

/**
 * Handle rewrite rules
 *
 * @return void
 */
function understrap_themer_rewrite_activation(){
	flush_rewrite_rules();
}

/**
 * Initiate filter for body class on frontend and backend
 */
add_filter('admin_body_class', 'understrap_themer_admin_body_class');
add_filter('body_class', 'understrap_themer_frontend_body_class');

/**
 * Add class to body tag on admin pages
 *
 * @param string $classes Space-delimited list of classes
 * @return string
 */
function understrap_themer_admin_body_class($classes){
	$understrap_themer_active_admin = get_option(
		'understrap_themer_active_admin', true
	);

	if ($understrap_themer_active_admin) {
		//load and concatenate imploded classes
		$new_classes = understrap_themer_get_classes();
		$classes .= implode(' ', $new_classes);

		//defined css template and load
		$template_name = 'enhanced-body-class-admin';
		understrap_themer_load_css($template_name);
		understrap_themer_load_script($template_name);
	}

	return $classes;
}

/**
 * Add class to body tag on frontend themes
 *
 * @param array $classes Array of classes
 * @return array
 */
function understrap_themer_frontend_body_class($classes) {
	$understrap_themer_active_frontend = get_option(
		'understrap_themer_active_frontend', false
	);

	if ($understrap_themer_active_frontend) {
		//load and merge classes
		$new_classes = understrap_themer_get_classes();
		$classes = array_merge($classes, $new_classes);

		//defined css template and load
		$template_name = 'enhanced-body-class-frontend';
		understrap_themer_load_css($template_name);
		understrap_themer_load_script($template_name);
	}

	return $classes;
}
