<?php

namespace OUR_TEAM\Inc\Widgets;

class Our_Team_Carousel_Widget extends \Elementor\Widget_Base
{

	public function get_name()
	{
		return 'our-team-custom-widget';
	}

	public function get_title()
	{
		return esc_html__('Our team', 'our_team');
	}

	public function get_script_depends()
	{
		return ['our-team-js'];
	}

	public function get_style_depends()
	{
		return ['our-team-css'];
	}

	public function get_icon()
	{
		return 'eicon-user-circle-o';
	}

	public function get_categories()
	{
		return ['our-team-section-elementor'];
	}

	public function _register_controls()
	{
		// Settings
		$this->start_controls_section(
			'slider_settings',
			[
				'label' => __('Settings', 'our_team'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'mobile_column',
			[
				'label' => esc_html__('Number of columns per Mobile', 'our_team'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 1,
			]
		);

		$this->add_control(
			'leptop_column',
			[
				'label' => esc_html__('Number of columns per Leptop', 'our_team'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 2,
			]
		);

		$this->add_control(
			'pc_column',
			[
				'label' => esc_html__('Number of columns per PC', 'our_team'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
			]
		);

		$this->add_control(
			'show_carrousel',
			[
				'label' => esc_html__('Show as carousel', 'our_team'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'our_team'),
				'label_off' => esc_html__('Hide', 'our_team'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();


		// Content Settings
		$this->start_controls_section(
			'content_settings',
			[
				'label' => __('Content Settings', 'our_team'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// Slider Repeater
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'slider_image',
			[
				'label'   => esc_html__('Photo', 'our_team'),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			],
		);

		$repeater->add_control(
			'slider_title',
			[
				'label' => esc_html__('Name', 'our_team'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter the person name', 'our_team'),
				'label_block' => true
			]
		);

		$repeater->add_control(
			'slider_description',
			[
				'label' => esc_html__('About', 'our_team'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__('Enter the person information here', 'our_team'),
				'placeholder' => esc_html__('Enter the person information here', 'our_team'),
			]
		);

		/* button */
		$repeater->add_control(
			'show_bottom_our_team',
			[
				'label' => esc_html__('Show Bottom', 'our_team'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'our_team'),
				'label_off' => esc_html__('Hide', 'our_team'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$repeater->add_control(
			'slider_link',
			[
				'label' => esc_html__('Button Link', 'our_team'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'our_team'),
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'show_bottom_our_team' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'slider_link_text',
			[
				'label' => esc_html__('Bottom Text', 'our_team'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Read more', 'our_team'),
				'placeholder' => esc_html__('Type your text here', 'our_team'),
				'condition' => [
					'show_bottom_our_team' => 'yes'
				]
			]
		);

		$this->add_control(
			'slider',
			[
				'label' => esc_html__('Man from the team list', 'our_team'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'slider_title' => esc_html__('Name', 'our_team'),
					],
				],
				'title_field' => '{{{ slider_title }}}',
			]
		);
		$this->end_controls_section();

		$this->style_tab();
	}

	private function style_tab()
	{
		// Image Style Settings
		$this->start_controls_section(
			'image_style_section',
			[
				'label' => esc_html__('Image', 'our_team'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Width
		$this->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__('Width', 'our_team'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'description' => 'Desfault: 100%',
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .image-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Height
		$this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__('Height', 'our_team'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'description' => 'Desfault: 230px',
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 230,
				],
				'selectors' => [
					'{{WRAPPER}} .image-wrapper img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'image_padding',
			[
				'label' => esc_html__('Padding', 'our_team'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .image-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Border Type
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'label' => esc_html__('Border', 'our_team'),
				'selector' => '{{WRAPPER}} .image-wrapper',
			]
		);

		// Border Radius
		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'our_team'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .image-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .image-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();


		// Title Style Settings
		$this->start_controls_section(
			'title_style_section',
			[
				'label' => esc_html__('Name', 'our_team'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Title Bottom Spacing
		$this->add_responsive_control(
			'content_title_bottom_spacing',
			[
				'label' => esc_html__('Bottom Spacing', 'our_team'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'description' => 'Default: 15px',
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .item-wrapper .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Title Color
		$this->add_control(
			'content_title_color',
			[
				'label' => esc_html__('Color', 'our_team'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-wrapper .title h3' => 'color: {{VALUE}}',
				],
				'default' => '#111',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_title_typography',
				'label' => esc_html__('Typography', 'our_team'),
				'selector' => '{{WRAPPER}} .item-wrapper .title h3',
			]
		);

		$this->end_controls_section();


		// About Style Settings
		$this->start_controls_section(
			'description_style_section',
			[
				'label' => esc_html__('About', 'our_team'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Title Bottom Spacing
		$this->add_responsive_control(
			'content_about_bottom_spacing',
			[
				'label' => esc_html__('Bottom Spacing', 'our_team'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'description' => 'Default: 15px',
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .item-wrapper .item_description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// About Color
		$this->add_control(
			'content_about_color',
			[
				'label' => esc_html__('Color', 'our_team'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-wrapper .item_description' => 'color: {{VALUE}}',
				],
				'default' => '#111',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_about_typography',
				'label' => esc_html__('Typography', 'our_team'),
				'selector' => '{{WRAPPER}} .item-wrapper .item_description',
			]
		);

		$this->end_controls_section();

		/**
		 * Buy Button Style Settings
		 */
		$this->start_controls_section(
			'buy_button_style_section',
			[
				'label' => esc_html__('Buy Button', 'our_team'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Button
		$this->start_controls_tabs(
			'but_button_style_tabs'
		);
		// Normal State
		$this->start_controls_tab(
			'button_normal_state',
			[
				'label' => esc_html__('Normal', 'our_team'),
			]
		);
		// Background Color
		$this->add_control(
			'button_normal_bg_color',
			[
				'label' => esc_html__('Background Color', 'our_team'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#562dd4',
				'selectors' => [
					'{{WRAPPER}} .item-wrapper a.item_btn' => 'background-color: {{VALUE}}',
				],
			]
		);
		// Text Color
		$this->add_control(
			'button_normal_text_color',
			[
				'label' => esc_html__('Text Color', 'our_team'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .item-wrapper a.item_btn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		// Hover State
		$this->start_controls_tab(
			'button_hover_state',
			[
				'label' => esc_html__('Hover', 'our_team'),
			]
		);
		// Background Color
		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => esc_html__('Background Color', 'our_team'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#707070',
				'selectors' => [
					'{{WRAPPER}} .item-wrapper a.item_btn:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		// Text Color
		$this->add_control(
			'but_button_hover_text_color',
			[
				'label' => esc_html__('Text Color', 'our_team'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .item-wrapper a.item_btn:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		// Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'buy_button_typography',
				'label' => esc_html__('Typography', 'our_team'),
				'selector' => '{{WRAPPER}} .item-wrapper a.item_btn',
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'carousel_options',
			[
				'id'          => 'team-carousel-' . $this->get_id(),
				'data-show-carrousel'   => $settings['show_carrousel'],
				'data-leptop-column'   => $settings['leptop_column'],
				'data-pc-column'       => $settings['pc_column'],
				'data-mobile-column'   => $settings['mobile_column'],
				'data-settings' => wp_json_encode($settings),
			]
		) ?>
		<div class="about-usour-team-widget-cover">
			<?php if ($settings['show_carrousel']) : ?>
				<div class="owl-carousel owl-theme team-carousel" <?php echo $this->get_render_attribute_string('carousel_options'); ?>>
					<?php foreach ($settings['slider'] as $slide) : ?>
						<div class="item item-wrapper">
							<div class="image-wrapper">
								<img src="<?php echo esc_url($slide['slider_image']['url']); ?>" alt="<?php esc_attr_e($slide['slider_title']); ?>" />
							</div>
							<div class="title">
								<h3>
									<?php echo esc_html($slide['slider_title']) ?>
								</h3>
							</div>
							<div class="item_description">
								<?php echo wp_kses_post($slide['slider_description']) ?>
							</div>
							<?php if ($slide['show_bottom_our_team'] === 'yes') { ?>
								<a href="<?php echo esc_url($slide['slider_link']['url']) ?>" class="item_btn"><?php echo esc_html($slide['slider_link_text']) ?></a>
							<?php } ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<div class="block-wrapper team-carousel" <?php echo $this->get_render_attribute_string('carousel_options'); ?>>
					<?php foreach ($settings['slider'] as $slide) : ?>
						<div class="item item-wrapper">
							<div class="image-wrapper">
								<img src="<?php echo esc_url($slide['slider_image']['url']); ?>" alt="<?php esc_attr_e($slide['slider_title']); ?>" />
							</div>
							<div class="title">
								<h3>
									<?php echo esc_html($slide['slider_title']) ?>
								</h3>
							</div>
							<div class="item_description">
								<?php echo wp_kses_post($slide['slider_description']) ?>
							</div>
							<?php if ($slide['show_bottom_our_team'] === 'yes') { ?>
								<a href="<?php echo esc_url($slide['slider_link']['url']) ?>" class="item_btn"><?php echo esc_html($slide['slider_link_text']) ?></a>
							<?php } ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

	<?php
	}

	protected function _content_template()
	{
	?>
		<# view.addRenderAttribute( 'carousel_options' , { 'id' : 'team-carousel-id' , 'data-show-carrousel' : settings.show_carrousel, 'data-pc-column' : settings.pc_column, 'data-leptop-column' : settings.leptop_column, 'data-mobile-column' : settings.mobile_column, } ); #>
			<div class="about-usour-team-widget-cover">
				<# if( settings.slider.length ) { #>
					<# if( settings.slider.length ) { #>
						<div class="owl-carousel owl-theme team-carousel" {{{ view.getRenderAttributeString( 'carousel_options' ) }}}>
							<# _.each( settings.slider, function( slide ) { #>
								<div class="item item-wrapper">
									<div class="image-wrapper">
										<img src="{{ slide.slider_image.url }}" alt="{{ slide.slider_title }}" />
									</div>
									<div class="title">
										<h3>{{slide.slider_title}}</h3>
									</div>
									<div class="item_description">{{slide.slider_description}}</div>
									<# if( slide.show_bottom_our_team=='yes' ) { #>
										<a href="{{slide.slider_link.url}}" class="item_btn">{{slide.slider_link_text}}</a>
										<# } #>
								</div>
								<# } ) #>
						</div>
						<# } #>
							<# }else{ #>
								<div class="block-wrapper" {{{ view.getRenderAttributeString( 'carousel_options' ) }}}>
									<# _.each( settings.slider, function( slide ) { #>
										<div class="item item-wrapper">
											<div class="image-wrapper">
												<img src="{{ slide.slider_image.url }}" alt="{{ slide.slider_title }}" />
											</div>
											<div class="title">
												<h3>{{slide.slider_title}}</h3>
											</div>
											<div class="item_description">{{slide.slider_description}}</div>
											<# if( slide.show_bottom_our_team=='yes' ) { #>
												<a href="{{slide.slider_link.url}}" class="item_btn">{{slide.slider_link_text}}</a>
												<# } #>
										</div>
										<# } ) #>
								</div>
								<# } #>
			</div>

	<?php
	}
}
