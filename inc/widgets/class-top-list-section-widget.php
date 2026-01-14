<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Top_List_Section_Widget extends Widget_Base {

    public function get_name() {
        return 'top_list_section';
    }

    public function get_title() {
        return __( 'Top List Section', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-editor-list-ul';
    }

    public function get_categories() {
        return [ 'nutrisslim' ]; // Assigning the widget to the 'nutrisslim' category
    }

    protected function _register_controls() {
        // You can register widget controls here if needed.
    }

    protected function render() {
        $lists_section = get_field('lists_section');
        if (empty($lists_section)) {
            // No lists_section data — bail or display fallback
            return;
        }
        ?>
<style>
.list-section h2 {
    text-align: center;
}

.lists-container {
    display: flex;
}

.lists-container .list {
    flex-basis: 35%;
    max-width: 35%;
    padding: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.lists-container .middle-img {
    flex-basis: 30%;
    max-width: 30%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.lists-container button {
    background-color: #1FB15A;
    border-radius: 35px;
    padding: 8px 40px;
    margin-top: 10px;
    border-color: #0ea44b;
}
</style>
<?php
    
        global $post;
        $product = wc_get_product($post->ID);
    
        // Grab the first repeater row
        $first_section = $lists_section[0] ?? [];
    
        // If empty, we can bail or display fallback
        if (empty($first_section)) {
            echo '<p>No data for first section</p>';
            return;
        }
    
        echo '<div class="list-section top-list-section">';
    
        // Section title
        if (! empty($first_section['section_title'])) {
            echo '<h2>' . esc_html($first_section['section_title']) . '</h2>';
        }
    
        echo '<div class="lists-container">';
    
        // LEFT COLUMN (Check if it exists)
        if (! empty($first_section['lists']['list-column'][0])) {
            $left_column = $first_section['lists']['list-column'][0];
            echo '<div class="list greenCheckList checkPlus">';
            echo '<div class="inner">';
            if (! empty($left_column['list_title'])) {
                echo '<h3>' . esc_html($left_column['list_title']) . '</h3>';
            }
            if (! empty($left_column['list_items']) && is_array($left_column['list_items'])) {
                echo '<ul>';
                foreach ($left_column['list_items'] as $item) {
                    echo '<li>' . esc_html($item['list_item'] ?? '') . '</li>';
                }
                echo '</ul>';
            }
            echo '</div>';
            echo '</div>';
        }
    
        // MIDDLE IMAGE + ADD TO CART
        echo '<div class="middle-img">';
        if (
            ! empty($first_section['image']) 
            && ! empty($first_section['image']['sizes']) 
            && ! empty($first_section['image']['sizes']['medium_large'])
        ) {
            $img_url     = $first_section['image']['sizes']['medium_large'];
            $img_width   = $first_section['image']['sizes']['medium_large-width'] ?? '';
            $img_height  = $first_section['image']['sizes']['medium_large-height'] ?? '';
            echo '<img width="' . esc_attr($img_width) . '" 
                       height="' . esc_attr($img_height) . '" 
                       src="' . esc_url($img_url) . '" 
                       class="img-responsive" />';
        } else {
            // Fallback or skip
            echo '<!-- No valid image found. -->';
        }
    
        // Add to cart form
        if (! empty($product)) {
            echo '<form class="addToCartForm">';
            echo '<button class="elementor-button add-to-cart-icon" 
                         data-product-id="' . esc_attr($product->get_id()) . '" 
                         data-quantity="1" 
                         type="submit">'
                    . __('Add to cart', 'nutrisslim-suiteV2') .
                 '</button>';
            echo '</form>';
        }
        echo '</div>';
    
        // RIGHT COLUMN (Check if it exists)
        if (! empty($first_section['lists']['list-column'][1])) {
            $right_column = $first_section['lists']['list-column'][1];
            echo '<div class="list greenCheckList checkMinus">';
            echo '<div class="inner">';
            if (! empty($right_column['list_title'])) {
                echo '<h3>' . esc_html($right_column['list_title']) . '</h3>';
            }
            if (! empty($right_column['list_items']) && is_array($right_column['list_items'])) {
                echo '<ul>';
                foreach ($right_column['list_items'] as $item) {
                    echo '<li>' . esc_html($item['list_item'] ?? '') . '</li>';
                }
                echo '</ul>';
            }
            echo '</div>';
            echo '</div>';
        }
    
        echo '</div>'; // .lists-container
        echo '</div>'; // .top-list-section
    }
    
}