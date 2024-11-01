<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_testimonial extends Widget_Base {

	public function get_name() {
		return 'wfe-testimonial';
	}

	public function get_title() {
		return __( 'Testimonial', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-quote-right wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {


		$this->start_controls_section(
			'wfe_section_testimonial_image',
			[
				'label' => esc_html__( 'Testimonial Image', 'wfe_elementor' )
			]
		);

		$this->add_control(
			'wfe_testimonial_enable_avatar',
			[
				'label' => esc_html__( 'Display Avatar?', 'wfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'wfe_testimonial_image',
			[
				'label' => __( 'Testimonial Avatar', 'wfe_elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'wfe_testimonial_enable_avatar' => 'yes',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'thumbnail',
				'condition' => [
					'wfe_testimonial_image[url]!' => '',
					'wfe_testimonial_enable_avatar' => 'yes',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'wfe_section_testimonial_content',
			[
				'label' => esc_html__( 'Testimonial Content', 'wfe_elementor' )
			]
		);

		$this->add_control(
			'wfe_testimonial_name',
			[
				'label' => esc_html__( 'User Name', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'John Doe', 'wfe_elementor' ),
				'dynamic' => [ 'active' => true ]
			]
		);

		$this->add_control(
			'wfe_testimonial_company_title',
			[
				'label' => esc_html__( 'Company Name', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Codetic', 'wfe_elementor' ),
				'dynamic' => [ 'active' => true ]
			]
		);

		$this->add_control(
			'wfe_testimonial_description',
			[
				'label' => esc_html__( 'Testimonial Description', 'wfe_elementor' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Add testimonial description here. Edit and place your own text.', 'wfe_elementor' ),
			]
		);


		$this->add_control(
			'wfe_testimonial_enable_rating',
			[
				'label' => esc_html__( 'Display Rating?', 'wfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);


		$this->add_control(
			'wfe_testimonial_rating_number',
			[
				'label'       => __( 'Rating Number', 'your-plugin' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'rating-five',
				'options' => [
					'rating-one'  => __( '1', 'wfe_elementor' ),
					'rating-two' => __( '2', 'wfe_elementor' ),
					'rating-three' => __( '3', 'wfe_elementor' ),
					'rating-four' => __( '4', 'wfe_elementor' ),
					'rating-five'   => __( '5', 'wfe_elementor' ),
				],
				'condition' => [
					'wfe_testimonial_enable_rating' => 'yes',
				],
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'wfe_section_testimonial_styles_general',
			[
				'label' => esc_html__( 'Testimonial Styles', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'wfe_testimonial_background',
			[
				'label' => esc_html__( 'Testimonial Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-testimonial-item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wfe_testimonial_alignment',
			[
				'label' => esc_html__( 'Set Alignment', 'wfe_elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'wfe-testimonial-align-default' => [
						'title' => __( 'Default', 'wfe_elementor' ),
						'icon' => 'fa fa-ban',
					],
					'wfe-testimonial-align-left' => [
						'title' => esc_html__( 'Left', 'wfe_elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'wfe-testimonial-align-centered' => [
						'title' => esc_html__( 'Center', 'wfe_elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'wfe-testimonial-align-right' => [
						'title' => esc_html__( 'Right', 'wfe_elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'wfe-testimonial-align-default',
			]
		);

		$this->add_control(
			'wfe_testimonial_user_display_block',
			[
				'label' => esc_html__( 'Display User & Company Block?', 'wfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_responsive_control(
			'wfe_testimonial_padding',
			[
				'label' => esc_html__( 'Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wfe_testimonial_border',
				'label' => esc_html__( 'Border', 'wfe_elementor' ),
				'selector' => '{{WRAPPER}} .wfe-testimonial-item',
			]
		);

		$this->add_control(
			'wfe_testimonial_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .wfe-testimonial-item' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'wfe_section_testimonial_image_styles',
			[
				'label' => esc_html__( 'Testimonial Image Style', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'wfe_testimonial_image_width',
			[
				'label' => esc_html__( 'Image Width', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 150,
					'unit' => 'px',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-testimonial-image img' => 'width:{{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'wfe_testimonial_image_margin',
			[
				'label' => esc_html__( 'Margin', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-testimonial-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'wfe_testimonial_image_padding',
			[
				'label' => esc_html__( 'Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-testimonial-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wfe_testimonial_image_border',
				'label' => esc_html__( 'Border', 'wfe_elementor' ),
				'selector' => '{{WRAPPER}} .wfe-testimonial-image img',
			]
		);

		$this->add_control(
			'wfe_testimonial_image_rounded',
			[
				'label' => esc_html__( 'Rounded Avatar?', 'wfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'testimonial-avatar-rounded',
				'default' => '',
			]
		);


		$this->add_control(
			'wfe_testimonial_image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .wfe-testimonial-image img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'condition' => [
					'wfe_testimonial_image_rounded!' => 'testimonial-avatar-rounded',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'wfe_section_testimonial_typography',
			[
				'label' => esc_html__( 'Color &amp; Typography', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'wfe_testimonial_name_heading',
			[
				'label' => __( 'User Name', 'wfe_elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'wfe_testimonial_name_color',
			[
				'label' => esc_html__( 'User Name Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#272727',
				'selectors' => [
					'{{WRAPPER}} .wfe-testimonial-content .wfe-testimonial-user' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_testimonial_name_typography',
				'selector' => '{{WRAPPER}} .wfe-testimonial-content .wfe-testimonial-user',
			]
		);

		$this->add_control(
			'wfe_testimonial_company_heading',
			[
				'label' => __( 'Company Name', 'wfe_elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);


		$this->add_control(
			'wfe_testimonial_company_color',
			[
				'label' => esc_html__( 'Company Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#272727',
				'selectors' => [
					'{{WRAPPER}} .wfe-testimonial-content .wfe-testimonial-user-company' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_testimonial_position_typography',
				'selector' => '{{WRAPPER}} .wfe-testimonial-content .wfe-testimonial-user-company',
			]
		);

		$this->add_control(
			'wfe_testimonial_description_heading',
			[
				'label' => __( 'Testimonial Text', 'wfe_elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'wfe_testimonial_description_color',
			[
				'label' => esc_html__( 'Testimonial Text Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#7a7a7a',
				'selectors' => [
					'{{WRAPPER}} .wfe-testimonial-content .wfe-testimonial-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_testimonial_description_typography',
				'selector' => '{{WRAPPER}} .wfe-testimonial-content .wfe-testimonial-text',
			]
		);

		$this->add_control(
			'wfe_testimonial_quotation_heading',
			[
				'label' => __( 'Quotation Mark', 'wfe_elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'wfe_testimonial_quotation_color',
			[
				'label' => esc_html__( 'Quotation Mark Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.15)',
				'selectors' => [
					'{{WRAPPER}} .wfe-testimonial-quote' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_testimonial_quotation_typography',
				'selector' => '{{WRAPPER}} .wfe-testimonial-quote',
			]
		);


		$this->end_controls_section();


	}


	protected function render( ) {

		$settings = $this->get_settings_for_display();
		$testimonial_image = $this->get_settings( 'wfe_testimonial_image' );
		$testimonial_image_url = Group_Control_Image_Size::get_attachment_image_src( $testimonial_image['id'], 'thumbnail', $settings );
		$testimonial_classes = $this->get_settings('wfe_testimonial_image_rounded') . " " . $this->get_settings('wfe_testimonial_alignment') . " " . $this->get_settings('wfe_testimonial_rating_number');


		?>


        <div id="wfe-testimonial-<?php echo esc_attr($this->get_id()); ?>" class="wfe-testimonial-item clearfix <?php echo $testimonial_classes; ?>">

            <div class="wfe-testimonial-image">
                <span class="wfe-testimonial-quote"></span>
				<?php if( 'yes' == $settings['wfe_testimonial_enable_avatar'] ) : ?>
                    <figure>
                        <img src="<?php echo esc_url($testimonial_image_url);?>" alt="<?php echo $settings['wfe_testimonial_name'];?>">
                    </figure>
				<?php endif; ?>
            </div>

            <div class="wfe-testimonial-content">
                <span class="wfe-testimonial-quote"></span>
                <p class="wfe-testimonial-text"><?php echo $settings['wfe_testimonial_description']; ?></p>

				<?php if ( ! empty( $settings['wfe_testimonial_enable_rating'] ) ) : ?>
                    <ul class="testimonial-star-rating">
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    </ul>
				<?php endif;?>
                <p class="wfe-testimonial-user" <?php if ( ! empty( $settings['wfe_testimonial_user_display_block'] ) ) : ?> style="display: block; float: none;"<?php endif;?>><?php echo $settings['wfe_testimonial_name']; ?></p>
                <p class="wfe-testimonial-user-company"><?php echo $settings['wfe_testimonial_company_title']; ?></p>
            </div>
        </div>


		<?php

	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Wfe_testimonial() );