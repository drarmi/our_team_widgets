<?php

namespace OUR_TEAM\Inc;

use OUR_TEAM\Inc\Traits\Singleton;

class Assets
{
	use Singleton;

	protected function __construct()
	{
		$this->setup_hooks();
	}

	protected function setup_hooks()
	{

		add_action('wp_enqueue_scripts', array($this, 'register_style'));
		add_action('wp_enqueue_scripts', array($this, 'register_script'));
	}

	public function register_style()
	{
		// Register styles.
		wp_register_style('our-team-css',  OUR_TEAM_DIR_URI . '/assets/dist/css/public.min.css', [], rand(), 'all');
		wp_register_style('owl-carousel', OUR_TEAM_DIR_URI . '/assets/vendor/owl-carousel/css/owl.carousel.min.css', [], rand(), 'all');
		wp_register_style('owl-carousel-theme', OUR_TEAM_DIR_URI . '/assets/vendor/owl-carousel/css/owl.theme.default.min.css', [], rand(), 'all');

		// Enqueue Styles.
		wp_enqueue_style('our-team-css');
		wp_enqueue_style('owl-carousel');
		wp_enqueue_style('owl-carousel-theme');
	}

	public function register_script()
	{
		// Register scripts.
		wp_register_script('our-team-js',  OUR_TEAM_DIR_URI . '/assets/dist/js/public.min.js', ['jquery'], filemtime(OUR_TEAM_DIR_PATH . '/assets/dist/js/public.min.js'), true);
		wp_register_script('owl-carousel-js',  OUR_TEAM_DIR_URI  . '/assets/vendor/owl-carousel/js/owl.carousel.min.js', ['jquery'], rand(), true);
		// Enqueue Scripts.
		wp_enqueue_script('our-team-js');
		wp_enqueue_script('owl-carousel-js');
	}
}
