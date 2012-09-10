<?php
/**
 * Registers and provides a wrapping meta box for our meta field
 */
class MGR_Custom_Meta_Box {

	static $instance;

	private function __construct() {
		/* Define what our "action" is that we'll
		listen for in our request handlers */
		$this->action = 'mgr_custom_metabox_action';
	}

	function factory() {
		if (!isset(self::$instance)) {
			self::$instance = new MGR_Custom_Meta_Box;
		}
		return self::$instance;
	}

	function add_actions() {
		add_action('add_meta_boxes', array($this, 'add_meta_box_for_post_types'));
		add_action('save_post', array($this, 'save_post_action'), null, 2);
	}

	function add_meta_box_for_post_types() {
		$types = apply_filters('mgr_custom_meta_box_types', array(
			'post',
		));
		foreach ($types as $type) {
			// @TODO allow custom names for meta boxes
			add_meta_box('mgr_custom_meta', 'MGR Custom Meta', array($this, 'output_custom_meta_box'), $type, 'normal');
		}

	}

	function output_custom_meta_box($post_obj, $callback_array) {
		// @TODO output nonce fields
		do_action('mgr_custom_meta_boxes', $post_obj);
	}

	function save_post_action($post_id, $post_obj) {
		// @TODO validate nonce here
		if (1) {
			do_action('mgr_custom_meta_box_save_post', $post_id, $post_obj);
		}
	}
}
