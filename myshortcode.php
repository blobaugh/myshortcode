<?php
/*
Plugin Name: My Shortcode Demo
Plugin URI: https://github.com/blobaugh/myshortcode
Description: Example shortcode that dynamically adds javascript to wp_foot if the shortcode is used
Author: Ben Lobaugh
Version: 0.6
Author URI: http://ben.lobaugh.net
*/




class My_Shortcode {
	static $add_script;

	static function init() {
		add_shortcode('myshortcode', array(__CLASS__, 'handle_shortcode'));

		add_action('init', array(__CLASS__, 'register_script'));
		add_action('wp_footer', array(__CLASS__, 'print_script'));
	}

	static function handle_shortcode($atts) {
		self::$add_script = true;

		// actual shortcode handling here
	}

	static function register_script() {
		wp_register_script('my-script', plugins_url('my-script.js', __FILE__), array('jquery'), '1.0', true);
	}

	static function print_script() {
		if ( ! self::$add_script )
			return;

		wp_print_scripts('my-script');
	}
}

My_Shortcode::init();