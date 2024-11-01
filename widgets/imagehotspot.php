<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_hotspot extends Widget_Base {

	public function get_name() {
		return 'wfe_image_hotspot';
	}

	/**
	 * Retrieve image hotspots widget title.
	 */
	public function get_title() {
		return __( 'Image Hotspots', 'wfe-image-hotspot' );
	}

	/**
	 * Retrieve the list of categories the image hotspots widget belongs to.
	 */

	/**
	 * Retrieve image hotspots widget icon.
	 */
	public function get_icon() {
		return 'eicon-image-hotspot';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	/**
	 * Register image hotspots widget controls.
	 */
	protected function _register_controls() {

		/*-----------------------------------------------------------------------------------*/
		/*	CONTENT TAB
		/*-----------------------------------------------------------------------------------*/

		/**
		 * Content Tab: Image
		 */
		$this->start_controls_section(
			'section_image',
			[
				'label'                 => __( 'Image', 'wfe-image-hotspot' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label'                 => __( 'Image', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::MEDIA,
				'default'               => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'                  => 'image',
				'label'                 => __( 'Image Size', 'wfe-image-hotspot' ),
				'default'               => 'full',
			]
		);

		$this->end_controls_section();

		/**
		 * Content Tab: Hotspots
		 */
		$this->start_controls_section(
			'section_hotspots',
			[
				'label'                 => __( 'Hotspots', 'wfe-image-hotspot' ),
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'hot_spots_tabs' );

		$repeater->start_controls_tab( 'tab_content', [ 'label' => __( 'Content', 'wfe-image-hotspot' ) ] );

		$repeater->add_control(
			'hotspot_type',
			[
				'label'           => __( 'Type', 'wfe-image-hotspot' ),
				'type'            => Controls_Manager::SELECT,
				'default'         => 'icon',
				'options'         => [
					'icon'  => __( 'Icon', 'wfe-image-hotspot' ),
					'text'  => __( 'Text', 'wfe-image-hotspot' ),
					'blank' => __( 'Blank', 'wfe-image-hotspot' ),
				],
			]
		);

		$repeater->add_control(
			'hotspot_icon',
			[
				'label'           => __( 'Icon', 'wfe-image-hotspot' ),
				'type'            => Controls_Manager::ICON,
				'default'         => 'fa fa-dot-circle-o',
				'condition'       => [
					'hotspot_type'   => 'icon',
				],
			]
		);

		$repeater->add_control(
			'hotspot_text',
			[
				'label'           => __( 'Text', 'wfe-image-hotspot' ),
				'type'            => Controls_Manager::TEXT,
				'label_block'     => true,
				'default'         => '#',
				'condition'       => [
					'hotspot_type'   => 'text',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'tab_position', [ 'label' => __( 'Position', 'wfe-image-hotspot' ) ] );

		$repeater->add_control(
			'left_position',
			[
				'label'         => __( 'Left Position', 'wfe-image-hotspot' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
						'step'	=> 0.1,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}%;',
				],
			]
		);

		$repeater->add_control(
			'top_position',
			[
				'label'         => __( 'Top Position', 'wfe-image-hotspot' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
						'step'	=> 0.1,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}%;',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'tab_tooltip', [ 'label' => __( 'Tooltip', 'wfe-image-hotspot' ) ] );

		$repeater->add_control(
			'tooltip',
			[
				'label'           => __( 'Tooltip', 'wfe-image-hotspot' ),
				'type'            => Controls_Manager::SWITCHER,
				'default'         => '',
				'label_on'        => __( 'Show', 'wfe-image-hotspot' ),
				'label_off'       => __( 'Hide', 'wfe-image-hotspot' ),
				'return_value'    => 'yes',
			]
		);

		$repeater->add_control(
			'tooltip_position_local',
			[
				'label'                 => __( 'Tooltip Position', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'global',
				'options'               => [
					'global'        => __( 'Global', 'wfe-image-hotspot' ),
					'top'           => __( 'Top', 'wfe-image-hotspot' ),
					'bottom'        => __( 'Bottom', 'wfe-image-hotspot' ),
					'left'          => __( 'Left', 'wfe-image-hotspot' ),
					'right'         => __( 'Right', 'wfe-image-hotspot' ),
					'top-left'      => __( 'Top Left', 'wfe-image-hotspot' ),
					'top-right'     => __( 'Top Right', 'wfe-image-hotspot' ),
					'bottom-left'   => __( 'Bottom Left', 'wfe-image-hotspot' ),
					'bottom-right'  => __( 'Bottom Right', 'wfe-image-hotspot' ),
				],
				'condition'       => [
					'tooltip'   => 'yes',
				],
			]
		);

		$repeater->add_control(
			'tooltip_content',
			[
				'label'           => __( 'Tooltip Content', 'wfe-image-hotspot' ),
				'type'            => Controls_Manager::WYSIWYG,
				'default'         => __( 'Tooltip Content', 'wfe-image-hotspot' ),
				'condition'       => [
					'tooltip'   => 'yes',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'hot_spots',
			[
				'label'                 => '',
				'type'                  => Controls_Manager::REPEATER,
				'default'               => [
					[
						'feature_text'    => __( 'Hotspot #1', 'wfe-image-hotspot' ),
						'feature_icon'    => 'fa fa-plus',
						'left_position'   => 20,
						'top_position'    => 30,
					],
				],
				'fields'                => array_values( $repeater->get_controls() ),
				'title_field'           => '{{{ hotspot_text }}}',
			]
		);

		$this->add_control(
			'hotspot_pulse',
			[
				'label'                 => __( 'Glow Effect', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => '',
				'label_on'              => __( 'Yes', 'wfe-image-hotspot' ),
				'label_off'             => __( 'No', 'wfe-image-hotspot' ),
				'return_value'          => 'yes',
			]
		);

		$this->add_control(
			'hotspot_pulse_effects',
			[
				'label'                 => __( 'Select Effects', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'hotspot-animation',
				'options'               => [
					'hotspot-animation'        => __( 'Normal', 'wfe-image-hotspot' ),
					'sq'           => __( 'SQ', 'wfe-image-hotspot' ),
					'morph'           => __( 'Morph', 'wfe-image-hotspot' ),
					'sonar'           => __( 'Sonar', 'wfe-image-hotspot' ),
					'slack'           => __( 'Slack', 'wfe-image-hotspot' ),
				],
				'condition'       => [
					'hotspot_pulse'   => 'yes',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Content Tab: Tooltip Settings
		 */
		$this->start_controls_section(
			'section_tooltip',
			[
				'label'                 => __( 'Tooltip Settings', 'wfe-image-hotspot' ),
			]
		);

		$this->add_control(
			'tooltip_arrow',
			[
				'label'                 => __( 'Show Arrow', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'yes',
				'label_on'              => __( 'Yes', 'wfe-image-hotspot' ),
				'label_off'             => __( 'No', 'wfe-image-hotspot' ),
				'return_value'          => 'yes',
			]
		);

		$this->add_control(
			'tooltip_size',
			[
				'label'                 => __( 'Size', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'default',
				'options'               => [
					'default'       => __( 'Default', 'wfe-image-hotspot' ),
					'tiny'          => __( 'Tiny', 'wfe-image-hotspot' ),
					'small'         => __( 'Small', 'wfe-image-hotspot' ),
					'large'         => __( 'Large', 'wfe-image-hotspot' )
				],
			]
		);

		$this->add_control(
			'tooltip_position',
			[
				'label'                 => __( 'Global Position', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'top',
				'options'               => [
					'top'           => __( 'Top', 'wfe-image-hotspot' ),
					'bottom'        => __( 'Bottom', 'wfe-image-hotspot' ),
					'left'          => __( 'Left', 'wfe-image-hotspot' ),
					'right'         => __( 'Right', 'wfe-image-hotspot' ),
					'top-left'      => __( 'Top Left', 'wfe-image-hotspot' ),
					'top-right'     => __( 'Top Right', 'wfe-image-hotspot' ),
					'bottom-left'   => __( 'Bottom Left', 'wfe-image-hotspot' ),
					'bottom-right'  => __( 'Bottom Right', 'wfe-image-hotspot' ),
				],
			]
		);

		$this->add_control(
			'tooltip_animation_in',
			[
				'label'                 => __( 'Animation In', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::SELECT2,
				'default'               => '',
				'options'               => [
					'bounce'            => __( 'Bounce', 'wfe-image-hotspot' ),
					'flash'             => __( 'Flash', 'wfe-image-hotspot' ),
					'pulse'             => __( 'Pulse', 'wfe-image-hotspot' ),
					'rubberBand'        => __( 'rubberBand', 'wfe-image-hotspot' ),
					'shake'             => __( 'Shake', 'wfe-image-hotspot' ),
					'swing'             => __( 'Swing', 'wfe-image-hotspot' ),
					'tada'              => __( 'Tada', 'wfe-image-hotspot' ),
					'wobble'            => __( 'Wobble', 'wfe-image-hotspot' ),
					'bounceIn'          => __( 'bounceIn', 'wfe-image-hotspot' ),
					'bounceInDown'      => __( 'bounceInDown', 'wfe-image-hotspot' ),
					'bounceInLeft'      => __( 'bounceInLeft', 'wfe-image-hotspot' ),
					'bounceInRight'     => __( 'bounceInRight', 'wfe-image-hotspot' ),
					'bounceInUp'        => __( 'bounceInUp', 'wfe-image-hotspot' ),
					'bounceOut'         => __( 'bounceOut', 'wfe-image-hotspot' ),
					'bounceOutDown'     => __( 'bounceOutDown', 'wfe-image-hotspot' ),
					'bounceOutLeft'     => __( 'bounceOutLeft', 'wfe-image-hotspot' ),
					'bounceOutRight'    => __( 'bounceOutRight', 'wfe-image-hotspot' ),
					'bounceOutUp'       => __( 'bounceOutUp', 'wfe-image-hotspot' ),
					'fadeIn'            => __( 'fadeIn', 'wfe-image-hotspot' ),
					'fadeInDown'        => __( 'fadeInDown', 'wfe-image-hotspot' ),
					'fadeInDownBig'     => __( 'fadeInDownBig', 'wfe-image-hotspot' ),
					'fadeInLeft'        => __( 'fadeInLeft', 'wfe-image-hotspot' ),
					'fadeInLeftBig'     => __( 'fadeInLeftBig', 'wfe-image-hotspot' ),
					'fadeInRight'       => __( 'fadeInRight', 'wfe-image-hotspot' ),
					'fadeInRightBig'    => __( 'fadeInRightBig', 'wfe-image-hotspot' ),
					'fadeInUp'          => __( 'fadeInUp', 'wfe-image-hotspot' ),
					'fadeInUpBig'       => __( 'fadeInUpBig', 'wfe-image-hotspot' ),
					'fadeOut'           => __( 'fadeOut', 'wfe-image-hotspot' ),
					'fadeOutDown'       => __( 'fadeOutDown', 'wfe-image-hotspot' ),
					'fadeOutDownBig'    => __( 'fadeOutDownBig', 'wfe-image-hotspot' ),
					'fadeOutLeft'       => __( 'fadeOutLeft', 'wfe-image-hotspot' ),
					'fadeOutLeftBig'    => __( 'fadeOutLeftBig', 'wfe-image-hotspot' ),
					'fadeOutRight'      => __( 'fadeOutRight', 'wfe-image-hotspot' ),
					'fadeOutRightBig'   => __( 'fadeOutRightBig', 'wfe-image-hotspot' ),
					'fadeOutUp'         => __( 'fadeOutUp', 'wfe-image-hotspot' ),
					'fadeOutUpBig'      => __( 'fadeOutUpBig', 'wfe-image-hotspot' ),
					'flip'              => __( 'flip', 'wfe-image-hotspot' ),
					'flipInX'           => __( 'flipInX', 'wfe-image-hotspot' ),
					'flipInY'           => __( 'flipInY', 'wfe-image-hotspot' ),
					'flipOutX'          => __( 'flipOutX', 'wfe-image-hotspot' ),
					'flipOutY'          => __( 'flipOutY', 'wfe-image-hotspot' ),
					'lightSpeedIn'      => __( 'lightSpeedIn', 'wfe-image-hotspot' ),
					'lightSpeedOut'     => __( 'lightSpeedOut', 'wfe-image-hotspot' ),
					'rotateIn'          => __( 'rotateIn', 'wfe-image-hotspot' ),
					'rotateInDownLeft'  => __( 'rotateInDownLeft', 'wfe-image-hotspot' ),
					'rotateInDownLeft'  => __( 'rotateInDownRight', 'wfe-image-hotspot' ),
					'rotateInUpLeft'    => __( 'rotateInUpLeft', 'wfe-image-hotspot' ),
					'rotateInUpRight'   => __( 'rotateInUpRight', 'wfe-image-hotspot' ),
					'rotateOut'         => __( 'rotateOut', 'wfe-image-hotspot' ),
					'rotateOutDownLeft' => __( 'rotateOutDownLeft', 'wfe-image-hotspot' ),
					'rotateOutDownLeft' => __( 'rotateOutDownRight', 'wfe-image-hotspot' ),
					'rotateOutUpLeft'   => __( 'rotateOutUpLeft', 'wfe-image-hotspot' ),
					'rotateOutUpRight'  => __( 'rotateOutUpRight', 'wfe-image-hotspot' ),
					'hinge'             => __( 'Hinge', 'wfe-image-hotspot' ),
					'rollIn'            => __( 'rollIn', 'wfe-image-hotspot' ),
					'rollOut'           => __( 'rollOut', 'wfe-image-hotspot' ),
					'zoomIn'            => __( 'zoomIn', 'wfe-image-hotspot' ),
					'zoomInDown'        => __( 'zoomInDown', 'wfe-image-hotspot' ),
					'zoomInLeft'        => __( 'zoomInLeft', 'wfe-image-hotspot' ),
					'zoomInRight'       => __( 'zoomInRight', 'wfe-image-hotspot' ),
					'zoomInUp'          => __( 'zoomInUp', 'wfe-image-hotspot' ),
					'zoomOut'           => __( 'zoomOut', 'wfe-image-hotspot' ),
					'zoomOutDown'       => __( 'zoomOutDown', 'wfe-image-hotspot' ),
					'zoomOutLeft'       => __( 'zoomOutLeft', 'wfe-image-hotspot' ),
					'zoomOutRight'      => __( 'zoomOutRight', 'wfe-image-hotspot' ),
					'zoomOutUp'         => __( 'zoomOutUp', 'wfe-image-hotspot' ),
				],
			]
		);

		$this->add_control(
			'tooltip_animation_out',
			[
				'label'                 => __( 'Animation Out', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::SELECT2,
				'default'               => '',
				'options'               => [
					'bounce'            => __( 'Bounce', 'wfe-image-hotspot' ),
					'flash'             => __( 'Flash', 'wfe-image-hotspot' ),
					'pulse'             => __( 'Pulse', 'wfe-image-hotspot' ),
					'rubberBand'        => __( 'rubberBand', 'wfe-image-hotspot' ),
					'shake'             => __( 'Shake', 'wfe-image-hotspot' ),
					'swing'             => __( 'Swing', 'wfe-image-hotspot' ),
					'tada'              => __( 'Tada', 'wfe-image-hotspot' ),
					'wobble'            => __( 'Wobble', 'wfe-image-hotspot' ),
					'bounceIn'          => __( 'bounceIn', 'wfe-image-hotspot' ),
					'bounceInDown'      => __( 'bounceInDown', 'wfe-image-hotspot' ),
					'bounceInLeft'      => __( 'bounceInLeft', 'wfe-image-hotspot' ),
					'bounceInRight'     => __( 'bounceInRight', 'wfe-image-hotspot' ),
					'bounceInUp'        => __( 'bounceInUp', 'wfe-image-hotspot' ),
					'bounceOut'         => __( 'bounceOut', 'wfe-image-hotspot' ),
					'bounceOutDown'     => __( 'bounceOutDown', 'wfe-image-hotspot' ),
					'bounceOutLeft'     => __( 'bounceOutLeft', 'wfe-image-hotspot' ),
					'bounceOutRight'    => __( 'bounceOutRight', 'wfe-image-hotspot' ),
					'bounceOutUp'       => __( 'bounceOutUp', 'wfe-image-hotspot' ),
					'fadeIn'            => __( 'fadeIn', 'wfe-image-hotspot' ),
					'fadeInDown'        => __( 'fadeInDown', 'wfe-image-hotspot' ),
					'fadeInDownBig'     => __( 'fadeInDownBig', 'wfe-image-hotspot' ),
					'fadeInLeft'        => __( 'fadeInLeft', 'wfe-image-hotspot' ),
					'fadeInLeftBig'     => __( 'fadeInLeftBig', 'wfe-image-hotspot' ),
					'fadeInRight'       => __( 'fadeInRight', 'wfe-image-hotspot' ),
					'fadeInRightBig'    => __( 'fadeInRightBig', 'wfe-image-hotspot' ),
					'fadeInUp'          => __( 'fadeInUp', 'wfe-image-hotspot' ),
					'fadeInUpBig'       => __( 'fadeInUpBig', 'wfe-image-hotspot' ),
					'fadeOut'           => __( 'fadeOut', 'wfe-image-hotspot' ),
					'fadeOutDown'       => __( 'fadeOutDown', 'wfe-image-hotspot' ),
					'fadeOutDownBig'    => __( 'fadeOutDownBig', 'wfe-image-hotspot' ),
					'fadeOutLeft'       => __( 'fadeOutLeft', 'wfe-image-hotspot' ),
					'fadeOutLeftBig'    => __( 'fadeOutLeftBig', 'wfe-image-hotspot' ),
					'fadeOutRight'      => __( 'fadeOutRight', 'wfe-image-hotspot' ),
					'fadeOutRightBig'   => __( 'fadeOutRightBig', 'wfe-image-hotspot' ),
					'fadeOutUp'         => __( 'fadeOutUp', 'wfe-image-hotspot' ),
					'fadeOutUpBig'      => __( 'fadeOutUpBig', 'wfe-image-hotspot' ),
					'flip'              => __( 'flip', 'wfe-image-hotspot' ),
					'flipInX'           => __( 'flipInX', 'wfe-image-hotspot' ),
					'flipInY'           => __( 'flipInY', 'wfe-image-hotspot' ),
					'flipOutX'          => __( 'flipOutX', 'wfe-image-hotspot' ),
					'flipOutY'          => __( 'flipOutY', 'wfe-image-hotspot' ),
					'lightSpeedIn'      => __( 'lightSpeedIn', 'wfe-image-hotspot' ),
					'lightSpeedOut'     => __( 'lightSpeedOut', 'wfe-image-hotspot' ),
					'rotateIn'          => __( 'rotateIn', 'wfe-image-hotspot' ),
					'rotateInDownLeft'  => __( 'rotateInDownLeft', 'wfe-image-hotspot' ),
					'rotateInDownLeft'  => __( 'rotateInDownRight', 'wfe-image-hotspot' ),
					'rotateInUpLeft'    => __( 'rotateInUpLeft', 'wfe-image-hotspot' ),
					'rotateInUpRight'   => __( 'rotateInUpRight', 'wfe-image-hotspot' ),
					'rotateOut'         => __( 'rotateOut', 'wfe-image-hotspot' ),
					'rotateOutDownLeft' => __( 'rotateOutDownLeft', 'wfe-image-hotspot' ),
					'rotateOutDownLeft' => __( 'rotateOutDownRight', 'wfe-image-hotspot' ),
					'rotateOutUpLeft'   => __( 'rotateOutUpLeft', 'wfe-image-hotspot' ),
					'rotateOutUpRight'  => __( 'rotateOutUpRight', 'wfe-image-hotspot' ),
					'hinge'             => __( 'Hinge', 'wfe-image-hotspot' ),
					'rollIn'            => __( 'rollIn', 'wfe-image-hotspot' ),
					'rollOut'           => __( 'rollOut', 'wfe-image-hotspot' ),
					'zoomIn'            => __( 'zoomIn', 'wfe-image-hotspot' ),
					'zoomInDown'        => __( 'zoomInDown', 'wfe-image-hotspot' ),
					'zoomInLeft'        => __( 'zoomInLeft', 'wfe-image-hotspot' ),
					'zoomInRight'       => __( 'zoomInRight', 'wfe-image-hotspot' ),
					'zoomInUp'          => __( 'zoomInUp', 'wfe-image-hotspot' ),
					'zoomOut'           => __( 'zoomOut', 'wfe-image-hotspot' ),
					'zoomOutDown'       => __( 'zoomOutDown', 'wfe-image-hotspot' ),
					'zoomOutLeft'       => __( 'zoomOutLeft', 'wfe-image-hotspot' ),
					'zoomOutRight'      => __( 'zoomOutRight', 'wfe-image-hotspot' ),
					'zoomOutUp'         => __( 'zoomOutUp', 'wfe-image-hotspot' ),
				],
			]
		);

		$this->end_controls_section();

		/*-----------------------------------------------------------------------------------*/
		/*	STYLE TAB
		/*-----------------------------------------------------------------------------------*/

		/**
		 * Style Tab: Image
		 */
		$this->start_controls_section(
			'section_image_style',
			[
				'label'                 => __( 'Image', 'wfe-image-hotspot' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label'                 => __( 'Width', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'min'   => 1,
						'max'   => 1200,
						'step'  => 1,
					],
					'%' => [
						'min'   => 1,
						'max'   => 100,
						'step'  => 1,
					],
				],
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .wfe-hot-spot-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Hotspot
		 */
		$this->start_controls_section(
			'section_hotspots_style',
			[
				'label'                 => __( 'Hotspot', 'wfe-image-hotspot' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'hotspot_icon_size',
			[
				'label'                 => __( 'Size', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [ 'size' => '14' ],
				'range'                 => [
					'px' => [
						'min'   => 6,
						'max'   => 40,
						'step'  => 1,
					],
				],
				'size_units'            => [ 'px' ],
				'selectors'             => [
					'{{WRAPPER}} .wfe-hot-spot-wrap' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_color_normal',
			[
				'label'                 => __( 'Color', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '#fff',
				'selectors'             => [
					'{{WRAPPER}} .wfe-hot-spot-wrap, {{WRAPPER}} .wfe-hot-spot-inner, {{WRAPPER}} .wfe-hot-spot-inner:before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_bg_color_normal',
			[
				'label'                 => __( 'Background Color', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '#4051b2',
				'selectors'             => [
					'{{WRAPPER}} .wfe-hot-spot-wrap, {{WRAPPER}} .wfe-hot-spot-inner, {{WRAPPER}} .wfe-hot-spot-inner:before, {{WRAPPER}} .wfe-hotspot-icon-wrap, {{WRAPPER}} .wfe-hot-spot-inner.slack' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'icon_border_normal',
				'label'                 => __( 'Border', 'wfe-image-hotspot' ),
				'placeholder'           => '',
				'default'               => '0px',
				'selector'              => '{{WRAPPER}} .wfe-hot-spot-wrap'
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label'                 => __( 'Border Radius', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .wfe-hot-spot-wrap, {{WRAPPER}} .wfe-hot-spot-inner, {{WRAPPER}} .wfe-hot-spot-inner:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label'                 => __( 'Padding', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .wfe-hot-spot-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'icon_box_shadow',
				'selector'              => '{{WRAPPER}} .wfe-hot-spot-wrap',
				'separator'             => 'before',
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Tooltip
		 */
		$this->start_controls_section(
			'section_tooltips_style',
			[
				'label'                 => __( 'Tooltip', 'wfe-image-hotspot' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tooltip_bg_color',
			[
				'label'                 => __( 'Background Color', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
			]
		);

		$this->add_control(
			'tooltip_color',
			[
				'label'                 => __( 'Text Color', 'wfe-image-hotspot' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
			]
		);

		$this->add_control(
			'tooltip_width',
			[
				'label'         => __( 'Width', 'wfe-image-hotspot' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' 	=> [
						'min' 	=> 50,
						'max' 	=> 400,
						'step'	=> 1,
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'tooltip_typography',
				'label'                 => __( 'Typography', 'wfe-image-hotspot' ),
				'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
				'selector'              => '.wfe-tooltip-{{ID}}',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['image']['url'] ) ) {
			return;
		}
		?>
        <div class="wfe-image-hotspots">
            <div class="wfe-hot-spot-image">
				<?php
				$i = 1;
				foreach ( $settings['hot_spots'] as $index => $item ) :

					$this->add_render_attribute( 'hotspot' . $i, 'class', 'wfe-hot-spot-wrap elementor-repeater-item-' . esc_attr( $item['_id'] ) );

					if ( $item['tooltip'] == 'yes' && $item['tooltip_content'] != '' ) {
						$this->add_render_attribute( 'hotspot' . $i, 'class', 'wfe-hot-spot-tooptip' );
						$this->add_render_attribute( 'hotspot' . $i, 'data-tipso', '<span class="wfe-tooltip-'.$this->get_id().'">' . $this->parse_text_editor( $item['tooltip_content'] ) . '</span>' );
					}

					$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-position-global', $settings['tooltip_position'] );

					if ( $item['tooltip_position_local'] != 'global' ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-position-local', $item['tooltip_position_local'] );
					}

					if ( $settings['tooltip_size'] ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-size', $settings['tooltip_size'] );
					}

					if ( $settings['tooltip_width'] ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-width', $settings['tooltip_width']['size'] );
					}

					if ( $settings['tooltip_animation_in'] ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-animation-in', $settings['tooltip_animation_in'] );
					}

					if ( $settings['tooltip_animation_out'] ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-animation-out', $settings['tooltip_animation_out'] );
					}

					if ( $settings['tooltip_bg_color'] ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-background', $settings['tooltip_bg_color'] );
					}

					if ( $settings['tooltip_color'] ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-text-color', $settings['tooltip_color'] );
					}

					if ( $settings['tooltip_arrow'] == 'yes' ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-arrow', $settings['tooltip_arrow'] );
					}

					$this->add_render_attribute( 'hotspot_inner_' . $i, 'class', 'wfe-hot-spot-inner' );

					if ( $settings['hotspot_pulse'] == 'yes' ) {
						$this->add_render_attribute( 'hotspot_inner_' . $i, 'class',  $settings['hotspot_pulse_effects'] );
					}
					?>
                    <span <?php echo $this->get_render_attribute_string( 'hotspot' . $i ); ?>>
                        <span <?php echo $this->get_render_attribute_string( 'hotspot_inner_' . $i ); ?>>
                        <?php
                        if ( $item['hotspot_type'] == 'icon' ) {
	                        printf( '<span class="wfe-hotspot-icon-wrap"><span class="wfe-hotspot-icon tooltip %1$s"></span></span>', esc_attr( $item['hotspot_icon'] ) );
                        }
                        elseif ( $item['hotspot_type'] == 'text' ) {
	                        printf( '<span class="wfe-hotspot-icon-wrap"><span class="wfe-hotspot-text">%1$s</span></span>', esc_attr( $item['hotspot_text'] ) );
                        }
                        ?>
                        </span>
                    </span>
					<?php $i++; endforeach; ?>

				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
            </div>
        </div>
		<?php
	}
	protected function content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Wfe_hotspot() );