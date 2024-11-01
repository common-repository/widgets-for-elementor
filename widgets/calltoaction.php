<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_calltoaction extends Widget_Base {

	public function get_name() {
		return 'wfe-calltoaction';
	}

	public function get_title() {
		return __( 'Call To Action', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-call-to-action wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Register Control
	protected function _register_controls() {

		/**
		 * Call to Action Content Settings
		 */
		$this->start_controls_section(
			'wfe_section_wfe_content_settings',
			[
				'label' => esc_html__( 'Content Settings', 'wfe_elementor' )
			]
		);

		$this->add_control(
			'wfe_wfe_type',
			[
				'label'       	=> esc_html__( 'Content Style', 'wfe_elementor' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'wfe-basic',
				'label_block' 	=> false,
				'options' 		=> [
					'wfe-basic'  		=> esc_html__( 'Basic', 'wfe_elementor' ),
					'wfe-flex' 			=> esc_html__( 'Flex Grid', 'wfe_elementor' ),
					'wfe-icon-flex' 	=> esc_html__( 'Flex Grid with Icon', 'wfe_elementor' ),
				],
			]
		);

		/**
		 * Condition: 'wfe_wfe_type' => 'wfe-basic'
		 */
		$this->add_control(
			'wfe_wfe_content_type',
			[
				'label'       	=> esc_html__( 'Content Type', 'wfe_elementor' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'wfe-default',
				'label_block' 	=> false,
				'options' 		=> [
					'wfe-default'  	=> esc_html__( 'Left', 'wfe_elementor' ),
					'wfe-center' 		=> esc_html__( 'Center', 'wfe_elementor' ),
					'wfe-right' 		=> esc_html__( 'Right', 'wfe_elementor' ),
				],
				'condition'    => [
					'wfe_wfe_type' => 'wfe-basic'
				]
			]
		);

		$this->add_control(
			'wfe_wfe_color_type',
			[
				'label'       	=> esc_html__( 'Color Style', 'wfe_elementor' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'wfe-bg-color',
				'label_block' 	=> false,
				'options' 		=> [
					'wfe-bg-color'  		=> esc_html__( 'Background Color', 'wfe_elementor' ),
					'wfe-bg-img' 			=> esc_html__( 'Background Image', 'wfe_elementor' ),
					'wfe-bg-img-fixed' 	=> esc_html__( 'Background Fixed Image', 'wfe_elementor' ),
				],
			]
		);

		/**
		 * Condition: 'wfe_wfe_type' => 'wfe-icon-flex'
		 */
		$this->add_control(
			'wfe_wfe_flex_grid_icon',
			[
				'label' => esc_html__( 'Icon', 'wfe_elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-bullhorn',
				'condition' => [
					'wfe_wfe_type' => 'wfe-icon-flex'
				]
			]
		);

		$this->add_control(
			'wfe_wfe_title',
			[
				'label' => esc_html__( 'Title', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Call To Action Widgets For Elementor', 'wfe_elementor' ),
				'dynamic' => [ 'active' => true ]
			]
		);
		$this->add_control(
			'wfe_wfe_content',
			[
				'label' => esc_html__( 'Content', 'wfe_elementor' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'wfe_elementor' ),
				'separator' => 'after',
			]
		);

		$this->add_control(
			'wfe_wfe_btn_text',
			[
				'label' => esc_html__( 'Button Text', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Button Text', 'wfe_elementor' )
			]
		);

		$this->add_control(
			'wfe_wfe_btn_link',
			[
				'label' => esc_html__( 'Button Link', 'wfe_elementor' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
					'url' => 'http://',
					'is_external' => '',
				],
				'show_external' => true,
				'separator' => 'after'
			]
		);

		/**
		 * Condition: 'wfe_wfe_color_type' => 'wfe-bg-img' && 'wfe_wfe_color_type' => 'wfe-bg-img-fixed',
		 */
		$this->add_control(
			'wfe_wfe_bg_image',
			[
				'label' => esc_html__( 'Background Image', 'wfe_elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action.bg-img' => 'background-image: url({{URL}});',
					'{{WRAPPER}} .wfe-call-to-action.bg-img-fixed' => 'background-image: url({{URL}});',
				],
				'condition' => [
					'wfe_wfe_color_type' => [ 'wfe-bg-img', 'wfe-bg-img-fixed' ],
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (wfe Title Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wfe_section_wfe_style_settings',
			[
				'label' => esc_html__( 'Call to Action Style', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'wfe_wfe_container_width',
			[
				'label' => esc_html__( 'Set max width for the container?', 'wfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'wfe_elementor' ),
				'label_off' => __( 'no', 'wfe_elementor' ),
				'default' => 'yes',
			]
		);

		$this->add_responsive_control(
			'wfe_wfe_container_width_value',
			[
				'label' => __( 'Container Max Width (% or px)', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1170,
					'unit' => 'px',
				],
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1500,
						'step' => 5,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'wfe_wfe_container_width' => 'yes',
				],
			]
		);

		$this->add_control(
			'wfe_wfe_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f4f4f4',
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'wfe_wfe_container_padding',
			[
				'label' => esc_html__( 'Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'wfe_wfe_container_margin',
			[
				'label' => esc_html__( 'Margin', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wfe_wfe_border',
				'label' => esc_html__( 'Border', 'wfe_elementor' ),
				'selector' => '{{WRAPPER}} .wfe-call-to-action',
			]
		);

		$this->add_control(
			'wfe_wfe_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wfe_wfe_shadow',
				'selector' => '{{WRAPPER}} .wfe-call-to-action',
			]
		);


		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (wfe Title Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wfe_section_wfe_title_style_settings',
			[
				'label' => esc_html__( 'Color &amp; Typography ', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'wfe_wfe_title_heading',
			[
				'label' => esc_html__( 'Title Style', 'wfe_elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'wfe_wfe_title_color',
			[
				'label' => esc_html__( 'Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action .wfe_cta_title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_wfe_title_typography',
				'selector' => '{{WRAPPER}} .wfe-call-to-action .wfe_cta_title',
			]
		);

		$this->add_control(
			'wfe_wfe_content_heading',
			[
				'label' => esc_html__( 'Content Style', 'wfe_elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'wfe_wfe_content_color',
			[
				'label' => esc_html__( 'Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_wfe_content_typography',
				'selector' => '{{WRAPPER}} .wfe-call-to-action p',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Button Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wfe_section_wfe_btn_style_settings',
			[
				'label' => esc_html__( 'Button Style', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'wfe_wfe_btn_effect_type',
			[
				'label'       	=> esc_html__( 'Effect', 'wfe_elementor' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'default',
				'label_block' 	=> false,
				'options' 		=> [
					'default'  			=> esc_html__( 'Default', 'wfe_elementor' ),
					'top-to-bottom'  	=> esc_html__( 'Top to Bottom', 'wfe_elementor' ),
					'left-to-right'  	=> esc_html__( 'Left to Right', 'wfe_elementor' ),
				],
			]
		);

		$this->add_responsive_control(
			'wfe_wfe_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action .wfe-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'wfe_wfe_btn_margin',
			[
				'label' => esc_html__( 'Margin', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action .wfe-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_wfe_btn_typography',
				'selector' => '{{WRAPPER}} .wfe-call-to-action .wfe-button',
			]
		);

		$this->start_controls_tabs( 'wfe_wfe_button_tabs' );

		// Normal State Tab
		$this->start_controls_tab( 'wfe_wfe_btn_normal', [ 'label' => esc_html__( 'Normal', 'wfe_elementor' ) ] );

		$this->add_control(
			'wfe_wfe_btn_normal_text_color',
			[
				'label' => esc_html__( 'Text Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action .wfe-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wfe_wfe_btn_normal_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f9f9f9',
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action .wfe-button' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wfe_cat_btn_normal_border',
				'label' => esc_html__( 'Border', 'wfe_elementor' ),
				'selector' => '{{WRAPPER}} .wfe-call-to-action .wfe-button',
			]
		);

		$this->add_control(
			'wfe_wfe_btn_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action .wfe-button' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_tab();

		// Hover State Tab
		$this->start_controls_tab( 'wfe_wfe_btn_hover', [ 'label' => esc_html__( 'Hover', 'wfe_elementor' ) ] );

		$this->add_control(
			'wfe_wfe_btn_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f9f9f9',
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action .wfe-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wfe_wfe_btn_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#3F51B5',
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action .wfe-button:after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .wfe-call-to-action .wfe-button:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wfe_wfe_btn_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action .wfe-button:hover' => 'border-color: {{VALUE}};',
				],
			]

		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wfe_wfe_button_shadow',
				'selector' => '{{WRAPPER}} .wfe-call-to-action .wfe-button',
				'separator' => 'before'
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Button Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wfe_section_wfe_icon_style_settings',
			[
				'label' => esc_html__( 'Icon Style', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'wfe_wfe_type' => 'wfe-icon-flex'
				]
			]
		);

		$this->add_control(
			'wfe_section_wfe_icon_size',
			[
				'label' => esc_html__( 'Font Size', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80
				],
				'range' => [
					'px' => [
						'max' => 160,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action.wfe-icon-flex .icon' => 'font-size: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'wfe_section_wfe_icon_color',
			[
				'label' => esc_html__( 'Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#444',
				'selectors' => [
					'{{WRAPPER}} .wfe-call-to-action.wfe-icon-flex .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}


	protected function render( ) {

		$settings = $this->get_settings_for_display();
		$target = $settings['wfe_wfe_btn_link']['is_external'] ? 'target="_blank"' : '';
		$nofollow = $settings['wfe_wfe_btn_link']['nofollow'] ? 'rel="nofollow"' : '';
		if( 'wfe-bg-color' == $settings['wfe_wfe_color_type'] ) {
			$wfe_class = 'bg-lite';
		}else if( 'wfe-bg-img' == $settings['wfe_wfe_color_type'] ) {
			$wfe_class = 'bg-img';
		}else if( 'wfe-bg-img-fixed' == $settings['wfe_wfe_color_type'] ) {
			$wfe_class = 'bg-img bg-fixed';
		}else {
			$wfe_class = '';
		}
		// Is Basic wfe Content Center or Not
		if( 'wfe-center' === $settings['wfe_wfe_content_type'] ) {
			$wfe_alignment = 'wfe-center';
		}elseif( 'wfe-right' === $settings['wfe_wfe_content_type'] ) {
			$wfe_alignment = 'wfe-right';
		}else {
			$wfe_alignment = 'wfe-left';
		}
		// Button Effect
		if( 'left-to-right' == $settings['wfe_wfe_btn_effect_type'] ) {
			$wfe_btn_effect = 'effect-2';
		}elseif( 'top-to-bottom' == $settings['wfe_wfe_btn_effect_type'] ) {
			$wfe_btn_effect = 'effect-1';
		}else {
			$wfe_btn_effect = '';
		}

		?>
		<?php if( 'wfe-basic' == $settings['wfe_wfe_type'] ) : ?>
            <div class="wfe-call-to-action <?php echo esc_attr( $wfe_class ); ?> <?php echo esc_attr( $wfe_alignment ); ?>">
                <h2 class="wfe_cta_title"><?php echo $settings['wfe_wfe_title']; ?></h2>
                    <p><?php echo $settings['wfe_wfe_content']; ?></p>
                <a href="<?php echo esc_url( $settings['wfe_wfe_btn_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="wfe-button <?php echo esc_attr( $wfe_btn_effect ); ?>"><?php esc_html_e( $settings['wfe_wfe_btn_text'], 'wfe_elementor' ); ?></a>
            </div>
		<?php endif; ?>
		<?php if( 'wfe-flex' == $settings['wfe_wfe_type'] ) : ?>
            <div class="wfe-call-to-action wfe-flex <?php echo esc_attr( $wfe_class ); ?>">
                <div class="content">
                    <h2 class="wfe_cta_title"><?php echo $settings['wfe_wfe_title']; ?></h2>
                        <p><?php echo $settings['wfe_wfe_content']; ?></p>
                </div>
                <div class="action">
                    <a href="<?php echo esc_url( $settings['wfe_wfe_btn_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="wfe-button <?php echo esc_attr( $wfe_btn_effect ); ?>"><?php esc_html_e( $settings['wfe_wfe_btn_text'], 'wfe_elementor' ); ?></a>
                </div>
            </div>
		<?php endif; ?>
		<?php if( 'wfe-icon-flex' == $settings['wfe_wfe_type'] ) : ?>
            <div class="wfe-call-to-action wfe-icon-flex <?php echo esc_attr( $wfe_class ); ?>">
                <div class="icon">
                    <i class="<?php echo esc_attr( $settings['wfe_wfe_flex_grid_icon'] ); ?>"></i>
                </div>
                <div class="content">
                    <h2 class="wfe_cta_title"><?php echo $settings['wfe_wfe_title']; ?></h2>
                        <p><?php echo $settings['wfe_wfe_content']; ?></p>
                </div>
                <div class="action">
                    <a href="<?php echo esc_url( $settings['wfe_wfe_btn_link']['url'] ); ?>" <?php echo $target; ?> class="wfe-button <?php echo esc_attr( $wfe_btn_effect ); ?>"><?php esc_html_e( $settings['wfe_wfe_btn_text'], 'wfe_elementor' ); ?></a>
                </div>
            </div>
		<?php endif; ?>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Wfe_calltoaction() );