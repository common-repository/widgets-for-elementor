<?php
/**
 * @package  WfeElementor
 */
namespace Wfe\Base;

class Enqueue extends BaseController {
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'front_enqueue' ) );
	}

	public function admin_enqueue() {
		//admin enqueue scripts
		wp_enqueue_style( 'wfe_fontawesome_load_admin', 'https://use.fontawesome.com/releases/v5.0.10/css/all.css' );

		//wp_enqueue_style( 'prime_admin_font_css', $this->plugin_url . 'assets/fonts/css/fontawesome-all.min.css' );

		wp_enqueue_style( 'wfe_param_css', $this->plugin_url . 'assets/css/params.min.css' );

		wp_enqueue_style( 'wfe_admin_css', $this->plugin_url . 'assets/css/adminstyle.css' );

		wp_enqueue_script( 'wfe-admin-js', $this->plugin_url . 'assets/js/adminscript.min.js', array( 'jquery' ), '', true );

		wp_enqueue_script( 'wfe-params-js', $this->plugin_url . 'assets/js/params.min.js', array( 'jquery' ), '', true );

	}

	//wp/front enqueue scripts
	public function front_enqueue() {
		wp_enqueue_style( 'wfe_bootstrap_load', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' );

		//wp_enqueue_style( 'prime_fontawesome_load', 'https://use.fontawesome.com/releases/v5.0.10/css/all.css' );
		//wp_enqueue_style( 'prime_front_font_css', $this->plugin_url . 'assets/fonts/css/fontawesome-all.min.css' );
		wp_enqueue_style( 'wfe-extensions-css', $this->plugin_url . 'assets/css/widgets.min.css' );

		wp_enqueue_script( 'wfe-elementor-js', $this->plugin_url . 'assets/js/widgets.min.js', array( 'jquery' ), '', false );
	}
}