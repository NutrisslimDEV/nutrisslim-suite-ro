<?php
/**
 * Romanian City Validator
 * Handles city validation and autocomplete for Romanian addresses
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Map province names from JSON to province codes used in checkout
 * 
 * @param string $province_name Province name from JSON
 * @return string|false Province code or false if not found
 */
function map_province_name_to_code($province_name) {
    // Normalize province name (remove diacritics, lowercase)
    $normalized = remove_diacritics(strtolower(trim($province_name)));
    
    // Mapping: JSON province name (normalized) => checkout province code
    $mapping = array(
        'bucuresti' => 'B',
        'alba' => 'AB',
        'arad' => 'AR',
        'arges' => 'AG',
        'bacau' => 'BC',
        'bihor' => 'BH',
        'bistrita-nasaud' => 'BN',
        'braila' => 'BR',
        'botosani' => 'BT',
        'brasov' => 'BV',
        'buzau' => 'BZ',
        'caras-severin' => 'CS',
        'calarasi' => 'CL',
        'cluj' => 'CJ',
        'constanta' => 'CT',
        'covasna' => 'CV',
        'dambovita' => 'DB',
        'dolj' => 'DJ',
        'galati' => 'GL',
        'giurgiu' => 'GR',
        'gorj' => 'GJ',
        'harghita' => 'HR',
        'hunedoara' => 'HD',
        'ialomita' => 'IL',
        'iasi' => 'IS',
        'ilfov' => 'IF',
        'maramures' => 'MM',
        'mehedinti' => 'MH',
        'mures' => 'MS',
        'neamt' => 'NT',
        'olt' => 'OT',
        'prahova' => 'PH',
        'satu mare' => 'SM',
        'salaj' => 'SJ',
        'sibiu' => 'SB',
        'suceava' => 'SV',
        'teleorman' => 'TR',
        'timis' => 'TM',
        'tulcea' => 'TL',
        'vaslui' => 'VS',
        'valcea' => 'VL',
        'vrancea' => 'VN',
    );
    
    return isset($mapping[$normalized]) ? $mapping[$normalized] : false;
}

/**
 * Remove Romanian diacritics from string for comparison
 * 
 * @param string $string Input string
 * @return string String without diacritics
 */
function remove_diacritics($string) {
    $diacritics = array(
        'ă' => 'a', 'â' => 'a', 'î' => 'i', 'ș' => 's', 'ț' => 't',
        'Ă' => 'A', 'Â' => 'A', 'Î' => 'I', 'Ș' => 'S', 'Ț' => 'T',
    );
    return strtr($string, $diacritics);
}

/**
 * Load and process Romanian address data from JSON
 * 
 * @return array|false Processed city data or false on error
 */
function load_romanian_cities_data() {
    // Check cache first
    $cached_data = get_transient('romanian_cities_data');
    if ($cached_data !== false) {
        return $cached_data;
    }
    
    // Get JSON file path
    $json_file = plugin_dir_path(dirname(__FILE__)) . 'ro-address.json';
    
    if (!file_exists($json_file)) {
        error_log('Romanian City Validator: ro-address.json file not found at ' . $json_file);
        return false;
    }
    
    // Read JSON file
    $json_content = file_get_contents($json_file);
    if ($json_content === false) {
        error_log('Romanian City Validator: Failed to read ro-address.json');
        return false;
    }
    
    // Parse JSON
    $addresses = json_decode($json_content, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('Romanian City Validator: JSON parse error - ' . json_last_error_msg());
        return false;
    }
    
    if (!is_array($addresses)) {
        error_log('Romanian City Validator: Invalid JSON structure');
        return false;
    }
    
    // Process addresses: group by province code -> city -> zipcodes
    $cities_data = array();
    
    foreach ($addresses as $address) {
        if (!isset($address['country (province)']) || !isset($address['city']) || !isset($address['zipcode'])) {
            continue;
        }
        
        $province_name = $address['country (province)'];
        $city_name = trim($address['city']);
        $zipcode = trim($address['zipcode']);
        
        if (empty($province_name) || empty($city_name) || empty($zipcode)) {
            continue;
        }
        
        // Map province name to code
        $province_code = map_province_name_to_code($province_name);
        if ($province_code === false) {
            // Log unmapped province for debugging
            error_log('Romanian City Validator: Unmapped province: ' . $province_name);
            continue;
        }
        
        // Initialize province if not exists
        if (!isset($cities_data[$province_code])) {
            $cities_data[$province_code] = array();
        }
        
        // Initialize city if not exists
        if (!isset($cities_data[$province_code][$city_name])) {
            $cities_data[$province_code][$city_name] = array();
        }
        
        // Add zipcode if not already present
        if (!in_array($zipcode, $cities_data[$province_code][$city_name])) {
            $cities_data[$province_code][$city_name][] = $zipcode;
        }
    }
    
    // Sort cities alphabetically within each province
    foreach ($cities_data as $province_code => &$cities) {
        ksort($cities);
        // Sort zipcodes within each city
        foreach ($cities as &$zipcodes) {
            sort($zipcodes);
        }
    }
    
    // Cache for 24 hours
    set_transient('romanian_cities_data', $cities_data, DAY_IN_SECONDS);
    
    return $cities_data;
}

/**
 * Get cities for autocomplete
 * AJAX endpoint: get_romanian_cities
 */
function ajax_get_romanian_cities() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'romanian_cities_nonce')) {
        wp_send_json_error(array('message' => __('Verificarea de securitate a eșuat.', 'nutrisslim-suiteV2')));
    }
    
    $province_code = isset($_POST['province_code']) ? sanitize_text_field($_POST['province_code']) : '';
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    
    // Minimum 2 characters for search
    if (strlen($search) < 2) {
        wp_send_json_success(array('results' => array()));
    }
    
    $cities_data = load_romanian_cities_data();
    if ($cities_data === false) {
        wp_send_json_error(array('message' => __('Nu s-au putut încărca datele despre orașe.', 'nutrisslim-suiteV2')));
    }
    
    $results = array();
    $normalized_search = remove_diacritics(strtolower($search));
    
    // Filter by province if provided
    $provinces_to_search = array();
    if (!empty($province_code)) {
        if (isset($cities_data[$province_code])) {
            $provinces_to_search[$province_code] = $cities_data[$province_code];
        }
    } else {
        $provinces_to_search = $cities_data;
    }
    
    // Search cities
    foreach ($provinces_to_search as $prov_code => $cities) {
        foreach ($cities as $city_name => $zipcodes) {
            $normalized_city = remove_diacritics(strtolower($city_name));
            
            // Check if search term matches city name
            if (strpos($normalized_city, $normalized_search) !== false) {
                // Format display text
                $zipcodes_str = implode(', ', array_slice($zipcodes, 0, 3));
                if (count($zipcodes) > 3) {
                    $zipcodes_str .= '...';
                }
                
                $display = count($zipcodes) > 1 
                    ? $city_name . ' (' . $zipcodes_str . ')'
                    : $city_name;
                
                $results[] = array(
                    'id' => $city_name,
                    'text' => $display,
                    'city' => $city_name,
                    'zipcodes' => $zipcodes,
                    'province_code' => $prov_code,
                );
            }
        }
    }
    
    // Limit results to 50
    $results = array_slice($results, 0, 50);
    
    wp_send_json_success(array('results' => $results));
}
add_action('wp_ajax_get_romanian_cities', 'ajax_get_romanian_cities');
add_action('wp_ajax_nopriv_get_romanian_cities', 'ajax_get_romanian_cities');

/**
 * Check Romanian city on checkout and add order note if not in database
 * This does NOT block the order - just logs a warning for review
 * 
 * @param int $order_id Order ID
 */
function check_romanian_city_after_order($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) {
        return;
    }
    
    $cities_data = load_romanian_cities_data();
    if ($cities_data === false) {
        return;
    }
    
    $warnings = array();
    
    // Check billing city
    $billing_state = $order->get_billing_state();
    $billing_city = $order->get_billing_city();
    
    if (!empty($billing_state) && !empty($billing_city)) {
        if (!validate_city_for_province($billing_city, $billing_state, $cities_data)) {
            $warnings[] = sprintf(
                __('Atenție: Orașul de facturare "%s" nu a fost găsit în baza noastră de date. Vă rugăm să verificați adresa.', 'nutrisslim-suiteV2'),
                $billing_city
            );
        }
    }
    
    // Check shipping city (if different from billing)
    $shipping_state = $order->get_shipping_state();
    $shipping_city = $order->get_shipping_city();
    
    if (!empty($shipping_state) && !empty($shipping_city) && $shipping_city !== $billing_city) {
        if (!validate_city_for_province($shipping_city, $shipping_state, $cities_data)) {
            $warnings[] = sprintf(
                __('Atenție: Orașul de livrare "%s" nu a fost găsit în baza noastră de date. Vă rugăm să verificați adresa.', 'nutrisslim-suiteV2'),
                $shipping_city
            );
        }
    }
    
    // Add order note if there are warnings
    if (!empty($warnings)) {
        $order->add_order_note(implode("\n", $warnings));
    }
}
add_action('woocommerce_checkout_order_created', 'check_romanian_city_after_order', 10, 1);

/**
 * Validate if city exists for given province
 * 
 * @param string $city_name City name to validate
 * @param string $province_code Province code
 * @param array $cities_data Cities data array
 * @return bool True if valid, false otherwise
 */
function validate_city_for_province($city_name, $province_code, $cities_data) {
    if (!isset($cities_data[$province_code])) {
        return false;
    }
    
    $normalized_city = remove_diacritics(strtolower(trim($city_name)));
    
    // Check exact match first
    foreach ($cities_data[$province_code] as $valid_city => $zipcodes) {
        $normalized_valid = remove_diacritics(strtolower(trim($valid_city)));
        
        // Exact match (case and diacritic insensitive)
        if ($normalized_city === $normalized_valid) {
            return true;
        }
    }
    
    return false;
}

/**
 * Clear city data cache (for admin use)
 */
function clear_romanian_cities_cache() {
    delete_transient('romanian_cities_data');
}
// Allow manual cache clearing via admin action if needed
if (isset($_GET['clear_romanian_cities_cache']) && current_user_can('manage_options')) {
    clear_romanian_cities_cache();
    add_action('admin_notices', function() {
        echo '<div class="notice notice-success"><p>' . __('Cache-ul pentru orașele din România a fost șters.', 'nutrisslim-suiteV2') . '</p></div>';
    });
}
