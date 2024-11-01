<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_heading extends Widget_Base {

	public function get_name() {
		return 'wfe-heading';
	}

	public function get_title() {
		return __( 'Heading', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-header wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {

		/* Start Title General Settings Section */
		$this->start_controls_section('wfe_elementor_heading_content',
			[
				'label'         => esc_html__('Title', 'wfe_elementor'),
			]
		);

		/*Title Text*/
		$this->add_control('wfe_elementor_heading_text',
			[
				'label'         => esc_html__('Title', 'wfe_elementor'),
				'type'          => Controls_Manager::TEXT,
				'default'       => esc_html__('Heading Title Goes Here','wfe_elementor'),
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ]
			]
		);

		/*Title Style*/
		$this->add_control('wfe_elementor_heading_style',
			[
				'label'         => esc_html__('Style', 'wfe_elementor'),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'style1',
				'options'       => [
					'style1'        => esc_html__('Style1'),
					'style2'        => esc_html__('Style2'),
					'style3'        => esc_html__('Style3'),
					'style4'        => esc_html__('Style4'),
					'style5'        => esc_html__('Style5'),
					'style6'        => esc_html__('Style6'),
					'style7'        => esc_html__('Style7'),
				],
				'label_block'   => true,
			]
		);

		/*Icon Switcher*/
		$this->add_control('wfe_elementor_heading_icon_switcher',
			[
				'label'         => esc_html__('Icon', 'wfe_elementor'),
				'type'          => Controls_Manager::SWITCHER,
			]
		);

		/*Icon*/
		$this->add_control('wfe_elementor_heading_icon',
			[
				'label'         => esc_html__('Font Awesome Icon', 'wfe_elementor'),
				'type'          => Controls_Manager::ICON,
				'label_block'   => true,
				'condition'     => [
					'wfe_elementor_heading_icon_switcher'   => 'yes',
				]
			]
		);

		/*Title HTML TAG*/
		$this->add_control('wfe_elementor_heading_tag',
			[
				'label'         => esc_html__('HTML Tag', 'wfe_elementor'),
				'type'          => Controls_Manager::SELECT,
				'default'       => esc_html__('h2','wfe_elementor'),
				'options'       => [
					'h1'    => 'H1',
					'h2'    => 'H2',
					'h3'    => 'H3',
					'h4'    => 'H4',
					'h5'    => 'H5',
					'h6'    => 'H6',
				],
			]
		);

		/*Title Align*/
		$this->add_responsive_control('wfe_elementor_heading_align',
			[
				'label'         => esc_html__( 'Alignment', 'wfe_elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'      => [
						'title'=> esc_html__( 'Left', 'wfe_elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center'    => [
						'title'=> esc_html__( 'Center', 'wfe_elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right'     => [
						'title'=> esc_html__( 'Right', 'wfe_elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default'       => 'left',
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-container' => 'text-align: {{VALUE}};',
				],
			]
		);



		/*Style 8*/
		/*Strip Width*/
		$this->add_control('wfe_elementor_heading_style7_strip_width',
			[
				'label'         => esc_html__('Strip Width (PX)', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'default'       => [
					'unit'  => 'px',
					'size'  => '120',
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-style7-strip:before' => 'width: {{SIZE}}{{UNIT}};',
				],
				'label_block'   => true,
				'condition'     => [
					'wfe_elementor_heading_style'   => 'style7',
				],
			]
		);

		/*Strip Height*/
		$this->add_control('wfe_elementor_heading_style7_strip_height',
			[
				'label'         => esc_html__('Strip Height (PX)', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', 'em'],
				'default'       => [
					'unit'  => 'px',
					'size'  => '5',
				],
				'label_block'   => true,
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-style7-strip,{{WRAPPER}} .wfe_elementor_heading-style7-strip:before ' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'wfe_elementor_heading_style'   => 'style7',
				],
			]
		);

		/*Strip Top Spacing*/
		$this->add_control('wfe_elementor_heading_style7_strip_top_spacing',
			[
				'label'         => esc_html__('Strip Top Spacing (PX)', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-style7-strip' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'label_block'   => true,
				'condition'     => [
					'wfe_elementor_heading_style'   => 'style7',
				],
			]
		);

		/*Strip Bottom Spacing*/
		$this->add_control('wfe_elementor_heading_style7_strip_bottom_spacing',
			[
				'label'         => esc_html__('Strip Bottom Spacing (PX)', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'label_block'   => true,
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-style7-strip' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'wfe_elementor_heading_style'   => 'style7',
				],
			]
		);

		/*Title Align*/
		$this->add_responsive_control('wfe_elementor_heading_style7_strip_align',
			[
				'label'         => esc_html__( 'Align', 'wfe_elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'      => [
						'title'=> esc_html__( 'Left', 'wfe_elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'none'    => [
						'title'=> esc_html__( 'Center', 'wfe_elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right'     => [
						'title'=> esc_html__( 'Right', 'wfe_elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default'       => 'none',
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-style7-strip:before' => 'float: {{VALUE}};',
				],
				'condition'     => [
					'wfe_elementor_heading_style'   => 'style7',
				],
			]
		);

		/*End Title General Settings Section*/
		$this->end_controls_section();

		/*Start Styling Section*/
		$this->start_controls_section('wfe_elementor_heading_style_section',
			[
				'label'         => esc_html__('Title', 'wfe_elementor'),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		/*Title Color*/
		$this->add_control('wfe_elementor_heading_color',
			[
				'label'         => esc_html__('Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => '#23a455',
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-header' => 'color: {{VALUE}};',
				],
			]
		);
		/*Style 1 Left Border Color*/
		$this->add_control('wfe_elementor_style1_left_border_color',
			[
				'label'         => esc_html__('Left Border Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'default' => '#b21a2f',
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-style1' => 'border-left: 3px solid {{VALUE}};',
				],
				'condition' => [
					'wfe_elementor_heading_style' => 'style1',
				],
			]
		);
		/*Style 2 Bottom Border Color*/
		$this->add_control('wfe_elementor_style2_bottom_border_color',
			[
				'label'         => esc_html__('Bottom Border Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'default' => '#b21a2f',
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-container.style2' => 'border-bottom: 3px solid {{VALUE}};',
				],
				'condition' => [
					'wfe_elementor_heading_style' => 'style2',
				],
			]
		);


		/*Title Typography*/
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'title_typography',
				'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
				'selector'      => '{{WRAPPER}} .wfe_elementor_heading-header',
			]
		);

		/*Style 1*/
		/*Style 1 Border*/
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'style_one_border',
				'selector'      => '{{WRAPPER}} .wfe_elementor_heading-style1',
				'condition'     => [
					'wfe_elementor_heading_style'   => 'style1',
				],
			]
		);

		/*Style 2*/
		/*Background Color*/
		$this->add_control('wfe_elementor_heading_style2_background_color',
			[
				'label'         => esc_html__('Background Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-style2' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'wfe_elementor_heading_style'   => 'style2',
				],
			]
		);

		/*Style 2*/


		/*Style 3*/
		/*Background Color*/
		$this->add_control('wfe_elementor_heading_style3_background_color',
			[
				'label'         => esc_html__('Background Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-style3' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'wfe_elementor_heading_style'   => 'style3',
				],
			]
		);


		/*Style 5*/
		/*Header Line Color*/
		$this->add_control('wfe_elementor_heading_style5_header_line_color',
			[
				'label'         => esc_html__('Line Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-style5' => 'border-bottom: 2px solid {{VALUE}};',
				],
				'condition'     => [
					'wfe_elementor_heading_style'   => 'style5',
				],
			]
		);

		/*Container Line Color*/
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'style_five_border',
				'selector'      => '{{WRAPPER}} .wfe_elementor_heading-container',
				'condition'     => [
					'wfe_elementor_heading_style'   => ['style2','style4','style5','style6'],
				],
			]
		);

		/*Style 7*/
		/*Header Line Color*/
		$this->add_control('wfe_elementor_heading_style6_header_line_color',
			[
				'label'         => esc_html__('Line Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-style6' => 'border-bottom: 2px solid {{VALUE}};',
				],
				'condition'     => [
					'wfe_elementor_heading_style'   => 'style6',
				],
			]
		);

		/*Triangle Color*/
		$this->add_control('wfe_elementor_heading_style6_triangle_color',
			[
				'label'         => esc_html__('Triangle Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-style6:before' => 'border-bottom-color: {{VALUE}};',
				],
				'condition'     => [
					'wfe_elementor_heading_style'   => 'style6',
				],
			]
		);



		/*Strip Color*/
		$this->add_control('wfe_elementor_heading_style7_strip_color',
			[
				'label'         => esc_html__('Strip Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-style7-strip:before' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'wfe_elementor_heading_style'   => 'style7',
				],
			]
		);

		/*Title Margin*/
		$this->add_responsive_control('wfe_elementor_heading_margin',
			[
				'label'         => esc_html__('Margin', 'wfe_elementor'),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		/*Title Text Shadow*/
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'label'             => esc_html__('Shadow','wfe_elementor'),
				'name'              => 'wfe_elementor_heading_text_shadow',
				'selector'          => '{{WRAPPER}} .wfe_elementor_heading-header',
			]
		);

		/*End Title Style Section*/
		$this->end_controls_section();

		/*Start Icon Style Section*/
		$this->start_controls_section('wfe_elementor_heading_icon_style_section',
			[
				'label'         => esc_html__('Icon Style', 'wfe_elementor'),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'wfe_elementor_heading_icon_switcher'   => 'yes',
				]
			]
		);

		/*Icon Color*/
		$this->add_control('wfe_elementor_heading_icon_color',
			[
				'label'         => esc_html__('Icon Color', 'wfe_elementor'),
				'type'          => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-icon' => 'color: {{VALUE}};',
				],
			]
		);

		/*Icon Size*/
		$this->add_control('wfe_elementor_heading_icon_size',
			[
				'label'         => esc_html__('Icon Size', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				]
			]
		);

		/*Icon Background*/
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'              => 'wfe_elementor_heading_icon_background',
				'types'             => [ 'classic' , 'gradient' ],
				'selector'          => '{{WRAPPER}} .wfe_elementor_heading-icon',
			]
		);

		/*Icon Border*/
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'              => 'wfe_elementor_heading_icon_border',
				'selector'          => '{{WRAPPER}} .wfe_elementor_heading-icon',
			]
		);

		/*Icon Border Radius*/
		$this->add_control('wfe_elementor_heading_icon_border_radius',
			[
				'label'         => esc_html__('Border Radius', 'wfe_elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-icon' => 'border-radius: {{SIZE}}{{UNIT}};'
				]
			]
		);

		/*Icon Margin*/
		$this->add_responsive_control('wfe_elementor_heading_icon_margin',
			[
				'label'         => esc_html__('Margin', 'wfe_elementor'),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				]
			]
		);

		/*Icon Padding*/
		$this->add_responsive_control('wfe_elementor_heading_icon_padding',
			[
				'label'         => esc_html__('Padding', 'wfe_elementor'),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_heading-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				]
			]
		);

		/*Icon Text Shadow*/
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'label'             => esc_html__('Icon Shadow', 'wfe_elementor'),
				'name'              => 'wfe_elementor_heading_icon_text_shadow',
				'selector'          => '{{WRAPPER}} .wfe_elementor_heading-icon',
			]
		);

		/*End Progress Bar Section*/
		$this->end_controls_section();

	}

	protected function render($instance = [])
	{
		// get our input from the widget settings.
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes('wfe_elementor_heading_text', 'none');

		$title_tag = $settings['wfe_elementor_heading_tag'];

		$selected_style = $settings['wfe_elementor_heading_style'];
		?>

    <div class="wfe_elementor_heading-container <?php echo $selected_style; ?>">
        <<?php echo $title_tag ; ?> class="wfe_elementor_heading-header wfe_elementor_heading-<?php echo $selected_style; ?>">
		<?php if ( $settings['wfe_elementor_heading_style'] === 'style7' ) : ?>
            <span class="wfe_elementor_heading-style7-strip"></span>
		<?php endif; ?>
		<?php if( !empty( $settings['wfe_elementor_heading_icon'] ) && $settings['wfe_elementor_heading_icon_switcher'] ) : ?>
            <i class="wfe_elementor_heading-icon <?php echo $settings['wfe_elementor_heading_icon'];?>"></i>
		<?php endif; ?>
        <span <?php echo $this->get_render_attribute_string('wfe_elementor_heading_text'); ?>><?php echo esc_html($settings['wfe_elementor_heading_text']); ?></span>
        </<?php echo $title_tag; ?>>
        </div>

		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Wfe_heading() );