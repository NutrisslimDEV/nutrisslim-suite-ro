jQuery(document).ready(function($) {

    // Find the custom field element
    var priceForTwoField = $('#_price_for_two');
    // Create a new span element to hold additional text
    var customTextElement = $('<span style="font-weight:bold;color:red;" id="custom-price-for-two-text"></span>');
    // Insert the custom text element after the custom field
    priceForTwoField.closest('.form-field').append(customTextElement);

    // Find the custom field element
    var priceForTwoField = $('#_price_for_three');
    // Create a new span element to hold additional text
    var customTextElement = $('<span style="font-weight:bold;color:red;" id="custom-price-for-three-text"></span>');
    // Insert the custom text element after the custom field
    priceForTwoField.closest('.form-field').append(customTextElement);    

    // Function to check and update the price
    function updatePriceForThree() {
        var priceForThreeField = $('#_price_for_three');
        var priceForThreeText = $('#custom-price-for-three-text');
        
        var price = parseFloat(priceForThreeField.val());
        var decimals = parseInt(priceForThreeField.data('decimals'));
        var pricePerProduct = (price / 3).toFixed(decimals);
        
        // Check if price per product has the correct number of decimals
        var totalCalculatedPrice = (pricePerProduct * 3).toFixed(decimals);

        if (totalCalculatedPrice != price.toFixed(decimals)) {
            priceForThreeText.text('This price is not applicable');
        } else {
            priceForThreeText.text(pricePerProduct + ' each');
        }
    }

    // Call the function on document ready
    updatePriceForThree();

    // Attach the function to the input field's change event
    $('#_price_for_three').on('input', function() {
        updatePriceForThree();
    });

    // Function to check and update the price
    function updatePriceForTwo() {
        var priceForTwoField = $('#_price_for_two');
        var priceForTwoText = $('#custom-price-for-two-text');
        
        var price = parseFloat(priceForTwoField.val());
        var decimals = parseInt(priceForTwoField.data('decimals'));
        var pricePerProduct = (price / 2).toFixed(decimals);
        
        // Check if price per product has the correct number of decimals
        var totalCalculatedPrice = (pricePerProduct * 2).toFixed(decimals);

        if (totalCalculatedPrice != price.toFixed(decimals)) {
            priceForTwoText.text('This price is not applicable');
        } else {
            priceForTwoText.text(pricePerProduct + ' each');
        }
    }

    // Call the function on document ready
    updatePriceForTwo();

    // Attach the function to the input field's change event
    $('#_price_for_two').on('input', function() {
        updatePriceForTwo();
    });    

    // Disable draggability
    $('.postbox').addClass('no-drag');

    // Collapse all postboxes by default
    $('.postbox').addClass('closed');
    $('#submitdiv').removeClass('closed');
    $('#woocommerce-product-data').removeClass('closed');

    // Collapse all ACF nested fields and subfields
    // $('.acf-field .acf-input').hide();

    // Define descriptions for each ACF field group by their key part of the ID
    var groupDescriptions = {
        '660d0bbae5e72': 'This field group is designed for sections alternating between text and images on opposite sides, with the arrangement flipping from one side to the other in each successive section.',
        '66042178009da': 'List all important product ingredients.',
        '660f056371218': 'Image in the middle, Positive and negative lists on the side. There are two sections like this on the page: one above and other below.'
        // Add more field group descriptions here
    };

    // Iterate over each ACF postbox
    $('.postbox.acf-postbox').each(function() {
        var postboxId = this.id;
        // Extract the key part of the ID
        var keyMatch = postboxId.match(/acf-group_(\w+)/);

        if (keyMatch && keyMatch[1] && groupDescriptions[keyMatch[1]]) {
            // Append the description to the group title
            $(this).find('.postbox-header .hndle').after('<p>' + groupDescriptions[keyMatch[1]] + '</p>');
        }
    });

    function updatePanelClass() {
        var productType = $('#product-type').val(); // Get the current value of the product type dropdown
        var panelWrap = $('.panel-wrap.product_data'); // Target the div you want to modify

        // Remove the class if it's there
        panelWrap.removeClass('is_bundle');

        // Add 'is_bundle' class if the product type is 'nutrisslim'
        if (productType === 'nutrisslim') {
            panelWrap.addClass('is_bundle');
        }
    }    

    $('select#product-type').on('change', function() {
        var productType = $(this).val();
        if (productType === 'nutrisslim') {
            $('div.panel-wrap.product_data').addClass('is_boundle');
            // $('#woocommerce-product-data ul.product_data_tabs li.general_options').addClass('active');
            // $('#woocommerce-product-data ul.product_data_tabs li.bundle_products_options').removeClass('active');
            // $('.options_group').addClass('show_if_bundle');
        } else {
            $('div.panel-wrap.product_data').removeClass('is_boundle');
            // $('.options_group').removeClass('show_if_bundle');
        }
    });

    /*
    function formatIngredient(ingredient) {
        console.log('formatIngredient called');
        
        if (!ingredient.id) {
            return ingredient.text;
        }

        var $ingredient = $('<span></span>');

        // Fetch ingredient data
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'get_ingredient_data',
                ingredient_id: ingredient.id
            },
            async: false, // Ensure the data is fetched before displaying the item
            success: function(response) {
                if (response.success) {
                    var data = response.data;
                    var description = data.description.length > 300 ? data.description.substring(0, 300) + '...' : data.description;
                    var thumbnail = data.thumbnail;

                    // Append thumbnail and description
                    $ingredient.append('<img src="' + thumbnail + '" style="width: 20px; height: 20px; margin-right: 5px;" />');
                    $ingredient.append('<strong>' + ingredient.text + '</strong>');
                    $ingredient.append('<div style="font-size: 12px; color: #888;">' + description + '</div>');
                }
            }
        });

        return $ingredient;
    }

    // Ensure the correct field selector
    var $acfField = $('#acf-field_66042178a198b');
    if ($acfField.length) {
        // Initialize Select2 with custom format function
        $acfField.select2({
            templateResult: formatIngredient,
            templateSelection: formatIngredient,
            ajax: {
                url: ajaxurl,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        // console.log('Initializing Select2 on field 1:', $acfField);
                        action: 'search_ingredients',
                        term: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        // console.log('Initializing Select2 on field 2:', $acfField);
                        results: data
                    };
                }
            }
        });
    } else {
        console.error('ACF field not found');
    }
    */
    
    updatePanelClass();

});