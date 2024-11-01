<?php
/**
 * @package  WfeElementor
 */
namespace Wfe\Base;

class BaseController {
	public $plugin_path;

	public $plugin_url;

	public $plugin;

	public $shortcodes = array();

	//For PHP Lower Version - Get Path
	public function cstm_dirname( $path, $count = 1 ) {
		if ( $count > 1 ) {
			return dirname( $this->cstm_dirname( $path, -- $count ) );
		} else {
			return dirname( $path );
		}
	}

	public function __construct() {
		$this->plugin_path = plugin_dir_path( $this->cstm_dirname( __FILE__, 2 ) );
		$this->plugin_url  = plugin_dir_url( $this->cstm_dirname( __FILE__, 2 ) );
		$this->plugin      = plugin_basename( $this->cstm_dirname( __FILE__, 3 ) ) . '/widgets-for-elementor.php';

//		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
//		$this->plugin_url  = plugin_dir_url( dirname( __FILE__, 2 ) );
//		$this->plugin      = plugin_basename( dirname( __FILE__, 3 ) ) . '/prime-extensions-vc-pro.php';

		/*-----------------------------------------------------------------------------------*/
		/*	Initalising Shortcodes In Content and Widget
		/*-----------------------------------------------------------------------------------*/
		add_filter( 'widget_text', 'do_shortcode' );
		add_filter( 'the_content', 'do_shortcode' );
		add_filter( 'the_excerpt', 'do_shortcode' );


		$this->shortcodes = array (
			'heading'      => 'Heading',
			'infobox'      => 'Info Box',
			'services'      => 'Services',
			'textseparator'      => 'Text Separator',
			'splittext'      => 'Split Text',
			'flipbox'      => 'Flip Box',
			'fancytext'      => 'Fancy Text',
			'banner'      => 'Banner',
			'pricing'      => 'Pricing Table',
			'modal'      => 'Modal',
			'shapedivider'      => 'Spape Divider',
			'twitterfeed'      => 'Twitter Feed',
			'tooltip'      => 'Tooltip',
			'datatable'      => 'Data Table',
			'vubonhovereffects'      => 'Vubon Hover Effects',
			'ultimatebutton'      => 'Ultimate Button',
			'teamshowcase'      => 'Team Showcase',
			'listproduct'      => 'List Product',
			'testimonial'      => 'Testimonial',
			'moderntestimonial'      => 'Modern Testimonial',
			'calltoaction'      => 'Call To Action',
			'imagecomparison'      => 'Image Comparison',
			'imagehotspot'      => 'Image Hotspot',
			'preloader'      => 'Preloader',
		);

	}

	public function activated( $key ) {
		$option = get_option( 'wfe_elementor' );

		return isset( $option[ $key ] ) ? $option[ $key ] : false;
	}
}