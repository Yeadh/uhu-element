<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://ThemeBeyond.com
 * @since             1.0.0
 * @package           Uhu_Element
 *
 * @wordpress-plugin
 * Plugin Name:       Uhu Element
 * Plugin URI:        https://ThemeBeyond.com/mega-addons-for-elementor
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            ThemeBeyond
 * Author URI:        https://ThemeBeyond.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       uhu
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class uhu {

	function __construct() {
		$this->load_plugin_textdomain();
		$this->load_dependencies();
		$this->uhu_setup();
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

	}

	public function uhu_setup() {
		add_image_size( 'uhu-77x64', 77,64, true );
		add_image_size( 'uhu-100x75', 100,75, true );
	}

	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'mega-addons', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/' );
	}

	public function enqueue_scripts() {
		wp_register_script( 'uhu-plugin-main-js', plugin_dir_url( __FILE__ ) . 'public/assets/js/main.js' );

		wp_enqueue_style( 'uhu-plugin-style' );
		wp_enqueue_script( 'uhu-plugin-main-js' );
	}

	public function admin_scripts() {
	    wp_enqueue_media();
	    wp_enqueue_script('uhu-admin-main-js', plugin_dir_url( __FILE__ ) . 'admin/assets/js/main.js', array('jquery'), wp_get_theme()->get( 'Version' ), true );
	}

	private function load_dependencies() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/elementor/elementor.php';
		require_once plugin_dir_path( __FILE__ ) . 'includes/recent-post.php';
		require_once plugin_dir_path( __FILE__ ) . 'includes/author-widget.php';
		require_once plugin_dir_path( __FILE__ ) . 'includes/social-share.php';
	}

}
new uhu();