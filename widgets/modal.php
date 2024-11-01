<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_modal extends Widget_Base {

	public function get_name() {
		return 'wfe-modal';
	}

	public function get_title() {
		return __( 'Modal', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-window-restore wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}
	// Adding the controls fields for the wfe_elementor modal box
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {
		/* Start Box Content Section */

		$this->start_controls_section('wfe_elementor_modal_box_selector_content_section',
			[
				'label'         => esc_html__('Content', 'wfe_elementor'),
			]
		);

		$this->add_control('wfe_elementor_modal_box_header_switcher',
			[
				'label'         => esc_html__('Header', 'wfe_elementor'),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => 'show',
				'label_off'     => 'hide',
				'default'       => 'yes',
				'description'   => esc_html__('Enable or disable modal header','wfe_elementor'),
			]
		);

		/*Icon To Display*/
		$this->add_control('wfe_elementor_modal_box_icon_selection',
			[
				'label'         => esc_html__('Icon', 'wfe_elementor'),
				'type'          => Controls_Manager::SELECT,
				'description'   => esc_html__('Use font awesome icon or upload a custom image', 'wfe_elementor'),
				'options'       => [
					'noicon'  => esc_html('None'),
					'fonticon'=> esc_html('Font Awesome'),
					'image'   => esc_html('Custom Image'),
				],
				'default'       => 'noicon',
				'condition'     => [
					'wfe_elementor_modal_box_header_switcher' => 'yes'
				],
				'label_block'   => true
			]
		);

		/*Font Awesome Icon*/
		$this->add_control('wfe_elementor_modal_box_font_icon',
			[
				'label'         => esc_html__('Font Awesome', 'wfe_elementor'),
				'type'          => Controls_Manager::ICON,
				'condition'     => [
					'wfe_elementor_modal_box_icon_selection'    => 'fonticon',
					'wfe_elementor_modal_box_header_switcher' => 'yes'
				],
				'label_block'   => true,
			]
		);

		/*Image Icon*/
		$this->add_control('wfe_elementor_modal_box_image_icon',
			[
				'label'         => esc_html__('Custom Image', 'wfe_elementor'),
				'type'          => Controls_Manager::MEDIA,
				'default'       => [
					'url'   => Utils::get_placeholder_image_src(),
				],
				'condition'     => [
					'wfe_elementor_modal_box_icon_selection'    => 'image',
					'wfe_elementor_modal_box_header_switcher' => 'yes'
				],
				'label_block'   => true,
			]
		);

		/*Modal Box Title*/
		$this->add_control('wfe_elementor_modal_box_title',
			[
				'label'         => esc_html__('Title', 'wfe_elementor'),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [ 'active' => true ],
				'description'   => esc_html__('Provide the modal box with a title', 'wfe_elementor'),
				'default'       => 'Modal Box Title',
				'condition'     => [
					'wfe_elementor_modal_box_header_switcher' => 'yes'
				],
				'label_block'   => true,
			]
		);

		/*Modal Box Content Heading*/
		$this->add_control('wfe_elementor_modal_box_content_heading',
			[
				'label'         => esc_html__('Content', 'wfe_elementor'),
				'type'          => Controls_Manager::HEADING,
			]
		);

		/*Modal Box Content Type*/
		$this->add_control('wfe_elementor_modal_box_content_type',
			[
				'label'         => esc_html__('Content to Show', 'wfe_elementor'),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'editor'        => esc_html('Text Editor', 'wfe_elementor'),
					'template'      => esc_html('Elementor Template', 'wfe_elementor'),
				],
				'default'       => 'editor',
				'label_block'   => true
			]
		);

		/*Modal Box Elementor Template*/
		$this->add_control('wfe_elementor_modal_box_content_temp',
			[
				'label'			=> esc_html__( 'Content', 'wfe_elementor' ),
				'description'	=> esc_html__( 'Modal content is a template which you can choose from Elementor library', 'wfe_elementor' ),
				'type' => Controls_Manager::SELECT2,
				//'options' => $this->getTemplateInstance()->get_elementor_page_list(),
				'condition'     => [
					'wfe_elementor_modal_box_content_type'    => 'template',
				],
			]
		);

		/*Modal Box Content*/
		$this->add_control('wfe_elementor_modal_box_content',
			[
				'type'          => Controls_Manager::WYSIWYG,
				'default'       => 'Modal Box Content',
				'dynamic'       => [ 'active' => true ],
				'selector'      => '{{WRAPPER}} .wfe_elementor-modal-box-modal-body',
				'condition'     => [
					'wfe_elementor_modal_box_content_type'    => 'editor',
				],
				'show_label'    => false,
			]
		);

		/*Upper Close Button*/
		$this->add_control('wfe_elementor_modal_box_upper_close',
			[
				'label'         => esc_html__('Upper Close Button', 'wfe_elementor'),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'condition'     => [
					'wfe_elementor_modal_box_header_switcher' => 'yes'
				]
			]
		);

		/*Lower Close Button*/
		$this->add_control('wfe_elementor_modal_box_lower_close',
			[
				'label'         => esc_html__('Lower Close Button', 'wfe_elementor'),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section('wfe_elementor_modal_box_content_section',
			[
				'label'         => esc_html__('Display Options', 'wfe_elementor'),
			]
		);

		/*Modal Box Display On*/
		$this->add_control('wfe_elementor_modal_box_display_on',
			[
				'label'         => esc_html__('Display Style', 'wfe_elementor'),
				'type'          => Controls_Manager::SELECT,
				'description'   => esc_html__('Choose where would you like the modal box appear on', 'wfe_elementor'),
				'options'       => [
					'button'  => esc_html('Button','wfe_elementor-elementor'),
					'image'   => esc_html('Image','wfe_elementor-elementor'),
					'text'    => esc_html('Text','wfe_elementor-elementor'),
					'pageload'=> esc_html('Page Load','wfe_elementor-elementor'),
				],
				'label_block'   =>  true,
				'default'       => 'button',
			]
		);

		/*Button Text*/
		$this->add_control('wfe_elementor_modal_box_button_text',
			[
				'label'         => esc_html__('Button Text', 'wfe_elementor'),
				'default'       => esc_html__('Premium Modal Box','wfe_elementor'),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [ 'active' => true ],
				'label_block'   => true,
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => 'button'
				],
			]
		);

		$this->add_control('wfe_elementor_modal_box_icon_switcher',
			[
				'label'         => esc_html__('Icon', 'wfe_elementor'),
				'type'          => Controls_Manager::SWITCHER,
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => 'button'
				],
				'description'   => esc_html__('Enable or disable button icon','wfe_elementor'),
			]
		);

		$this->add_control('wfe_elementor_modal_box_button_icon_selection',
			[
				'label'         => esc_html__('Icon', 'wfe_elementor'),
				'type'          => Controls_Manager::ICON,
				'default'       => 'fa fa-bars',
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => 'button',
					'wfe_elementor_modal_box_icon_switcher'   => 'yes'
				],
				'label_block'   => true,
			]
		);

		$this->add_control('wfe_elementor_modal_box_icon_position',
			[
				'label'         => esc_html__('Icon Position', 'wfe_elementor'),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'before',
				'options'       => [
					'before'        => esc_html__('Before'),
					'after'         => esc_html__('After'),
				],
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => 'button',
					'wfe_elementor_modal_box_icon_switcher'   => 'yes'
				],
				'label_block'   => true,
			]
		);

		$this->add_control('wfe_elementor_modal_box_icon_before_size',
			[
				'label'         => esc_html__('Icon Size', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => 'button',
					'wfe_elementor_modal_box_icon_switcher'   => 'yes'
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-button-selector i '=> 'font-size: {{SIZE}}px',
				]
			]
		);


			$this->add_control('wfe_elementor_modal_box_icon_before_spacing',
				[
					'label'         => esc_html__('Icon Spacing', 'wfe_elementor'),
					'type'          => Controls_Manager::SLIDER,
					'condition'     => [
						'wfe_elementor_modal_box_display_on'      => 'button',
						'wfe_elementor_modal_box_icon_switcher'   => 'yes',
						'wfe_elementor_modal_box_icon_position'   => 'before'
					],
					'default'       => [
						'size'  => 15
					],
					'selectors'     => [
						'{{WRAPPER}} .wfe_elementor-modal-box-button-selector i' => 'margin-right: {{SIZE}}px',
					],
					'separator'     => 'after',
				]
			);



			$this->add_control('wfe_elementor_modal_box_icon_after_spacing',
				[
					'label'         => esc_html__('Icon Spacing', 'wfe_elementor'),
					'type'          => Controls_Manager::SLIDER,
					'condition'     => [
						'wfe_elementor_modal_box_display_on'      => 'button',
						'wfe_elementor_modal_box_icon_switcher'   => 'yes',
						'wfe_elementor_modal_box_icon_position'   => 'after'
					],
					'default'       => [
						'size'  => 15
					],
					'selectors'     => [
						'{{WRAPPER}} .wfe_elementor-modal-box-button-selector i' => 'margin-left: {{SIZE}}px',
					],
					'separator'     => 'after',
				]
			);



			$this->add_control('wfe_elementor_modal_box_icon_rtl_before_spacing',
				[
					'label'         => esc_html__('Icon Spacing', 'wfe_elementor'),
					'type'          => Controls_Manager::SLIDER,
					'condition'     => [
						'wfe_elementor_modal_box_display_on'      => 'button',
						'wfe_elementor_modal_box_icon_switcher'   => 'yes',
						'wfe_elementor_modal_box_icon_position'   => 'before'
					],
					'default'       => [
						'size'  => 15
					],
					'selectors'     => [
						'{{WRAPPER}} .wfe_elementor-modal-box-button-selector i' => 'margin-left: {{SIZE}}px',
					],
					'separator'     => 'after',
				]
			);



			$this->add_control('wfe_elementor_modal_box_icon_rtl_after_spacing',
				[
					'label'         => esc_html__('Icon Spacing', 'wfe_elementor'),
					'type'          => Controls_Manager::SLIDER,
					'condition'     => [
						'wfe_elementor_modal_box_display_on'      => 'button',
						'wfe_elementor_modal_box_icon_switcher'   => 'yes',
						'wfe_elementor_modal_box_icon_position'   => 'after'
					],
					'default'       => [
						'size'  => 15
					],
					'selectors'     => [
						'{{WRAPPER}} .wfe_elementor-modal-box-button-selector i' => 'margin-right: {{SIZE}}px',
					],
					'separator'     => 'after',
				]
			);


		/*Button Size*/
		$this->add_control('wfe_elementor_modal_box_button_size',
			[
				'label'         => esc_html__('Button Size', 'wfe_elementor'),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'sm'    => esc_html('Small','wfe_elementor-elementor'),
					'md'    => esc_html('Medium','wfe_elementor-elementor'),
					'lg'    => esc_html('Large','wfe_elementor-elementor'),
					'block' => esc_html('Block','wfe_elementor-elementor'),
				],
				'label_block'   => true,
				'default'       => 'lg',
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => 'button'
				],
			]
		);

		/*Image Source*/
		$this->add_control('wfe_elementor_modal_box_image_src',
			[
				'label'         => esc_html__('Image', 'wfe_elementor'),
				'type'          => Controls_Manager::MEDIA,
				'default'       => [
					'url'   => Utils::get_placeholder_image_src(),
				],
				'condition'     => [
					'wfe_elementor_modal_box_display_on'    => 'image',
				],
				'label_block'   => true,
			]
		);

		/*Text Selector*/
		$this->add_control('wfe_elementor_modal_box_selector_text',
			[
				'label'         => esc_html__('Text', 'wfe_elementor'),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [ 'active' => true ],
				'label_block'   => true,
				'default'       => esc_html__('Premium Modal Box', 'wfe_elementor'),
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => 'text',
				]
			]
		);

		/*On Load Trigger Delay*/
		$this->add_control('wfe_elementor_modal_box_popup_delay',
			[
				'label'         => esc_html__('Delay in Popup Display (Sec)','wfe_elementor'),
				'type'          => Controls_Manager::NUMBER,
				'description'   => esc_html__('When should the popup appear during page load? The value are counted in seconds', 'wfe_elementor'),
				'default'       => 1,
				'label_block'   => true,
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => 'pageload',
				]
			]
		);


		/*Alignment*/
		$this->add_responsive_control('wfe_elementor_modal_box_selector_align',
			[
				'label' => __( 'Alignment', 'wfe_elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'wfe_elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'wfe_elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'wfe_elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default'       => 'center',
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-selector-container' => 'text-align: {{VALUE}};',
				],
				'condition'     => [
					'wfe_elementor_modal_box_display_on!' => 'pageload',
				],
			]
		);

		/*End Box Content Section*/
		$this->end_controls_section();

		/*Selector Style*/
		$this->start_controls_section('wfe_elementor_modal_box_selector_style_section',
			[
				'label'         => esc_html__('Trigger', 'wfe_elementor'),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'wfe_elementor_modal_box_display_on!'  => 'pageload',
				]
			]
		);

		/*Button Text Color*/
		$this->add_control('wfe_elementor_modal_box_button_text_color',
			[
				'label'         => esc_html__('Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-button-selector, {{WRAPPER}} .wfe_elementor-modal-box-text-selector' => 'color:{{VALUE}};',
				],
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => ['button', 'text'],
				]
			]
		);

		$this->add_control('wfe_elementor_modal_box_button_icon_color',
			[
				'label'         => esc_html__('Icon Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-button-selector i' => 'color:{{VALUE}};',
				],
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => ['button'],
				]
			]
		);

		/*Selector Text Typography*/
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'selectortext',
				'label'         => esc_html__('Typography', 'wfe_elementor'),
				'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
				'selector'      => '{{WRAPPER}} .wfe_elementor-modal-box-button-selector, {{WRAPPER}} .wfe_elementor-modal-box-text-selector',
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => ['button','text'],
				],
			]
		);

		$this->start_controls_tabs('wfe_elementor_modal_box_button_style');

		/*Button Color*/
		$this->start_controls_tab('wfe_elementor_modal_box_tab_selector_normal',
			[
				'label'         => esc_html__( 'Normal', 'wfe_elementor' ),
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => ['button', 'text','image'],
				]
			]
		);

		/*Button Background Color*/
		$this->add_control('wfe_elementor_modal_box_selector_background',
			[
				'label'         => esc_html__('Background Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-button-selector'   => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => 'button',
				]
			]
		);

		/*Button Border*/
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'selector_border',
				'selector'      => '{{WRAPPER}} .wfe_elementor-modal-box-button-selector,{{WRAPPER}} .wfe_elementor-modal-box-text-selector, {{WRAPPER}} .wfe_elementor-modal-box-img-selector',
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => ['button', 'text','image'],
				]
			]
		);

		/*Button Border Radius*/
		$this->add_control('wfe_elementor_modal_box_selector_border_radius',
			[
				'label'          => esc_html__('Border Radius', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'default'       => [
					'size'  => 0
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-button-selector, {{WRAPPER}} .wfe_elementor-modal-box-text-selector, {{WRAPPER}} .wfe_elementor-modal-box-img-selector'     => 'border-radius:{{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => ['button', 'text', 'image'],
				],
				'separator'     => 'after',
			]
		);

		/*Selector Padding*/
		$this->add_responsive_control('wfe_elementor_modal_box_selector_padding',
			[
				'label'         => esc_html__('Padding', 'wfe_elementor'),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'default'       => [
					'unit'  => 'px',
					'top'   => 20,
					'right' => 30,
					'bottom'=> 20,
					'left'  => 30,
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-button-selector, {{WRAPPER}} .wfe_elementor-modal-box-text-selector' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => ['button', 'text'],
				]
			]
		);

		/*Selector Box Shadow*/
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'label'         => esc_html__('Shadow','wfe_elementor'),
				'name'          => 'wfe_elementor_modal_box_selector_box_shadow',
				'selector'      => '{{WRAPPER}} .wfe_elementor-modal-box-button-selector, {{WRAPPER}} .wfe_elementor-modal-box-img-selector',
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => ['button', 'image'],
				]
			]
		);

		/*Selector Text Shadow*/
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'          => 'wfe_elementor_modal_box_selector_text_shadow',
				'selector'      => '{{WRAPPER}} .wfe_elementor-modal-box-text-selector',
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => 'text',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('wfe_elementor_modal_box_tab_selector_hover',
			[
				'label'         => esc_html__('Hover', 'wfe_elementor'),
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => ['button','text','image'],
				]
			]
		);

		/*Button Hover Background Color*/
		$this->add_control('wfe_elementor_modal_box_selector_hover_background',
			[
				'label'         => esc_html__('Background Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-button-selector:hover' => 'background: {{VALUE}};',
				],
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => 'button',
				]
			]
		);

		/*Button Border*/
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'selector_border_hover',
				'selector'      => '{{WRAPPER}} .wfe_elementor-modal-box-button-selector:hover,
                    {{WRAPPER}} .wfe_elementor-modal-box-text-selector:hover, {{WRAPPER}} .wfe_elementor-modal-box-img-selector:hover',
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => ['button', 'text', 'image'],
				]
			]
		);

		/*Button Border Radius*/
		$this->add_control('wfe_elementor_modal_box_selector_border_radius_hover',
			[
				'label'          => esc_html__('Border Radius', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-button-selector:hover,{{WRAPPER}} .wfe_elementor-modal-box-text-selector:hover, {{WRAPPER}} .wfe_elementor-modal-box-img-selector:hover'     => 'border-radius:{{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => ['button', 'text', 'image'],
				]
			]
		);

		/*Selector Box Shadow*/
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'label'         => esc_html__('Shadow','wfe_elementor'),
				'name'          => 'wfe_elementor_modal_box_selector_box_shadow_hover',
				'selector'      => '{{WRAPPER}} .wfe_elementor-modal-box-button-selector:hover, {{WRAPPER}} .wfe_elementor-modal-box-text-selector:hover, {{WRAPPER}} .wfe_elementor-modal-box-img-selector:hover',
				'condition'     => [
					'wfe_elementor_modal_box_display_on'  => ['button', 'text', 'image'],
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/*Start Header Seettings Section*/
		$this->start_controls_section('wfe_elementor_modal_box_header_settings',
			[
				'label'         => esc_html__('Heading', 'wfe_elementor'),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'wfe_elementor_modal_box_header_switcher' => 'yes'
				],
			]
		);

		/*Header Text Color*/
		$this->add_control('wfe_elementor_modal_box_header_text_color',
			[
				'label'         => esc_html__('Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-title' => 'color: {{VALUE}};',
				]
			]
		);

		/*Header Text Typography*/
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'headertext',
				'label'         => esc_html__('Typography', 'wfe_elementor'),
				'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
				'selector'      => '{{WRAPPER}} .wfe_elementor-modal-box-modal-title',
			]
		);

		/*Header Background Color*/
		$this->add_control('wfe_elementor_modal_box_header_background',
			[
				'label'         => esc_html__('Background Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-header'  => 'background: {{VALUE}};',
				]
			]
		);

		/*End Header Settings Section*/
		$this->end_controls_section();


		/*Start Close Button Section*/
		$this->start_controls_section('wfe_elementor_modal_box_upper_close_button_section',
			[
				'label'         => esc_html__('Upper Close Button', 'wfe_elementor'),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'wfe_elementor_modal_box_upper_close'   => 'yes',
					'wfe_elementor_modal_box_header_switcher' => 'yes'
				]
			]
		);

		/*Close Button Size*/
		$this->add_responsive_control('wfe_elementor_modal_box_upper_close_button_size',
			[
				'label'         => esc_html__('Size', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%' ,'em'],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-header button' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);



		$this->start_controls_tabs('wfe_elementor_modal_box_upper_close_button_style');

		/*Button Color*/
		$this->start_controls_tab('wfe_elementor_modal_box_upper_close_button_normal',
			[
				'label'         => esc_html__( 'Normal', 'wfe_elementor' ),
			]
		);

		/*Close Button Color*/
		$this->add_control('wfe_elementor_modal_box_upper_close_button_normal_color',
			[
				'label'         => esc_html__('Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-close' => 'color: {{VALUE}};',
				]
			]
		);

		/*Close Button Background Color*/
		$this->add_control('wfe_elementor_modal_box_upper_close_button_background_color',
			[
				'label'         => esc_html__('Background Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-close' => 'background:{{VALUE}};',
				],
			]
		);

		/*Button Border*/
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'wfe_elementor_modal_upper_border',
				'selector'      => '{{WRAPPER}} .wfe_elementor-modal-box-modal-close',
			]
		);

		/*Button Border Radius*/
		$this->add_control('wfe_elementor_modal_upper_border_radius',
			[
				'label'          => esc_html__('Border Radius', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-close'     => 'border-radius:{{SIZE}}{{UNIT}};',
				],
				'separator'     => 'after',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('wfe_elementor_modal_box_upper_close_button_hover',
			[
				'label'         => esc_html__('Hover', 'wfe_elementor'),
			]
		);

		/*Close Button Color*/
		$this->add_control('wfe_elementor_modal_box_upper_close_button_hover_color',
			[
				'label'         => esc_html__('Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-close:hover' => 'color: {{VALUE}};',
				],
			]
		);

		/*Close Button Background Color*/
		$this->add_control('wfe_elementor_modal_box_upper_close_button_background_color_hover',
			[
				'label'         => esc_html__('Background Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-close:hover' => 'background:{{VALUE}};',
				],
			]
		);

		/*Button Border*/
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'wfe_elementor_modal_upper_border_hover',
				'selector'      => '{{WRAPPER}} .wfe_elementor-modal-box-modal-close:hover',
			]
		);

		/*Button Border Radius*/
		$this->add_control('wfe_elementor_modal_upper_border_radius_hover',
			[
				'label'          => esc_html__('Border Radius', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-close:hover'     => 'border-radius:{{SIZE}}{{UNIT}};',
				],
				'separator'     => 'after',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		/*Upper Close Padding*/
		$this->add_responsive_control('wfe_elementor_modal_box_upper_close_button_padding',
			[
				'label'         => esc_html__('Padding', 'wfe_elementor'),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				]
			]
		);

		/*End Upper Close Button Style Section*/
		$this->end_controls_section();

		/*Start Close Button Section*/
		$this->start_controls_section('wfe_elementor_modal_box_lower_close_button_section',
			[
				'label'         => esc_html__('Lower Close Button', 'wfe_elementor'),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'wfe_elementor_modal_box_lower_close'   => 'yes',
				]
			]
		);

		/*Close Button Text Typography*/
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'         => esc_html__('Typography', 'wfe_elementor'),
				'name'          => 'lowerclose',
				'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
				'selector'      => '{{WRAPPER}} .wfe_elementor-modal-box-modal-lower-close',
			]
		);

		/*Close Button Size*/
		$this->add_responsive_control('wfe_elementor_modal_box_lower_close_button_width',
			[
				'label'         => esc_html__('Width', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'range'         => [
					'px'    => [
						'min'   => 1,
						'max'   => 500,
					],
					'em'    => [
						'min'   => 1,
						'max'   => 30,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-lower-close' => 'min-width: {{SIZE}}{{UNIT}};',
				]
			]
		);


		$this->start_controls_tabs('wfe_elementor_modal_box_lower_close_button_style');

		/*Button Color*/
		$this->start_controls_tab('wfe_elementor_modal_box_lower_close_button_normal',
			[
				'label'         => esc_html__( 'Normal', 'wfe_elementor' ),
			]
		);

		/*Close Button Background Color*/
		$this->add_control('wfe_elementor_modal_box_lower_close_button_normal_color',
			[
				'label'         => esc_html__('Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-lower-close' => 'color: {{VALUE}};',
				]
			]
		);

		/*Close Button Background Color*/
		$this->add_control('wfe_elementor_modal_box_lower_close_button_background_normal_color',
			[
				'label'         => esc_html__('Background Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-lower-close' => 'background-color: {{VALUE}};',
				],
			]
		);

		/*Lower Close Border*/
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'              => 'wfe_elementor_modal_box_lower_close_border',
				'selector'          => '{{WRAPPER}} .wfe_elementor-modal-box-modal-lower-close',
			]
		);

		/*Lower Close Radius*/
		$this->add_control('wfe_elementor_modal_box_lower_close_border_radius',
			[
				'label'         => esc_html__('Border Radius', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-lower-close' => 'border-radius: {{SIZE}}{{UNIT}};'
				],
				'separator'     => 'after',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('wfe_elementor_modal_box_lower_close_button_hover',
			[
				'label'         => esc_html__('Hover', 'wfe_elementor'),
			]
		);

		/*Close Button Background Color*/
		$this->add_control('wfe_elementor_modal_box_lower_close_button_hover_color',
			[
				'label'         => esc_html__('Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-lower-close:hover' => 'color: {{VALUE}};',
				]
			]
		);

		/*Close Button Background Color*/
		$this->add_control('wfe_elementor_modal_box_lower_close_button_background_hover_color',
			[
				'label'         => esc_html__('Background Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-lower-close:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		/*Lower Close Hover Border*/
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'              => 'wfe_elementor_modal_box_lower_close_border_hover',
				'selector'          => '{{WRAPPER}} .wfe_elementor-modal-box-modal-lower-close:hover',
			]
		);

		/*Lower Close Hover Border Radius*/
		$this->add_control('wfe_elementor_modal_box_lower_close_border_radius_hover',
			[
				'label'         => esc_html__('Border Radius', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-lower-close:hover' => 'border-radius: {{SIZE}}{{UNIT}};'
				],
				'separator'     => 'after',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		/*Upper Close Padding*/
		$this->add_responsive_control('wfe_elementor_modal_box_lower_close_button_padding',
			[
				'label'         => esc_html__('Padding', 'wfe_elementor'),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-lower-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				]
			]
		);

		/*End Lower Close Button Style Section*/
		$this->end_controls_section();

		$this->start_controls_section('wfe_elementor_modal_box_style',
			[
				'label'         => esc_html__('Modal Box', 'wfe_elementor'),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		/*Modal Size*/
		$this->add_control('wfe_elementor_modal_box_modal_size',
			[
				'label'         => esc_html__('Width', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'range'         => [
					'px'    => [
						'min'   => 50,
						'max'   => 1000,
					]
				],
				'label_block'   => true,
			]
		);

		/*Modal Background Color*/
		$this->add_control('wfe_elementor_modal_box_modal_background',
			[
				'label'         => esc_html__('Overlay Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal'  => 'background:{{VALUE}};',
				]
			]
		);

		/*Content Background Color*/
		$this->add_control('wfe_elementor_modal_box_content_background',
			[
				'label'         => esc_html__('Content Background Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-body'  => 'background: {{VALUE}};',
				]
			]
		);

		/*Footer Background Color*/
		$this->add_control('wfe_elementor_modal_box_footer_background',
			[
				'label'         => esc_html__('Footer Background Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-footer'  => 'background: {{VALUE}};',
				]
			]
		);

		/*Content Box Border*/
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'contentborder',
				'selector'      => '{{WRAPPER}} .wfe_elementor-modal-box-modal-content',
			]
		);

		/*Border Radius*/
		$this->add_control('wfe_elementor_modal_box_border_radius',
			[
				'label'          => esc_html__('Border Radius', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-content'     => 'border-radius: {{SIZE}}{{UNIT}};',
				]
			]
		);

		/*Modal Box Margin*/
		$this->add_responsive_control('wfe_elementor_modal_box_margin',
			[
				'label'         => esc_html__('Margin', 'wfe_elementor'),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor-modal-box-modal-dialog' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render($instance = [])
	{
		// get our input from the widget settings.
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes('wfe_elementor_modal_box_selector_text');

		$button_icon = $settings['wfe_elementor_modal_box_button_icon_selection'];


		$elementor_post_id = $settings['wfe_elementor_modal_box_content_temp'];
		$wfe_elementor_elements_frontend = new Frontend;
		$modal_settings = [
			'trigger'   => $settings['wfe_elementor_modal_box_display_on'],
			'delay'     => $settings['wfe_elementor_modal_box_popup_delay'],
		];
		?>


        <div class="container wfe_elementor-modal-box-container" data-settings='<?php echo wp_json_encode($modal_settings); ?>'>
            <!-- Trigger The Modal Box -->
            <div class="wfe_elementor-modal-box-selector-container">
				<?php
				if ( $settings['wfe_elementor_modal_box_display_on'] === 'button' ) : ?>
                    <button type="button" class="wfe_elementor-modal-box-button-selector btn btn-info <?php
					if( $settings['wfe_elementor_modal_box_button_size'] === 'sm' ) : echo "wfe_elementor-btn-sm";
                    elseif( $settings['wfe_elementor_modal_box_button_size'] === 'md' ) : echo "wfe_elementor-btn-md";
                    elseif( $settings['wfe_elementor_modal_box_button_size'] === 'lg' ) : echo "wfe_elementor-btn-lg";
                    elseif( $settings['wfe_elementor_modal_box_button_size'] === 'block' ) : echo "wfe_elementor-btn-block"; endif; ?>" data-toggle="wfe_elementor-modal" data-target="#wfe_elementor-modal-<?php echo esc_attr( $this->get_id() ); ?>"><?php if($settings['wfe_elementor_modal_box_icon_switcher'] && $settings['wfe_elementor_modal_box_icon_position'] == 'before' && !empty($settings['wfe_elementor_modal_box_button_icon_selection'])) : ?><i class="fa <?php echo esc_attr($button_icon); ?>"></i><?php endif; ?><span><?php echo $settings['wfe_elementor_modal_box_button_text']; ?></span><?php if($settings['wfe_elementor_modal_box_icon_switcher'] && $settings['wfe_elementor_modal_box_icon_position'] == 'after' &&!empty($settings['wfe_elementor_modal_box_button_icon_selection'])) : ?><i class="fa <?php echo esc_attr($button_icon); ?>"></i><?php endif; ?></button>
				<?php elseif ( $settings['wfe_elementor_modal_box_display_on'] === 'image' ) : ?>
                    <img class="wfe_elementor-modal-box-img-selector" data-toggle="wfe_elementor-modal" data-target="#wfe_elementor-modal-<?php  echo esc_attr( $this->get_id() ); ?>" src="<?php echo $settings['wfe_elementor_modal_box_image_src']['url'];?>">
				<?php elseif($settings['wfe_elementor_modal_box_display_on'] === 'text') : ?>
                    <span class="wfe_elementor-modal-box-text-selector" data-toggle="wfe_elementor-modal" data-target="#wfe_elementor-modal-<?php  echo esc_attr( $this->get_id() ); ?>"><div <?php echo $this->get_render_attribute_string('wfe_elementor_modal_box_selector_text'); ?>><?php echo $settings['wfe_elementor_modal_box_selector_text'];?></div></span>
				<?php endif; ?>
            </div>

            <!-- Modal -->
            <div id="wfe_elementor-modal-<?php echo  $this->get_id(); ?>"  class="wfe_elementor-modal-box-modal wfe_elementor-modal-fade" role="dialog">
                <div class="wfe_elementor-modal-box-modal-dialog">

                    <!-- Modal content-->
                    <div class="wfe_elementor-modal-box-modal-content">
						<?php if($settings['wfe_elementor_modal_box_header_switcher'] == 'yes'): ?>
                            <div class="wfe_elementor-modal-box-modal-header">
								<?php if ( $settings['wfe_elementor_modal_box_upper_close'] === 'yes' ) : ?>
                                    <div class="wfe_elementor-modal-box-close-button-container">
                                        <button type="button" class="wfe_elementor-modal-box-modal-close" data-dismiss="wfe_elementor-modal">&times;</button>
                                    </div>
								<?php endif; ?>
                                <h3 class="wfe_elementor-modal-box-modal-title">
									<?php if($settings['wfe_elementor_modal_box_icon_selection'] === 'fonticon') : ?>
                                        <i class="fa <?php echo $settings['wfe_elementor_modal_box_font_icon'];?>"></i>
									<?php elseif( $settings['wfe_elementor_modal_box_icon_selection'] === 'image' ) : ?>
                                        <img src="<?php echo $settings['wfe_elementor_modal_box_image_icon']['url'];?>">
									<?php endif; ?><?php echo $settings['wfe_elementor_modal_box_title'];?></h3>
                            </div>
						<?php endif; ?>
                        <div class="wfe_elementor-modal-box-modal-body">
							<?php if($settings['wfe_elementor_modal_box_content_type'] == 'editor') : echo $settings['wfe_elementor_modal_box_content']; else: echo $wfe_elementor_elements_frontend->get_builder_content($elementor_post_id, true); endif; ?>
                        </div>
						<?php if ( $settings['wfe_elementor_modal_box_lower_close'] === 'yes' ) : ?>
                            <div class="wfe_elementor-modal-box-modal-footer">
                                <button type="button" class="btn wfe_elementor-modal-box-modal-lower-close" data-dismiss="wfe_elementor-modal">Close
                                </button>
                            </div>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <style>

            <?php if( !empty($settings['wfe_elementor_modal_box_modal_size']['size'] ) ) :
				echo '@media (min-width:992px) {'; ?>
            #wfe_elementor-modal-<?php echo  $this->get_id(); ?> .wfe_elementor-modal-box-modal-dialog {
                width: <?php echo $settings['wfe_elementor_modal_box_modal_size']['size'] . $settings['wfe_elementor_modal_box_modal_size']['unit']; ?>
            }
            <?php echo '}'; endif; ?>

        </style>

		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Wfe_modal() );