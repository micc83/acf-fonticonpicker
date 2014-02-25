<?php

class acf_field_fonticonpicker extends acf_field {

	// Vars
	var $settings, 		// Will hold info such as dir / path
		$defaults,		// Will hold default field options
		$json_content; 	// Hold the content of icons JSON config file

	/**
	 *  __construct
	 *
	 *  @since	1.0.0
	 */
	function __construct() {
		
		// Vars
		$this->name = 'fonticonpicker';
		$this->label = __('Font Icon Picker');
		$this->category = __("Choice", 'acf');

    	parent::__construct();

    	// Settings
		$this->settings = array(
			'path' 		=> apply_filters('acf/helpers/get_path', __FILE__),
			'dir' 		=> apply_filters('acf/helpers/get_dir', __FILE__),
			'version' 	=> '1.0.0'
		);

		// Register icons style
		wp_register_style( 'acf-fonticonpicker-icons', $this->settings['dir'] . 'icons/css/fontello.css' );
		
		// Enqueue icons style in the frontend
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_enqueue' ) );

		// Load icons list from the icons JSON file
		if ( is_admin() ){
			$json_file = @file_get_contents( $this->settings['path'] . 'icons/config.json' );
			$this->json_content = @json_decode( $json_file, true );
		}

	}
	
	/**
	 *  frontend_enqueue()
	 *
	 *  @since	1.0.0
	 */
	function frontend_enqueue() {
		wp_enqueue_style( 'acf-fonticonpicker-icons' );
	}

	/**
	 *  create_field()
	 *
	 *  @param	$field - An array holding all the field's data
	 *
	 *  @since	1.0.0
	 */
	function create_field( $field ) {
		
		if ( !isset( $this->json_content['glyphs'] ) ){
			_e('No icons found');
			return;
		}

		// icons SELECT input
		echo '<select name="'. $field['name'] .'" id="'. $field['name'] .'" class="acf-iconpicker">';
		echo '<option value="">'. __('None').'</option>';
		foreach ( $this->json_content['glyphs'] as $glyph ) {
			$glyph_full = $this->json_content['css_prefix_text'] . $glyph['css'];
			echo '<option value="'. $glyph_full .'" '. selected( $field['value'], $glyph_full, false ) .'>'. $glyph['css'] .'</option>';
		}
		echo '</select>';
		
	}


	/**
	 *  input_admin_enqueue_scripts()
	 *
	 *  @since	1.0.0
	 */
	function input_admin_enqueue_scripts() {
	
		// Scripts
		wp_register_script( 'acf-fonticonpicker', $this->settings['dir'] . 'js/jquery.fonticonpicker.min.js', array('jquery'), $this->settings['version'] );
		wp_register_script( 'acf-fonticonpicker-input', $this->settings['dir'] . 'js/input.js', array('acf-fonticonpicker'), $this->settings['version'] );
		wp_enqueue_script( 'acf-fonticonpicker-input' );
		
		// Styles
		wp_register_style( 'acf-fonticonpicker-style', $this->settings['dir'] . 'css/jquery.fonticonpicker.min.css', false, $this->settings['version'] );
		wp_enqueue_style( 'acf-fonticonpicker-style' );

	}


	/**
	 *  input_admin_head()
	 *
	 *  @since	1.0.0
	 */
	function input_admin_head() {
		wp_enqueue_style( 'acf-fonticonpicker-icons' );
	}

} // Class acf_field_fonticonpicker

// create field
new acf_field_fonticonpicker();