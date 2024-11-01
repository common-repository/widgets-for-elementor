<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_tooltip extends Widget_Base {

	public function get_name() {
		return 'wfe-tooltip';
	}

	public function get_title() {
		return __( 'Tooltip', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-button wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {
		/**
		 * Tooltip Settings
		 */
		$this->start_controls_section(
			'eael_section_tooltip_settings',
			[
				'label' => esc_html__( 'Content Settings', 'wfe_elementor' )
			]
		);
		$this->add_responsive_control(
			'wfe_tooltip_type',
			[
				'label' => esc_html__( 'Content Type', 'wfe_elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'icon' => [
						'title' => esc_html__( 'Icon', 'wfe_elementor' ),
						'icon' => 'fa fa-info',
					],
					'text' => [
						'title' => esc_html__( 'Text', 'wfe_elementor' ),
						'icon' => 'fa fa-text-width',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'wfe_elementor' ),
						'icon' => 'fa fa-image',
					],
					'shortcode' => [
						'title' => esc_html__( 'Shortcode', 'wfe_elementor' ),
						'icon' => 'fa fa-code',
					],
				],
				'default' => 'icon',
			]
		);
		$this->add_control(
			'wfe_tooltip_content',
			[
				'label' => esc_html__( 'Content', 'wfe_elementor' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => esc_html__( 'Hover Me!', 'wfe_elementor' ),
				'condition' => [
					'wfe_tooltip_type' => [ 'text' ]
				],
				'dynamic' => [ 'active' => true ]
			]
		);
		$this->add_control(
			'wfe_tooltip_content_tag',
			[
				'label'       	=> esc_html__( 'Content Tag', 'wfe_elementor' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'span',
				'label_block' 	=> false,
				'options' 		=> [
					'h1'  	=> esc_html__( 'H1', 'wfe_elementor' ),
					'h2'  	=> esc_html__( 'H2', 'wfe_elementor' ),
					'h3'  	=> esc_html__( 'H3', 'wfe_elementor' ),
					'h4'  	=> esc_html__( 'H4', 'wfe_elementor' ),
					'h5'  	=> esc_html__( 'H5', 'wfe_elementor' ),
					'h6'  	=> esc_html__( 'H6', 'wfe_elementor' ),
					'div'  	=> esc_html__( 'DIV', 'wfe_elementor' ),
					'span'  => esc_html__( 'SPAN', 'wfe_elementor' ),
					'p'  	=> esc_html__( 'P', 'wfe_elementor' ),
				],
				'condition' => [
					'wfe_tooltip_type' => 'text'
				]
			]
		);
		$this->add_control(
			'wfe_tooltip_shortcode_content',
			[
				'label' => esc_html__( 'Shortcode', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( '[shortcode-here]', 'wfe_elementor' ),
				'condition' => [
					'wfe_tooltip_type' => [ 'shortcode' ]
				]
			]
		);
		$this->add_control(
			'wfe_tooltip_icon_content',
			[
				'label' => esc_html__( 'Icon', 'wfe_elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-home',
				'condition' => [
					'wfe_tooltip_type' => [ 'icon' ]
				]
			]
		);
		$this->add_control(
			'wfe_tooltip_img_content',
			[
				'label' => esc_html__( 'Image', 'wfe_elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'wfe_tooltip_type' => [ 'image' ]
				]
			]
		);
		$this->add_responsive_control(
			'wfe_tooltip_content_alignment',
			[
				'label' => esc_html__( 'Content Alignment', 'wfe_elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'wfe_elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'wfe_elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'wfe_elementor' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'wfe_elementor' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'left',
				'prefix_class' => 'wfe-tooltip-align-',
			]
		);
		$this->add_control(
			'wfe_tooltip_enable_link',
			[
				'label' => esc_html__( 'Enable Link', 'wfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'false',
				'return_value' => 'yes',
				'condition' => [
					'wfe_tooltip_type!' => ['shortcode']
				]
			]
		);
		$this->add_control(
			'wfe_tooltip_link',
			[
				'label' => esc_html__( 'Button Link', 'wfe_elementor' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
					'url' => '#',
					'is_external' => '',
				],
				'show_external' => true,
				'condition' => [
					'wfe_tooltip_enable_link' => 'yes'
				]
			]
		);
		$this->end_controls_section();

		/**
		 * Tooltip Hover Content Settings
		 */
		$this->start_controls_section(
			'eael_section_tooltip_hover_content_settings',
			[
				'label' => esc_html__( 'Tooltip Settings', 'wfe_elementor' )
			]
		);
		$this->add_control(
			'wfe_tooltip_hover_content',
			[
				'label' => esc_html__( 'Content', 'wfe_elementor' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => esc_html__( 'Tooltip content', 'wfe_elementor' ),
				'dynamic' => [ 'active' => true ]
			]
		);
		$this->add_control(
			'wfe_tooltip_hover_dir',
			[
				'label'       	=> esc_html__( 'Hover Direction', 'wfe_elementor' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'right',
				'label_block' 	=> false,
				'options' 		=> [
					'left'  	=> esc_html__( 'Left', 'wfe_elementor' ),
					'right'  	=> esc_html__( 'Right', 'wfe_elementor' ),
					'top'  		=> esc_html__( 'Top', 'wfe_elementor' ),
					'bottom'  	=> esc_html__( 'Bottom', 'wfe_elementor' ),
				],
			]
		);
		$this->add_control(
			'wfe_tooltip_hover_speed',
			[
				'label' => esc_html__( 'Hover Speed', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '300', 'wfe_elementor' ),
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip:hover .wfe-tooltip-text.wfe-tooltip-top' => 'animation-duration: {{SIZE}}ms;',
					'{{WRAPPER}} .wfe-tooltip:hover .wfe-tooltip-text.wfe-tooltip-left' => 'animation-duration: {{SIZE}}ms;',
					'{{WRAPPER}} .wfe-tooltip:hover .wfe-tooltip-text.wfe-tooltip-bottom' => 'animation-duration: {{SIZE}}ms;',
					'{{WRAPPER}} .wfe-tooltip:hover .wfe-tooltip-text.wfe-tooltip-right' => 'animation-duration: {{SIZE}}ms;',
				]
			]
		);
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Tooltip Content
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'eael_section_tooltip_style_settings',
			[
				'label' => esc_html__( 'Content Style', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'wfe_tooltip_max_width',
			[
				'label' => __( 'Content Max Width', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip' => 'max-width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'wfe_tooltip_content_padding',
			[
				'label' => esc_html__( 'Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wfe_tooltip_content_margin',
			[
				'label' => esc_html__( 'Margin', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'wfe_tooltip_content_style_tabs' );
		// Normal State Tab
		$this->start_controls_tab( 'wfe_tooltip_content_normal', [ 'label' => esc_html__( 'Normal', 'wfe_elementor' ) ] );
		$this->add_control(
			'wfe_tooltip_content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'wfe_tooltip_content_color',
			[
				'label' => esc_html__( 'Text Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wfe-tooltip a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wfe_tooltip_shadow',
				'selector' => '{{WRAPPER}} .wfe-tooltip',
				'separator' => 'before'
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wfe_tooltip_border',
				'label' => esc_html__( 'Border', 'wfe_elementor' ),
				'selector' => '{{WRAPPER}} .wfe-tooltip',
			]
		);
		$this->end_controls_tab();

		// Hover State Tab
		$this->start_controls_tab( 'wfe_tooltip_content_hover', [ 'label' => esc_html__( 'Hover', 'wfe_elementor' ) ] );
		$this->add_control(
			'wfe_tooltip_content_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'wfe_tooltip_content_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#212121',
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wfe-tooltip:hover a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wfe_tooltip_hover_shadow',
				'selector' => '{{WRAPPER}} .wfe-tooltip:hover',
				'separator' => 'before'
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wfe_tooltip_hover_border',
				'label' => esc_html__( 'Border', 'wfe_elementor' ),
				'selector' => '{{WRAPPER}} .wfe-tooltip:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_tooltip_content_typography',
				'selector' => '{{WRAPPER}} .wfe-tooltip',
			]
		);
		$this->add_responsive_control(
			'wfe_tooltip_content_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Tooltip Hover Content
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'eael_section_tooltip_hover_style_settings',
			[
				'label' => esc_html__( 'Tooltip Style', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'wfe_tooltip_hover_width',
			[
				'label' => __( 'Tooltip Width', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '150'
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'wfe_tooltip_hover_max_width',
			[
				'label' => __( 'Tooltip Max Width', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '150'
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text' => 'max-width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'wfe_tooltip_hover_content_padding',
			[
				'label' => esc_html__( 'Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wfe_tooltip_hover_content_margin',
			[
				'label' => esc_html__( 'Margin', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'wfe_tooltip_hover_content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#555',
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'wfe_tooltip_hover_content_color',
			[
				'label' => esc_html__( 'Text Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_tooltip_hover_content_typography',
				'selector' => '{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wfe_tooltip_box_shadow',
				'selector' => '{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text',
			]
		);
		$this->add_responsive_control(
			'wfe_tooltip_arrow_size',
			[
				'label' => __( 'Arrow Size', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text:after' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text.wfe-tooltip-left::after' => 'top: calc( 50% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text.wfe-tooltip-right::after' => 'top: calc( 50% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text.wfe-tooltip-top::after' => 'left: calc( 50% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text.wfe-tooltip-bottom::after' => 'left: calc( 50% - {{SIZE}}{{UNIT}} );',
				],
			]
		);
		$this->add_control(
			'wfe_tooltip_arrow_color',
			[
				'label' => esc_html__( 'Arrow Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#555',
				'selectors' => [
					'{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text.wfe-tooltip-top:after' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text.wfe-tooltip-bottom:after' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text.wfe-tooltip-left:after' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .wfe-tooltip .wfe-tooltip-text.wfe-tooltip-right:after' => 'border-right-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}


	protected function render( ) {

		$settings = $this->get_settings_for_display();
		$target = $settings['wfe_tooltip_link']['is_external'] ? 'target="_blank"' : '';
		$nofollow = $settings['wfe_tooltip_link']['nofollow'] ? 'rel="nofollow"' : '';
		?>
        <div class="wfe-tooltip">
		<?php if( $settings['wfe_tooltip_type'] === 'text' ) : ?>
            <<?php echo esc_attr( $settings['wfe_tooltip_content_tag'] ); ?> class="wfe-tooltip-content"><?php if( $settings['wfe_tooltip_enable_link'] === 'yes' ) : ?><a href="<?php echo esc_url( $settings['wfe_tooltip_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> ><?php endif; ?><?php echo esc_html__( $settings['wfe_tooltip_content'], 'wfe_elementor' ); ?><?php if( $settings['wfe_tooltip_enable_link'] === 'yes' ) : ?></a><?php endif; ?></<?php echo esc_attr( $settings['wfe_tooltip_content_tag'] ); ?>>
            <span class="wfe-tooltip-text wfe-tooltip-<?php echo esc_attr( $settings['wfe_tooltip_hover_dir'] ) ?>"><?php echo __( $settings['wfe_tooltip_hover_content'] ); ?></span>
		<?php elseif( $settings['wfe_tooltip_type'] === 'icon' ) : ?>
            <span class="wfe-tooltip-content"><?php if( $settings['wfe_tooltip_enable_link'] === 'yes' ) : ?><a href="<?php echo esc_url( $settings['wfe_tooltip_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> ><?php endif; ?><i class="<?php echo esc_attr( $settings['wfe_tooltip_icon_content'] ); ?>"></i><?php if( $settings['wfe_tooltip_enable_link'] === 'yes' ) : ?></a><?php endif; ?></span>
            <span class="wfe-tooltip-text wfe-tooltip-<?php echo esc_attr( $settings['wfe_tooltip_hover_dir'] ) ?>"><?php echo __( $settings['wfe_tooltip_hover_content'] ); ?></span>
		<?php elseif( $settings['wfe_tooltip_type'] === 'image' ) : ?>
            <span class="wfe-tooltip-content"><?php if( $settings['wfe_tooltip_enable_link'] === 'yes' ) : ?><a href="<?php echo esc_url( $settings['wfe_tooltip_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> ><?php endif; ?><img src="<?php echo esc_url( $settings['wfe_tooltip_img_content']['url'] ); ?>" alt="<?php echo esc_attr( $settings['wfe_tooltip_hover_content'] ); ?>"><?php if( $settings['wfe_tooltip_enable_link'] === 'yes' ) : ?></a><?php endif; ?></span>
            <span class="wfe-tooltip-text wfe-tooltip-<?php echo esc_attr( $settings['wfe_tooltip_hover_dir'] ) ?>"><?php echo __( $settings['wfe_tooltip_hover_content'] ); ?></span>
		<?php elseif( $settings['wfe_tooltip_type'] === 'shortcode' ) : ?>
            <div class="wfe-tooltip-content"><?php echo do_shortcode( $settings['wfe_tooltip_shortcode_content'] ); ?></div>
            <span class="wfe-tooltip-text wfe-tooltip-<?php echo esc_attr( $settings['wfe_tooltip_hover_dir'] ) ?>"><?php echo __( $settings['wfe_tooltip_hover_content'] ); ?></span>
		<?php endif; ?>
        </div>
		<?php
	}

	protected function content_template() {}
}


Plugin::instance()->widgets_manager->register_widget_type( new Wfe_tooltip() );