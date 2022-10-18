<?php
/**
 * Plugin Name:       Novo Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Luiz Eduardo F Silva
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       np
 * Domain Path:       /languages
 */

if (!defined('WPINC')) {
    die();
}

if(file_exists(plugin_dir_path(__FILE__).'core-init.php')) {
    require_once(plugin_dir_path(__FILE__).'core-init.php');
}