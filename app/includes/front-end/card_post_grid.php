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
        echo '<div class="post-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">';

        while ($query->have_posts()) {
            $query->the_post();

            // Start the post item with background color from $atts
            echo '<a href="' . get_the_permalink() . '" class="post-item block border border-gray-200 shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300 h-full flex flex-col" style="background-color:' . esc_attr($atts['bg_color']) . '">';

            // Display Post Thumbnail or Placeholder
            if (has_post_thumbnail()) {
                echo '<div style="width: 100%; height: 16rem; position: relative; overflow: hidden; background-color: #e2e8f0;">';
                echo '<img src="' . get_the_post_thumbnail_url(null, 'full') . '" alt="' . get_the_title() . '" style="position: absolute; top: 50%; left: 50%; width: 100%; height: auto; transform: translate(-50%, -50%); min-height: 100%;">';
                echo '</div>';
            } else {
                // Placeholder for posts without thumbnails
                echo '<div style="width: 100%; height: 16rem; position: relative; overflow: hidden; background-color: #f7fafc; border: 1px solid #cbd5e0; display: flex; align-items: center; justify-content: center;">';
                echo '<span style="text-align: center; color: #4a5568;">Please add a featured image</span>';
                echo '</div>';
            }

            // Display Post Content
            echo '<div class="p-4 flex flex-col flex-grow">';

            // Display Post Title with 2-line truncation and applied font styles from $atts
            echo '<h2 class="post-title text-lg font-bold ' . esc_attr($atts['title_font_family']) . ' mb-2 line-clamp-2" title="' . get_the_title() . '" style="color:' . esc_attr($atts['title_font_color']) . ';">' . get_the_title() . '</h2>';

            // Display Post Description / Excerpt, with font styles from $atts
            $excerpt = wp_trim_words(get_the_excerpt(), 20, '...');
            echo '<div class="post-description ' . esc_attr($atts['description_font_family']) . ' mb-4" title="' . esc_html($excerpt) . '" style="color:' . esc_attr($atts['description_font_color']) . ';">' . esc_html($excerpt) . '</div>';

            echo '</div>'; // End of post content

            // Read More Button styled as a div with custom classes
            echo '<div class="p-4 mt-auto">';
            echo '<div class="bg-blue-600 text-white text-xs font-semibold py-2 px-4 rounded hover:bg-green-600 inline-block">VIEW POST &rsaquo;</div>';
            echo '</div>';

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
                    echo str_replace('<span', '<span class="block px-3 py-2 border border-gray text-black rounded"', $page_link);  // Styling the current page link
                    echo '</li>';
                } else {
                    // Append TailwindCSS classes to the clickable links
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