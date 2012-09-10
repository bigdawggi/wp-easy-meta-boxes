<?php

/**
 * Provides template for unique post meta fields
 */
abstract class MGR_Meta_Field {

	function add_actions() {
		add_filter('mgr_custom_meta_box_types', array($this, 'add_post_type'));
		add_action('mgr_custom_meta_boxes', array($this, 'maybe_output_field'));
		add_action('mgr_custom_meta_box_save_post', array($this, 'save_field'), null, 2);
	}

	/**
	 * Ensure our post types have the aim custom meta box available
	 *
	 * @param array $types
	 * @return array
	 */
	function add_post_type($types) {
		if (is_array($this->post_types)) {
			return array_merge($types, array_diff($this->post_types, $types));
		}
		else {
			return $types;
		}
	}

	function get_meta($post_id) {
		return get_post_meta($post_id, $this->meta_key, true);
	}

	function save_field($post_id, $post_obj) {
		if (in_array($post_obj->post_type, $this->post_types)) {
			update_post_meta($post_id, $this->meta_key, $this->sanitize_val());
		}
	}

	/**
	 * Checks to see if we're on the right type of page
	 *
	 * @param obj $post_obj
	 * @return void
	 * @author Matthew Richmond
	 */
	function is_proper_post_type($post_obj) {
		return in_array($post_obj->post_type, $this->post_types);
	}

	/**
	 * Outputs the field *IF* we're on the right type of edit page
	 *
	 * @param obj $post_obj
	 * @return void
	 */
	function maybe_output_field($post_obj) {
		if ($this->is_proper_post_type($post_obj)) {
			$this->output_field($post_obj);
		}
	}
}
