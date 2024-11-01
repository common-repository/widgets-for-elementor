<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_moderntestimonial extends Widget_Base {

	public function get_name() {
		return 'wfe-moderntestimonial';
	}

	public function get_title() {
		return __( 'Modern Testimonial', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-comments wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {
		/*Testimonials Content Section */
		$this->start_controls_section('modern_testimonial_person_settings',
			[
				'label'             => esc_html__('Author', 'wfe_elementor'),
			]
		);

		/*Person Image*/
		$this->add_control('modern_testimonial_person_image',
			[
				'label'             => esc_html__('Image','wfe_elementor'),
				'type'              => Controls_Manager::MEDIA,
				'default'           => [
					'url' => plugin_dir_url( dirname( __FILE__,1 ) ). 'assets/img/image_person.jpg',
				],
				'description'       => esc_html__( 'Choose an image for the author', 'wfe_elementor' ),
				'show_label'        => true,
			]
		);

		/*Person Image Shape*/
		$this->add_control('modern_testimonial_person_image_shape',
			[
				'label'             => esc_html__('Image Style', 'wfe_elementor'),
				'type'              => Controls_Manager::SELECT,
				'description'       => esc_html__( 'Choose image style', 'wfe_elementor' ),
				'options'           => [
					'square'  => esc_html__('Square'),
					'circle'  => esc_html__('Circle'),
					'rounded' => esc_html__('Rounded'),
				],
				'default'           => 'circle',
			]
		);

		/*Person Name*/
		$this->add_control('modern_testimonial_person_name',
			[
				'label'             => esc_html__('Name', 'wfe_elementor'),
				'type'              => Controls_Manager::TEXT,
				'dynamic'           => [ 'active' => true ],
				'default'           => esc_html__('Person Name', 'wfe_elementor'),
				'description'       => esc_html__( 'Enter author name', 'wfe_elementor' ),
				'label_block'       => true
			]
		);

		/*Name Title Tag*/
		$this->add_control('modern_testimonial_person_name_size',
			[
				'label'             => esc_html__('HTML Tag', 'wfe_elementor'),
				'type'              => Controls_Manager::SELECT,
				'description'       => esc_html__( 'Select a heading tag for author name', 'wfe_elementor' ),
				'options'       => [
					'h1'    => 'H1',
					'h2'    => 'H2',
					'h3'    => 'H3',
					'h4'    => 'H4',
					'h5'    => 'H5',
					'h6'    => 'H6',
				],
				'default'           => 'h3',
				'label_block'       => true,
			]
		);

		/*End Person Content Section*/
		$this->end_controls_section();

		/*Start Company Content Section*/
		$this->start_controls_section('modern_testimonial_company_settings',
			[
				'label'             => esc_html__('Company', 'wfe_elementor')
			]
		);

		/*Company Name*/
		$this->add_control('modern_testimonial_company_name',
			[
				'label'             => esc_html__('Name', 'wfe_elementor'),
				'type'              => Controls_Manager::TEXT,
				'dynamic'           => [ 'active' => true ],
				'default'           => esc_html__('Company Name','wfe_elementor'),
				'description'       => esc_html__( 'Enter company name', 'wfe_elementor' ),
				'label_block'       => true,
			]
		);

		/*Company Name Tag*/
		$this->add_control('modern_testimonial_company_name_size',
			[
				'label'             => esc_html__('HTML Tag', 'wfe_elementor'),
				'type'              => Controls_Manager::SELECT,
				'description'       => esc_html__( 'Select a heading tag for company name', 'wfe_elementor' ),
				'options'           => [
					'h1' => esc_html('H1'),
					'h2' => esc_html('H2'),
					'h3' => esc_html('H3'),
					'h4' => esc_html('H4'),
					'h5' => esc_html('H5'),
					'h6' => esc_html('H6'),
				],
				'default'           => 'h4',
				'label_block'       => true,
			]
		);

		$this->add_control('modern_testimonial_company_link_switcher',
			[
				'label'         => esc_html__('Link', 'wfe_elementor'),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		/*Company Link */
		$this->add_control('modern_testimonial_company_link',
			[
				'label'             => esc_html__('Link', 'wfe_elementor'),
				'type'              => Controls_Manager::TEXT,
				'description'       => esc_html__( 'Add company URL', 'wfe_elementor' ),
				'label_block'       => true,
				'condition'         => [
					'modern_testimonial_company_link_switcher' => 'yes'
				]
			]
		);

		/*Link Target*/
		$this->add_control('modern_testimonial_link_target',
			[
				'label'             => esc_html__('Link Target', 'wfe_elementor'),
				'type'              => Controls_Manager::SELECT,
				'description'       => esc_html__( 'Select link target', 'wfe_elementor' ),
				'options'           => [
					'blank'  => esc_html__('Blank'),
					'parent' => esc_html__('Parent'),
					'self'   => esc_html__('Self'),
					'top'    => esc_html__('Top'),
				],
				'default'           => esc_html__('blank','wfe_elementor'),
				'condition'         => [
					'modern_testimonial_company_link_switcher' => 'yes'
				]
			]
		);

		/*End Company Content Section*/
		$this->end_controls_section();

		/*Start Testimonial Content Section*/
		$this->start_controls_section('modern_testimonial_settings',
			[
				'label'                 => esc_html__('Content', 'wfe_elementor'),
			]
		);

		/*Testimonial Content*/
		$this->add_control('modern_testimonial_content',
			[
				'label'             => esc_html__('Testimonial Content', 'wfe_elementor'),
				'type'              => Controls_Manager::WYSIWYG,
				'dynamic'           => [ 'active' => true ],
				'default'           => esc_html__('Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cras mattis consectetur purus sit amet fermentum. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec id elit non mi porta gravida at eget metus.','premium-elementor'),
				'label_block'       => true,
			]
		);

		/*End Testimonial Content Section*/
		$this->end_controls_section();


		/*Image Styling*/
		$this->start_controls_section('modern_testimonial_image_style',
			[
				'label'             => esc_html__('Image', 'wfe_elementor'),
				'tab'               => Controls_Manager::TAB_STYLE,
			]
		);

		/*Image Size*/
		$this->add_control('modern_testimonial_img_size',
			[
				'label'             => esc_html__('Size', 'wfe_elementor'),
				'type'              => Controls_Manager::SLIDER,
				'size_units'        => ['px', 'em'],
				'default'           => [
					'unit'  =>  'px',
					'size'  =>  110,
				],
				'range'             => [
					'px'=> [
						'min' => 10,
						'max' => 150,
					]
				],
				'selectors'         => [
					'{{WRAPPER}} .wfe-modern-testimonial-img-wrapper'=> 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				]
			]
		);

		/*Image Border Width*/
		$this->add_control('modern_testimonial_img_border_width',
			[
				'label'             => esc_html__('Border Width (PX)', 'wfe_elementor'),
				'type'              => Controls_Manager::SLIDER,
				'default'           => [
					'unit'  => 'px',
					'size'  =>  2,
				],
				'range'             => [
					'px'=> [
						'min' => 0,
						'max' => 15,
					]
				],
				'selectors'         => [
					'{{WRAPPER}} .wfe-modern-testimonial-person-image' => 'border-width: {{SIZE}}{{UNIT}};',
				]
			]
		);

		/*Image Border Color*/
		$this->add_control('modern_testimonial_image_border_color',
			[
				'label'                 => esc_html__('Color', 'wfe_elementor'),
				'type'                  => Controls_Manager::COLOR,
				'scheme'            => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors'            => [
					'{{WRAPPER}} .wfe-modern-testimonial-img-wrapper' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

		/*Start Person Settings Section*/
		$this->start_controls_section('modern_testimonials_person_style',
			[
				'label'                 => esc_html__('Author', 'wfe_elementor'),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		/*Person Name Color*/
		$this->add_control('modern_testimonial_person_name_color',
			[
				'label'             => esc_html__('Color', 'wfe_elementor'),
				'type'              => Controls_Manager::COLOR,
				'scheme'            => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors'         => [
					'{{WRAPPER}} .wfe-modern-testimonial-person-name' => 'color: {{VALUE}};',
				]
			]
		);

		/*Authohr Name Typography*/
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'author_name_typography',
				'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
				'selector'      => '{{WRAPPER}} .wfe-modern-testimonial-person-name',
			]
		);

		/*Separator Color*/
		$this->add_control('modern_testimonial_separator_color',
			[
				'label'             => esc_html__('Divider Color', 'wfe_elementor'),
				'type'              => Controls_Manager::COLOR,
				'scheme'            => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors'         => [
					'{{WRAPPER}} .wfe-modern-testimonial-separator' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

		/*Start Company Settings Section*/
		$this->start_controls_section('modern_testimonial_company_style',
			[
				'label'             => esc_html__('Company', 'wfe_elementor'),
				'tab'               => Controls_Manager::TAB_STYLE,
			]
		);

		/*Company Name Color*/
		$this->add_control('modern_testimonial_company_name_color',
			[
				'label'             => esc_html__('Color', 'wfe_elementor'),
				'type'              => Controls_Manager::COLOR,
				'scheme'            => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors'         => [
					'{{WRAPPER}} .wfe-modern-testimonial-company-link' => 'color: {{VALUE}};',
				]
			]
		);

		/*Company Typography*/
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'company_name_typography',
				'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
				'selector'      => '{{WRAPPER}} .wfe-modern-testimonial-company-link',
			]
		);

		/*End Color Section*/
		$this->end_controls_section();

		/*Start Content Settings Section*/
		$this->start_controls_section('modern_testimonial_content_style',
			[
				'label'             => esc_html__('Content', 'wfe_elementor'),
				'tab'               => Controls_Manager::TAB_STYLE,
			]
		);

		/*Content Color*/
		$this->add_control('modern_testimonial_content_color',
			[
				'label'             => esc_html__('Color', 'wfe_elementor'),
				'type'              => Controls_Manager::COLOR,
				'scheme'            => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors'         => [
					'{{WRAPPER}} .wfe-modern-testimonial-text-wrapper' => 'color: {{VALUE}};',
				]
			]
		);

		/*Content Typography*/
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'content_typography',
				'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
				'selector'      => '{{WRAPPER}} .wfe-modern-testimonial-text-wrapper',
			]
		);


		/*Testimonial Text Margin*/
		$this->add_responsive_control('modern_testimonial_margin',
			[
				'label'                 => esc_html__('Margin', 'wfe_elementor'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'default'               =>[
					'top'   =>  15,
					'bottom'=>  15,
					'left'  =>  0 ,
					'right' =>  0 ,
					'unit'  => 'px',
				],
				'selectors'             => [
					'{{WRAPPER}} .wfe-modern-testimonial-text-wrapper' => 'margin: {{top}}{{UNIT}} {{right}}{{UNIT}} {{bottom}}{{UNIT}} {{left}}{{UNIT}};',
				]
			]
		);

		/*End Content Settings Section*/
		$this->end_controls_section();

		/*Start Quotes Style Section*/
		$this->start_controls_section('modern_testimonial_quotes',
			[
				'label'             => esc_html__('Quotation Icon', 'wfe_elementor'),
				'tab'               => Controls_Manager::TAB_STYLE,
			]
		);

		/*Quotes Color*/
		$this->add_control('modern_testimonial_quote_icon_color',
			[
				'label'              => esc_html__('Color','wfe_elementor'),
				'type'               => Controls_Manager::COLOR,
				'default'            => 'rgba(110,193,228,0.2)',
				'selectors'         =>  [
					'{{WRAPPER}} .fa'   =>  'color: {{VALUE}};',
				]
			]
		);

		/*Quotes Size*/
		$this->add_control('modern_testimonial_quotes_size',
			[
				'label'             => esc_html__('Size', 'wfe_elementor'),
				'type'              => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'default'           => [
					'unit'  => 'px',
					'size'  => 120,
				],
				'range'             => [
					'px' => [
						'min' => 5,
						'max' => 250,
					]
				],
				'selectors'         => [
					'{{WRAPPER}} .wfe-modern-testimonial-upper-quote, {{WRAPPER}} .wfe-modern-testimonial-lower-quote' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);

		/*Upper Quote Position*/
		$this->add_responsive_control('modern_testimonial_upper_quote_position',
			[
				'label'             => esc_html__('Top Icon Position', 'wfe_elementor'),
				'type'              => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'default'           =>[
					'top'   =>  70,
					'left'  =>  12 ,
					'unit'  =>  'px',
				],
				'selectors'         => [
					'{{WRAPPER}} .wfe-modern-testimonial-upper-quote' => 'top: {{TOP}}{{UNIT}}; left:{{LEFT}}{{UNIT}};',
				]
			]
		);

		/*Lower Quote Position*/
		$this->add_responsive_control('modern_testimonial_lower_quote_position',
			[
				'label'             => esc_html__('Bottom Icon Position', 'wfe_elementor'),
				'type'              => Controls_Manager::DIMENSIONS,
				'size_units'        => ['px', 'em', '%'],
				'default'           =>[
					'bottom'    =>  3,
					'right'     =>  12,
					'unit'      =>  'px',
				],
				'selectors'         => [
					'{{WRAPPER}} .wfe-modern-testimonial-lower-quote' => 'right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}};',
				]
			]
		);

		/*End Typography Section*/
		$this->end_controls_section();

	}

	protected function render($instance = [])
	{
		// get our input from the widget settings.
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes('modern_testimonial_person_name');
		$this->add_inline_editing_attributes('modern_testimonial_company_name');
		$this->add_inline_editing_attributes('modern_testimonial_content', 'advanced');
		$person_title_tag = $settings['modern_testimonial_person_name_size'];

		$company_title_tag = $settings['modern_testimonial_company_name_size'];

		if(!empty($settings['modern_testimonial_person_image']['url'])) {
			$image_src = $settings['modern_testimonial_person_image']['url'];
		} else {
			$image_src = PREMIUM_ADDONS_URL. 'assets/images/person-image.jpg';
		}

		?>

        <!-- Testimonial Box Wrapper -->
        <div class="wfe-modern-testimonial-Box">
            <div class="wfe-modern-testimonial-container">
                <i class="fa fa-quote-left wfe-modern-testimonial-upper-quote"></i>
                <!-- Testimonial Body Wrapper -->
                <div class="wfe-modern-testimonial-content-wrapper">
                    <!-- Image Wrapper -->
                    <div class="wfe-modern-testimonial-img-wrapper" style="border-radius: <?php
					if( $settings['modern_testimonial_person_image_shape'] === 'circle' ) : echo "50%;";
                    elseif ( $settings['modern_testimonial_person_image_shape'] === 'square' ) : echo "0;";
                    elseif ( $settings['modern_testimonial_person_image_shape'] === 'rounded' ) : echo "15px;";
					endif;?>">
                        <img src="<?php echo $image_src; ?>" alt="premium-image" class="wfe-modern-testimonial-person-image"
                             style="border-radius: <?php
						     if ( $settings['modern_testimonial_person_image_shape'] === 'circle' ) : echo "50%;";
                             elseif ( $settings['modern_testimonial_person_image_shape'] === 'square' ) : echo "0;";
                             elseif ( $settings['modern_testimonial_person_image_shape'] === 'rounded' ) : echo "15px;";
						     endif; ?>">
                    </div>

                    <!-- Testimonial Text Wrapper -->
                    <div class="wfe-modern-testimonial-text-wrapper">
                        <div <?php echo $this->get_render_attribute_string('modern_testimonial_content'); ?>><?php echo $settings['modern_testimonial_content']; ?></div>
                    </div>

                    <!-- Person Name & Separator & Company Name-->
                    <span class="wfe-modern-testimonial-author-info">
                <<?php echo $person_title_tag; ?> class="wfe-modern-testimonial-person-name"><span <?php echo $this->get_render_attribute_string('modern_testimonial_person_name'); ?>><?php echo $settings['modern_testimonial_person_name']; ?></span></<?php echo $person_title_tag; ?>><span class="wfe-modern-testimonial-separator"> - </span>

                    <<?php echo $company_title_tag; ?> class="wfe-modern-testimonial-company-name"><?php if($settings['modern_testimonial_company_link_switcher'] == 'yes') : ?><a class="wfe-modern-testimonial-company-link" href="<?php echo $settings['modern_testimonial_company_link']; ?>" target="_<?php echo $settings['modern_testimonial_link_target']; ?>"><span <?php echo $this->get_render_attribute_string('modern_testimonial_company_name'); ?>><?php echo $settings['modern_testimonial_company_name']; ?></span></a><?php else: ?><span class="wfe-modern-testimonial-company-link" <?php echo $this->get_render_attribute_string('modern_testimonial_company_name'); ?>><?php echo $settings['modern_testimonial_company_name']; ?></span><?php endif;?></<?php echo $company_title_tag; ?>>


                </span>
            </div>

            <i class="fa fa-quote-right wfe-modern-testimonial-lower-quote"></i>
        </div>
        </div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Wfe_moderntestimonial() );