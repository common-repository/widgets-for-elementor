<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_imagecomparison extends Widget_Base {

	public function get_name() {
		return 'wfe-imagecomparison';
	}

	public function get_title() {
		return __( 'Image Comparison', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-clone wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium video box
	// This will controls the animation, colors and background, dimensions etc

	protected function _register_controls() {


		$this->start_controls_section( 'section_title_wfe_global_options', [
				'label' => esc_html__( 'Before Image', 'wfe_elementor' ),
			] );


		$this->add_control( 'wfe_elements_before_caption', [
				'label'   => esc_html__( 'Caption Before', 'wfe_elementor' ),
				'default' => esc_html__( 'Before', 'wfe_elementor' ),
				'type'    => Controls_Manager::TEXT,
			] );

		$this->add_control( 'wfe_elements_before_image', [
				'type' => Controls_Manager::MEDIA,
			] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
				'name'    => 'thumbnail_before',
				'default' => 'full',
			] );

		$this->end_controls_section();


		$this->start_controls_section( 'section_title_wfe_after_options', [
				'label' => esc_html__( 'After Image', 'wfe_elementor' ),
			] );


		$this->add_control( 'wfe_elements_after_caption', [
				'label'   => esc_html__( 'Caption After', 'wfe_elementor' ),
				'default' => esc_html__( 'After', 'wfe_elementor' ),
				'type'    => Controls_Manager::TEXT,
			] );

		$this->add_control( 'wfe_elements_after_image', [
				'type' => Controls_Manager::MEDIA,
			] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
				'name'    => 'thumbnail_after',
				'default' => 'full',
			] );


		$this->end_controls_section();


		$this->start_controls_section( 'section_title_wfe_js_option', [
				'label' => esc_html__( 'Comparison Settings', 'wfe_elementor' ),
			] );

		$this->add_responsive_control( 'wfe_elements_img_align', [
				'label'       => esc_html__( 'Image Align', 'wfe_elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'   => [
						'title' => esc_html__( 'Left', 'wfe_elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'wfe_elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'wfe_elementor' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .wfe_elementor-image-comparison-container' => 'text-align: {{VALUE}}',
				],
			] );


		$this->add_control( 'wfe_elements_visible_ratio', [
				'label'   => esc_html__( 'Visible Ratio', 'wfe_elementor' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => [
					'px' => [
						'step' => 0.1,
						'min'  => 0,
						'max'  => 1,
					],
				],
				'default' => [
					'size' => 0.5,
				],
			] );


		$this->add_control( 'wfe_elements_selection_control', [
				'label'   => esc_html__( 'Interaction Mode', 'wfe_elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'drag'      => esc_html__( 'Drag', 'wfe_elementor' ),
					'mousemove' => esc_html__( 'Mouse Move', 'wfe_elementor' ),
					'click'     => esc_html__( 'Mouse Click', 'wfe_elementor' ),
				],
				'default' => 'drag',
			] );

		$this->add_control( 'wfe_elements_selection_separator', [
				'label'   => esc_html__( 'Separator', 'wfe_elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'true'  => esc_html__( 'Display Separator', 'wfe_elementor' ),
					'false' => esc_html__( 'Hide Separator', 'wfe_elementor' ),
				],
				'default' => 'true',
			] );

		$this->add_control( 'wfe_elements_drag_handle', [
				'label'   => esc_html__( 'Drag Handle', 'wfe_elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'true'  => esc_html__( 'Display Handle', 'wfe_elementor' ),
					'false' => esc_html__( 'Hide Handle', 'wfe_elementor' ),
				],
				'default' => 'true',
			] );

		$this->end_controls_section();


		$this->start_controls_section( 'section_title_wfe_caption_styles', [
				'label' => esc_html__( 'Caption Styles', 'wfe_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			] );


		$this->add_control( 'wfe_elements_caption_text_color', [
				'label'     => esc_html__( 'Caption Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .images-compare-label' => 'color: {{VALUE}};',
				],
			] );

		$this->add_control( 'wfe_elements_caption_background_color', [
				'label'     => esc_html__( 'Caption Background', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .images-compare-label' => 'background: {{VALUE}};',
				],
			] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
				'name'     => 'section_wfe_caption_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .images-compare-label',
			] );


		$this->add_control( 'wfe_elements_select_caption_position', [
				'label'     => esc_html__( 'Caption Position', 'wfe_elementor' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'options'   => [
					'wfe-img-compare-position-top'    => esc_html__( 'Top', 'wfe_elementor' ),
					'wfe-img-compare-position-middle' => esc_html__( 'Middle', 'wfe_elementor' ),
					'wfe-img-compare-position-bottom' => esc_html__( 'Bottom', 'wfe_elementor' ),
				],
				'default'   => 'wfe-img-compare-position-top',
			] );

		$this->add_responsive_control( 'section_title_caption_padding', [
				'label'      => esc_html__( 'Padding', 'wfe_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .images-compare-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );

		$this->add_responsive_control( 'section_title_caption_margin', [
				'label'      => esc_html__( 'Margin', 'wfe_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator'  => 'before',
				'selectors'  => [
					'{{WRAPPER}} .images-compare-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );

		$this->add_responsive_control( 'section_title_caption_border_radius', [
				'label'      => esc_html__( 'Border Radius', 'wfe_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .images-compare-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );


		$this->end_controls_section();


		$this->start_controls_section( 'section_title_wfe_general_styles', [
				'label' => esc_html__( 'Control Styles', 'wfe_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			] );

		$this->add_control( 'wfe_elements_caption_divider_color', [
				'label'     => esc_html__( 'Divider Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .images-compare-separator' => 'background: {{VALUE}};',
				],
			] );


		$this->add_control( 'wfe_elements_caption_drag_handle_color', [
				'label'     => esc_html__( 'Drag Handle Background', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .images-compare-handle' => 'background: {{VALUE}};',
				],
			] );

		$this->add_control( 'wfe_elements_caption_drag_handle_border_color', [
				'label'     => esc_html__( 'Drag Border Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .images-compare-handle' => 'border-color: {{VALUE}};',
				],
			] );

		$this->add_control( 'wfe_elements_caption_drag_handle_arrow_left_color', [
				'label'     => esc_html__( 'Drag Arrow Left Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .images-compare-left-arrow' => 'border-right-color: {{VALUE}};',
				],
			] );

		$this->add_control( 'wfe_elements_caption_drag_handle_arrow_right_color', [
				'label'     => esc_html__( 'Drag Arrow right Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .images-compare-right-arrow' => 'border-left-color: {{VALUE}};',
				],
			] );

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		?>

		<?php if ( ! empty( $settings['wfe_elements_before_image']['url'] ) ) : ?>
            <div class="wfe_elementor-image-comparison-container <?php echo esc_attr( $settings['wfe_elements_select_caption_position'] ); ?>">
                <div id="wfeImageCompare-<?php echo esc_attr( $this->get_id() ); ?>">
                    <!-- The first div will be the front element, to prevent FOUC add a style="display: none;" -->
                    <div class="wfeImageCompareBeforeHidden">
						<?php if ( ! empty( $settings['wfe_elements_before_caption'] ) ) : ?><span
                                class="images-compare-label"><?php echo esc_attr( $settings['wfe_elements_before_caption'] ); ?></span><?php endif; ?>

						<?php $image_before = $settings['wfe_elements_before_image'];
						$image_url_before   = Group_Control_Image_Size::get_attachment_image_src( $image_before['id'], 'thumbnail_before', $settings ); ?>
                        <img src="<?php echo esc_url( $image_url_before ); ?>" alt="<?php echo esc_attr( $settings['wfe_elements_before_caption'] ); ?>">
                    </div>
                    <!-- This div will be the back element -->
                    <div class="wfeImageCompareAfter">
						<?php if ( ! empty( $settings['wfe_elements_after_caption'] ) ) : ?><span
                                class="images-compare-label"><?php echo esc_attr( $settings['wfe_elements_after_caption'] ); ?></span><?php endif; ?>
						<?php if ( ! empty( $settings['wfe_elements_after_image']['url'] ) ) : ?>
							<?php $image_after = $settings['wfe_elements_after_image'];
							$image_url_after   = Group_Control_Image_Size::get_attachment_image_src( $image_after['id'], 'thumbnail_after', $settings ); ?>
                            <img src="<?php echo esc_url( $image_url_after ); ?>" alt="<?php echo esc_attr( $settings['wfe_elements_after_caption'] ); ?>">
						<?php endif; ?>
                    </div>
                </div>
            </div><!-- close image comparison container -->
		<?php endif; ?>

        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                'use strict';
                $('#wfeImageCompare-<?php echo esc_attr( $this->get_id() ); ?>').imagesCompare({
                    initVisibleRatio: <?php echo esc_attr( $settings['wfe_elements_visible_ratio']['size'] ); ?>,
                    interactionMode: "<?php echo esc_attr( $settings['wfe_elements_selection_control'] ); ?>",
                    addSeparator: <?php echo esc_attr( $settings['wfe_elements_selection_separator'] ); ?>,
                    addDragHandle: <?php echo esc_attr( $settings['wfe_elements_drag_handle'] ); ?>,
                    animationDuration: 400,
                    animationEasing: "swing",
                    precision: 4
                });
            });
        </script>

		<?php

	}

	protected function content_template() {

		?>


		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Wfe_imagecomparison() );