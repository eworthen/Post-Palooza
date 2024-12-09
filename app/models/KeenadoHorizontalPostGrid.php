<?php

namespace app\models;

use \WP_Query;
use \Exception;

class KeenadoHorizontalPostGrid {
    private $atts;

    public function __construct($atts = []) {
        $this->atts = shortcode_atts(
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
    }

    public function render() {
        try {
            $horz_output = '';
            // Arguments for WP_Query
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'post', // Default to 'post' if no post_type is passed in $atts
                'posts_per_page' => intval($this->atts['posts_per_page']),
                'paged' => $paged, // Ensure pagination works
            );
        
            // If a category is provided, filter posts by category
            if (!empty($atts['category'])) {
                $args['category_name'] = sanitize_text_field($this->atts['category']);
            }
        
            // The Query
            $query = new WP_Query($args);
        
            if ($query->have_posts()) {
                $horz_output .= '<div class="post-grid flex flex-col gap-6">'; // Full-width horizontal post grid
        
                while ($query->have_posts()) {
                    $query->the_post();
        
                    // Start the post item with background color from $atts
                    $horz_output .= '<div onclick="window.location.href=\'' . esc_url(get_the_permalink()) . '\'" class="post-item flex flex-col md:flex-row justify-between items-stretch border border-gray-200 shadow-md hover:shadow-lg transition-shadow duration-300" style="background-color:' . esc_attr($this->atts['bg_color']) . '; cursor:pointer;">';
        
                    // Display Post Thumbnail (Image container with responsive order)
                    if (has_post_thumbnail()) {
                        $horz_output .= '<div class="w-full md:w-1/3 h-64 relative overflow-hidden bg-gray-200 order-1 md:order-2">
                                        <img src="' . get_the_post_thumbnail_url(null, 'full') . '" alt="' . get_the_title() . '" class="absolute inset-0 w-full h-full min-h-full object-cover object-center">
                                    </div>';                
                    } else {
                        // Placeholder for posts without thumbnails
                        $horz_output .= '<div class="w-full md:w-1/3 h-64 flex items-center justify-center bg-gray-200 border border-gray-300 order-1 md:order-2">
                                        <span class="text-gray-500">No Image Available</span>
                                    </div>';
                    }
        
                    // Display Post Content (Title, Meta, and Description on the left)
                    $horz_output .= '<div class="p-4 flex flex-col justify-start w-full md:w-2/3 order-2 md:order-1">'; // Order changes on md screens
        
                    // Display Post Category above the title, smaller and in blue
                    $category = get_the_category();
                    if (!empty($category) && $category[0]->name !== 'Uncategorized') {
                        $horz_output .= '<h3 class="post-category font-bold text-blue-600 mb-1" style="padding-left: 0.5rem;">' . esc_html($category[0]->name) . '</h3>';
                    }
        
                    // Display Post Title at the top with larger font size and left padding
                    $horz_output .= '<h2 class="post-title text-2xl font-bold ' . esc_attr($this->atts['title_font_family']) . '" title="' . get_the_title() . '" style="color:' . esc_attr($this->atts['title_font_color']) . '; padding-left: 0.5rem;">' . esc_html(wp_trim_words(get_the_title(), 14, '...')) . '</h2>';
        
                    // Post Meta (Author and Date) with icons, left-aligned under the title
                    $horz_output .= '<div class="post-meta flex justify-start items-center text-gray-600 text-sm gap-4 mt-2" style="padding-left: 0.5rem;">';
        
                    // Author with SVG icon
                    $horz_output .= '<span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A10.97 10.97 0 0112 15c2.733 0 5.254 1.04 7.121 2.804M12 12a4 4 0 100-8 4 4 0 000 8z" />
                                    </svg>
                                    <span class="font-semibold text-gray-800">' . get_the_author() . '</span>
                                </span>';
        
                    // Date with SVG icon
                    $horz_output .= '<span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-6 8h6m-6 4h6M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="font-semibold text-gray-800">' . get_the_date() . '</span>
                                </span>';
        
                    $horz_output .= '</div>'; // End of post-meta section
        
                    // Add spacing between the meta section and the description
                    $horz_output .= '<div class="mt-4 post-description text-base ' . esc_attr($this->atts['description_font_family']) . '" style="color:' . esc_attr($this->atts['description_font_color']) . '; padding-left: 0.5rem;">' . esc_html(wp_trim_words(get_the_excerpt(), 20, '...')) . '</div>';
        
                    // Button container
                    $horz_output .= '<div class="p-2">
                                    <div class="bg-blue-600 text-white text-xs font-semibold py-1 px-2 hover:bg-green-600 transition-colors duration-300 inline-block">VIEW POST &raquo;</div>
                                </div>';
        
                    $horz_output .= '</div>'; // End of post content (left side)
        
                    $horz_output .= '</div>'; // End of post-item link
        
                }

                // Reset Post Data (Important)
                wp_reset_postdata();
        
                $horz_output .= '</div>'; // End of post-grid
        
                // Pagination below the post grid
                $pagination = paginate_links(array(
                    'total' => $query->max_num_pages,
                    'current' => max(1, get_query_var('paged')),
                    'mid_size' => 2,
                    'prev_text' => '&laquo;',  // Left double chevron
                    'next_text' => '&raquo;',  // Right double chevron
                    'type' => 'array',  // Output pagination as an array for customization
                ));
        
                // Display pagination with styling using TailwindCSS
                if ($pagination) {
                    $horz_output .= '<div class="pagination mt-8 text-center">
                                    <ul class="flex justify-center space-x-4 text-sm">';
        
        
                    foreach ($pagination as $page_link) {
                        // Check if the link is the current page (non-clickable)
                        if (strpos($page_link, 'current') !== false) {
                            // Apply styling to the current page (non-clickable, centered, outlined)
                            $horz_output .= '<li>'
                                            . str_replace('<span', '<span class="block px-3 py-2 border border-gray text-black"', $page_link)
                                        . '</li>';
                        } else {
                            // Append TailwindCSS classes to clickable links
                            $horz_output .= '<li>'
                                           . str_replace('<a', '<a class="block px-3 py-2 bg-gray-200 rounded hover:bg-blue-500 hover:text-white"', $page_link)
                                       . '</li>';
                        }
                    }
        
                    $horz_output .= '</ul>
                            </div>';
                }
        
            } else {
                // If no posts are found, display a message
                $horz_output = '<p>No posts found.</p>';
            }
        
        } catch (Exception $e) {
            // Capture and display any error that occurs
            error_log($e->getMessage());
            $horz_output = '<p>An error occurred: ' . esc_html($e->getMessage()) . '</p>';
        }

        wp_reset_postdata();
        return $horz_output;

    }

}

?>