<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_shapedivider extends Widget_Base {

	public function get_name() {
		return 'wfe-shapedivider';
	}

	public function get_title() {
		return __( 'Shape Divider', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-eraser wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {

		$this->start_controls_section(
			'section_shape',
			[
				'label' => __( 'Shape', 'wfe_elementor' )
			]
		);

		$this->add_control(
			'separator_shape',
			[
				'label' => __( 'Shape', 'wfe_elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'triangle-upper-left' => __( 'Triangle Upper Left', 'wfe_elementor' ),
					'triangle-upper-right' => __( 'Triangle Upper Right', 'wfe_elementor' ),
					'triangle-bottom-left' => __( 'Triangle Bottom Left', 'wfe_elementor' ),
					'triangle-bottom-right' => __( 'Triangle Bottom Right', 'wfe_elementor' ),
				],
				'default' => 'triangle-upper-right',

			]
		);

		$this->add_control(
			'shape_color',
			[
				'label' => __( 'Shape Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} svg' => 'fill:{{VALUE}}',
				],
			]
		);

		$this->add_control(
			'shape_height',
			[
				'type' => Controls_Manager::NUMBER,
				'label' => __( 'Shape Height (in px)', 'wfe_elementor' ),
				'placeholder' => __( '75', 'wfe_elementor' ),
				'default' => __( '75', 'wfe_elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render( ) {
		$settings = $this->get_settings();

		if ($settings['separator_shape'] == "triangle-upper-left"){
            echo '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" fill="<?php echo $settings[\'shape_color\']; ?>" width="100%" height="90" viewBox="0 0 50 50" preserveAspectRatio="none" style="height: <?php echo $settings[\'shape_height\']; ?>px;">
    <polygon class="fil0" points="0,0 50,0 0,50"></polygon>
</svg>';
        }

		if ($settings['separator_shape'] == "triangle-upper-right"){
            echo '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" fill="<?php echo $settings[\'shape_color\']; ?>" width="100%" height="90" viewBox="0 0 50 50" preserveAspectRatio="none" style="height: <?php echo $settings[\'shape_height\']; ?>px;">
    <polygon class="fil0" points="0,0 50,0 50,50"></polygon>
</svg>';
        }

		if ($settings['separator_shape'] == "triangle-bottom-left"){
            echo '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" fill="<?php echo $settings[\'shape_color\']; ?>" width="100%" height="90" viewBox="0 0 50 50" stroke="<?php echo $settings[\'shape_color\']; ?>" stroke-width="1" preserveAspectRatio="none" style="height: <?php echo $settings[\'shape_height\']; ?>px;">
    <polygon points="0,0 0,50 50,50"></polygon>
</svg>';
        }
		if ($settings['separator_shape'] == "triangle-bottom-right"){
            echo '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" fill="<?php echo $settings[\'shape_color\']; ?>" width="100%" height="90" viewBox="0 0 50 50" preserveAspectRatio="none" style="height: <?php echo $settings[\'shape_height\']; ?>px;">
    <polygon class="fil0" points="0,50 50,50 50,0"></polygon>
</svg>';
        }
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Wfe_shapedivider() );