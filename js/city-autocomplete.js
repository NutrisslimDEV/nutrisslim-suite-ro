/**
 * Romanian City Autocomplete
 * Simple inline suggestions as you type
 */

(function($) {
    'use strict';

    // Configuration
    const CONFIG = {
        minChars: 2,
        debounceDelay: 300,
        debug: true
    };

    function log(msg, data) {
        if (CONFIG.debug) console.log('[CityAutocomplete]', msg, data || '');
    }

    // Simple debounce
    let debounceTimer = null;
    function debounce(fn, delay) {
        return function(...args) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => fn.apply(this, args), delay);
        };
    }

    // Create suggestion dropdown
    function createDropdown(fieldId) {
        const id = fieldId + '_suggestions';
        let $dropdown = $('#' + id);
        if (!$dropdown.length) {
            $dropdown = $('<ul id="' + id + '" class="city-suggestions"></ul>');
            $('#' + fieldId).after($dropdown);
        }
        return $dropdown;
    }

    // Fetch cities from server
    function fetchCities(searchTerm, provinceCode, callback) {
        if (typeof cityAutocomplete === 'undefined') {
            log('cityAutocomplete not defined');
            return;
        }

        $.ajax({
            url: cityAutocomplete.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'get_romanian_cities',
                nonce: cityAutocomplete.nonce,
                search: searchTerm,
                province_code: provinceCode || ''
            },
            success: function(response) {
                log('Response:', response);
                if (response.success && response.data && response.data.results) {
                    callback(response.data.results);
                } else {
                    callback([]);
                }
            },
            error: function() {
                callback([]);
            }
        });
    }

    // Show suggestions
    function showSuggestions($dropdown, results, $input, postcodeFieldId) {
        $dropdown.empty();

        if (results.length === 0) {
            $dropdown.hide();
            return;
        }

        results.slice(0, 10).forEach(function(item) {
            const $li = $('<li class="city-suggestion-item"></li>');
            $li.text(item.city);
            if (item.zipcodes && item.zipcodes.length > 0) {
                $li.append($('<span class="city-zipcode"></span>').text(' (' + item.zipcodes[0] + ')'));
            }
            $li.on('mousedown', function(e) {
                e.preventDefault();
                
                // Set city value
                $input.val(item.city);
                $dropdown.hide();
                $input.trigger('change');
                
                // Auto-fill postal code if available
                if (item.zipcodes && item.zipcodes.length > 0 && postcodeFieldId) {
                    const $postcodeField = $('#' + postcodeFieldId);
                    if ($postcodeField.length) {
                        $postcodeField.val(item.zipcodes[0]);
                        $postcodeField.trigger('change');
                        log('Auto-filled postcode:', item.zipcodes[0]);
                    }
                }
            });
            $dropdown.append($li);
        });

        $dropdown.show();
    }

    // Hide suggestions
    function hideSuggestions($dropdown) {
        if ($dropdown) $dropdown.hide();
    }

    // Initialize autocomplete on a field
    function initField(fieldId, provinceFieldId, postcodeFieldId) {
        const $input = $('#' + fieldId);
        if (!$input.length) {
            log('Field not found:', fieldId);
            return;
        }

        // Skip if already initialized
        if ($input.data('city-init')) return;
        $input.data('city-init', true);

        log('Initializing field:', fieldId, 'postcode field:', postcodeFieldId);

        const $dropdown = createDropdown(fieldId);
        const $provinceField = $('#' + provinceFieldId);

        // Debounced search function
        const doSearch = debounce(function(term) {
            const province = $provinceField.length ? $provinceField.val() : '';
            log('Searching:', term, 'Province:', province);
            
            fetchCities(term, province, function(results) {
                showSuggestions($dropdown, results, $input, postcodeFieldId);
            });
        }, CONFIG.debounceDelay);

        // Input event - trigger search
        $input.on('input', function() {
            const val = $(this).val().trim();
            if (val.length >= CONFIG.minChars) {
                doSearch(val);
            } else {
                hideSuggestions($dropdown);
            }
        });

        // Focus event - show suggestions if we have text
        $input.on('focus', function() {
            const val = $(this).val().trim();
            if (val.length >= CONFIG.minChars) {
                doSearch(val);
            }
        });

        // Blur event - hide suggestions
        $input.on('blur', function() {
            setTimeout(function() {
                hideSuggestions($dropdown);
            }, 150);
        });

        // Keyboard navigation
        $input.on('keydown', function(e) {
            const $items = $dropdown.find('.city-suggestion-item');
            const $active = $items.filter('.active');

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                if ($active.length) {
                    $active.removeClass('active');
                    const $next = $active.next();
                    if ($next.length) $next.addClass('active');
                    else $items.first().addClass('active');
                } else {
                    $items.first().addClass('active');
                }
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                if ($active.length) {
                    $active.removeClass('active');
                    const $prev = $active.prev();
                    if ($prev.length) $prev.addClass('active');
                    else $items.last().addClass('active');
                } else {
                    $items.last().addClass('active');
                }
            } else if (e.key === 'Enter' && $active.length) {
                e.preventDefault();
                $active.trigger('mousedown');
            } else if (e.key === 'Escape') {
                hideSuggestions($dropdown);
            }
        });

        // Clear city when province changes
        if ($provinceField.length) {
            $provinceField.on('change', function() {
                $input.val('');
                hideSuggestions($dropdown);
            });
        }
    }

    // Initialize all city fields
    function init() {
        log('Initializing city autocomplete...');
        initField('billing_city', 'billing_state', 'billing_postcode');
        initField('shipping_city', 'shipping_state', 'shipping_postcode');
    }

    // Run on document ready
    $(document).ready(function() {
        log('Document ready');
        
        // Initial load
        setTimeout(init, 300);

        // Re-initialize when WooCommerce updates checkout
        $(document.body).on('updated_checkout', function() {
            log('Checkout updated, re-initializing...');
            // Remove init flag to allow re-initialization
            $('#billing_city, #shipping_city').removeData('city-init');
            setTimeout(init, 100);
        });
    });

    // Close suggestions when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.city-suggestions, #billing_city, #shipping_city').length) {
            $('.city-suggestions').hide();
        }
    });

})(jQuery);
