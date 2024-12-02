<?php
// Ensure the script is being run within WordPress
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**********************************************
 * Admin Dashboard
 **********************************************/
function keenado_post_palooza_plugin_admin_page() {
    try {
        // Check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

       // Container with adjusted width to account for margins
        echo '<div class="h-[calc(100%-20px)] w-[calc(100%-20px)] m-2.5 bg-transparent">'; // Adjust width for margins

        // Placeholder content to visualize the container
        echo '<h3 class="text-3xl font-bold text-center text-gray-800 mb-8">Post Palooza Admin</h3>';

         // Include the necessary file
        include(KEENADO_POST_PALOOZA_PLUGIN_DIR . 'app/includes/admin/cards-config.php');

        echo '</div>'; // End of transparent container with border

    } catch (Exception $e) {
        echo '<p>An error occurred: ' . esc_html($e->getMessage()) . '</p>';
    }
}


/**********************************************
 * Shortcode to display a post grid with custom post type and number of posts
 **********************************************/
function keenado_post_grid_shortcode($atts) {
    // Include the KeenadoPostGrid class
    require_once KEENADO_POST_PALOOZA_PLUGIN_DIR . 'app/models/KeenadoPostGrid.php';

    // Instantiate the class and call the render method
    $keenado_post_grid = new KeenadoPostGrid($atts);
    return $keenado_post_grid->render();
}

/**********************************************
 * Shortcode for WordPress: [post_palooza_horizontal_view]
 * Example usage: [post_palooza_grid_view post_type="custom_post_type" posts_per_page="5"]
 **********************************************/
add_shortcode('post_palooza_grid_view', 'keenado_post_grid_shortcode');

/**********************************************
 * Shortcode to display a horizontal post grid with custom post type and number of posts
 **********************************************/
function keenado_horizontal_post_grid_shortcode($atts) {
    // Include the KeenadoPostGrid class
    require_once KEENADO_POST_PALOOZA_PLUGIN_DIR . 'app/models/KeenadoHorizontalPostGrid.php';

    // Instantiate the class and call the render method
    $keenado_horizontal_post_grid = new KeenadoPostGrid($atts);
    return $keenado_horizontal_post_grid->render();
}

/**********************************************
 * Shortcode for WordPress: [post_palooza_horizontal_grid_view]
 * Example usage: [post_palooza_horizontal_grid_view post_type="custom_post_type" posts_per_page="5"]
 **********************************************/
add_shortcode('post_palooza_horizontal_grid_view', 'keenado_horizontal_post_grid_shortcode');
