<?php
try {
    // Arguments for WP_Query
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'post', // Default to 'post' if no post_type is passed in $atts
        'posts_per_page' => intval($atts['posts_per_page']),
        'paged' => $paged, // Ensure pagination works
    );

    // If a category is provided, filter posts by category
    if (!empty($atts['category'])) {
        $args['category_name'] = sanitize_text_field($atts['category']);
    }

    // The Query
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div class="post-grid flex flex-col gap-6">'; // Full-width horizontal post grid

        while ($query->have_posts()) {
            $query->the_post();

            // Start the post item with background color from $atts
            echo '<a href="' . get_the_permalink() . '" class="post-item flex flex-col md:flex-row justify-between items-stretch border border-gray-200 shadow-md hover:shadow-lg transition-shadow duration-300" style="background-color:' . esc_attr($atts['bg_color']) . ';">';

            // Display Post Thumbnail (Image container with responsive order)
            if (has_post_thumbnail()) {
                echo '<div class="w-full md:w-1/3 h-64 relative overflow-hidden bg-gray-200 order-1 md:order-2">'; // Order changes on md screens
                echo '<img src="' . get_the_post_thumbnail_url(null, 'full') . '" alt="' . get_the_title() . '" class="absolute inset-0 w-full h-full min-h-full object-cover object-center">';
                echo '</div>';                
            } else {
                // Placeholder for posts without thumbnails
                echo '<div class="w-full md:w-1/3 h-64 flex items-center justify-center bg-gray-200 border border-gray-300 order-1 md:order-2">';
                echo '<span class="text-gray-500">No Image Available</span>';
                echo '</div>';
            }

            // Display Post Content (Title, Meta, and Description on the left)
            echo '<div class="p-4 flex flex-col justify-start w-full md:w-2/3 order-2 md:order-1">'; // Order changes on md screens

            // Display Post Category above the title, smaller and in blue
            $category = get_the_category();
            if (!empty($category) && $category[0]->name !== 'Uncategorized') {
                echo '<h3 class="post-category font-bold text-blue-600 mb-1" style="padding-left: 0.5rem;">' . esc_html($category[0]->name) . '</h3>';
            }

            // Display Post Title at the top with larger font size and left padding
            echo '<h2 class="post-title text-2xl font-bold ' . esc_attr($atts['title_font_family']) . '" title="' . get_the_title() . '" style="color:' . esc_attr($atts['title_font_color']) . '; padding-left: 0.5rem;">' . esc_html(wp_trim_words(get_the_title(), 14, '...')) . '</h2>';

            // Post Meta (Author and Date) with icons, left-aligned under the title
            echo '<div class="post-meta flex justify-start items-center text-gray-600 text-sm gap-4 mt-2" style="padding-left: 0.5rem;">';

            // Author with SVG icon
            echo '<span class="flex items-center">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
            echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A10.97 10.97 0 0112 15c2.733 0 5.254 1.04 7.121 2.804M12 12a4 4 0 100-8 4 4 0 000 8z" />';
            echo '</svg>';
            echo '<span class="font-semibold text-gray-800">' . get_the_author() . '</span>';
            echo '</span>';

            // Date with SVG icon
            echo '<span class="flex items-center">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
            echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-6 8h6m-6 4h6M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />';
            echo '</svg>';
            echo '<span class="font-semibold text-gray-800">' . get_the_date() . '</span>';
            echo '</span>';

            echo '</div>'; // End of post-meta section

            // Add spacing between the meta section and the description
            echo '<div class="mt-4 post-description text-base ' . esc_attr($atts['description_font_family']) . '" style="color:' . esc_attr($atts['description_font_color']) . '; padding-left: 0.5rem;">' . esc_html(wp_trim_words(get_the_excerpt(), 20, '...')) . '</div>';

            // Button container
            echo '<div class="p-2">';
            echo '<div class="bg-blue-600 text-white text-xs font-semibold py-1 px-2 hover:bg-green-600 transition-colors duration-300 inline-block">VIEW POST &raquo;</div>';
            echo '</div>'; // End of button container

            echo '</div>'; // End of post content (left side)

            echo '</a>'; // End of post-item link

        }

        echo '</div>'; // End of post-grid

        


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
            echo '<div class="pagination mt-8">';
            echo '<ul class="flex justify-center space-x-4 text-sm">';


            foreach ($pagination as $page_link) {
                // Check if the link is the current page (non-clickable)
                if (strpos($page_link, 'current') !== false) {
                    // Apply styling to the current page (non-clickable, centered, outlined)
                    echo '<li>';
                    echo str_replace('<span', '<span class="block px-3 py-2 border border-gray text-black"', $page_link);
                    echo '</li>';
                } else {
                    // Append TailwindCSS classes to clickable links
                    echo '<li>';
                    echo str_replace('<a', '<a class="block px-3 py-2 bg-gray-200 rounded hover:bg-blue-500 hover:text-white"', $page_link);
                    echo '</li>';
                }
            }

            echo '</ul>';
            echo '</div>';
        }

    } else {
        // If no posts are found, display a message
        echo '<p>No posts found.</p>';
    }

    // Reset Post Data (Important)
    wp_reset_postdata();

} catch (Exception $e) {
    // Capture and display any error that occurs
    echo '<p>An error occurred: ' . esc_html($e->getMessage()) . '</p>';
}
?>
