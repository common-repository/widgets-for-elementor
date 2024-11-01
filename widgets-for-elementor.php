<?php
/**
 * @package  WfeElementor
 */
/*
Plugin Name: Widgets For Elementor
Description: Best Addon for Elementor WordPress Plugin​ with Most of the Popular Elements that you need for everyday use in website page building. Development of the Element Pack addon for Elementor has the world’s best practices in code standard and meets proper validation using the latest CSS, HTML5 and PHP 7.x technology to bring you a professional addon for the Elementor Page Builder Plugin that is WordPress 4.9.x​ ready (Also tested with version 5.0.0) and compliant.
Author: maxster
Version: 1.0.7
Requires at least: 3.8
Tested up to:      4.9.8
Author URI: http://codecans.com
License: GPL2
Text Domain: wfe_elementor
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// prevent direct access
defined( 'ABSPATH' ) or die( 'Hey, you can\t access this file, you silly human!' );

// Vendor Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

//The code that runs during plugin activation
function activate_wfe_plugin() {
	Wfe\Base\Activate::activate();
}

register_activation_hook( __FILE__, 'activate_wfe_plugin' );


//The code that runs during plugin deactivation
function deactivate_wfe_plugin() {
	Wfe\Base\Deactivate::deactivate();
}

register_deactivation_hook( __FILE__, 'deactivate_wfe_plugin' );


//The code that runs during plugin Uninstall
function uninstall_wfe_plugin() {
	Wfe\Base\Uninstall::uninstall();
}

register_uninstall_hook( __FILE__, 'uninstall_wfe_plugin' );


// Redirect Settings Page After Plugin Activation
function wfe_activation_redirect( $plugin ) {
	if ( $plugin == plugin_basename( __FILE__ ) ) {
		exit( wp_redirect( admin_url( 'admin.php?page=wfe_elementor' ) ) );
	}
}

add_action( 'activated_plugin', 'wfe_activation_redirect' );


// Register ALL Services
if ( class_exists( 'Wfe\\Init' ) ) {
	Wfe\Init::register_services();
}

function wfe_ccn_widgets_reg() {

	if ( class_exists( 'Wfe\\Widgets' ) ) {
		Wfe\Widgets::register_services();
	}
}

add_action( 'elementor/widgets/widgets_registered', 'wfe_ccn_widgets_reg' );