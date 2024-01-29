<?php

/**
 * Plugin Name: Our Team
 * Description: This plugin adds a custom "Our Team" widget to the Elementor website builder.
 * Plugin URI: www.linkedin.com/in/artur-drohalchuk-4013b425a
 * Author: Drohalchuk Artur
 * Version: 1.0.0
 * Author URI: www.linkedin.com/in/artur-drohalchuk-4013b425a
 * Text Domain: our_team
 * 
 * 
 * Elementor tested up to: 3.16.0
 * Elementor Pro tested up to: 3.16.0
 */

if (!defined('ABSPATH')) {
	exit;
}

if (!defined('OUR_TEAM_DIR_PATH')) {
	define('OUR_TEAM_DIR_PATH', plugin_dir_path(__FILE__));
}

if (!defined('OUR_TEAM_DIR_URI')) {
	define('OUR_TEAM_DIR_URI', untrailingslashit(plugins_url('/', __FILE__)));
}
if (!defined('OUR_TEAM_VERSION')) {
	define('OUR_TEAM_VERSION', '1.0.0');
}

if (!defined('OUR_TEAM_MINIMUM_ELEMENTOR_VERSION')) {
	define('OUR_TEAM_MINIMUM_ELEMENTOR_VERSION', '2.0.0');
}

if (!defined('OUR_TEAM_MINIMUM_PHP_VERSION')) {
	define('OUR_TEAM_MINIMUM_PHP_VERSION', '7.0');
}

require_once OUR_TEAM_DIR_PATH . '/inc/helpers/autoloader.php';

function our_team_plugin_get_instance()
{
	\OUR_TEAM\Inc\My_Custom_Elementor_Widget::get_instance();
}

our_team_plugin_get_instance();
