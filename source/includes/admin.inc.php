<?php

/**
 * Define settings fields
 *
 * @return array
 */
function enhanced_body_class_settings_fields() {
	$settings = [
		'id' => 'enhanced_body_class',
		'kabob' => 'enhanced-body-class',
		'label' => __('Enhanced Body Class'),
		'settings' => [
			[
				'id' => 'enhanced_body_class_add_roles',
				'label' => __('Add User Role'),
				'description' => 
					__('Add a class to the body tag for the current user\'s role'),
				'type' => 'boolean',
				'default' => true
			], [
				'id' => 'enhanced_body_class_add_user_name',
				'label' => __('Add Username'),
				'description' => 
					__('Add a class to the body tag for the current user\'s username'),
				'type' => 'boolean',
				'default' => false
			], [
				'id' => 'enhanced_body_class_add_user_id',
				'label' => __('Add User ID'),
				'description' => 
					__('Add a class to the body tag for the current user\'s ID'),
				'type' => 'boolean',
				'default' => false
			], [
				'id' => 'enhanced_body_class_active_frontend',
				'label' => __('Active On Frontend'),
				'description' => 
					__('Active on the frontend of the website'),
				'type' => 'boolean',
				'default' => false
			], [
				'id' => 'enhanced_body_class_active_admin',
				'label' => __('Active On Backend/Admin'),
				'description' => 
					__('Active on the backend or admin pages'),
				'type' => 'boolean',
				'default' => true
			]
		]
	];

	return $settings;
}


/**
 * action admin_menu
 */
add_action('admin_menu', 'enhanced_body_class_create_menu');

/**
 * Create admin menu item
 *
 * @return void
 */
function enhanced_body_class_create_menu() {
	add_submenu_page(
		'options-general.php',
		'Enhanced Body Class',
		'Enhanced Body Class',
		'administrator',
		__FILE__,
		'enhanced_body_class_admin',
		plugins_url('/images/icon.png', __FILE__)
	);
}

/**
 * action admin_init
 */
add_action('admin_init', 'enhanced_body_class_settings');

/**
 * Register custom settings
 *
 * @return void
 */
function enhanced_body_class_settings() {
	$settings = enhanced_body_class_settings_fields();

	//register settings
	foreach ($settings['settings'] as $setting) {
		if (!isset($setting['id'])) {
			print_r($setting);
			die;
		}

		register_setting($settings['kabob'] . '-settings-group', $setting['id']);
	}	
}

/**
 * Admin settings
 *
 * @return void
 */
function enhanced_body_class_admin() {
	//load user settings
	$settings = enhanced_body_class_settings_fields();
	?>
	<div class="wrap">
	<h1><?php echo $settings['label']; ?></h1>

	<form method="post" action="options.php">
		<?php settings_fields($settings['kabob'] . '-settings-group'); ?>
		<?php do_settings_sections($settings['kabob'] . '-settings-group'); ?>

		<table class="form-table">
			<?php
			foreach ($settings['settings'] as $setting) {
				$setting['saved'] = get_option($setting['id'], $setting['default']);
				echo enhanced_body_class_get_formatted_field($setting);
				?>
			<?php
			}
			?>
		</table>

		<?php submit_button(); ?>
	</form>

</div>
<?php
}
