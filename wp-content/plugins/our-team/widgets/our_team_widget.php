<?php

namespace OUR_TEAM\Inc\Widgets;

class Our_Team extends \Elementor\Widget_Base
{

	public function get_name()
	{
		return  'our-team-widget-id';
	}

	public function get_title()
	{
		return esc_html__('Our team', 'our_team');
	}

	public function get_script_depends()
	{
		return ['our-team-js', 'slick-js'];
	}

	public function get_style_depends()
	{
		return ['our-team-css', 'slick-css'];
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
		// Main Settings
		$this->start_controls_section(
			'our_team_settings',
			[
				'label' => esc_html__('Settings', 'our_team'),
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
				'label' => esc_html__('Content Settings', 'our_team'),
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
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__('Enter the person information here', 'our_team'),
				'placeholder' => esc_html__('Enter the person information here', 'our_team'),
			]
		);

		/* button */
		$repeater->add_control(
			'show_bottom_our_team',
			[
				'label' => esc_html__('Show Bottom', 'plugin-domain'),
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
				'label' => esc_html__('Button Link', 'elementor-list-widget'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'elementor-list-widget'),
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
				'label' => esc_html__('Bottom Text', 'plugin-domain'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Read more', 'plugin-domain'),
				'placeholder' => esc_html__('Type your text here', 'plugin-domain'),
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
						'slider_title' => esc_html__('Slider title #1', 'our_team'),
					],
				],
				'title_field' => '{{{ slider_title }}}',
			]
		);
		$this->end_controls_section();
	}

	private function style_tab()
	{
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute(
			'logo_carousel_options',
			[
				'id'          => 'logo-carousel-' . $this->get_id(),

			]
		);
?>
		<div class="slick-carousel">
			<?php foreach ($settings['slider'] as $slide) : ?>
				<div class="item">
					<div>
						<img src="<?php echo esc_url($slide['slider_image']['url']); ?>" alt="<?php esc_attr_e($slide['slider_title']); ?>" />
					</div>
					<h3>
						<?php echo esc_html($slide['slider_title']) ?>
					</h3>
					<div>
						<?php echo wp_kses_post($slide['slider_description']) ?>
					</div>
					<?php if ($slide['show_bottom_our_team'] === 'yes') { ?>
						<a href="<?php echo esc_url($slide['slider_link']['url']) ?>"><?php echo esc_html($slide['slider_link_text']) ?></a>
					<?php } ?>

				</div>
			<?php endforeach; ?>
		</div>
	<?php
	}

	protected function _content_template()
	{
	?>
		<# if( settings.slider.length ) { #>
			<div class="slick-carousel">
				<# _.each( settings.slider, function( slide ) { #>
					<div class="item">
						<div>
							<img src="{{ slide.slider_image.url }}" alt="{{ slide.slider_title }}" />
						</div>
						<h3>{{slide.slider_title}}</h3>
						<div>{{slide.slider_description}}</div>
						<# if( slide.show_bottom_our_team=='yes' ) { #>
							<a href="{{slide.slider_link.url}}">{{slide.slider_link_text}}</a>
						<# } #>
					</div>
					<# } ) #>
			</div>
			<# } #>
		<?php
	}
}
