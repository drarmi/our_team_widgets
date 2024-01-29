<?php

namespace OUR_TEAM\Inc;

use OUR_TEAM\Inc\Traits\Singleton;

final class My_Custom_Elementor_Widget
{
	use Singleton;

	public function __construct()
	{
		Init_Widgets::get_instance();
		Assets::get_instance();
		Notices::get_instance();
		Category::get_instance();
		$this->setup_hooks();
	}


	protected function setup_hooks()
	{
		add_action('init', [$this, 'i18n']);
	}

	public function i18n()
	{
		load_plugin_textdomain('my-elementor-widget', false, dirname(plugin_basename(__FILE__)) . '/languages');
	}
}
