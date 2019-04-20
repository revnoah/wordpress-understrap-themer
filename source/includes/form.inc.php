<?php

/**
 * Get formatted field
 *
 * @param array $setting Array element from settings
 * @return string
 */
function enhanced_body_class_get_formatted_field($setting) {
	$output = '';

	//get field parts
	$label = enhanced_body_class_get_label($setting);
	$description = enhanced_body_class_get_description($setting);
	$field = enhanced_body_class_get_field($setting);

	//output row
	$output = '<tr valign="top">';
	if($setting['type'] === 'boolean') {
		//place checkboxes to the left of the label
		$output .= '<th colspan="2">';
		$output .= $field . $label;
		if($description !== '') {
			$output .= '<br />';
			$output .= $description;
		}
		$output .= '</th>';
	} else {
		//align other fields to column cells
		$output .= '<th>';
		$output .= $label;
		$output .= '</th>';
		$output .= '<td>';
		$output .= $field;
		if($description !== '') {
			$output .= '<br />';
			$output .= $description;
		}
		$output .= '</td>';
	}
	$output .= '</tr>';

	return $output;
}

/**
 * Get field
 *
 * @param array $setting Array element from settings
 * @return string
 */
function enhanced_body_class_get_field($setting) {
	$output = '';

	if ($setting['type'] === 'boolean') {
		$output .= enhanced_body_class_get_checkbox($setting);
	} elseif ($setting['type'] === 'text') {
		$output .= enhanced_body_class_get_text($setting);
	}

	return $output;
}

/**
 * Get label
 *
 * @param array $setting Array element from settings
 * @return string
 */
function enhanced_body_class_get_label($setting) {
	$output = '<label for="' . $setting['id'] . '">' 
		. $setting['label'] . '</label>';

	return $output;
}

/**
 * Get description
 *
 * @param array $setting Array element from settings
 * @return string
 */
function enhanced_body_class_get_description($setting) {
	if ($setting['description'] != '') {
		return '<small style="font-weight: 400;">' 
			. $setting['description'] 
			. '</small>';
	}

	return '';
}

/**
 * Get Checkbox
 *
 * @param array $setting Array of field settings
 * @return string
 */
function enhanced_body_class_get_checkbox($setting) {
	$output = '<input type="checkbox" id="' . $setting['id'] 
	. '" name="' . $setting['id'] . '" ' 
	. ($setting['saved'] === 'on' ? 'checked' : '');
	$output .= _enhanced_body_class_get_data($setting);
	$output .= '/>';

	return $output;
}

/**
 * Get Text Field
 *
 * @param array $setting Array of field settings
 * @return string
 */
function enhanced_body_class_get_text($setting) {
	$output = '<input type="text" id="' . $setting['id'] 
		. '" name="' . $setting['id'] 
		. '" class="form-control"';
	$output .= _enhanced_body_class_get_data($setting);
	$output .= ' value="' . $setting['saved'] 
		. '" />';

	return $output;
}

/**
 * Get data from settings
 *
 * @param array $setting Array of field settings 
 * @return string
 */
function _enhanced_body_class_get_data($setting) {
	if (!isset($setting['data']) || count($setting['data']) === 0) {
		return '';
	}

	$output = ' data-' . implode(' data-', $setting['data']);

	return $output;
}
