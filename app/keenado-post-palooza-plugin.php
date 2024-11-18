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
    // Define default attributes and merge with the ones passed through the shortcode
    $atts = shortcode_atts(
        array(
            'title_font_family'     => 'font-arial',   // Default font family for the title
            'title_font_color'      => '#000000',      // Default title font color
            'description_font_family' => 'font-arial', // Default font family for the description
            'description_font_color' => '#454545',     // Default description font color
            'bg_color'              => '#ffffff',      // Default background color
            'posts_per_page'        => '3',            // Default number of posts per page
            'category'              => '',             // Default post category (empty means all)
        ), $atts
    );

    // Include the card layout file and pass $atts to it
    ob_start(); // Start output buffering
    include(KEENADO_POST_PALOOZA_PLUGIN_DIR . 'app/includes/front-end/card-post-grid.php');
    return ob_get_clean(); // Return the content and clean the buffer
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
    // Define default attributes and merge with the ones passed through the shortcode
    $atts = shortcode_atts(
        array(
            'title_font_family'     => 'font-arial',   // Default font family for the title
            'title_font_color'      => '#000000',      // Default title font color
            'description_font_family' => 'font-arial', // Default font family for the description
            'description_font_color' => '#454545',     // Default description font color
            'bg_color'              => '#ffffff',      // Default background color
            'posts_per_page'        => '3',            // Default number of posts per page
            'category'              => '',             // Default post category (empty means all)
        ), $atts
    );

    // Include the card layout file and pass $atts to it
    ob_start(); // Start output buffering
    include(KEENADO_POST_PALOOZA_PLUGIN_DIR . 'app/includes/front-end/horizontal-post-grid.php');
    return ob_get_clean(); // Return the content and clean the buffer
}

/**********************************************
 * Shortcode for WordPress: [post_palooza_horizontal_grid_view]
 * Example usage: [post_palooza_horizontal_grid_view post_type="custom_post_type" posts_per_page="5"]
 **********************************************/
add_shortcode('post_palooza_horizontal_grid_view', 'keenado_horizontal_post_grid_shortcode');
