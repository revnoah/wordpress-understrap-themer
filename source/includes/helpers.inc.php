<?php

/**
 * Added classes based on settings
 *
 * @return string[] classes
 */
function enhanced_body_class_get_classes() {
	$classes = [];
	$current_user = wp_get_current_user();
	$user_role = _enhanced_body_class_get_user_role($current_user);
	$user_name = _enhanced_body_class_get_user_name($current_user);
	$user_id = _enhanced_body_class_get_user_id($current_user);

	if($user_role) {
		$classes = $user_role;
	}
	if($user_name) {
		$classes[] = $user_name;
	}
	if($user_id) {
		$classes[] = $user_id;
	}

	return $classes;
}

/**
 * Load CSS template file, if present in template directory
 *
 * @param string $template_name css file to look for, load in theme folder
 * @return void
 */
function enhanced_body_class_load_css($template_name) {
	$template = locate_template($template_name . '.css', false);
	if ($template) {
		wp_enqueue_style(
			$template_name, 
			get_template_directory_uri() . '/' . $template_name . '.css'
		);
	}
}

/**
 * Load javascript file, if present in template directory
 *
 * @param string $template_name js file to look for, load in theme folder
 * @return void
 */
function enhanced_body_class_load_script($template_name) {
	$template = locate_template($template_name . '.js', false);
	if ($template) {
		wp_enqueue_script(
			$template_name . '-js', 
			get_template_directory_uri() . '/' . $template_name . '.js',
			array(), 
			null, 
			true 
		);
	}
}

/**
 * Get role
 *
 * @param WP_User $current_user WordPress user returned from current_user()
 * @return string[]
 */
function _enhanced_body_class_get_user_role($current_user) {
	$classes = [];
	$enhanced_body_class_add_roles 
		= get_option('enhanced_body_class_add_roles', true);

	if($enhanced_body_class_add_roles) {
		foreach ($current_user->roles as $role) {
			$classes[] = 'user-role-' . $role;
		}
	}

	return $classes;
}

/**
 * Get user name
 *
 * @param WP_User $current_user WordPress user returned from current_user()
 * @return string
 */
function _enhanced_body_class_get_user_name($current_user) {
	$classes = '';
	$enhanced_body_class_add_user_name 
		= get_option('enhanced_body_class_add_user_name', false);

	if ($enhanced_body_class_add_user_name) {
		return 'user-name-' . $current_user->display_name;
	}
	
	return false;
}

/**
 * Get user ID
 *
 * @param WP_User $current_user WordPress user returned from current_user()
 * @return string
 */
function _enhanced_body_class_get_user_id($current_user) {
	$enhanced_body_class_add_user_id 
		= get_option('enhanced_body_class_add_user_id', false);

	if ($enhanced_body_class_add_user_id) {
		return 'user-id-' . $current_user->ID;
	}
	
	return false;
}
