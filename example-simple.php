<?php
class MGR_Subhead_Meta extends MGR_Meta_Field {
	static $instance;

	protected function __construct() {
		$this->meta_key = $this->input_field_name = '_mgr_subheadline';

		$this->post_types = array(
			'post',
			'page',
		);
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
		?>
		<div>
			<label for="<?php echo $this->input_field_name; ?>">Subheadline</label>:
			<textarea name="<?php echo $this->input_field_name; ?>" id="<?php echo $this->input_field_name; ?>" class="widefat"><?php echo esc_textarea($val); ?></textarea>
		</div>
		<?php
	}

	function sanitize_val() {
		return wp_filter_post_kses($_POST[$this->input_field_name]);
	}
}
MGR_Subhead_Meta::factory()->add_actions();
