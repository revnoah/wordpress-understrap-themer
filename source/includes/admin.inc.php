<?php

/**
 * Define settings fields
 *
 * @return array
 */
function understrap_themer_settings_fields() {
	$settings = [
		'id' => 'understrap_themer',
		'kabob' => 'understrap-themer',
		'label' => __('Understrap Themer'),
		'settings' => [
			[
				'id' => 'understrap_themer_add_roles',
				'label' => __('Add User Role'),
				'description' => 
					__('Add a class to the body tag for the current user\'s role'),
				'type' => 'boolean',
				'default' => true
			], [
				'id' => 'understrap_themer_add_user_name',
				'label' => __('Add Username'),
				'description' => 
					__('Add a class to the body tag for the current user\'s username'),
				'type' => 'boolean',
				'default' => false
			], [
				'id' => 'understrap_themer_add_user_id',
				'label' => __('Add User ID'),
				'description' => 
					__('Add a class to the body tag for the current user\'s ID'),
				'type' => 'boolean',
				'default' => false
			], [
				'id' => 'understrap_themer_active_frontend',
				'label' => __('Active On Frontend'),
				'description' => 
					__('Active on the frontend of the website'),
				'type' => 'boolean',
				'default' => false
			], [
				'id' => 'understrap_themer_active_admin',
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
add_action('admin_menu', 'understrap_themer_create_menu');

/**
 * Create admin menu item
 *
 * @return void
 */
function understrap_themer_create_menu() {
	add_submenu_page(
		'options-general.php',
		'Understrap Themer',
		'Understrap Themer',
		'administrator',
		__FILE__,
		'understrap_themer_admin',
		plugins_url('/images/icon.png', __FILE__)
	);
}

/**
 * action admin_init
 */
add_action('admin_init', 'understrap_themer_settings');

/**
 * Register custom settings
 *
 * @return void
 */
function understrap_themer_settings() {
	$settings = understrap_themer_settings_fields();

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
function understrap_themer_admin() {
	//load user settings
	$settings = understrap_themer_settings_fields();
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
				echo understrap_themer_get_formatted_field($setting);
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
