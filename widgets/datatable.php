<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_datatable extends Widget_Base {

	public function get_name() {
		return 'wfe-datatable';
	}

	public function get_title() {
		return __( 'Data Table', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-table wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {

		/**
		 * Data Table Header
		 */
		$this->start_controls_section(
			'wfe_section_data_table_header',
			[
				'label' => esc_html__( 'Header', 'wfe_elementor' )
			]
		);

		$this->add_control(
			'wfe_section_data_table_enabled',
			[
				'label' => __( 'Enable Table Sorting', 'wfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'true',
				'label_on' => esc_html__( 'Yes', 'wfe_elementor' ),
				'label_off' => esc_html__( 'No', 'wfe_elementor' ),
				'return_value' => 'true',
			]
		);

		$this->add_control(
			'wfe_data_table_header_cols_data',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'wfe_data_table_header_col' => 'Table Header' ],
					[ 'wfe_data_table_header_col' => 'Table Header' ],
					[ 'wfe_data_table_header_col' => 'Table Header' ],
					[ 'wfe_data_table_header_col' => 'Table Header' ],
				],
				'fields' => [
					[
						'name' => 'wfe_data_table_header_col',
						'label' => esc_html__( 'Column Name', 'wfe_elementor' ),
						'default' => 'Table Header',
						'type' => Controls_Manager::TEXT,
						'label_block' => false,
					],
					[
						'name' => 'wfe_data_table_header_col_icon_enabled',
						'label' => esc_html__( 'Enable Header Icon', 'wfe_elementor' ),
						'type' => Controls_Manager::SWITCHER,
						'label_on' => __( 'yes', 'wfe_elementor' ),
						'label_off' => __( 'no', 'wfe_elementor' ),
						'default' => 'false',
						'return_value' => 'true',
					],
					[
						'name' => 'wfe_data_table_header_col_icon',
						'label' => esc_html__( 'Icon', 'wfe_elementor' ),
						'type' => Controls_Manager::ICON,
						'default' => '',
						'condition' => [
							'wfe_data_table_header_col_icon_enabled' => 'true'
						]
					],
					[
						'name' => 'wfe_data_table_header_col_img_enabled',
						'label' => esc_html__( 'Enable Header Image', 'wfe_elementor' ),
						'type' => Controls_Manager::SWITCHER,
						'label_on' => __( 'yes', 'wfe_elementor' ),
						'label_off' => __( 'no', 'wfe_elementor' ),
						'default' => 'false',
						'return_value' => 'true',
					],
					[
						'name' => 'wfe_data_table_header_col_img',
						'label' => esc_html__( 'Image', 'wfe_elementor' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'condition' => [
							'wfe_data_table_header_col_img_enabled' => 'true',
						]
					],
					[
						'name' => 'wfe_data_table_header_col_img_size',
						'label' => esc_html__( 'Image Size(px)', 'wfe_elementor' ),
						'default' => '25',
						'type' => Controls_Manager::TEXT,
						'label_block' => false,
						'condition' => [
							'wfe_data_table_header_col_img_enabled' => 'true',
						]
					],

				],
				'title_field' => '{{wfe_data_table_header_col}}',
			]
		);

		$this->end_controls_section();

		/**
		 * Data Table Content
		 */
		$this->start_controls_section(
			'wfe_section_data_table_cotnent',
			[
				'label' => esc_html__( 'Content', 'wfe_elementor' )
			]
		);

		$this->add_control(
			'wfe_data_table_content_rows',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'wfe_data_table_content_row_type' => 'row' ],
					[ 'wfe_data_table_content_row_type' => 'col' ],
					[ 'wfe_data_table_content_row_type' => 'col' ],
					[ 'wfe_data_table_content_row_type' => 'col' ],
					[ 'wfe_data_table_content_row_type' => 'col' ],
				],
				'fields' => [
					[
						'name' => 'wfe_data_table_content_row_type',
						'label' => esc_html__( 'Row Type', 'wfe_elementor' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'row',
						'label_block' => false,
						'options' => [
							'row' => esc_html__( 'Row', 'wfe_elementor' ),
							'col' => esc_html__( 'Column', 'wfe_elementor' ),
						]
					],
					[
						'name' => 'wfe_data_table_content_row_title',
						'label' => esc_html__( 'Cell Text', 'wfe_elementor' ),
						'type' => Controls_Manager::TEXTAREA,
						'label_block' => false,
						'default' => esc_html__( 'Content', 'wfe_elementor' ),
						'condition' => [
							'wfe_data_table_content_row_type' => 'col'
						]
					],
					[
						'name' => 'wfe_data_table_content_row_title_link',
						'label' => esc_html__( 'Link', 'wfe_elementor' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'default' => [
							'url' => '',
							'is_external' => '',
						],
						'show_external' => true,
						'separator' => 'before',
						'condition' => [
							'wfe_data_table_content_row_type' => 'col'
						]
					],
					[
						'name' => 'wfe_data_table_content_row_colspan',
						'label' => esc_html__( 'Colspan', 'wfe_elementor' ),
						'type' => Controls_Manager::NUMBER,
						'default' => 1,
						'min'     => 1,
						'condition' => [
							'wfe_data_table_content_row_type' => 'col'
						]
					]
				],
				'title_field' => '{{wfe_data_table_content_row_type}}::{{wfe_data_table_content_row_title}}',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Data Table Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wfe_section_data_table_style_settings',
			[
				'label' => esc_html__( 'General Style', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'wfe_data_table_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-data-table-wrap' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'wfe_data_table_container_padding',
			[
				'label' => esc_html__( 'Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-data-table-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'wfe_data_table_container_margin',
			[
				'label' => esc_html__( 'Margin', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-data-table-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wfe_data_table_border',
				'label' => esc_html__( 'Border', 'wfe_elementor' ),
				'selector' => '{{WRAPPER}} .wfe-data-table-wrap',
			]
		);

		$this->add_control(
			'wfe_data_table_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-data-table-wrap' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'wfe_data_table_th_padding',
			[
				'label' => esc_html__( 'Table Header Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-data-table thead tr th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'wfe_data_table_td_padding',
			[
				'label' => esc_html__( 'Table Data Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-data-table tbody tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wfe_data_table_shadow',
				'selector' => '{{WRAPPER}} .wfe-data-table-wrap',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Data Table Header Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wfe_section_data_table_title_style_settings',
			[
				'label' => esc_html__( 'Header Style', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_control(
			'wfe_section_data_table_header_radius',
			[
				'label' => esc_html__( 'Header Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 7,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-data-table thead tr th:first-child' => 'border-radius: {{SIZE}}px 0px 0px 0px;',
					'{{WRAPPER}} .wfe-data-table thead tr th:last-child' => 'border-radius: 0px {{SIZE}}px 0px 0px;',
				],
			]
		);

		$this->add_control(
			'wfe_data_table_header_title_color',
			[
				'label' => esc_html__( 'Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .wfe-data-table thead tr th' => 'color: {{VALUE}};',
					'{{WRAPPER}} table.dataTable thead .sorting:after' => 'color: {{VALUE}};',
					'{{WRAPPER}} table.dataTable thead .sorting_asc:after' => 'color: {{VALUE}};',
					'{{WRAPPER}} table.dataTable thead .sorting_desc:after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wfe_data_table_header_title_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4a4893',
				'selectors' => [
					'{{WRAPPER}} .wfe-data-table thead tr th' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_data_table_header_title_typography',
				'selector' => '{{WRAPPER}} .wfe-data-table thead tr th',
			]
		);

		$this->add_responsive_control(
			'wfe_data_table_header_title_alignment',
			[
				'label' => esc_html__( 'Title Alignment', 'wfe_elementor' ),
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
				'default' => 'left',
				'prefix_class' => 'wfe-dt-th-align-',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Data Table Content Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wfe_section_data_table_content_style_settings',
			[
				'label' => esc_html__( 'Content Style', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'wfe_data_table_content_color_odd',
			[
				'label' => esc_html__( 'Color ( Odd Row )', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#6d7882',
				'selectors' => [
					'{{WRAPPER}} .wfe-data-table tbody > tr:nth-child(2n) td' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wfe_data_table_content_bg_odd_color',
			[
				'label' => esc_html__( 'Background Color (Odd Row)', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-data-table tbody > tr:nth-child(2n) td' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wfe_data_table_content_color_even',
			[
				'label' => esc_html__( 'Color ( Even Row )', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#6d7882',
				'selectors' => [
					'{{WRAPPER}} .wfe-data-table tbody > tr:nth-child(2n+1) td' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wfe_data_table_content_bg_even_color',
			[
				'label' => esc_html__( 'Background Color (Even Row)', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-data-table tbody > tr:nth-child(2n+1) td' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_data_table_content_typography',
				'selector' => '{{WRAPPER}} .wfe-data-table tbody tr td',
			]
		);

		$this->add_control(
			'wfe_data_table_content_link_typo',
			[
				'label' => esc_html__( 'Link Color', 'wfe_elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		/* Table Content Link */
		$this->start_controls_tabs( 'wfe_data_table_link_tabs' );

		// Normal State Tab
		$this->start_controls_tab( 'wfe_data_table_link_normal', [ 'label' => esc_html__( 'Normal', 'wfe_elementor' ) ] );

		$this->add_control(
			'wfe_data_table_link_normal_text_color',
			[
				'label' => esc_html__( 'Text Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#c15959',
				'selectors' => [
					'{{WRAPPER}} .wfe-data-table-wrap table td a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		// Hover State Tab
		$this->start_controls_tab( 'wfe_data_table_link_hover', [ 'label' => esc_html__( 'Hover', 'wfe_elementor' ) ] );

		$this->add_control(
			'wfe_data_table_link_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#6d7882',
				'selectors' => [
					'{{WRAPPER}} .wfe-data-table-wrap table td a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'wfe_data_table_content_alignment',
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
				'default' => 'left',
				'prefix_class' => 'wfe-dt-td-align-',
			]
		);

		$this->end_controls_section();

	}


	protected function render( ) {

		$settings = $this->get_settings();

		$table_tr = [];
		$table_td = [];

		// Storing Data table content values
		foreach( $settings['wfe_data_table_content_rows'] as $content_row ) {

			$row_id = rand(10, 1000);
			if( $content_row['wfe_data_table_content_row_type'] == 'row' ) {
				$table_tr[] = [
					'id' => $row_id,
					'type' => $content_row['wfe_data_table_content_row_type'],
				];

			}
			if( $content_row['wfe_data_table_content_row_type'] == 'col' ) {
				$target = $content_row['wfe_data_table_content_row_title_link']['is_external'] ? 'target="_blank"' : '';
				$nofollow = $content_row['wfe_data_table_content_row_title_link']['nofollow'] ? 'rel="nofollow"' : '';

				$table_tr_keys = array_keys( $table_tr );
				$last_key = end( $table_tr_keys );

				$table_td[] = [
					'row_id' => $table_tr[$last_key]['id'],
					'type' => $content_row['wfe_data_table_content_row_type'],
					'title' => $content_row['wfe_data_table_content_row_title'],
					'link_url' => $content_row['wfe_data_table_content_row_title_link']['url'],
					'link_target' => $target,
					'nofollow' => $nofollow,
					'colspan' => $content_row['wfe_data_table_content_row_colspan']
				];
			}
		}

		$table_th_count = count($settings['wfe_data_table_header_cols_data']);
		?>
        <div class="wfe-data-table-wrap">
            <table id="wfe-data-table-<?php echo $this->get_id(); ?>" class="tablesorter wfe-data-table">
                <thead>
                <tr class="table-header">
					<?php foreach( $settings['wfe_data_table_header_cols_data'] as $header_title ) : ?>
                        <th class="sorting">
							<?php if( $header_title['wfe_data_table_header_col_icon_enabled'] == 'true' ) : ?>
                                <i class="data-header-icon <?php echo esc_attr( $header_title['wfe_data_table_header_col_icon'] ); ?>"></i>
							<?php endif; ?>
							<?php if( $header_title['wfe_data_table_header_col_img_enabled'] == 'true' ) : ?>
                                <img src="<?php echo esc_url( $header_title['wfe_data_table_header_col_img']['url'] ) ?>" class="wfe-data-table-th-img" style="width:<?php echo $header_title['wfe_data_table_header_col_img_size'] ?>px" alt="<?php echo esc_attr( $header_title['wfe_data_table_header_col'] ); ?>">
							<?php endif; ?>
							<?php echo __( $header_title['wfe_data_table_header_col'], 'wfe_elementor' ); ?>
                        </th>
					<?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
				<?php for( $i = 0; $i < count( $table_tr ); $i++ ) : ?>
                    <tr>
						<?php
						for( $j = 0; $j < count( $table_td ); $j++ ) {
							if( $table_tr[$i]['id'] == $table_td[$j]['row_id'] ) {
								?>
								<?php if( !empty( $table_td[$j]['link_url'] ) ) : ?>
                                    <td<?php echo $table_td[$j]['colspan'] > 1 ? ' colspan="'.$table_td[$j]['colspan'].'"' : ''; ?>>
                                        <a href="<?php echo esc_attr( $table_td[$j]['link_url'] ); ?>" <?php echo $table_td[$j]['link_target'] ?> <?php echo $table_td[$j]['nofollow'] ?>><?php echo $table_td[$j]['title']; ?></a>
                                    </td>
								<?php else: ?>
                                    <td<?php echo $table_td[$j]['colspan'] > 1 ? ' colspan="'.$table_td[$j]['colspan'].'"' : ''; ?>><?php echo $table_td[$j]['title']; ?></td>
								<?php endif; ?>
								<?php
							}
						}
						?>
                    </tr>
				<?php endfor; ?>
                </tbody>
            </table>

            <script type="text/javascript">
                jQuery(document).ready(function($) {
					<?php if( $settings['wfe_section_data_table_enabled'] == 'true' ) : ?>
                    $("#wfe-data-table-<?php echo $this->get_id(); ?>").tablesorter();
					<?php endif; ?>
                });
            </script>
			<?php if( $settings['wfe_section_data_table_enabled'] != 'true' ) : ?>
                <style>
                    table#wfe-data-table-<?php echo $this->get_id(); ?> .sorting:after,
                    table#wfe-data-table-<?php echo $this->get_id(); ?> .sorting_desc:after,
                    table#wfe-data-table-<?php echo $this->get_id(); ?> .sorting_asc:after {
                        display: none;
                    }
                </style>
			<?php endif; ?>
        </div>
		<?php
	}

	protected function content_template() {

		?>


		<?php
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Wfe_datatable() );