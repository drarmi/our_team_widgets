<?php

namespace OUR_TEAM\Inc;

use OUR_TEAM\Inc\Traits\Singleton;

class Notices
{
	use Singleton;

	protected function __construct()
	{
		$this->setup_hooks();
	}

	protected function setup_hooks()
	{
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return;
		}

		if (!version_compare(ELEMENTOR_VERSION, OUR_TEAM_MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return;
		}

		if (!version_compare(PHP_VERSION, OUR_TEAM_MINIMUM_PHP_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return;
		}
	}

	public function admin_notice_missing_main_plugin()
	{
		if (isset($_GET['activate'])) unset($_GET['activate']);
		$message = sprintf(
			esc_html__('"%1$s" requires "%2$s" to be installed and activated', 'my-elementor-widget'),
			'<strong>' . esc_html__('My Elementor Widget', 'my-elementor-widget') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'my-elementor-widget') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message);
	}

	public function admin_notice_minimum_elementor_version()
	{
		if (isset($_GET['activate'])) unset($_GET['activate']);
		$message = sprintf(
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater', 'my-elementor-widget'),
			'<strong>' . esc_html__('My Elementor Widget', 'my-elementor-widget') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'my-elementor-widget') . '</strong>',
			OUR_TEAM_MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message);
	}

	public function admin_notice_minimum_php_version()
	{
		if (isset($_GET['activate'])) unset($_GET['activate']);
		$message = sprintf(
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater', 'my-elementor-widget'),
			'<strong>' . esc_html__('My Elementor Widget', 'my-elementor-widget') . '</strong>',
			'<strong>' . esc_html__('PHP', 'my-elementor-widget') . '</strong>',
			OUR_TEAM_MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message);
	}
}
