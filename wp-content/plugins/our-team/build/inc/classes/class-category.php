<?php

namespace OUR_TEAM\Inc;

use OUR_TEAM\Inc\Traits\Singleton;

class Category
{
	use Singleton;

	protected function __construct()
	{
		$this->setup_hooks();
	}

	protected function setup_hooks()
	{
		add_action('elementor/init', [$this, 'init_category']);
	}

	public function init_category()
	{
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'our-team-section-elementor',
			[
				'title' => __('Our team section', 'our_team'),
			],
			1
		);
	}
}
