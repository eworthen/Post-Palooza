<?php
/*
Plugin Name: Keenado - Post Palooza
Description: A plugin to list posts. POST GRID VIEW Shortcode: [post_palooza_grid_view]
Version: 1.0
Author: EDUB@Keenado
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**********************************************
 * Plugin Constants
 **********************************************/
define( 'KEENADO_POST_PALOOZA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'KEENADO_POST_PALOOZA_URL_DIR', plugin_dir_url( __FILE__ ) );


/**********************************************
 * AJAX Handlers
 **********************************************/
add_action('init', 'keenado_post_palooza_plugin_init'); // initialize plugin
add_action( 'admin_menu', 'keenado_post_palooza_plugin_menu' ); // admin dashboard menu
add_action( 'wp_enqueue_scripts', 'keenado_posts_plugin_enqueue_frontend_scripts' ); // front end css
add_action( 'admin_enqueue_scripts', 'keenado_posts_plugin_enqueue_admin_scripts' ); // admin dashboard css

// Include the main plugin file
require_once KEENADO_POST_PALOOZA_PLUGIN_DIR . 'app/keenado-post-palooza-plugin.php';

// Initialize the plugin
function keenado_post_palooza_plugin_init() {
    // Any initialization or setup logic for your plugin
    if ( function_exists( 'keenado_events_setup' ) ) {
        keenado_events_setup(); // Call setup function from keenado_events_plugin.php
    }
}

/**********************************************
 * Plugin Admin Dashboard
 **********************************************/
function keenado_post_palooza_plugin_menu() {
    // [0] page title, [1] menu title, [2] capability, [3] menu slug, [4] Admin function to display in dashboard, [5] link to icon file, [6] position in admin panel from top
    add_menu_page(
        'Keenado Post Palooza Plugin', 
        'Post Palooza', 
        'manage_options',
        'keenado_post_palooza_plugin_dashboard', 
        'keenado_post_palooza_plugin_admin_page', 
        'dashicons-megaphone',
        8,
    );
}

/**********************************************
 * Enqueue Styles and Scripts for Admin and Front End
 **********************************************/
// Enqueue TailwindCSS for the front end
function keenado_posts_plugin_enqueue_frontend_scripts() {
    // Enqueue the TailwindCSS output file for front-end
    wp_enqueue_style( 'keenado-post-palooza-styles', KEENADO_POST_PALOOZA_URL_DIR. 'app/assets/css/output.css', array(), '1.0.0', 'all' );
}

// Enqueue TailwindCSS for the admin dashboard
function keenado_posts_plugin_enqueue_admin_scripts() {
    // Enqueue the TailwindCSS output file for admin pages
    wp_enqueue_style( 'keenado-post-palooza-admin-styles', KEENADO_POST_PALOOZA_URL_DIR . 'app/assets/css/output.css', array(), '1.0.0', 'all' );
}