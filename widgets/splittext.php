<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_splittext extends Widget_Base {

	public function get_name() {
		return 'wfe-splittext';
	}

	public function get_title() {
		return __( 'Split Text', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-type-tool wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {
		$this->start_controls_section(
			'section_general',
			[
				'label' => __( 'General', 'wfe_elementor' )
			]
		);


		$this->add_responsive_control(
			'text-align',
			[
				'label' => __( 'Alignment', 'wfe_elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
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
					]
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-st-transform-text' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'split_mode',
			[
				'label' => __( 'Split Mode', 'wfe_elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'text' => __( 'Letter', 'wfe_elementor' ),
					'word' => __( 'Word', 'wfe_elementor' )
				],
				'default' => 'word',
			]
		);

		$this->add_control(
			'split_count',
			[
				'label' => __( 'Split Count', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '2',
				'placeholder' => __( 'Count', 'wfe_elementor' ),
			]
		);

		$this->add_control(
			'title_size',
			[
				'label' => __( 'HTML Tag', 'wfe_elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => __( 'H1', 'wfe_elementor' ),
					'h2' => __( 'H2', 'wfe_elementor' ),
					'h3' => __( 'H3', 'wfe_elementor' ),
					'h4' => __( 'H4', 'wfe_elementor' ),
					'h5' => __( 'H5', 'wfe_elementor' ),
					'h6' => __( 'H6', 'wfe_elementor' ),
					'div' => __( 'div', 'wfe_elementor' ),
					'span' => __( 'span', 'wfe_elementor' ),
					'p' => __( 'p', 'wfe_elementor' ),
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __( 'Text', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter text', 'wfe_elementor' ),
				'default' => __( 'I Love Elementor', 'wfe_elementor' ),
			]
		);




		$this->end_controls_section();

		$this->start_controls_section(
			'section_split_text_style',
			[
				'label' => __( 'Part 1', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'split_text_color',
			[
				'label' => __( 'Text Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-st-split-text' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'split_text_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe-st-split-text',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'split_text_border',
				'label' => __( 'Box Border', 'wfe_elementor' ),
				'selector' => '{{WRAPPER}} .wfe-st-split-text',
			]
		);



		$this->add_control(
			'split_text_box_border_radius',
			[
				'label' => __( 'Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-st-split-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'split_text_box_padding',
			[
				'label' => __( 'Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-st-split-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'split_text_box_margin',
			[
				'label' => __( 'Margin', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-st-split-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'split_text_section_bg',
				'label' => __( 'Text Background', 'wfe_elementor' ),
				'types' => [ 'none','classic','gradient' ],
				'selector' => '{{WRAPPER}} .wfe-st-split-text',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_rest_text_style',
			[
				'label' => __( 'Part 2', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'rest_text_color',
			[
				'label' => __( 'Text Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-st-rest-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'rest_text_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe-st-rest-text',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'rest_text_border',
				'label' => __( 'Box Border', 'wfe_elementor' ),
				'selector' => '{{WRAPPER}} .wfe-st-rest-text',
			]
		);



		$this->add_control(
			'rest_text_box_border_radius',
			[
				'label' => __( 'Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-st-rest-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rest_text_box_padding',
			[
				'label' => __( 'Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-st-rest-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'rest_text_box_margin',
			[
				'label' => __( 'Margin', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-st-rest-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'rest_text_section_bg',
				'label' => __( 'Text Background', 'wfe_elementor' ),
				'types' => [ 'none','classic','gradient' ],
				'selector' => '{{WRAPPER}} .wfe-st-rest-text',
			]
		);

		$this->end_controls_section();

	}
	protected function render(){
		$settings = $this->get_settings();

		$this->add_render_attribute('wfe-st-transform-text-wrapper','class','wfe-st-transform-text-wrapper');

		$this->add_render_attribute('wfe-st-transform-text-wrapper','class','waiting');

		$this->add_render_attribute('wfe-st-transform-text','class','wfe-st-transform-text');

		$this->add_render_attribute('wfe-st-split-text','class','wfe-st-split-text');

		$this->add_render_attribute('wfe-st-split-full-text','class','wfe-st-split-text wfe-st-full-text');

		$this->add_render_attribute('wfe-st-rest-text','class','wfe-st-rest-text');

		?>
        <div id="wfe-at-<?php echo $this->get_id(); ?>" class="wfe-st-transform-text-wrapper">
            <div <?php echo $this->get_render_attribute_string( 'wfe-st-transform-text' ); ?>>
				<?php if($settings['split_mode'] == 'text'){ ?>
					<?php echo sprintf('<%1$s class="wfe-st-transform-text-title">%2$s</%1$s>', $settings['title_size'], "<div ".$this->get_render_attribute_string( 'wfe-st-split-text' ).">".substr($settings['text'], 0, $settings['split_count'])."</div><div ".$this->get_render_attribute_string( 'wfe-st-rest-text' ).">".substr($settings['text'], $settings['split_count'], strlen($settings['text']) - $settings['split_count'])."</div>"); ?>
				<?php } else { ?>
					<?php
					$arr = explode(" ", $settings['text']);
					if(count($arr) <= $settings['split_count']){
						$split_text = "<div " . $this->get_render_attribute_string( 'wfe-st-split-full-text' ) . ">".$settings['text']."</div>";
						echo sprintf('<%1$s class="wfe-st-transform-text-title">%2$s</%1$s>', $settings['title_size'], $split_text) ;
					}else{
						$split_text = "<div " . $this->get_render_attribute_string( 'wfe-st-split-text' ) . ">" . implode(" ", array_slice($arr, 0, $settings['split_count'])) . "&nbsp;</div>";
						$rest_text = "<div " . $this->get_render_attribute_string( 'wfe-st-rest-text' ) . ">" . implode(" ", array_slice($arr, $settings['split_count'], count($arr))) . "</div>";
						echo sprintf('<%1$s class="wfe-st-transform-text-title">%2$s</%1$s>', $settings['title_size'], $split_text.$rest_text);
					}
					?>
				<?php } ?>
            </div>
        </div>
		<?php
	}

}
Plugin::instance()->widgets_manager->register_widget_type( new Wfe_splittext() );