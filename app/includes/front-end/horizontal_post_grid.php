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
            echo '<a href="' . get_the_permalink() . '" class="post-item flex justify-between items-center border border-gray-200 shadow-md hover:shadow-lg transition-shadow duration-300" style="background-color:' . esc_attr($atts['bg_color']) . ';">';

            // Display Post Content (Title and Description on the left)
            echo '<div class="p-4 flex flex-col w-2/3">';

            // Display Post Title with applied font styles from $atts
            echo '<h2 class="post-title text-lg font-bold ' . esc_attr($atts['title_font_family']) . ' mb-2" title="' . get_the_title() . '" style="color:' . esc_attr($atts['title_font_color']) . ';">' . get_the_title() . '</h2>';

            // Display Post Description / Excerpt, with font styles from $atts
            $excerpt = wp_trim_words(get_the_excerpt(), 20, '...');
            echo '<div class="post-description ' . esc_attr($atts['description_font_family']) . ' mb-4" title="' . esc_html($excerpt) . '" style="color:' . esc_attr($atts['description_font_color']) . ';">' . esc_html($excerpt) . '</div>';

            echo '</div>'; // End of post content (left side)

            // Display Post Thumbnail (Image on the right)
            if (has_post_thumbnail()) {
                echo '<div class="w-1/3 h-64 relative overflow-hidden bg-gray-200">';
                echo '<img src="' . get_the_post_thumbnail_url(null, 'full') . '" alt="' . get_the_title() . '" class="object-cover object-center w-full h-full">';
                echo '</div>';
            } else {
                // Placeholder for posts without thumbnails
                echo '<div class="w-1/3 h-64 flex items-center justify-center bg-gray-200 border border-gray-300">';
                echo '<span class="text-gray-500">No Image Available</span>';
                echo '</div>';
            }

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
