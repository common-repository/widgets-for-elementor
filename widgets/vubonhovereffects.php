<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_vubonhovereffects extends Widget_Base {

	public function get_name() {
		return 'wfe-vubonhovereffects';
	}

	public function get_title() {
		return __( 'Vubon Hover Effects', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-info-box wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {

		// Content Controls
		$this->start_controls_section(
			'wfe_section_vhover_content',
			[
				'label' => esc_html__( 'Hover Content', 'wfe_elementor' )
			]
		);


		$this->add_control(
			'vhover_image',
			[
				'label' => __( 'Hover Image', 'wfe_elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'vhover_image_alt',
			[
				'label' => __( 'Image ALT Tag', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
				'placeholder' => __( 'Enter alter tag for the image', 'wfe_elementor' ),
				'title' => __( 'Input image alter tag here', 'wfe_elementor' ),
				'dynamic' => [ 'action' => true ]
			]
		);

		$this->add_control(
			'vhover_heading',
			[
				'label' => __( 'Hover Heading', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'I am Interactive',
				'placeholder' => __( 'Enter heading for the vhover', 'wfe_elementor' ),
				'title' => __( 'Enter heading for the vhover', 'wfe_elementor' ),
				'dynamic' => [ 'active' => true ]
			]
		);

		$this->add_control(
			'vhover_content',
			[
				'label'   => __( 'Hover Content', 'wfe_elementor' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Click to inspect, then edit as needed.', 'wfe_elementor' ),
			]
		);


		$this->add_control(
			'vhover_link_url',
			[
				'label' => __( 'Link URL', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '#',
				'placeholder' => __( 'Enter link URL for the vhover', 'wfe_elementor' ),
				'title' => __( 'Enter heading for the vhover', 'wfe_elementor' ),
			]
		);

		$this->add_control(
			'vhover_link_target',
			[
				'label' => esc_html__( 'Open in new window?', 'wfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( '_blank', 'wfe_elementor' ),
				'label_off' => __( '_self', 'wfe_elementor' ),
				'default' => '_self',
			]
		);

		$this->end_controls_section();



		// Style Controls
		$this->start_controls_section(
			'wfe_section_vhover_settings',
			[
				'label' => esc_html__( 'Hover Effects &amp; Settings', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'vhover_effect',
			[
				'label' => esc_html__( 'Set Hover Effect', 'wfe_elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'effect-lily',
				'options' => [
					'effect-lily' 	=> esc_html__( 'Lily', 		'wfe_elementor' ),
					'effect-sadie' 	=> esc_html__( 'Sadie', 	'wfe_elementor' ),
					'effect-layla'	=> esc_html__( 'Layla', 	'wfe_elementor' ),
					'effect-oscar' 	=> esc_html__( 'Oscar',		'wfe_elementor' ),
					'effect-marley' => esc_html__( 'Marley',	'wfe_elementor' ),
					'effect-ruby' 	=> esc_html__( 'Ruby', 	 	'wfe_elementor' ),
					'effect-roxy'	=> esc_html__( 'Roxy', 		'wfe_elementor' ),
					'effect-bubba'	=> esc_html__( 'Bubba', 	'wfe_elementor' ),
					'effect-romeo' 	=> esc_html__( 'Romeo', 	'wfe_elementor' ),
					'effect-sarah' 	=> esc_html__( 'Sarah', 	'wfe_elementor' ),
					'effect-chico' 	=> esc_html__( 'Chico', 	'wfe_elementor' ),
					'effect-milo' 	=> esc_html__( 'Milo', 		'wfe_elementor' ),
					'effect-apollo' => esc_html__( 'Apolo', 	'wfe_elementor' ),
					'effect-jazz' 	=> esc_html__( 'Jazz', 		'wfe_elementor' ),
					'effect-ming' 	=> esc_html__( 'Ming', 		'wfe_elementor' ),
				],
			]
		);

		$this->add_control(
			'vhover_container_width',
			[
				'label' => esc_html__( 'Set max width for the container?', 'wfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'wfe_elementor' ),
				'label_off' => __( 'no', 'wfe_elementor' ),
				'default' => 'yes',
			]
		);

		$this->add_responsive_control(
			'vhover_container_width_value',
			[
				'label' => __( 'Container Max Width (% or px)', 'wfe_elementor' ),
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
					'{{WRAPPER}} .wfe-interactive-vhover' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'vhover_container_width' => 'yes',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'vhover_border',
				'selector' => '{{WRAPPER}} .wfe-interactive-vhover',
			]
		);


		$this->add_control(
			'vhover_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-interactive-vhover' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'wfe_section_vhover_styles',
			[
				'label' => esc_html__( 'Colors &amp; Typography', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'vhover_heading_color',
			[
				'label' => esc_html__( 'Hover Heading Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .wfe-interactive-vhover figure figcaption h2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_vhover_title_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe-interactive-vhover figure figcaption h2',
			]
		);

		$this->add_control(
			'vhover_content_color',
			[
				'label' => esc_html__( 'Hover Content Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .wfe-interactive-vhover figure p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_vhover_content_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe-interactive-vhover figure p',
			]
		);

		$this->add_control(
			'vhover_overlay_color',
			[
				'label' => esc_html__( 'Hover Overlay Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#3085a3',
				'selectors' => [
					'{{WRAPPER}} .wfe-interactive-vhover figure' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


	}


	protected function render( ) {


		$settings = $this->get_settings_for_display();
		$vhover_image = $this->get_settings( 'vhover_image' );


		?>


        <div id="wfe-vhover-<?php echo esc_attr($this->get_id()); ?>" class="wfe-interactive-vhover">
            <figure class="<?php echo esc_attr($settings['vhover_effect'] ); ?>">
				<?php echo '<img alt="'. $settings['vhover_image_alt'] . '" src="' . $vhover_image['url'] . '">'; ?>
                <figcaption>
                    <div>
						<?php if ( ! empty( $settings['vhover_heading'] ) ) : ?>
                            <h2><?php echo esc_attr($settings['vhover_heading'] ); ?></h2>
						<?php endif; ?>
                        <p><?php echo $settings['vhover_content']; ?></p>
                    </div>
                    <a href="<?php echo esc_attr($settings['vhover_link_url'] ); ?>" target="<?php echo esc_attr($settings['vhover_link_target'] ); ?>"></a>
                </figcaption>
            </figure>
        </div>


		<?php

	}

	protected function content_template() {

		?>


		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Wfe_vubonhovereffects() );