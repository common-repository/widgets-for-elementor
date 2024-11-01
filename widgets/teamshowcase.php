<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_teamshowcase extends Widget_Base {

	public function get_name() {
		return 'wfe-teamshowcase';
	}

	public function get_title() {
		return __( 'Team Showcase', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-person wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {


		$this->start_controls_section(
			'wfe_section_team_member_image',
			[
				'label' => esc_html__( 'Team Member Image', 'wfe_elementor' )
			]
		);


		$this->add_control(
			'wfe_team_member_image',
			[
				'label' => __( 'Team Member Avatar', 'wfe_elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);


		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'wfe_team_member_image[url]!' => '',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'wfe_section_team_member_content',
			[
				'label' => esc_html__( 'Team Member Content', 'wfe_elementor' )
			]
		);


		$this->add_control(
			'wfe_team_member_name',
			[
				'label' => esc_html__( 'Name', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'John Doe', 'wfe_elementor' ),
			]
		);

		$this->add_control(
			'wfe_team_member_job_title',
			[
				'label' => esc_html__( 'Job Position', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Software Engineer', 'wfe_elementor' ),
			]
		);

		$this->add_control(
			'wfe_team_member_description',
			[
				'label' => esc_html__( 'Description', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Add team member description here. Remove the text if not necessary.', 'wfe_elementor' ),
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'wfe_section_team_member_social_profiles',
			[
				'label' => esc_html__( 'Social Profiles', 'wfe_elementor' )
			]
		);

		$this->add_control(
			'wfe_team_member_enable_social_profiles',
			[
				'label' => esc_html__( 'Display Social Profiles?', 'wfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);


		$this->add_control(
			'wfe_team_member_social_profile_links',
			[
				'type' => Controls_Manager::REPEATER,
				'condition' => [
					'wfe_team_member_enable_social_profiles!' => '',
				],
				'default' => [
					[
						'social' => 'fa fa-facebook',
					],
					[
						'social' => 'fa fa-twitter',
					],
					[
						'social' => 'fa fa-google-plus',
					],
					[
						'social' => 'fa fa-linkedin',
					],
				],
				'fields' => [
					[
						'name' => 'social',
						'label' => esc_html__( 'Icon', 'wfe_elementor' ),
						'type' => Controls_Manager::ICON,
						'label_block' => true,
						'default' => 'fa fa-wordpress',
						'include' => [
							'fa fa-apple',
							'fa fa-behance',
							'fa fa-bitbucket',
							'fa fa-codepen',
							'fa fa-delicious',
							'fa fa-digg',
							'fa fa-dribbble',
							'fa fa-envelope',
							'fa fa-facebook',
							'fa fa-flickr',
							'fa fa-foursquare',
							'fa fa-github',
							'fa fa-google-plus',
							'fa fa-houzz',
							'fa fa-instagram',
							'fa fa-jsfiddle',
							'fa fa-linkedin',
							'fa fa-medium',
							'fa fa-pinterest',
							'fa fa-product-hunt',
							'fa fa-reddit',
							'fa fa-shopping-cart',
							'fa fa-slideshare',
							'fa fa-snapchat',
							'fa fa-soundcloud',
							'fa fa-spotify',
							'fa fa-stack-overflow',
							'fa fa-tripadvisor',
							'fa fa-tumblr',
							'fa fa-twitch',
							'fa fa-twitter',
							'fa fa-vimeo',
							'fa fa-vk',
							'fa fa-whatsapp',
							'fa fa-wordpress',
							'fa fa-xing',
							'fa fa-yelp',
							'fa fa-youtube',
						],
					],
					[
						'name' => 'link',
						'label' => esc_html__( 'Link', 'wfe_elementor' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'default' => [
							'url' => '',
							'is_external' => 'true',
						],
						'placeholder' => esc_html__( 'Place URL here', 'wfe_elementor' ),
					],
				],
				'title_field' => '<i class="{{ social }}"></i> {{{ social.replace( \'fa fa-\', \'\' ).replace( \'-\', \' \' ).replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}}',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'wfe_section_team_showcase_styles_general',
			[
				'label' => esc_html__( 'Team Member Styles', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_control(
			'wfe_team_showcase_preset',
			[
				'label' => esc_html__( 'Style Preset', 'wfe_elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'wfe-team-showcases-simple',
				'options' => [
					'wfe-team-showcases-simple' 		=> esc_html__( 'Simple Style', 		'wfe_elementor' ),
					'wfe-team-showcases-overlay' 	=> esc_html__( 'Overlay Style', 	'wfe_elementor' ),
					'wfe-team-showcases-centered' 	=> esc_html__( 'Centered Style', 	'wfe_elementor' ),
					'wfe-team-showcases-circle' 		=> esc_html__( 'Circle Style', 	'wfe_elementor' ),
					'wfe-team-showcases-social-bottom' => esc_html__( 'Social on Bottom', 	'wfe_elementor' ),
				],
			]
		);

		$this->add_control(
			'wfe_team_showcase_overlay_background',
			[
				'label' => esc_html__( 'Overlay Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(255,255,255,0.8)',
				'selectors' => [
					'{{WRAPPER}} .wfe-team-showcases-overlay .wfe-team-content' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'wfe_team_showcase_preset' => 'wfe-team-showcases-overlay',
				],
			]
		);

		$this->add_control(
			'wfe_team_showcase_background',
			[
				'label' => esc_html__( 'Content Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-team-item .wfe-team-content' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wfe_team_showcase_alignment',
			[
				'label' => esc_html__( 'Set Alignment', 'wfe_elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'default' => [
						'title' => __( 'Default', 'wfe_elementor' ),
						'icon' => 'fa fa-ban',
					],
					'left' => [
						'title' => esc_html__( 'Left', 'wfe_elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'centered' => [
						'title' => esc_html__( 'Center', 'wfe_elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'wfe_elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'wfe-team-align-default',
				'prefix_class' => 'wfe-team-align-',
			]
		);

		$this->add_responsive_control(
			'wfe_team_showcase_padding',
			[
				'label' => esc_html__( 'Content Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-team-item .wfe-team-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wfe_team_showcase_border',
				'label' => esc_html__( 'Border', 'wfe_elementor' ),
				'selector' => '{{WRAPPER}} .wfe-team-item',
			]
		);

		$this->add_control(
			'wfe_team_showcase_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .wfe-team-item' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'wfe_section_team_showcase_image_styles',
			[
				'label' => esc_html__( 'Team Member Image Style', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'wfe_team_showcase_image_width',
			[
				'label' => esc_html__( 'Image Width', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '100',
					'unit' => '%',
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
					'{{WRAPPER}} .wfe-team-item figure img' => 'width:{{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'wfe_team_showcase_preset!' => 'wfe-team-showcases-circle'
				]
			]
		);

		$this->add_responsive_control(
			'wfe_team_showcase_circle_image_width',
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
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-team-item.wfe-team-showcases-circle figure img' => 'width:{{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'wfe_team_showcase_preset' => 'wfe-team-showcases-circle'
				]
			]
		);

		$this->add_responsive_control(
			'wfe_team_showcase_circle_image_height',
			[
				'label' => esc_html__( 'Image Height', 'wfe_elementor' ),
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
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-team-item.wfe-team-showcases-circle figure img' => 'height:{{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'wfe_team_showcase_preset' => 'wfe-team-showcases-circle'
				]
			]
		);


		$this->add_responsive_control(
			'wfe_team_showcase_image_margin',
			[
				'label' => esc_html__( 'Margin', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-team-item figure img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'wfe_team_showcase_image_padding',
			[
				'label' => esc_html__( 'Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-team-item figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wfe_team_showcase_image_border',
				'label' => esc_html__( 'Border', 'wfe_elementor' ),
				'selector' => '{{WRAPPER}} .wfe-team-item figure img',
			]
		);

		$this->add_control(
			'wfe_team_showcase_image_rounded',
			[
				'label' => esc_html__( 'Rounded Avatar?', 'wfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'team-avatar-rounded',
				'default' => '',
			]
		);


		$this->add_control(
			'wfe_team_showcase_image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .wfe-team-item figure img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'condition' => [
					'wfe_team_showcase_image_rounded!' => 'team-avatar-rounded',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'wfe_section_team_showcase_typography',
			[
				'label' => esc_html__( 'Color &amp; Typography', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'wfe_team_showcase_name_heading',
			[
				'label' => __( 'Member Name', 'wfe_elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'wfe_team_showcase_name_color',
			[
				'label' => esc_html__( 'Member Name Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#272727',
				'selectors' => [
					'{{WRAPPER}} .wfe-team-item .wfe-team-showcase-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_team_showcase_name_typography',
				'selector' => '{{WRAPPER}} .wfe-team-item .wfe-team-showcase-name',
			]
		);

		$this->add_control(
			'wfe_team_showcase_position_heading',
			[
				'label' => __( 'Member Job Position', 'wfe_elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'wfe_team_showcase_position_color',
			[
				'label' => esc_html__( 'Job Position Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#272727',
				'selectors' => [
					'{{WRAPPER}} .wfe-team-item .wfe-team-showcase-position' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_team_showcase_position_typography',
				'selector' => '{{WRAPPER}} .wfe-team-item .wfe-team-showcase-position',
			]
		);

		$this->add_control(
			'wfe_team_showcase_description_heading',
			[
				'label' => __( 'Member Description', 'wfe_elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'wfe_team_showcase_description_color',
			[
				'label' => esc_html__( 'Description Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#272727',
				'selectors' => [
					'{{WRAPPER}} .wfe-team-item .wfe-team-content .wfe-team-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_team_showcase_description_typography',
				'selector' => '{{WRAPPER}} .wfe-team-item .wfe-team-content .wfe-team-text',
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'wfe_section_team_showcase_social_profiles_styles',
			[
				'label' => esc_html__( 'Social Profiles Style', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_control(
			'wfe_team_showcase_social_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					//'unit' => '%',
					'size' => 22,
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-team-showcase-social-link > a > i' => ' font-size: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'wfe_team_showcase_social_icon_width',
			[
				'label' => esc_html__( 'Icon Width', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					//'unit' => '%',
					'size' => 25,
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-team-showcase-social-link > a' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'wfe_team_showcase_social_profiles_padding',
			[
				'label' => esc_html__( 'Social Profiles Spacing', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-team-content > .wfe-team-showcase-social-profiles' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs( 'wfe_team_showcase_social_icons_style_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'wfe_elementor' ) ] );

		$this->add_control(
			'wfe_team_showcase_social_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#3e6499',
				'selectors' => [
					'{{WRAPPER}} .wfe-team-showcase-social-link > a' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'wfe_team_showcase_social_icon_background',
			[
				'label' => esc_html__( 'Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-team-showcase-social-link > a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wfe_team_showcase_social_icon_border',
				'selector' => '{{WRAPPER}} .wfe-team-showcase-social-link > a',
			]
		);

		$this->add_control(
			'wfe_team_showcase_social_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-team-showcase-social-link > a' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_team_showcase_social_icon_typography',
				'selector' => '{{WRAPPER}} .wfe-team-showcase-social-link > a',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab( 'wfe_team_showcase_social_icon_hover', [ 'label' => esc_html__( 'Hover', 'wfe_elementor' ) ] );

		$this->add_control(
			'wfe_team_showcase_social_icon_hover_color',
			[
				'label' => esc_html__( 'Icon Hover Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ad8647',
				'selectors' => [
					'{{WRAPPER}} .wfe-team-showcase-social-link > a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wfe_team_showcase_social_icon_hover_background',
			[
				'label' => esc_html__( 'Hover Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-team-showcase-social-link > a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wfe_team_showcase_social_icon_hover_border_color',
			[
				'label' => esc_html__( 'Hover Border Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-team-showcase-social-link > a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();


	}


	protected function render( ) {

		$settings = $this->get_settings();
		$team_member_image = $this->get_settings( 'wfe_team_member_image' );
		$team_member_image_url = Group_Control_Image_Size::get_attachment_image_src( $team_member_image['id'], 'thumbnail', $settings );
		if( empty( $team_member_image_url ) ) : $team_member_image_url = $team_member_image['url']; else: $team_member_image_url = $team_member_image_url; endif;
		$team_member_classes = $this->get_settings('wfe_team_showcase_preset') . " " . $this->get_settings('wfe_team_showcase_image_rounded');

		?>


        <div id="wfe-team-showcase-<?php echo esc_attr($this->get_id()); ?>" class="wfe-team-item <?php echo $team_member_classes; ?>">
            <div class="wfe-team-item-inner">
                <div class="wfe-team-image">
                    <figure>
                        <img src="<?php echo esc_url($team_member_image_url);?>" alt="<?php echo $settings['wfe_team_member_name'];?>">
                    </figure>
                </div>

                <div class="wfe-team-content">
                    <h3 class="wfe-team-showcase-name"><?php echo $settings['wfe_team_member_name']; ?></h3>
                    <h4 class="wfe-team-showcase-position"><?php echo $settings['wfe_team_member_job_title']; ?></h4>
					<?php if( 'wfe-team-showcases-social-bottom' === $settings['wfe_team_showcase_preset'] ) : ?>
                        <p class="wfe-team-text"><?php echo $settings['wfe_team_member_description']; ?></p>
						<?php if ( ! empty( $settings['wfe_team_member_enable_social_profiles'] ) ): ?>
                            <ul class="wfe-team-showcase-social-profiles">
								<?php foreach ( $settings['wfe_team_member_social_profile_links'] as $item ) : ?>
									<?php if ( ! empty( $item['social'] ) ) : ?>
										<?php $target = $item['link']['is_external'] ? ' target="_blank"' : ''; ?>
                                        <li class="wfe-team-showcase-social-link" id="wfe-team-showcase-social-link">
                                            <a href="<?php echo esc_attr( $item['link']['url'] ); ?>"<?php echo $target; ?>><i class="<?php echo esc_attr($item['social'] ); ?>"></i></a>
                                        </li>
									<?php endif; ?>
								<?php endforeach; ?>
                            </ul>
						<?php endif; ?>
					<?php else: ?>
						<?php if ( ! empty( $settings['wfe_team_member_enable_social_profiles'] ) ): ?>
                            <ul class="wfe-team-showcase-social-profiles">
								<?php foreach ( $settings['wfe_team_member_social_profile_links'] as $item ) : ?>
									<?php if ( ! empty( $item['social'] ) ) : ?>
										<?php $target = $item['link']['is_external'] ? ' target="_blank"' : ''; ?>
                                        <li class="wfe-team-showcase-social-link" id="wfe-team-showcase-social-link">
                                            <a href="<?php echo esc_attr( $item['link']['url'] ); ?>"<?php echo $target; ?>><i class="<?php echo esc_attr($item['social'] ); ?>"></i></a>
                                        </li>
									<?php endif; ?>
								<?php endforeach; ?>
                            </ul>
						<?php endif; ?>
                        <p class="wfe-team-text"><?php echo $settings['wfe_team_member_description']; ?></p>
					<?php endif; ?>

                </div>
            </div>
        </div>


		<?php

	}

	protected function content_template() {

		?>


		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Wfe_teamshowcase() );