<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_fancytext extends Widget_Base {

	public function get_name() {
		return 'wfe-fancytext';
	}

	public function get_title() {
		return __( 'Fancy Text', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-text-height wfe-ccn-pe';
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
					'{{WRAPPER}} .wfe_elementor-at-animation' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'pre-text',
			[
				'label' => __( 'Pre Text', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter text', 'wfe_elementor' ),
				'default' => __( 'I Love', 'wfe_elementor' ),
			]
		);


		$this->add_control(
			'animation-text-list',
			[
				'label' => __( 'Animated Text List', 'wfe_elementor' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'text' => __( 'Football', 'wfe_elementor' ),
					],
					[
						'text' => __( 'Cricket', 'wfe_elementor' ),
					],
					[
						'text' => __( 'Basketball', 'wfe_elementor' ),
					],
				],
				'fields' => [
					[
						'name' => 'text',
						'label' => __( 'Text', 'wfe_elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'placeholder' => __( 'Text to animate', 'wfe_elementor' ),
						'default' => __( '', 'wfe_elementor' ),
					],
				],
				'title_field' => '{{{ text }}}'
			]
		);

		$this->add_control(
			'post-text',
			[
				'label' => __( 'Post Text', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter text', 'wfe_elementor' ),
				'default' => __( 'Very Much', 'wfe_elementor' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pre_text_style',
			[
				'label' => __( 'Pre Text', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'pre_text_color',
			[
				'label' => __( 'Pre Text Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-at-pre-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pre_text_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe_elementor-at-pre-text',
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'section_animation_text_style',
			[
				'label' => __( 'Animated Text', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'animation_color_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe_elementor-at-animation-text, {{WRAPPER}} .wfe_elementor-at-animation-text i',
			]
		);


		$this->add_control(
			'animation_color',
			[
				'label' => __( 'Animation Text Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-at-animation-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'animated_text_border',
				'label' => __( 'Box Border', 'wfe_elementor' ),
				'selector' => '{{WRAPPER}} .wfe_elementor-at-animation-text-wrapper .wfe_elementor-at-animation-text.is-visible',
			]
		);



		$this->add_control(
			'box_border_radius',
			[
				'label' => __( 'Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-at-animation-text-wrapper .wfe_elementor-at-animation-text.is-visible' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-at-animation-text-wrapper .wfe_elementor-at-animation-text.is-visible' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_margin',
			[
				'label' => __( 'Margin', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-at-animation-text-wrapper .wfe_elementor-at-animation-text.is-visible' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'animation_section_bg',
				'label' => __( 'Section Background', 'wfe_elementor' ),
				'types' => [ 'classic','gradient'  ],
				'selector' => '{{WRAPPER}} .wfe_elementor-at-animation-text-wrapper .wfe_elementor-at-animation-text.is-visible',
			]
		);



		$this->end_controls_section();

		$this->start_controls_section(
			'section_cursor_style',
			[
				'label' => __( 'Cursor Control', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'cursor_color',
			[
				'label' => __( 'Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => '#54595f',
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-at-animation-text-wrapper::after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'cursor_width',
			[
				'label' => __( 'Width', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'size' => 1,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-at-animation.type .wfe_elementor-at-animation-text-wrapper::after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_post_text_style',
			[
				'label' => __( 'Post Text', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'post_text_color',
			[
				'label' => __( 'Post Text Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor-at-post-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'post_text_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe_elementor-at-post-text',
			]
		);

		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings();

		$this->add_render_attribute('wfe_elementor-at-animated-text-wrapper','class','wfe_elementor-at-animation-text-wrapper');

		$this->add_render_attribute('wfe_elementor-at-animated-text-wrapper','class','waiting');

		$this->add_render_attribute('wfe_elementor-at-animated-text','class','wfe_elementor-at-animation-text');

		$this->add_render_attribute('wfe_elementor-at-pre-txt','class','wfe_elementor-at-pre-text');

		$this->add_render_attribute('wfe_elementor-at-animated','class','wfe_elementor-at-animation');

		$this->add_render_attribute('wfe_elementor-at-animated','class','type');

		$this->add_render_attribute('wfe_elementor-at-animated','class','letters');

		$this->add_render_attribute('wfe_elementor-at-post-txt','class','wfe_elementor-at-post-text');

		?>
        <div id="wfe_elementor-at-<?php echo $this->get_id(); ?>" class="wfe_elementor-animtext-wrapper">
            <div <?php echo $this->get_render_attribute_string( 'wfe_elementor-at-animated' ); ?>>
                <span <?php echo $this->get_render_attribute_string( 'wfe_elementor-at-pre-txt' ); ?>><?php echo $settings['pre-text']; ?></span>
				<?php if(count($settings['animation-text-list'])){
					?>
                    <span <?php echo $this->get_render_attribute_string( 'wfe_elementor-at-animated-text-wrapper' ); ?>>
								<?php
								foreach($settings['animation-text-list'] as $animation_text){
									?>

                                    <span <?php echo $this->get_render_attribute_string( 'wfe_elementor-at-animated-text' ); ?>><?php echo $animation_text['text']; ?></span>

									<?php
								}
								?>
							</span>
					<?php
				}?>
                <span <?php echo $this->get_render_attribute_string( 'wfe_elementor-at-post-txt' ); ?>><?php echo $settings['post-text']; ?></span>
            </div>
        </div>
        <script>
            console.log('before-trigger');
            jQuery(document).trigger('elementor/render/animation-text','#wfe_elementor-at-<?php echo $this->get_id(); ?>');

            jQuery(document).ready(function(){
                jQuery(document).trigger('elementor/render/animation-text','#wfe_elementor-at-<?php echo $this->get_id(); ?>');
            });
        </script>
		<?php
	}

	protected function content_template() {
		?>
        <#

                box_html = '';

                print( separator_html );
                #>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Wfe_fancytext() );