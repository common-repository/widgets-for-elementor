<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_infobox extends Widget_Base {

	public function get_name() {
		return 'wfe-infobox';
	}

	public function get_title() {
		return __( 'Infobox', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-building-o wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	protected function _register_controls() {

		/**
		 * Infobox Image Settings
		 */
		$this->start_controls_section(
			'wfe_elementor_section_infobox_content_settings',
			[
				'label' => esc_html__( 'Infobox Image', 'wfe_elementor' )
			]
		);

		$this->add_control(
			'wfe_elementor_infobox_img_type',
			[
				'label'       	=> esc_html__( 'Infobox Type', 'wfe_elementor' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'img-on-top',
				'label_block' 	=> false,
				'options' 		=> [
					'img-on-top'  	=> esc_html__( 'Image/Icon On Top', 'wfe_elementor' ),
					'img-on-left' 	=> esc_html__( 'Image/Icon On Left', 'wfe_elementor' ),
					'img-on-right' 	=> esc_html__( 'Image/Icon On Right', 'wfe_elementor' ),
				],
			]
		);

		$this->add_responsive_control(
			'wfe_elementor_infobox_img_or_icon',
			[
				'label' => esc_html__( 'Image or Icon', 'wfe_elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'img' => [
						'title' => esc_html__( 'Image', 'wfe_elementor' ),
						'icon' => 'fa fa-picture-o',
					],
					'icon' => [
						'title' => esc_html__( 'Icon', 'wfe_elementor' ),
						'icon' => 'fa fa-info-circle',
					],
				],
				'default' => 'icon',
			]
		);
		/**
		 * Condition: 'wfe_elementor_infobox_img_or_icon' => 'img'
		 */
		$this->add_control(
			'wfe_elementor_infobox_image',
			[
				'label' => esc_html__( 'Infobox Image', 'wfe_elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'wfe_elementor_infobox_img_or_icon' => 'img'
				]
			]
		);


		/**
		 * Condition: 'wfe_elementor_infobox_img_or_icon' => 'icon'
		 */
		$this->add_control(
			'wfe_elementor_infobox_icon',
			[
				'label' => esc_html__( 'Icon', 'wfe_elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-building-o',
				'condition' => [
					'wfe_elementor_infobox_img_or_icon' => 'icon'
				]
			]
		);

		$this->add_control(
			'wfe_elementor_show_infobox_clickable',
			[
				'label' => __( 'Infobox Clickable', 'wfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'wfe_elementor' ),
				'label_off' => __( 'No', 'wfe_elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'wfe_elementor_show_infobox_clickable_link',
			[
				'label' => esc_html__( 'Infobox Link', 'wfe_elementor' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
					'url' => 'http://',
					'is_external' => '',
				],
				'show_external' => true,
				'condition' => [
					'wfe_elementor_show_infobox_clickable' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Infobox Content
		 */
		$this->start_controls_section(
			'wfe_elementor_infobox_content',
			[
				'label' => esc_html__( 'Infobox Content', 'wfe_elementor' ),
			]
		);
		$this->add_control(
			'wfe_elementor_infobox_title',
			[
				'label' => esc_html__( 'Infobox Title', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [
					'active' => true
				],
				'default' => esc_html__( 'This is an icon box', 'wfe_elementor' )
			]
		);
		$this->add_control(
			'wfe_elementor_infobox_text_type',
			[
				'label'                 => __( 'Content Type', 'wfe_elementor' ),
				'type'                  => Controls_Manager::SELECT,
				'options'               => [
					'content'       => __( 'Content', 'wfe_elementor' ),
					'template'      => __( 'Saved Templates', 'wfe_elementor' ),
				],
				'default'               => 'content',
			]
		);

		$this->add_control(
			'wfe_elementor_primary_templates',
			[
				'label'                 => __( 'Choose Template', 'wfe_elementor' ),
				'type'                  => Controls_Manager::SELECT,
				'condition'             => [
					'wfe_elementor_infobox_text_type'      => 'template',
				],
			]
		);
		$this->add_control(
			'wfe_elementor_infobox_text',
			[
				'label' => esc_html__( 'Infobox Content', 'wfe_elementor' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'dynamic' => [
					'active' => true
				],
				'default' => esc_html__( 'Write a short description, that will describe the title or something informational and useful.', 'wfe_elementor' ),
				'condition' => [
					'wfe_elementor_infobox_text_type' => 'content'
				]
			]
		);
		$this->add_control(
			'wfe_elementor_show_infobox_content',
			[
				'label' => __( 'Show Content', 'wfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'wfe_elementor' ),
				'label_off' => __( 'Hide', 'wfe_elementor' ),
				'return_value' => 'yes',
			]
		);
		$this->add_responsive_control(
			'wfe_elementor_infobox_content_alignment',
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
				],
				'default' => 'center',
				'prefix_class' => 'wfe_elementor-infobox-content-align-',
				'condition' => [
					'wfe_elementor_infobox_img_type' => 'img-on-top'
				]
			]
		);
		$this->end_controls_section();

		/*
		$this->start_controls_section(
			'wfe_elementor_section_pro',
			[
				'label' => __( 'Go Premium for More Features', 'wfe_elementor' )
			]
		);

		$this->add_control(
			'wfe_elementor_control_get_pro',
			[
				'label' => __( 'Unlock more possibilities', 'wfe_elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'title' => __( '', 'wfe_elementor' ),
						'icon' => 'fa fa-unlock-alt',
					],
				],
				'default' => '1',
				'description' => '<span class="pro-feature"> Get the  <a href="#" target="_blank">Pro version</a> for more stunning elements and customization options.</span>'
			]
		);

		$this->end_controls_section();

		*/

		/**
		 * -------------------------------------------
		 * Tab Style (Info Box Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wfe_elementor_section_infobox_style_settings',
			[
				'label' => esc_html__( 'Info Box Style', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'wfe_elementor_infobox_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-infobox' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'wfe_elementor_infobox_container_padding',
			[
				'label' => esc_html__( 'Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-infobox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'wfe_elementor_infobox_container_margin',
			[
				'label' => esc_html__( 'Margin', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-infobox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wfe_elementor_infobox_border',
				'label' => esc_html__( 'Border', 'wfe_elementor' ),
				'selector' => '{{WRAPPER}} .wfe_elementor-infobox',
			]
		);

		$this->add_control(
			'wfe_elementor_infobox_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-infobox' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wfe_elementor_infobox_shadow',
				'selector' => '{{WRAPPER}} .wfe_elementor-infobox',
			]
		);

		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Tab Style (Info Box Image)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wfe_elementor_section_infobox_imgae_style_settings',
			[
				'label' => esc_html__( 'Image Style', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'wfe_elementor_infobox_img_or_icon' => 'img'
				]
			]
		);

		$this->add_control(
			'wfe_elementor_infobox_img_shape',
			[
				'label'     	=> esc_html__( 'Image Shape', 'wfe_elementor' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'square',
				'label_block' 	=> false,
				'options' 		=> [
					'square'  	=> esc_html__( 'Square', 'wfe_elementor' ),
					'circle' 	=> esc_html__( 'Circle', 'wfe_elementor' ),
					'radius' 	=> esc_html__( 'Radius', 'wfe_elementor' ),
				],
				'prefix_class' => 'wfe_elementor-infobox-shape-',
				'condition' => [
					'wfe_elementor_infobox_img_or_icon' => 'img'
				]
			]
		);

		$this->add_control(
			'wfe_elementor_infobox_image_resizer',
			[
				'label' => esc_html__( 'Image Resizer', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100
				],
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-infobox .infobox-icon img' => 'width: {{SIZE}}px;',
					'{{WRAPPER}} .wfe_elementor-infobox.icon-on-left .infobox-icon' => 'width: {{SIZE}}px;',
					'{{WRAPPER}} .wfe_elementor-infobox.icon-on-right .infobox-icon' => 'width: {{SIZE}}px;',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'wfe_elementor_infobox_image[url]!' => '',
				],
				'condition' => [
					'wfe_elementor_infobox_img_or_icon' => 'img',
				]
			]
		);

		$this->add_responsive_control(
			'wfe_elementor_infobox_img_margin',
			[
				'label' => esc_html__( 'Margin', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-infobox .infobox-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Info Box Icon Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wfe_elementor_section_infobox_icon_style_settings',
			[
				'label' => esc_html__( 'Icon Style', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'wfe_elementor_infobox_img_or_icon' => 'icon'
				]
			]
		);

		$this->add_control(
			'wfe_elementor_infobox_icon_size',
			[
				'label' => __( 'Icon Size', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-infobox .infobox-icon i' => 'font-size: {{SIZE}}px;',
				],
			]
		);


		$this->add_control(
			'wfe_elementor_infobox_icon_bg_size',
			[
				'label' => __( 'Icon Background Size', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 90,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-infobox .infobox-icon .infobox-icon-wrap' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
				],
				'condition' => [
					'wfe_elementor_infobox_icon_bg_shape!' => 'none',
					'wfe_elementor_infobox_img_type!' => ['img-on-left', 'img-on-right'],
				]
			]
		);

		$this->add_responsive_control(
			'wfe_elementor_infobox_icon_margin',
			[
				'label' => esc_html__( 'Margin', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-infobox .infobox-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'wfe_elementor_infobox_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-infobox .infobox-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wfe_elementor-infobox.icon-beside-title .infobox-content .title figure i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wfe_elementor_infobox_icon_bg_shape',
			[
				'label'     	=> esc_html__( 'Background Shape', 'wfe_elementor' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'none',
				'label_block' 	=> false,
				'options' 		=> [
					'none'  	=> esc_html__( 'None', 'wfe_elementor' ),
					'circle' 	=> esc_html__( 'Circle', 'wfe_elementor' ),
					'radius' 	=> esc_html__( 'Radius', 'wfe_elementor' ),
					'square' 	=> esc_html__( 'Square', 'wfe_elementor' ),
				],
				'prefix_class' => 'wfe_elementor-infobox-icon-bg-shape-',
				'condition' => [
					'wfe_elementor_infobox_img_type!' => ['img-on-left', 'img-on-right'],
				]
			]
		);

		$this->add_control(
			'wfe_elementor_infobox_icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f4f4f4',
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-infobox .infobox-icon .infobox-icon-wrap' => 'background: {{VALUE}};',
				],
				'condition' => [
					'wfe_elementor_infobox_img_type!' => ['img-on-left', 'img-on-right'],
					'wfe_elementor_infobox_icon_bg_shape!' => 'none',
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Info Box Title Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wfe_elementor_section_infobox_title_style_settings',
			[
				'label' => esc_html__( 'Color &amp; Typography', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'wfe_elementor_infobox_title_heading',
			[
				'label' => esc_html__( 'Title Style', 'wfe_elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'wfe_elementor_infobox_title_color',
			[
				'label' => esc_html__( 'Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-infobox .infobox-content .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_elementor_infobox_title_typography',
				'selector' => '{{WRAPPER}} .wfe_elementor-infobox .infobox-content .title',
			]
		);

		$this->add_responsive_control(
			'wfe_elementor_infobox_title_margin',
			[
				'label' => esc_html__( 'Margin', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-infobox .infobox-content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'wfe_elementor_infobox_content_heading',
			[
				'label' => esc_html__( 'Content Style', 'wfe_elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'wfe_elementor_infobox_content_color',
			[
				'label' => esc_html__( 'Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-infobox .infobox-content p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_elementor_infobox_content_typography',
				'selector' => '{{WRAPPER}} .wfe_elementor-infobox .infobox-content p',
			]
		);

		$this->end_controls_section();

	}


	protected function render( ) {

		$settings = $this->get_settings_for_display();
		$infobox_image = $this->get_settings( 'wfe_elementor_infobox_image' );
		$infobox_image_url = Group_Control_Image_Size::get_attachment_image_src( $infobox_image['id'], 'thumbnail', $settings );
		if( empty( $infobox_image_url ) ) : $infobox_image_url = $infobox_image['url']; else: $infobox_image_url = $infobox_image_url; endif;

		$target = $settings['wfe_elementor_show_infobox_clickable_link']['is_external'] ? 'target="_blank"' : '';
		$nofollow = $settings['wfe_elementor_show_infobox_clickable_link']['nofollow'] ? 'rel="nofollow"' : '';

		?>
		<?php if( 'img-on-top' == $settings['wfe_elementor_infobox_img_type'] ) : ?>
            <div class="wfe_elementor-infobox">
				<?php if( 'yes' == $settings['wfe_elementor_show_infobox_clickable'] ) : ?><a href="<?php echo esc_url( $settings['wfe_elementor_show_infobox_clickable_link']['url'] ) ?>" <?php echo $target; ?> <?php echo $nofollow; ?>> <?php endif;?>
                    <div class="infobox-icon">
						<?php if( 'img' == $settings['wfe_elementor_infobox_img_or_icon'] ) : ?>
                            <img src="<?php echo esc_url( $infobox_image_url ); ?>" alt="Icon Image">
						<?php endif; ?>
						<?php if( 'icon' == $settings['wfe_elementor_infobox_img_or_icon'] ) : ?>
                            <div class="infobox-icon-wrap">
                                <i class="<?php echo esc_attr( $settings['wfe_elementor_infobox_icon'] ); ?>"></i>
                            </div>
						<?php endif; ?>
                    </div>
                    <div class="infobox-content">
                        <h4 class="title"><?php echo $settings['wfe_elementor_infobox_title']; ?></h4>
						<?php if( 'yes' == $settings['wfe_elementor_show_infobox_content'] ) : ?>
							<?php if( 'content' === $settings['wfe_elementor_infobox_text_type'] ) : ?>
								<?php if ( ! empty( $settings['wfe_elementor_infobox_text'] ) ) : ?>
                                    <p><?php echo $settings['wfe_elementor_infobox_text']; ?></p>
								<?php endif; ?>
							<?php elseif( 'template' === $settings['wfe_elementor_infobox_text_type'] ) :
								if ( !empty( $settings['wfe_elementor_primary_templates'] ) ) {
									$wfe_elementor_template_id = $settings['wfe_elementor_primary_templates'];
									$wfe_elementor_frontend = new Frontend;

									echo $wfe_elementor_frontend->get_builder_content( $wfe_elementor_template_id, true );
								}
							endif; ?>
						<?php endif; ?>
                    </div>
					<?php if( 'yes' == $settings['wfe_elementor_show_infobox_clickable'] ) : ?></a><?php endif; ?>
            </div>
		<?php endif; ?>
		<?php if( 'img-on-left' == $settings['wfe_elementor_infobox_img_type'] ) : ?>
			<?php if( 'yes' == $settings['wfe_elementor_show_infobox_clickable'] ) : ?><a href="<?php echo esc_url( $settings['wfe_elementor_show_infobox_clickable_link']['url'] ) ?>" <?php echo $target; ?> <?php echo $nofollow; ?>> <?php endif;?>
            <div class="wfe_elementor-infobox icon-on-left">
                <div class="infobox-icon <?php if( 'icon' == $settings['wfe_elementor_infobox_img_or_icon'] ) : echo esc_attr( 'wfe_elementor-icon-only', 'wfe_elementor' ); endif; ?>">
					<?php if( 'img' == $settings['wfe_elementor_infobox_img_or_icon'] ) : ?>
                        <figure>
                            <img src="<?php echo esc_url( $infobox_image_url ); ?>" alt="Icon Image">
                        </figure>
					<?php endif; ?>
					<?php if( 'icon' == $settings['wfe_elementor_infobox_img_or_icon'] ) : ?>
                        <div class="infobox-icon-wrap">
                            <i class="<?php echo esc_attr( $settings['wfe_elementor_infobox_icon'] ); ?>"></i>
                        </div>
					<?php endif; ?>
                </div>
                <div class="infobox-content <?php if( 'icon' == $settings['wfe_elementor_infobox_img_or_icon'] ) : echo esc_attr( 'wfe_elementor-icon-only', 'wfe_elementor' ); endif; ?>">
                    <h4 class="title"><?php echo $settings['wfe_elementor_infobox_title']; ?></h4>
					<?php if( 'yes' == $settings['wfe_elementor_show_infobox_content'] ) : ?>
						<?php if( 'content' === $settings['wfe_elementor_infobox_text_type'] ) : ?>
							<?php if ( ! empty( $settings['wfe_elementor_infobox_text'] ) ) : ?>
                                <p><?php echo $settings['wfe_elementor_infobox_text']; ?></p>
							<?php endif; ?>
						<?php elseif( 'template' === $settings['wfe_elementor_infobox_text_type'] ) :
							if ( !empty( $settings['wfe_elementor_primary_templates'] ) ) {
								$wfe_elementor_template_id = $settings['wfe_elementor_primary_templates'];
								$wfe_elementor_frontend = new Frontend;

								echo $wfe_elementor_frontend->get_builder_content( $wfe_elementor_template_id, true );
							}
						endif; ?>
					<?php endif; ?>
                </div>
            </div>
			<?php if( 'yes' == $settings['wfe_elementor_show_infobox_clickable'] ) : ?></a><?php endif; ?>
		<?php endif; ?>
		<?php if( 'img-on-right' == $settings['wfe_elementor_infobox_img_type'] ) : ?>
			<?php if( 'yes' == $settings['wfe_elementor_show_infobox_clickable'] ) : ?><a href="<?php echo esc_url( $settings['wfe_elementor_show_infobox_clickable_link']['url'] ) ?>" <?php echo $target; ?> <?php echo $nofollow; ?>> <?php endif;?>
            <div class="wfe_elementor-infobox icon-on-right">
                <div class="infobox-icon <?php if( 'icon' == $settings['wfe_elementor_infobox_img_or_icon'] ) : echo esc_attr( 'wfe_elementor-icon-only', 'wfe_elementor' ); endif; ?>">
					<?php if( 'img' == $settings['wfe_elementor_infobox_img_or_icon'] ) : ?>
                        <figure>
                            <img src="<?php echo esc_url( $infobox_image_url ); ?>" alt="Icon Image">
                        </figure>
					<?php endif; ?>
					<?php if( 'icon' == $settings['wfe_elementor_infobox_img_or_icon'] ) : ?>
                        <div class="infobox-icon-wrap">
                            <i class="<?php echo esc_attr( $settings['wfe_elementor_infobox_icon'] ); ?>"></i>
                        </div>
					<?php endif; ?>
                </div>
                <div class="infobox-content <?php if( 'icon' == $settings['wfe_elementor_infobox_img_or_icon'] ) : echo esc_attr( 'wfe_elementor-icon-only', 'wfe_elementor' ); endif; ?>">
                    <h4 class="title"><?php echo $settings['wfe_elementor_infobox_title']; ?></h4>
					<?php if( 'yes' == $settings['wfe_elementor_show_infobox_content'] ) : ?>
						<?php if( 'content' === $settings['wfe_elementor_infobox_text_type'] ) : ?>
							<?php if ( ! empty( $settings['wfe_elementor_infobox_text'] ) ) : ?>
                                <p><?php echo $settings['wfe_elementor_infobox_text']; ?></p>
							<?php endif; ?>
						<?php elseif( 'template' === $settings['wfe_elementor_infobox_text_type'] ) :
							if ( !empty( $settings['wfe_elementor_primary_templates'] ) ) {
								$wfe_elementor_template_id = $settings['wfe_elementor_primary_templates'];
								$wfe_elementor_frontend = new Frontend;

								echo $wfe_elementor_frontend->get_builder_content( $wfe_elementor_template_id, true );
							}
						endif; ?>
					<?php endif; ?>
                </div>
            </div>
			<?php if( 'yes' == $settings['wfe_elementor_show_infobox_clickable'] ) : ?></a><?php endif; ?>
		<?php endif; ?>
		<?php
	}

	protected function content_template() {

		?>


		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Wfe_infobox() );