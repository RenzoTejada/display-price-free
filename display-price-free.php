<?php
/**
 *
 * @link              https://renzotejada.com/
 * @package           Display Price Free
 *
 * @wordpress-plugin
 * Plugin Name:       Display Price Free
 * Plugin URI:        https://renzotejada.com/display-price-free/
 * Description:       Display FREE if Price Zero or Empty - WooCommerce Single Product
 * Version:           1.4
 * Author:            Renzo Tejada
 * Author URI:        https://renzotejada.com/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       rt-display-free
 * Domain Path:       /language
 * WC tested up to:   9.5.2
 * WC requires at least: 2.6
 */
if (!defined('ABSPATH')) {
    exit;
}

$plugin_display_free_version = get_file_data(__FILE__, array('Version' => 'Version'), false);

define('Version_RT_Display_Free', $plugin_display_free_version['Version']);

add_action( 'before_woocommerce_init', function() {
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    }
} );

function rt_display_free_load_textdomain()
{
    load_plugin_textdomain('rt-display-free', false, basename(dirname(__FILE__)) . '/language/');
}

add_action('init', 'rt_display_free_load_textdomain');


function rt_display_free_add_plugin_page_settings_link($links)
{
    $links2[] = '<a href="' . admin_url('admin.php?page=rt_display_settings') . '">' . __('Settings', 'rt-display-free') . '</a>';
    $links = array_merge($links2, $links);
    return $links;
}

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'rt_display_free_add_plugin_page_settings_link');

function rt_display_free_plugin_row_meta($links, $file)
{
    if ('display-price-free/display-price-free.php' !== $file) {
        return $links;
    }
    $row_meta = array(
        'contact' => '<a target="_blank" href="' . esc_url('https://renzotejada.com/contacto/') . '">' . esc_html__('Contact', 'rt-display-free') . '</a>',
        'support' => '<a target="_blank" href="' . esc_url('https://wordpress.org/support/plugin/display-price-free/') . '">' . esc_html__('Support', 'rt-display-free') . '</a>',
    );
    return array_merge($links, $row_meta);
}

add_filter('plugin_row_meta', 'rt_display_free_plugin_row_meta', 10, 2);

/*
 * ADMIN
 */
require dirname(__FILE__) . "/display_admin.php";
