<?php
/**
 * @package  WfeElementor
 */

namespace Wfe\Base;

class Activate extends BaseController {
	public static function activate() {
		flush_rewrite_rules();

		$option_name = 'wfe_elementor';

		if ( get_option( $option_name ) ) {
			return;
		}

		$default = array(
			'heading',
			'infobox',
			'services',
			'textseparator',
			'splittext',
			'flipbox',
			'fancytext',
			'banner',
			'pricing',
			'modal',
			'shapedivider',
			'twitterfeed',
			'tooltip',
			'datatable',
			'vubonhovereffects',
			'ultimatebutton',
			'teamshowcase',
			'listproduct',
			'testimonial',
			'moderntestimonial',
			'calltoaction',
			'imagecomparison',
			'imagehotspot',
			'preloader',
		);

		$default_settings = array_fill_keys( $default, true );

		if ( get_option( $option_name ) !== false ) {

			// The option already exists, so update it.
			update_option( $option_name, $default_settings );

		} else {

			// The option hasn't been created yet, so add it with $autoload set to 'no'.
			$deprecated = null;
			$autoload   = 'no';
			add_option( $option_name, $default_settings, $deprecated, $autoload );

		}
	}
}