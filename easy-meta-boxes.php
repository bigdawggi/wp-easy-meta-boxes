<?php
/*
Plugin Name: MGR Easy Meta Boxes
Plugin URI: https://github.com/bigdawggi/wp-easy-meta-boxes
Description: Enables you to easily add meta fields to a custom meta box.
Version: 0.1
Author: Matthew Richmond
Author URI: http://matthewgrichmond.com
*/

// You may want to include your field files that extend MGR_Meta_Field at the 'init' hook, so you don't get into a race conditions.

// Meta Boxes only need to hook in the admin.
if (is_admin()) {
	require_once 'lib/class.mgr-custom-meta-box.php';
	require_once 'lib/class.mgr-meta-field.php';
	MGR_Custom_Meta_Box::factory()->add_actions();
}
