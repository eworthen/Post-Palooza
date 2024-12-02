<?php
/*
** Post Grid Card Layout
*/

// horizontal line seperation
echo '<hr class="w-full border-t border-gray-400 my-4" />';

// Align title to the left edge of the container
echo '<h2 class="text-xl font-bold text-gray-800 mb-4 ml-5">Post Grid Card Configuration</h2>';

// Outer container with padding and transparent background
echo '<div class="w-full p-2.5 bg-transparent flex gap-6">';

// First container - 360px wide (Card Preview)
echo '<div id="card-preview" class="w-[360px] bg-white border border-gray-200 shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col">';
    // Display Demo Post Image
    echo '<div style="width: 100%; height: 16rem; position: relative; overflow: hidden; background-color: #e2e8f0;">';
    echo '<img src="' . KEENADO_POST_PALOOZA_URL_DIR . 'app/assets/images/keenado-demo.jpg" alt="This is your title" style="position: absolute; top: 50%; left: 50%; width: 100%; height: auto; transform: translate(-50%, -50%); min-height: 100%;">';
    echo '</div>';

    // Display Post Content
    echo '<div class="p-4 flex flex-col flex-grow">';
    echo '<h2 id="preview-title" class="text-lg font-bold text-black mb-2 font-arial" style="color: #000000;">Keenado Post Grid Card Demo</h2>';
    echo '<div id="preview-description" class="text-lg text-gray-600 mb-4 font-arial" style="color: #454545;">Apply styles to this card and copy the shortcode to your page!</div>';
    echo '</div>';

    // Read More Button
    echo '<div class="p-4 mt-auto">';
    echo '<div class="bg-blue-600 text-white text-xs font-semibold py-2 px-4 rounded hover:bg-green-600 inline-block">VIEW POST &rsaquo;</div>';
    echo '</div>';

    // Post Author and Date with separator and icons
    echo '<div class="border-t border-gray-300 mt-2 py-2 px-4 text-xs text-gray-600 flex justify-between items-center">';

    // Author with icon
    echo '<span class="flex items-center">';
    echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
    echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A10.97 10.97 0 0112 15c2.733 0 5.254 1.04 7.121 2.804M12 12a4 4 0 100-8 4 4 0 000 8z" />';
    echo '</svg>';
    echo '<span class="font-semibold text-gray-800">Author</span>';
    echo '</span>';

    // Date with icon
    echo '<span class="flex items-center">';
    echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
    echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-6 8h6m-6 4h6M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />';
    echo '</svg>';
    echo '<span class="font-semibold text-gray-800">' . date('F j, Y') . '</span>';
    echo '</span>';

    echo '</div>';
echo '</div>'; // End of the first card container

// Control Section (Column 2) - Form for customization with rows of elements
echo '<div class="flex-grow p-5 bg-white border rounded flex flex-col justify-between">';

    // First Row (Title and Description Fonts & Colors)
    echo '<div class="flex flex-wrap gap-4">';

        // Title Font Family Selector
        echo '<div class="w-full sm:w-1/2">';
            echo '<label for="title-font-family" class="block mb-2">Title Font Family:</label>';
            echo '<select id="title-font-family" class="p-2 border rounded mb-2 w-full">';
                echo '<option value="font-arial">Arial</option>';
                echo '<option value="font-mono">Monospace</option>';
                echo '<option value="font-playfair">Playfair Display</option>';
                echo '<option value="font-sans">Sans</option>';
                echo '<option value="font-serif">Serif</option>';
                echo '<option value="font-tahoma">Tahoma</option>';
            echo '</select>';
        echo '</div>';

        // Title Font Color Selector
        echo '<div class="w-full sm:w-1/2">';
            echo '<label for="title-font-color" class="block mb-2">Title Font Color:</label>';
            echo '<input type="color" id="title-font-color" value="#000000">';
        echo '</div>';

        // Description Font Family Selector
        echo '<div class="w-full sm:w-1/2">';
            echo '<label for="description-font-family" class="block mb-2">Description Font Family:</label>';
            echo '<select id="description-font-family" class="p-2 border rounded mb-2 w-full">';
                echo '<option value="font-arial">Arial</option>';
                echo '<option value="font-mono">Monospace</option>';
                echo '<option value="font-playfair">Playfair Display</option>';
                echo '<option value="font-sans">Sans</option>';
                echo '<option value="font-serif">Serif</option>';
                echo '<option value="font-tahoma">Tahoma</option>';
            echo '</select>';
        echo '</div>';

        // Description Font Color Selector
        echo '<div class="w-full sm:w-1/2">';
            echo '<label for="description-font-color" class="block mb-2">Description Font Color:</label>';
            echo '<input type="color" id="description-font-color" value="#454545">';
        echo '</div>';
    echo '</div>'; // End of First Row

    // Second Row (Background, Number of Cards, and Post Category)
    echo '<div class="flex flex-wrap gap-4">';

        // Background Color Selector
        echo '<div class="w-full sm:w-1/2">';
            echo '<label for="bg-color" class="block mb-2 mt-2">Card Background:</label>';
            echo '<input type="color" id="bg-color" value="#FFFFFF">';
        echo '</div>';

        // Number of Cards Per Page
        echo '<div class="w-1/2 sm:w-1/5">';
            echo '<label for="cards-per-page" class="block mb-2 mt-2">Cards Per Page:</label>';
            echo '<input type="number" id="cards-per-page" class="p-2 border rounded mb-2 w-full" value="3">';
        echo '</div>';

        // Post Categories Dropdown
        echo '<div class="w-full sm:w-1/3">';
            echo '<label for="post-category" class="block mb-2">Post Category:</label>';
            echo '<select id="post-category" class="p-2 border rounded mb-2 w-full">';
                echo '<option value="">All Categories</option>';
                // Fetching the categories from WordPress
                $categories = get_categories(array('orderby' => 'name', 'order' => 'ASC'));
                foreach ($categories as $category) {
                    echo '<option value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
                }
            echo '</select>';
        echo '</div>';
    echo '</div>'; // End of Second Row

    // Generate Shortcode Button
    echo '<button id="generate-shortcode" class="bg-blue-600 text-white py-2 px-4 rounded mt-4">Generate Shortcode</button>';
    echo '</div>'; // End of Control Section

    // Shortcode Section (Column 3) - Smallest column, flexible to take less space
    echo '<div class="w-1/5 p-5 border rounded bg-white">';
        echo '<label class="block mb-2">Generated Shortcode:</label>';
        echo '<textarea id="shortcode-output" class="p-2 bg-white border rounded w-full h-[200px]" readonly>[post_palooza_grid_view]</textarea>';
        echo '<button id="copy-button" class="bg-blue-600 text-white py-2 px-4 rounded mt-4">Copy to clipboard</button>';
    echo '</div>';

    echo '</div>'; // End of the outer container

    // horizontal line seperation
    echo '<hr class="w-full border-t border-gray-400 my-4" />';

    /*
    ** Horizontal Post Grid Layout
    */

    // Align title to the left edge of the container
    echo '<h2 class="text-xl font-bold text-gray-800 mb-4 ml-5 mt-10">Horizontal Post Grid Configuration</h2>';

    // outer container
    echo '<div class="w-full p-2.5 bg-transparent flex gap-6" style="min-width:680px;">';

        // Start the post item with background color from $atts
        echo '<div id="post-item" class="flex flex-col md:flex-row justify-between items-stretch border border-gray-200 shadow-md hover:shadow-lg transition-shadow duration-300 bg-white w-[700px] h-64 md:h-64 sm:h-[480px]">';

        // Display Post Thumbnail (Image container with responsive order)
        echo '<div class="w-full md:w-1/3 h-64 relative overflow-hidden bg-gray-200 order-1 md:order-2">'; // Order changes on md screens
        echo '<img src="' . KEENADO_POST_PALOOZA_URL_DIR . 'app/assets/images/keenado-demo.jpg" alt="Demo Image" class="absolute inset-0 w-full h-full min-h-full object-cover object-center">';
        echo '</div>';                

        // Display Post Content (Title, Meta, and Description on the left)
        echo '<div class="p-4 flex flex-col justify-start w-full md:w-2/3 order-2 md:order-1">';

        // Display Post Category above the title, smaller and in blue
        echo '<h3 id="post-category" class="font-bold text-blue-600 mb-1" style="padding-left: 0.5rem;">CATEGORY</h3>';

        // Display Post Title at the top with larger font size and left padding
        echo '<h2 id="post-title" class="text-2xl font-bold font-arial" title="Keenado Horizontal Post Grid Demo" style="color:#000000; padding-left: 0.5rem;">Keenado Horizontal Post Grid Demo</h2>';

        // Post Meta (Author and Date) with icons, left-aligned under the title
        echo '<div class="post-meta flex justify-start items-center text-gray-600 text-sm gap-4 mt-2" style="padding-left: 0.5rem;">';

        // Author with SVG icon
        echo '<span class="flex items-center">';
        echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
        echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A10.97 10.97 0 0112 15c2.733 0 5.254 1.04 7.121 2.804M12 12a4 4 0 100-8 4 4 0 000 8z" />';
        echo '</svg>';
        echo '<span class="font-semibold text-gray-800">Author</span>';
        echo '</span>';

        // Date with SVG icon
        echo '<span class="flex items-center">';
        echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
        echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-6 8h6m-6 4h6M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />';
        echo '</svg>';
        echo '<span class="font-semibold text-gray-800">' . date('F j, Y') . '</span>';
        echo '</span>';

        echo '</div>'; // End of post-meta section

        // Add spacing between the meta section and the description
        echo '<div id="post-description" class="mt-4 text-base font-arial" style="color:#454545; padding-left: 0.5rem;">Apply styles to the card and copy the shortcode to your page!</div>';

        // Button container
        echo '<div class="p-2">';
        echo '<div class="bg-blue-600 text-white text-xs font-semibold py-1 px-2 hover:bg-green-600 transition-colors duration-300 inline-block">VIEW POST &raquo;</div>';
        echo '</div>'; // End of button container

        echo '</div>'; // End of post content (left side)

        echo '</div>'; // End of post-item link

        // Control Section (Column 2) - Form for customization with rows of elements
        echo '<div class="flex-grow p-5 bg-white border flex flex-col justify-between w-1/4">';

            // First Row (Title and Description Fonts & Colors)
            echo '<div class="flex flex-wrap gap-4">';

                // Title Font Family Selector
                echo '<div class="w-full sm:w-1/2">';
                    echo '<label for="horz-title-font-family" class="block mb-2">Title Font Family:</label>';
                    echo '<select id="horz-title-font-family" class="p-2 border rounded mb-2 w-full">';
                        echo '<option value="font-arial">Arial</option>';
                        echo '<option value="font-mono">Monospace</option>';
                        echo '<option value="font-playfair">Playfair Display</option>';
                        echo '<option value="font-sans">Sans</option>';
                        echo '<option value="font-serif">Serif</option>';
                        echo '<option value="font-tahoma">Tahoma</option>';
                    echo '</select>';
                echo '</div>';

                // Title Font Color Selector
                echo '<div class="w-full sm:w-1/2">';
                    echo '<label for="horz-title-font-color" class="block mb-2">Title Font Color:</label>';
                    echo '<input type="color" id="horz-title-font-color" value="#000000">';
                echo '</div>';

                // Description Font Family Selector
                echo '<div class="w-full sm:w-1/2">';
                    echo '<label for="horz-description-font-family" class="block mb-2">Description Font Family:</label>';
                    echo '<select id="horz-description-font-family" class="p-2 border rounded mb-2 w-full">';
                        echo '<option value="font-arial">Arial</option>';
                        echo '<option value="font-mono">Monospace</option>';
                        echo '<option value="font-playfair">Playfair Display</option>';
                        echo '<option value="font-sans">Sans</option>';
                        echo '<option value="font-serif">Serif</option>';
                        echo '<option value="font-tahoma">Tahoma</option>';
                    echo '</select>';
                echo '</div>';

                // Description Font Color Selector
                echo '<div class="w-full sm:w-1/2">';
                    echo '<label for="horz-description-font-color" class="block mb-2">Description Font Color:</label>';
                    echo '<input type="color" id="horz-description-font-color" value="#454545">';
                echo '</div>';
            echo '</div>'; // End of First Row

            // Second Row (Background, Number of Cards, and Post Category)
            echo '<div class="flex flex-wrap gap-4">';

                // Background Color Selector
                echo '<div class="w-full">';
                    echo '<label for="horz-bg-color" class="block mb-2 mt-2">Card Background:</label>';
                    echo '<input type="color" id="horz-bg-color" value="#FFFFFF">';
                echo '</div>';

                // Number of Cards Per Page
                echo '<div class="w-full sm:w-1/2">';
                    echo '<label for="horz-cards-per-page" class="block mb-2 mt-2">Cards Per Page:</label>';
                    echo '<input type="number" id="horz-cards-per-page" class="p-2 border rounded mb-2 w-full" value="3">';
                echo '</div>';

                // Post Categories Dropdown
                echo '<div class="w-full sm:w-1/2">';
                    echo '<label for="horz-post-category" class="block mb-2">Post Category:</label>';
                    echo '<select id="horz-post-category" class="p-2 border rounded mb-2 w-full">';
                        echo '<option value="">All Categories</option>';
                        // Fetching the categories from WordPress
                        $categories = get_categories(array('orderby' => 'name', 'order' => 'ASC'));
                        foreach ($categories as $category) {
                            echo '<option value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
                        }
                    echo '</select>';
                echo '</div>';
            echo '</div>'; // End of Second Row

            // Generate Shortcode Button
            echo '<button id="horz-generate-shortcode" class="bg-blue-600 text-white py-2 px-4 rounded mt-4">Generate Shortcode</button>';
            echo '</div>'; // End of Control Section

            // Shortcode Section (Column 3) - Smallest column, flexible to take less space
            echo '<div class="w-1/5 p-5 border bg-white">';
                echo '<label class="block mb-2">Generated Shortcode:</label>';
                echo '<textarea id="horz-shortcode-output" class="p-2 bg-white border rounded w-full h-[200px]" readonly>[post_palooza_grid_view]</textarea>';
                echo '<button id="horz-copy-button" class="bg-blue-600 text-white py-2 px-4 rounded mt-4">Copy to clipboard</button>';
            echo '</div>';

        echo '</div>';



// JavaScript for real-time updates and shortcode generation
echo '<script>
    // Function to update card styles
    function updateCardStyles() {
        // Update Title
        document.getElementById("preview-title").style.color = document.getElementById("title-font-color").value;
        document.getElementById("preview-title").className = "text-lg font-bold mb-2 " + document.getElementById("title-font-family").value;
        
        // Update Description
        document.getElementById("preview-description").style.color = document.getElementById("description-font-color").value;
        document.getElementById("preview-description").className = "text-lg mb-4 " + document.getElementById("description-font-family").value;
        
        // Update Background
        document.getElementById("card-preview").style.backgroundColor = document.getElementById("bg-color").value;
    }

    function updateHorizontalStyles() {
        // Update Title
        document.getElementById("post-title").style.color = document.getElementById("horz-title-font-color").value;
        document.getElementById("post-title").className = "text-lg font-bold mb-2 " + document.getElementById("horz-title-font-family").value;
        
        // Update Description
        document.getElementById("post-description").style.color = document.getElementById("horz-description-font-color").value;
        document.getElementById("post-description").className = "text-lg mb-4 " + document.getElementById("horz-description-font-family").value;
        
        // Update Background
        document.getElementById("post-item").style.backgroundColor = document.getElementById("horz-bg-color").value;
    }



    // Event listeners for live updates (cards)
    document.getElementById("title-font-family").addEventListener("change", updateCardStyles);
    document.getElementById("title-font-color").addEventListener("change", updateCardStyles);
    document.getElementById("description-font-family").addEventListener("change", updateCardStyles);
    document.getElementById("description-font-color").addEventListener("change", updateCardStyles);
    document.getElementById("bg-color").addEventListener("change", updateCardStyles);

    // Event listeners for live updates (horizontal)
    document.getElementById("horz-title-font-family").addEventListener("change", updateHorizontalStyles);
    document.getElementById("horz-title-font-color").addEventListener("change", updateHorizontalStyles);
    document.getElementById("horz-description-font-family").addEventListener("change", updateHorizontalStyles);
    document.getElementById("horz-description-font-color").addEventListener("change", updateHorizontalStyles);
    document.getElementById("horz-bg-color").addEventListener("change", updateHorizontalStyles);

    // Copy shortcode button logic (cards)
    document.getElementById("copy-button").addEventListener("click", function() {
        var textarea = document.getElementById("shortcode-output");
        textarea.select();
        document.execCommand("copy");
        this.textContent = "Copied!";
        setTimeout(() => { this.textContent = "Copy to clipboard"; }, 2000);
    });

    // Copy shortcode button logic (horizontal)
    document.getElementById("horz-copy-button").addEventListener("click", function() {
        var textarea = document.getElementById("horz-shortcode-output");
        textarea.select();
        document.execCommand("copy");
        this.textContent = "Copied!";
        setTimeout(() => { this.textContent = "Copy to clipboard"; }, 2000);
    });

    // Generate shortcode (cards)
    document.getElementById("generate-shortcode").addEventListener("click", function() {
        const titleFontFamily = document.getElementById("title-font-family").value;
        const titleFontColor = document.getElementById("title-font-color").value;
        const descriptionFontFamily = document.getElementById("description-font-family").value;
        const descriptionFontColor = document.getElementById("description-font-color").value;
        const bgColor = document.getElementById("bg-color").value;
        const cardsPerPage = document.getElementById("cards-per-page").value;
        const category = document.getElementById("post-category").value;

        let shortcode = `[post_palooza_grid_view title_font_family="${titleFontFamily}" title_font_color="${titleFontColor}" description_font_family="${descriptionFontFamily}" description_font_color="${descriptionFontColor}" bg_color="${bgColor}" posts_per_page="${cardsPerPage}" category="${category}"]`;

        document.getElementById("shortcode-output").innerText = shortcode;
    });

    // Generate shortcode (horizontal)
    document.getElementById("horz-generate-shortcode").addEventListener("click", function() {
        const horzTitleFontFamily = document.getElementById("horz-title-font-family").value;
        const horzTitleFontColor = document.getElementById("horz-title-font-color").value;
        const horzDescriptionFontFamily = document.getElementById("horz-description-font-family").value;
        const horzDescriptionFontColor = document.getElementById("horz-description-font-color").value;
        const horzBgColor = document.getElementById("horz-bg-color").value;
        const horzCardsPerPage = document.getElementById("horz-cards-per-page").value;
        const horzCategory = document.getElementById("horz-post-category").value;

        let horzShortcode = `[post_palooza_horizontal_grid_view title_font_family="${horzTitleFontFamily}" title_font_color="${horzTitleFontColor}" description_font_family="${horzDescriptionFontFamily}" description_font_color="${horzDescriptionFontColor}" bg_color="${horzBgColor}" posts_per_page="${horzCardsPerPage}" category="${horzCategory}"]`;

        document.getElementById("horz-shortcode-output").innerText = horzShortcode;
    });
</script>';
?>
