<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_test extends Widget_Base {

	public function get_name() {
		return 'wfe-test';
	}

	public function get_title() {
		return __( 'Services', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-favorite wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Register Control
	protected function _register_controls() {

		$this->start_controls_section( 'content_section', [
			'label' => __( 'Options', 'wfe_elementor' ),
			//'tab'   => Controls_Manager::TAB_CONTENT,
		] );
		// Services Icon
		$this->add_control( 'service_icon', [
			'label'       => __( 'Icon', 'wfe_elementor' ),
			'type'        => Controls_Manager::ICON,
			'label_block' => true,
			'default'     => 'fa fa-star',
		] );

		//Title Control
		$this->add_control( 'service_title', [
				'label'       => __( 'Service Title', 'wfe_elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Creative Idea', 'wfe_elementor' ),
				'placeholder' => __( 'Type your Service Title here', 'wfe_elementor' ),
			] );

		//Description Control
		$this->add_control( 'service_description', [
				'label'       => __( 'Service Description', 'wfe_elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings.', 'wfe_elementor' ),
				'placeholder' => __( 'Type your Service Item Description here', 'wfe_elementor' ),
			] );

		//Link Title Control
		$this->add_control( 'link_text', [
				'label'   => __( 'Link Text', 'wfe_elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Learn More', 'wfe_elementor' ),
				//'placeholder' => __( 'Type your Service Title here', 'wfe_elementor' ),
			] );

		// Link Control
		$this->add_control( 'website_link', [
				'label'         => __( 'Link', 'plugin-domain' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'plugin-domain' ),
				'show_external' => true,
				'default'       => [
					'url'         => 'http://google.com',
					'is_external' => true,
					'nofollow'    => true,
				],
			] );


		$this->end_controls_section();


		// Service Styling Start

		$this->start_controls_section( 'wfe_service_style_section', [
			'label' => __( 'Service Effects', 'wfe_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		// Select Services Style
		$this->add_control('wfe_services_style',[
				'label' => __( 'Select Service Style', 'wfe_elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style1' => __( 'Style 1', 'wfe_elementor' ),
					'style2' => __( 'Style 2', 'wfe_elementor' ),
					'style3' => __( 'Style 3', 'wfe_elementor' ),
					'style4' => __( 'Style 4', 'wfe_elementor' ),
					'style5' => __( 'Style 5', 'wfe_elementor' ),
					'style6' => __( 'Style 6', 'wfe_elementor' ),
					'style7' => __( 'Style 7', 'wfe_elementor' ),
					'style8' => __( 'Style 8', 'wfe_elementor' ),
				],
				'default' => 'style1',
			]
		);
		$this->end_controls_section();


		$this->start_controls_section( 'wfe_service_icon_section', [
			'label' => __( 'Icon Style', 'wfe_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );


		// Style 1 Icon Background Color Control
		$this->add_control( 'icon_bg_color1', [
				'label'     => __( 'Icon Background Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3498DB',

				'selectors' => [
					'{{WRAPPER}} .wfe-services-icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'wfe_services_style' => 'style1',
				],
			] );


		// Icon  Color Control
		$this->add_control( 'icon_color', [
				'label'   => __( 'Icon Color', 'wfe_elementor' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .wfe-services-icon' => 'color: {{VALUE}};',
				],
			] );

		// Style 2 Icon Background Hover Color Control
		$this->add_control( 'icon_color2', [
			'label'     => __( 'Icon Background Hover Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#000',
			'selectors' => [
				'{{WRAPPER}} .wfe-services-style2 .wfe-services-item:hover .wfe-services-icon' => 'background-color: {{VALUE}};',
			],
			'condition' => [
				'wfe_services_style' => 'style2',
			],
		] );

		// Style 2 Icon Background Color Control
		$this->add_control( 'icon_bg_color2', [
				'label'     => __( 'Icon Background Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ddd',
				'selectors' => [
					'{{WRAPPER}} .wfe-services-icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'wfe_services_style' => 'style2',
				],
			] );
		// Style 4 Icon Border Color
		$this->add_control( 'icon_border_color4', [
				'label'     => __( 'Icon Border Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'condition' => [
					'wfe_services_style' => 'style4',
				],
			] );

		// Style 5 Icon Background Hover Color Control
		$this->add_control( 'icon_hov_color5', [
			'label'     => __( 'Icon Background Hover Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#000',
			'selectors' => [
				'{{WRAPPER}} .wfe-services-style5 .wfe-services-item:hover .wfe-services-icon' => 'background-color: {{VALUE}};',
			],
			'condition' => [
				'wfe_services_style' => 'style5',
			],
		] );

		// Style 6 Icon Background Color Control
		$this->add_control( 'icon_bg_color6', [
				'label'     => __( 'Icon Background Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3498DB',
				'condition' => [
					'wfe_services_style' => 'style6',
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-services-style6 .wfe-services-icon' => 'background-color: {{VALUE}};',
				],
			] );

		// Style 7 Icon Background Color Control
		$this->add_control( 'icon_bg_color7', [
				'label'     => __( 'Icon Service Background Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#EDEDED',
				'condition' => [
					'wfe_services_style' => 'style7',
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-services-style7 .wfe-services-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wfe-services-style7 .wfe-services-desc' => 'background-color: {{VALUE}};',
				],
			] );

		// Style 7 Icon Background Hover Color Control
		$this->add_control( 'icon_bg_color7hover', [
				'label'     => __( 'Icon Service Background hover Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'condition' => [
					'wfe_services_style' => 'style7',
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-services-style7 .wfe-services-item:hover .wfe-services-icon' => 'background-color: {{VALUE}};',
				],
			] );

		// Style 8 Icon Background Hover Color Control
		$this->add_control( 'icon_bg_color8hover', [
				'label'     => __( 'Icon Service Background hover Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'condition' => [
					'wfe_services_style' => 'style8',
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-services-style8 .wfe-services-item:hover .wfe-services-icon' => 'background-color: {{VALUE}};',
				],
			] );

		$this->end_controls_section();

	}

	// Render Control in Frontend
	protected function render() {
		//
		//		$html = wp_oembed_get( $settings['url'] );

		// Get Controller Output
		$settings = $this->get_settings_for_display();

		// Get Url Value
		$target   = $settings['website_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['website_link']['nofollow'] ? ' rel="nofollow"' : '';


		// Style 1
		if ( $settings['wfe_services_style'] == 'style1' ) {
			$output = '<div class=" container-center"><div class=" wfe-services-' . $settings['wfe_services_style'] . '">';

			$output .= '<div class="wfe-services-item">
						            <div class="wfe-services-icon">
						                <i class="' . $settings['service_icon'] . '"></i>
						            </div>
						            <div class="wfe-services-desc">
						                <h2 class="wfe-services-title">' . $settings['service_title'] . '</h2>
						               <p>' . $settings['service_description'] . '</p>
						               <a href="' . $settings['website_link']['url'] . '" ' . $target . $nofollow . '>' . $settings['link_text'] . ' <i class="fa fa-arrow-circle-o-right"></i></a>
						            </div>
						        </div>';
		} // Style 2
		else if ( $settings['wfe_services_style'] == 'style2' ) {
			$output = '<div class=" container-center"><div class=" wfe-services-' . $settings['wfe_services_style'] . '">';

			$output .= '<div class="wfe-services-item">
						            <div class="wfe-services-icon">
						                <i class="' . $settings['service_icon'] . '"></i>
						            </div>
						            <div class="wfe-services-desc">
						                <h2 class="wfe-services-title">' . $settings['service_title'] . '</h2>
						               <p>' . $settings['service_description'] . '</p>
						               <a href="' . $settings['website_link']['url'] . '" ' . $target . $nofollow . '>' . $settings['link_text'] . ' <i class="fa fa-arrow-circle-o-right"></i></a>
						            </div>
						        </div>';
		} // Style 3
		else if ( $settings['wfe_services_style'] == 'style3' ) {
			$output = '<div class=" container-center"><div class=" wfe-services-' . $settings['wfe_services_style'] . '">';
			$output .= '<div class="wfe-services-item">
						            <div class="wfe-services-icon">
						                <i class="' . $settings['service_icon'] . '"></i>
						            </div>
						            <div class="wfe-services-desc">
						                <h2 class="wfe-services-title">' . $settings['service_title'] . '</h2>
						               <p>' . $settings['service_description'] . '</p>
						               <a href="' . $settings['website_link']['url'] . '" ' . $target . $nofollow . '>' . $settings['link_text'] . ' <i class="fa fa-arrow-circle-o-right"></i></a>
						            </div>
						        </div>';
		} // Style 4
		else if ( $settings['wfe_services_style'] == 'style4' ) {

			$output = '<div class=" container-center"><div class=" wfe-services-' . $settings['wfe_services_style'] . '">';
			$output .= '<div class="wfe-services-item" style="border: 1px solid ' . $settings['icon_border_color4'] . ';">
						            <div class="wfe-services-icon" style="border-color: ' . $settings['icon_border_color4'] . '; ">
						                <i class="' . $settings['service_icon'] . '"></i>
						            </div>
						            <div class="wfe-services-desc">
						                <h2 class="wfe-services-title">' . $settings['service_title'] . '</h2>
						               <p>' . $settings['service_description'] . '</p>
						               <a href="' . $settings['website_link']['url'] . '" ' . $target . $nofollow . '>' . $settings['link_text'] . ' <i class="fa fa-arrow-circle-o-right"></i></a>
						            </div>
						        </div>';
		} // Style 5
		else if ( $settings['wfe_services_style'] == 'style5' ) {
			$output = '<div class=" container-center"><div class=" wfe-services-' . $settings['wfe_services_style'] . '">';
			$output .= '<div class="wfe-services-item">
						            <div class="wfe-services-icon">
						                <i class="' . $settings['service_icon'] . '"></i>
						            </div>
						            <div class="wfe-services-desc">
						                <h2 class="wfe-services-title">' . $settings['service_title'] . '</h2>
						               <p>' . $settings['service_description'] . '</p>
						               <a href="' . $settings['website_link']['url'] . '" ' . $target . $nofollow . '>' . $settings['link_text'] . ' <i class="fa fa-arrow-circle-o-right"></i></a>
						            </div>
						        </div>';
		} // Style 6
		else if ( $settings['wfe_services_style'] == 'style6' ) {
			$output = '<div class=" container-center"><div class=" wfe-services-' . $settings['wfe_services_style'] . '">';
			$output .= '<div class="wfe-services-item">
					            <div class="wfe-services-icon">
						                <i class="' . $settings['service_icon'] . '"></i>
						            </div>
						            <div class="wfe-services-desc">
						                <h2 class="wfe-services-title">' . $settings['service_title'] . '</h2>
						               <p>' . $settings['service_description'] . '</p>
						               <a href="' . $settings['website_link']['url'] . '" ' . $target . $nofollow . '>' . $settings['link_text'] . ' <i class="fa fa-arrow-circle-o-right"></i></a>
						            </div>
						        </div>';
		} // Style 7
		else if ( $settings['wfe_services_style'] == 'style7' ) {
			$output = '<div class=" container-center"><div class=" wfe-services-' . $settings['wfe_services_style'] . '">';
			$output .= '<div class="wfe-services-item">
						            <div class="wfe-services-icon">
						                <i class="' . $settings['service_icon'] . '"></i>
						            </div>
						            <div class="wfe-services-desc">
						                <h2 class="wfe-services-title">' . $settings['service_title'] . '</h2>
						               <p>' . $settings['service_description'] . '</p>
						               <a href="' . $settings['website_link']['url'] . '" ' . $target . $nofollow . '>' . $settings['link_text'] . ' <i class="fa fa-arrow-circle-o-right"></i></a>
						            </div>
						        </div>';
		} // Style 8
		else if ( $settings['wfe_services_style'] == 'style8' ) {
			$output = '<div class=" container-center"><div class=" wfe-services-' . $settings['wfe_services_style'] . '">';
			$output .= '<div class="wfe-services-item">
						            <div class="wfe-services-icon">
						                <i class="' . $settings['service_icon'] . '"></i>
						            </div>
						            <div class="wfe-services-desc">
						                <h2 class="wfe-services-title">' . $settings['service_title'] . '</h2>
						               <p>' . $settings['service_description'] . '</p>
						               <a href="' . $settings['website_link']['url'] . '" ' . $target . $nofollow . '>' . $settings['link_text'] . ' <i class="fa fa-arrow-circle-o-right"></i></a>
						            </div>
						        </div>';
		}


		$output .= '</div></div>';

		echo $output;

	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Wfe_test() );