<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_listproduct extends Widget_Base {

	public function get_name() {
		return 'wfe-listproduct';
	}

	public function get_title() {
		return __( 'List Product', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-list-alt wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {

		// Content Controls
		$this->start_controls_section(
			'wfe_section_list_product_content',
			[
				'label' => esc_html__( 'Product Details', 'ewfe_elementor' )
			]
		);


		$this->add_control(
			'wfe_list_product_image',
			[
				'label' => __( 'Product Image', 'ewfe_elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);


		$this->add_control(
			'wfe_list_product_heading',
			[
				'label' => __( 'Product Heading', 'ewfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Product Name',
				'placeholder' => __( 'Enter heading for the product', 'ewfe_elementor' ),
				'title' => __( 'Enter heading for the product', 'ewfe_elementor' ),
				'dynamic' => [ 'active' => true ]
			]
		);

		$this->add_control(
			'wfe_list_product_description',
			[
				'label'   => __( 'Product Description', 'ewfe_elementor' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Click to inspect, then edit as needed.', 'ewfe_elementor' ),
			]
		);


		$this->add_control(
			'wfe_list_product_title_buttons',
			[
				'label' => __( 'Links & Buttons', 'ewfe_elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'wfe_list_product_link_url',
			[
				'label' => __( 'Product Link URL', 'ewfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '#',
				'placeholder' => __( 'Enter link URL for the promo', 'ewfe_elementor' ),
				'title' => __( 'Enter URL for the product', 'ewfe_elementor' ),
			]
		);

		$this->add_control(
			'wfe_list_product_link_target',
			[
				'label' => esc_html__( 'Open in new window?', 'ewfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( '_blank', 'ewfe_elementor' ),
				'label_off' => __( '_self', 'ewfe_elementor' ),
				'default' => '_self',
			]
		);

		$this->add_control(
			'wfe_list_product_demo_link_url',
			[
				'label' => __( 'Live Demo URL', 'ewfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '#',
				'placeholder' => __( 'Enter link URL for live demo', 'ewfe_elementor' ),
				'title' => __( 'Enter URL for the promo', 'ewfe_elementor' ),
			]
		);

		$this->add_control(
			'wfe_list_product_demo_text',
			[
				'label' => esc_html__( 'Live Demo Text', 'ewfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Live Demo', 'ewfe_elementor' ),
			]
		);

		$this->add_control(
			'wfe_list_product_demo_link_target',
			[
				'label' => esc_html__( 'Open in new window?', 'ewfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( '_blank', 'ewfe_elementor' ),
				'label_off' => __( '_self', 'ewfe_elementor' ),
				'default' => '_blank',
			]
		);

		// generate details button

		$this->add_control(
			'wfe_list_product_show_details_btn',
			[
				'label' => esc_html__( 'Show Details Button?', 'ewfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'ewfe_elementor' ),
				'label_off' => __( 'no', 'ewfe_elementor' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'wfe_list_product_btn',
			[
				'label' => esc_html__( 'Button Text', 'ewfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'View Details', 'ewfe_elementor' ),
				'condition' => [
					'wfe_list_product_show_details_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			'wfe_list_product_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'ewfe_elementor' ),
				'type' => Controls_Manager::ICON,
				'condition' => [
					'wfe_list_product_show_details_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			'wfe_list_product_btn_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'ewfe_elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'ewfe_elementor' ),
					'right' => esc_html__( 'After', 'ewfe_elementor' ),
				],
				'condition' => [
					'wfe_list_product_show_details_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			'wfe_list_product_btn_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'ewfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'wfe_list_product_show_details_btn' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product-button-icon-right' => 'margin-left: {{SIZE}}px;',
					'{{WRAPPER}} .wfe-list-product-button-icon-left' => 'margin-right: {{SIZE}}px;',
				],
			]
		);



		$this->add_control(
			'wfe_list_product_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'ewfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'wfe_list_product_show_details_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			'wfe_list_product_btn_border_radius',
			[
				'label' => esc_html__( 'Button Border Radius', 'ewfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'wfe_list_product_show_details_btn' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_list_product_btn_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe-list-product-btn',
				'condition' => [
					'wfe_list_product_show_details_btn' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'wfe_list_product_btn_content_tabs' );

		$this->start_controls_tab( 'normal_default_content', [ 'label' => esc_html__( 'Normal', 'ewfe_elementor' ),
		                                                       'condition' => [
			                                                       'wfe_list_product_show_details_btn' => 'yes',
		                                                       ],
			]
		);

		$this->add_control(
			'wfe_list_product_btn_text_color',
			[
				'label' => esc_html__( 'Text Color', 'ewfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product-btn' => 'color: {{VALUE}};',
				],
				'condition' => [
					'wfe_list_product_show_details_btn' => 'yes',
				],
			]
		);



		$this->add_control(
			'wfe_list_product_btn_background_color',
			[
				'label' => esc_html__( 'Background Color', 'ewfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#646464',
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product-btn' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'wfe_list_product_show_details_btn' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wfe_list_product_btn_border',
				'selector' => '{{WRAPPER}} .wfe-list-product-btn',
				'condition' => [
					'wfe_list_product_show_details_btn' => 'yes',
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab( 'wfe_list_product_btn_hover',
			[
				'label' => esc_html__( 'Hover', 'ewfe_elementor' ),
				'condition' => [
					'wfe_list_product_show_details_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			'wfe_list_product_btn_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'ewfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product-btn:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'wfe_list_product_show_details_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			'wfe_list_product_btn_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'ewfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#272727',
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product-btn:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'wfe_list_product_show_details_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			'wfe_list_product_btn_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'ewfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product-btn:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'wfe_list_product_show_details_btn' => 'yes',
				],
			]
		);
		// generate button end


		$this->end_controls_section();



		// Style Controls
		$this->start_controls_section(
			'wfe_section_wfe_list_product_settings',
			[
				'label' => esc_html__( 'Product Style', 'ewfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_control(
			'wfe_list_product_container_width',
			[
				'label' => esc_html__( 'Set max width for the container?', 'ewfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'ewfe_elementor' ),
				'label_off' => __( 'no', 'ewfe_elementor' ),
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'wfe_list_product_container_width_value',
			[
				'label' => __( 'Container Max Width (% or px)', 'ewfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 480,
					'unit' => 'px',
				],
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'wfe_list_product_container_width' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'wfe_list_product_text_alignment',
			[
				'label' => esc_html__( 'Content Text Alignment', 'ewfe_elementor' ),
				'separator' => 'before',
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'ewfe_elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ewfe_elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'ewfe_elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product-details' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .wfe-list-product-btn-wrap' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wfe_list_product_content_padding',
			[
				'label' => esc_html__( 'Content Padding', 'ewfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wfe_list_product_border',
				'selector' => '{{WRAPPER}} .wfe-list-product',
			]
		);


		$this->add_control(
			'wfe_list_product_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'ewfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wfe_list_product_box_shadow',
				'selector' => '{{WRAPPER}} .wfe-list-product',
				'separator' => '',
			]
		);


		$this->add_control(
			'wfe_list_product_hover_style_title',
			[
				'label' => __( 'Hover Style', 'ewfe_elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wfe_list_product_hover_border',
				'selector' => '{{WRAPPER}} .wfe-list-product:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wfe_list_product_hover_box_shadow',
				'selector' => '{{WRAPPER}} .wfe-list-product:hover',
				'separator' => '',
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'wfe_section_wfe_list_product_styles',
			[
				'label' => esc_html__( 'Colors &amp; Typography', 'ewfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'wfe_list_product_overlay_color',
			[
				'label' => esc_html__( 'Product Thumbnail Overlay Color', 'ewfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0, .75)',
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product-thumb-overlay' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wfe_list_product_live_link_color',
			[
				'label' => esc_html__( 'Live Link Color', 'ewfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product-thumb-overlay > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_list_product_live_link_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe-list-product-thumb-overlay > a',
			]
		);

		$this->add_control(
			'wfe_list_product_title_color',
			[
				'label' => esc_html__( 'Product Title Color', 'ewfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#303133',
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product-details > h2 > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_list_product_title_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe-list-product-details > h2',
			]
		);

		$this->add_control(
			'wfe_list_product_content_color',
			[
				'label' => esc_html__( 'Product Content Color', 'ewfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#7a7a7a',
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product-details > p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wfe_list_product_content_background',
			[
				'label' => esc_html__( 'Product Content Background Color', 'ewfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .wfe-list-product-details' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_list_product_content_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe-list-product-details > p',
			]
		);


		$this->end_controls_section();


	}


	protected function render( ) {


		$settings = $this->get_settings_for_display();
		$list_product_image = $this->get_settings( 'wfe_list_product_image' );


		?>


        <div id="wfe-list-product-<?php echo esc_attr($this->get_id()); ?>" class="wfe-list-product">
            <div class="wfe-list-product-media">
                <div class="wfe-list-product-thumb-overlay">
                    <a href="<?php echo esc_attr($settings['wfe_list_product_demo_link_url'] ); ?>" target="<?php echo esc_attr($settings['wfe_list_product_demo_link_target'] ); ?>"><span><?php echo esc_attr($settings['wfe_list_product_demo_text'] ); ?></span></a>
                </div>
                <div class="wfe-list-product-thumb">
					<?php echo '<img alt="'. $settings['wfe_list_product_heading'] . '" src="' . $list_product_image['url'] . '">'; ?>
                </div>
            </div>
            <div class="wfe-list-product-details">
				<?php if ( ! empty( $settings['wfe_list_product_heading'] ) ) : ?>
                    <h2><a href="<?php echo esc_attr($settings['wfe_list_product_link_url'] ); ?>" target="<?php echo esc_attr($settings['wfe_list_product_link_target'] ); ?>"><?php echo esc_attr($settings['wfe_list_product_heading'] ); ?></a></h2>
				<?php endif; ?>
                <p><?php echo $settings['wfe_list_product_description']; ?></p>

				<?php if ( ! empty( $settings['wfe_list_product_show_details_btn'] ) ) : ?>
                    <div class="wfe-list-product-btn-wrap">
                        <a href="<?php echo esc_attr($settings['wfe_list_product_link_url'] ); ?>" target="<?php echo esc_attr($settings['wfe_list_product_link_target'] ); ?>" class="wfe-list-product-btn">
							<?php if ( ! empty( $settings['wfe_list_product_btn_icon'] ) && $settings['wfe_list_product_btn_icon_align'] == 'left' ) : ?>
                                <i class="<?php echo esc_attr($settings['wfe_list_product_btn_icon'] ); ?> wfe-list-product-button-icon-left" aria-hidden="true"></i>
							<?php endif; ?>

							<?php echo esc_attr($settings['wfe_list_product_btn'] ); ?>

							<?php if ( ! empty( $settings['wfe_list_product_btn_icon'] ) && $settings['wfe_list_product_btn_icon_align'] == 'right' ) : ?>
                                <i class="<?php echo esc_attr($settings['wfe_list_product_btn_icon'] ); ?> wfe-list-product-button-icon-right" aria-hidden="true"></i>
							<?php endif; ?>
                        </a>
                    </div>
				<?php endif; ?>
            </div>
        </div>


		<?php

	}

	protected function content_template() {

		?>


		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Wfe_listproduct() );