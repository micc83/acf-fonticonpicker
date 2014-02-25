<?php
/*
Plugin Name: Advanced Custom Fields: FontIconPicker
Plugin URI: http://codeb.it/fonticonpicker
Description: A simple Font Icons Picker for ACF
Version: 1.0.0
Author: Alessandro Benoit
Author URI: http://codeb.it/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
class acf_field_fonticonpicker_plugin {

	/**
	 *  Construct
	 *
	 *  @since: 1.0.0
	 */
	function __construct() {

		// Version 4+
		add_action('acf/register_fields', array($this, 'register_fields'));

	}

	/**
	 *  register_fields()
	 *
	 *  @since: 1.0.0
	 */
	function register_fields() {
		include_once('fonticonpicker-v4.php');
	}

} // Class acf_field_fonticonpicker_plugin

new acf_field_fonticonpicker_plugin();