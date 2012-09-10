<?php
class MGR_Magazine_Section_Meta extends MGR_Meta {
	static $instance;

	protected function __construct() {
		$this->meta_key = $this->input_field_name = '_mgr_magazine_section';

		$this->post_types = array(
			'page',

		);
	}

	function factory() {
		if (!isset(self::$instance)) {
			$classname = __CLASS__;
			self::$instance = new $classname;
		}
		return self::$instance;
	}

	/**
	 * Outputs the HTML for the field
	 *
	 * @param string $post_type
	 * @param object $post_obj
	 * @return void
	 */
	function output_field($post_obj) {
		$val = get_post_meta($post_obj->ID, $this->meta_key, true);
		echo '<div>';

        $parent = get_page_by_title('Magazines');

        wp_dropdown_pages(array(
			'child_of' => $parent->ID,
			'selected' => $val,
			'name' => $this->input_field_name,
			'show_option_none' => 'Please Select A Magazine Section',
			'option_none_value' => 0
		));

		echo '</div>';
	}

    function is_proper_post_type($post_obj) {

        $parent = get_page_by_title('Magazines');
        if(in_array($post_obj->post_type, $this->post_types) && $post_obj->post_parent == $parent->ID) {
		    return in_array($post_obj->post_type, $this->post_types);
        }
	}

    function maybe_output_field($post_obj) {
		if ($this->is_proper_post_type($post_obj)) {
			$this->output_field($post_obj);
		}
	}

	function sanitize_val() {
		return wp_filter_post_kses($_POST[$this->input_field_name]);
	}
}
MGR_Magazine_Section_Meta::factory()->add_actions();
