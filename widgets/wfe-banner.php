<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_banner extends Widget_Base {

	public function get_name() {
		return 'wfe-banner';
	}

	public function get_title() {
		return __( 'Banner', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-picture-o wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Register Control
	protected function _register_controls() {
		$this->start_controls_section(
			'wfe_elementor_banner_global_settings',
			[
				'label' 		=> esc_html__( 'Image', 'wfe_elementor_banner' )
			]
		);

		$this->add_control(
			'wfe_elementor_banner_image',
			[
				'label'			=> esc_html__( 'Upload Image', 'wfe_elementor_banner' ),
				'description'	=> esc_html__( 'Select an image for the Banner', 'wfe_elementor_banner' ),
				'type'			=> Controls_Manager::MEDIA,
				'default'		=> [
					'url'	=> Utils::get_placeholder_image_src()
				],
				'show_external'	=> true
			]
		);

		$this->add_control('wfe_elementor_banner_link_url_switch',
			[
				'label'         => esc_html__('Link', 'wfe_elementor_banner'),
				'type'          => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'wfe_elementor_banner_image_link_switcher',
			[
				'label'			=> esc_html__( 'Custom Link', 'wfe_elementor_banner' ),
				'type'			=> Controls_Manager::SWITCHER,
				'default'		=> '',
				'description'	=> esc_html__( 'Add a custom link to the banner', 'wfe_elementor_banner' ),
				'condition'     => [
					'wfe_elementor_banner_link_url_switch'    => 'yes',
				],
			]
		);

		$this->add_control(
			'wfe_elementor_banner_image_custom_link',
			[
				'label'			=> esc_html__( 'Set custom Link', 'wfe_elementor_banner' ),
				'type'			=> Controls_Manager::URL,
				'description'	=> esc_html__( 'What custom link you want to set to banner?', 'wfe_elementor_banner' ),
				'condition'		=> [
					'wfe_elementor_banner_image_link_switcher' => 'yes',
					'wfe_elementor_banner_link_url_switch'    => 'yes',
				],
				'show_external' => false,
			]
		);

		$this->add_control(
			'wfe_elementor_banner_image_existing_page_link',
			[
				'label'			=> esc_html__( 'Existing Page', 'wfe_elementor_banner' ),
				'type'			=> Controls_Manager::SELECT2,
				'description'	=> esc_html__( 'Link the banner with an existing page', 'wfe_elementor_banner' ),
				'condition'		=> [
					'wfe_elementor_banner_image_link_switcher!' => 'yes',
					'wfe_elementor_banner_link_url_switch'    => 'yes',
				],
				'multiple'      => false,
				//'options'		=> $this->getTemplateInstance()->get_all_post()
			]
		);

		$this->add_control(
			'wfe_elementor_banner_image_link_open_new_tab',
			[
				'label'			=> esc_html__( 'New Tab', 'wfe_elementor_banner' ),
				'type'			=> Controls_Manager::SWITCHER,
				'default'		=> '',
				'description'	=> esc_html__( 'Choose if you want the link be opened in a new tab or not', 'wfe_elementor_banner' ),
				'condition'     => [
					'wfe_elementor_banner_link_url_switch'    => 'yes',
				],
			]
		);

		$this->add_control(
			'wfe_elementor_banner_image_link_add_nofollow',
			[
				'label'			=> esc_html__( 'Nofollow Option', 'wfe_elementor_banner' ),
				'type'			=> Controls_Manager::SWITCHER,
				'default'		=> '',
				'description'	=> esc_html__('if you choose yes, the link will not be counted in search engines', 'wfe_elementor_banner' ),
				'condition'     => [
					'wfe_elementor_banner_link_url_switch'    => 'yes',
				],
			]
		);

		$this->add_control(
			'wfe_elementor_banner_image_animation',
			[
				'label'			=> esc_html__( 'Effect', 'wfe_elementor_banner' ),
				'type'			=> Controls_Manager::SELECT,
				'default'		=> 'wfe_elementor_banner_animation1',
				'description'	=> esc_html__( 'Choose a hover effect for the banner', 'wfe_elementor_banner' ),
				'options'		=> [
					'wfe_elementor_banner_animation1'		=> 'Effect 1',
					'wfe_elementor_banner_animation5'		=> 'Effect 2',
					'wfe_elementor_banner_animation13'	=> 'Effect 3',
					'wfe_elementor_banner_animation2'		=> 'Effect 4',
					'wfe_elementor_banner_animation4'		=> 'Effect 5',
					'wfe_elementor_banner_animation6'		=> 'Effect 6'
				]
			]
		);

		$this->add_control(
			'wfe_elementor_banner_hover_effect',
			[
				'label'         => esc_html__('Hover Effect', 'wfe_elementor_banner'),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'none'          => esc_html__('None', 'wfe_elementor_banner'),
					'zoomin'        => esc_html__('Zoom In', 'wfe_elementor_banner'),
					'zoomout'       => esc_html__('Zoom Out', 'wfe_elementor_banner'),
					'scale'         => esc_html__('Scale', 'wfe_elementor_banner'),
					'grayscale'     => esc_html__('Grayscale', 'wfe_elementor_banner'),
					'blur'          => esc_html__('Blur', 'wfe_elementor_banner'),
					'blur'          => esc_html__('Blur', 'wfe_elementor_banner'),
					'bright'        => esc_html__('Bright', 'wfe_elementor_banner'),
					'sepia'         => esc_html__('Sepia', 'wfe_elementor_banner'),
				],
				'default'       => 'none',
			]
		);

		$this->add_control(
			'wfe_elementor_banner_height',
			[
				'label'			=> esc_html__( 'Height', 'wfe_elementor_banner' ),
				'type'			=> Controls_Manager::SELECT,
				'default'		=> 'default',
				'description'	=> esc_html__( 'Choose if you want to set a custom height for the banner or keep it as it is', 'wfe_elementor_banner' ),
				'options'		=> [
					'default'		=> 'Default',
					'custom'		=> 'Custom',
				]
			]
		);

		$this->add_control(
			'wfe_elementor_banner_custom_height',
			[
				'label'			=> esc_html__( 'Min Height', 'wfe_elementor_banner' ),
				'type'			=> Controls_Manager::NUMBER,
				'description'	=> esc_html__( 'Set a minimum height value in pixels', 'wfe_elementor_banner' ),
				'condition'		=> [
					'wfe_elementor_banner_height' => 'custom'
				],
				'selectors'		=> [
					'{{WRAPPER}} .wfe_elementor_banner-ib' => 'height: {{VALUE}}px;'
				]
			]
		);

		$this->add_control(
			'wfe_elementor_banner_extra_class',
			[
				'label'			=> esc_html__( 'Extra Class', 'wfe_elementor_banner' ),
				'type'			=> Controls_Manager::TEXT,
				'description'	=> esc_html__( 'Add extra class name that will be applied to the banner, and you can use this class for your customizations.', 'wfe_elementor_banner' ),
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'wfe_elementor_banner_image_section',
			[
				'label' => esc_html__( 'Content', 'wfe_elementor_banner' )
			]
		);

		$this->add_control(
			'wfe_elementor_banner_title',
			[
				'label'			=> esc_html__( 'Title', 'wfe_elementor_banner' ),
				'placeholder'	=> esc_html__( 'Give a title to this banner', 'wfe_elementor_banner' ),
				'description'	=> esc_html__( 'Give a title to this banner', 'wfe_elementor_banner' ),
				'type'			=> Controls_Manager::TEXT,
				'dynamic'       => [ 'active' => true ],
				'default'		=> esc_html__( 'Premium Banner', 'wfe_elementor_banner' ),
				'label_block'	=> false
			]
		);

		$this->add_control(
			'wfe_elementor_banner_title_tag',
			[
				'label'			=> esc_html__( 'HTML Tag', 'wfe_elementor_banner' ),
				'description'	=> esc_html__( 'Select a heading tag for the title. Headings are defined with H1 to H6 tags', 'wfe_elementor_banner' ),
				'type'			=> Controls_Manager::SELECT,
				'default'		=> 'h3',
				'options'       => [
					'h1'    => 'H1',
					'h2'    => 'H2',
					'h3'    => 'H3',
					'h4'    => 'H4',
					'h5'    => 'H5',
					'h6'    => 'H6',
				],
				'label_block'	=> true,
			]
		);


		$this->add_control(
			'wfe_elementor_banner_description_hint',
			[
				'label'			=> esc_html__( 'Description', 'wfe_elementor_banner' ),
				'type'			=> Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'wfe_elementor_banner_description',
			[
				'label'			=> esc_html__( 'Description', 'wfe_elementor_banner' ),
				'description'	=> esc_html__( 'Give the description to this banner', 'wfe_elementor_banner' ),
				'type'			=> Controls_Manager::WYSIWYG,
				'dynamic'       => [ 'active' => true ],
				'default'		=> esc_html__( 'Premium Banner gives you a wide range of styles and options that you will definitely fall in love with', 'wfe_elementor_banner' ),
				'label_block'	=> true
			]
		);

		$this->add_control('wfe_elementor_banner_title_text_align',
			[
				'label'         => esc_html__('Alignment', 'wfe_elementor_banner'),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'  => [
						'title'     => esc_html__('Left', 'wfe_elementor_banner'),
						'icon'      => 'fa fa-align-left'
					],
					'center'  => [
						'title'     => esc_html__('Center', 'wfe_elementor_banner'),
						'icon'      => 'fa fa-align-center'
					],
					'right'  => [
						'title'     => esc_html__('Right', 'wfe_elementor_banner'),
						'icon'      => 'fa fa-align-right'
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_banner-ib-title, {{WRAPPER}} .wfe_elementor_banner-ib-content'   => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section('wfe_elementor_banner_responsive_section',
			[
				'label'         => esc_html__('Responsive', 'wfe_elementor_banner'),
			]);

		$this->add_control('wfe_elementor_banner_responsive_switcher',
			[
				'label'         => esc_html__('Responsive Controls', 'wfe_elementor_banner'),
				'type'          => Controls_Manager::SWITCHER,
				'description'   => esc_html__('If the description text is not suiting well on specific screen sizes, you may enable this option which will hide the description text.', 'wfe_elementor_banner')
			]);

		$this->add_control('wfe_elementor_banner_min_range',
			[
				'label'     => esc_html__('Minimum Size', 'wfe_elementor_banner'),
				'type'      => Controls_Manager::NUMBER,
				'description'=> esc_html__('Note: minimum size for extra small screens is 1px.','wfe_elementor_banner'),
				'default'   => 1,
				'condition' => [
					'wfe_elementor_banner_responsive_switcher'    => 'yes'
				],
			]);

		$this->add_control('wfe_elementor_banner_max_range',
			[
				'label'     => esc_html__('Maximum Size', 'wfe_elementor_banner'),
				'type'      => Controls_Manager::NUMBER,
				'description'=> esc_html__('Note: maximum size for extra small screens is 767px.','wfe_elementor_banner'),
				'default'   => 767,
				'condition' => [
					'wfe_elementor_banner_responsive_switcher'    => 'yes'
				],
			]);

		$this->end_controls_section();

		$this->start_controls_section(
			'wfe_elementor_banner_opacity_style',
			[
				'label' 		=> esc_html__( 'Image', 'wfe_elementor_banner' ),
				'tab' 			=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'wfe_elementor_banner_image_bg_color',
			[
				'label' 		=> esc_html__( 'Background Color', 'wfe_elementor_banner' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wfe_elementor_banner-ib' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'wfe_elementor_banner_image_opacity',
			[
				'label' => esc_html__( 'Image Opacity', 'wfe_elementor_banner' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => .1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor_banner-ib .wfe_elementor_banner-ib-img' => 'opacity: {{SIZE}};',
				],
			]
		);


		$this->add_control(
			'wfe_elementor_banner_image_hover_opacity',
			[
				'label' => esc_html__( 'Hover Opacity', 'wfe_elementor_banner' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => .1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor_banner-ib .wfe_elementor_banner-ib-img.active' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'wfe_elementor_banner_title_style',
			[
				'label' 		=> esc_html__( 'Title', 'wfe_elementor_banner' ),
				'tab' 			=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'wfe_elementor_banner_color_of_title',
			[
				'label' => esc_html__( 'Color', 'wfe_elementor_banner' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor_banner-ib-desc .wfe_elementor_banner_title' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'wfe_elementor_banner_style2_title_bg',
			[
				'label'			=> esc_html__( 'Title Background', 'wfe_elementor_banner' ),
				'type'			=> Controls_Manager::COLOR,
				'default'       => '#f2f2f2',
				'description'	=> esc_html__( 'Choose a background color for the title', 'wfe_elementor_banner' ),
				'condition'		=> [
					'wfe_elementor_banner_image_animation' => 'wfe_elementor_banner_animation5'
				],
				'selectors'     => [
					'{{WRAPPER}} .wfe_elementor_banner_animation5 .wfe_elementor_banner-ib-desc'    => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_elementor_banner_title_typography',
				'selector' => '{{WRAPPER}} .wfe_elementor_banner-ib-desc .wfe_elementor_banner_title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'label'             => esc_html__('Shadow','wfe_elementor_banner'),
				'name'              => 'wfe_elementor_banner_title_shadow',
				'selector'          => '{{WRAPPER}} .wfe_elementor_banner-ib-desc .wfe_elementor_banner_title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'wfe_elementor_banner_styles_of_content',
			[
				'label' 		=> esc_html__( 'Description', 'wfe_elementor_banner' ),
				'tab' 			=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'wfe_elementor_banner_color_of_content',
			[
				'label' => esc_html__( 'Color', 'wfe_elementor_banner' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .wfe_elementor_banner .wfe_elementor_banner_content' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'wfe_elementor_banner_content_typhography',
				'selector'      => '{{WRAPPER}} .wfe_elementor_banner .wfe_elementor_banner_content',
				'scheme'        => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'label'             => esc_html__('Shadow','wfe_elementor_banner'),
				'name'              => 'wfe_elementor_banner_description_shadow',
				'selector'          => '{{WRAPPER}} .wfe_elementor_banner .wfe_elementor_banner_content',
			]
		);

		$this->end_controls_section();
    }

	// Render Control in Frontend
	protected function render() {
		$settings 	= $this->get_settings_for_display(); // All the settings values stored in $settings varaiable
		$this->add_inline_editing_attributes('wfe_elementor_banner_title');
		$this->add_inline_editing_attributes('wfe_elementor_banner_description', 'advanced');

		$title_tag 	= $settings[ 'wfe_elementor_banner_title_tag' ];
		$title 		= $settings[ 'wfe_elementor_banner_title' ];
		$full_title = '<'. $title_tag . ' class="wfe_elementor_banner-ib-title ult-responsive wfe_elementor_banner_title"><div '. $this->get_render_attribute_string('wfe_elementor_banner_title') .'>' .$title. '</div></'.$title_tag.'>';

		$link = isset( $settings['wfe_elementor_banner_image_link_switcher'] ) && $settings['wfe_elementor_banner_image_link_switcher'] != '' ? $settings['wfe_elementor_banner_image_custom_link']['url'] : get_permalink( $settings['wfe_elementor_banner_image_existing_page_link'] );

		$link_title = $settings['wfe_elementor_banner_image_link_switcher'] != 'yes' ? get_the_title( $settings['wfe_elementor_banner_image_existing_page_link'] ) : '';

		$open_new_tab = $settings['wfe_elementor_banner_image_link_open_new_tab'] == 'yes' ? ' target="_blank"' : '';
		$nofollow_link = $settings['wfe_elementor_banner_image_link_add_nofollow'] == 'yes' ? ' rel="nofollow"' : '';
		$full_link = '<a class="wfe_elementor_banner-ib-link" href="'. $link .'" title="'. $link_title .'"'. $open_new_tab . $nofollow_link . '></a>';
		$animation_class = $settings['wfe_elementor_banner_image_animation'];
		$hover_class = ' ' . $settings['wfe_elementor_banner_hover_effect'];
		$extra_class = isset( $settings['wfe_elementor_banner_extra_class'] ) && $settings['wfe_elementor_banner_extra_class'] != '' ? ' '. $settings['wfe_elementor_banner_extra_class'] : '';
		$min_height_class = $settings['wfe_elementor_banner_height'] == 'custom' ? '' : '';
		$full_class = $animation_class.$hover_class.$extra_class.$min_height_class;
		$min_size = $settings['wfe_elementor_banner_min_range'].'px';
		$max_size = $settings['wfe_elementor_banner_max_range'].'px';

		ob_start();
		?>
        <div class="wfe_elementor_banner" id="wfe_elementor_banner-<?php echo esc_attr($this->get_id()); ?>">
            <div class="wfe_elementor_banner-ib <?php echo $full_class; ?> wfe_elementor_banner-min-height">
				<?php if( isset(  $settings['wfe_elementor_banner_image']['url'] ) &&  $settings['wfe_elementor_banner_image']['url'] != '' ): ?>
                    <img class="wfe_elementor_banner-ib-img" alt="null" src="<?php echo $settings['wfe_elementor_banner_image']['url']; ?>">
				<?php endif; ?>
                <div class="wfe_elementor_banner-ib-desc" style="">
					<?php echo $full_title; ?>
                    <div class="wfe_elementor_banner-ib-content wfe_elementor_banner_content">
                        <div <?php echo $this->get_render_attribute_string('wfe_elementor_banner_description'); ?>><?php echo $settings[ 'wfe_elementor_banner_description' ]; ?></div>
                    </div>
                </div>
				<?php
				if( $settings['wfe_elementor_banner_link_url_switch'] == 'yes' && (!empty( $settings['wfe_elementor_banner_image_custom_link']['url'] ) || !empty($settings['wfe_elementor_banner_image_existing_page_link'] )) ) {
					echo $full_link;
				}
				?>
            </div>
			<?php if($settings['wfe_elementor_banner_responsive_switcher'] == 'yes') : ?>
                <style>
                    @media(min-width: <?php echo $min_size; ?> ) and (max-width:<?php echo $max_size; ?>){
                        #wfe_elementor_banner-<?php echo esc_attr($this->get_id()); ?> .wfe_elementor_banner-ib-content {
                            display: none;
                        }
                    }
                </style>
			<?php endif; ?>

        </div>
		<?php $output = ob_get_clean();
		echo $output;
	}

	protected function content_template() {

		?>


		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Wfe_banner() );