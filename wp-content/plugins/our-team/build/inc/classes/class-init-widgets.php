<?php

namespace OUR_TEAM\Inc;

use OUR_TEAM\Inc\Traits\Singleton;

class Init_Widgets
{
	use Singleton;

	protected function __construct()
	{
		$this->setup_hooks();
	}

	protected function setup_hooks()
	{
		add_action('elementor/widgets/register', array($this, 'register_our_team_widget'));
	}

	public function register_our_team_widget($widgets_manager)
	{
		require_once(OUR_TEAM_DIR_PATH . 'inc/widgets/widget-our-team.php');
		$widgets_manager->register_widget_type(new \OUR_TEAM\Inc\Widgets\Our_Team_Carousel_Widget());
	}
}
