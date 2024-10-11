<?php
// Move the title and align it to the left edge of the container
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
echo '<div class="w-1/5 p-5 border rounded bg-gray-100">';
    echo '<label class="block mb-2">Generated Shortcode:</label>';
    echo '<textarea id="shortcode-output" class="p-2 bg-white border rounded w-full h-[200px]" readonly>[post_palooza_grid_view]</textarea>';
    echo '<button id="copy-button" class="bg-blue-600 text-white py-2 px-4 rounded mt-4">Copy to clipboard</button>';
echo '</div>';

echo '</div>'; // End of the outer container

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

    // Add event listeners for live updates
    document.getElementById("title-font-family").addEventListener("change", updateCardStyles);
    document.getElementById("title-font-color").addEventListener("change", updateCardStyles);
    document.getElementById("description-font-family").addEventListener("change", updateCardStyles);
    document.getElementById("description-font-color").addEventListener("change", updateCardStyles);
    document.getElementById("bg-color").addEventListener("change", updateCardStyles);

    // Copy shortcode button logic
    document.getElementById("copy-button").addEventListener("click", function() {
        var textarea = document.getElementById("shortcode-output");
        textarea.select();
        document.execCommand("copy");
        this.textContent = "Copied!";
        setTimeout(() => { this.textContent = "Copy to clipboard"; }, 2000);
    });

    // Generate shortcode
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
</script>';
?>
