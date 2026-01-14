<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Product_Video_Description_Widget extends Widget_Base {

    public function get_name() {
        return 'product_video_description';
    }

    public function get_title() {
        return __( 'Product Video Description', 'your-plugin-text-domain' );
    }

    public function get_icon() {
        return 'eicon-video-camera';
    }

    public function get_categories() {
        return [ 'nutrisslim' ]; // Change to your desired widget category
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'your-plugin-text-domain' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Optionally add controls here if needed.

        $this->end_controls_section();
    }

    protected function render() {
        $post_id = get_the_ID();
        $vimeo_video_id = get_field('vimeo', $post_id);

	$media_type = get_field('media_type', $post_id);

        $image = get_field('image', $post_id);

        if ($vimeo_video_id == '') {
            // return;
        }    
        ?>
        <style>
            .elementor-widget-product_video_description {
                width:100%;
            }
            .elementor-widget-product_video_description div.media-content-subsection {
                display:flex;
                align-items: center;
            }    
            .elementor-widget-product_video_description div.media-content-subsection div.content-holder {
                padding:20px;
                flex-basis: 50%;
                max-width: 50%;                
            }
            .elementor-widget-product_video_description div.media-content-subsection.novideo div.content-holder {
                padding:20px;
                flex-basis: 100%;
                max-width: 100%;                
            }            
            .elementor-widget-product_video_description div.media-content-subsection div.image-holder {
                flex-basis: 50%;
                max-width: 50%;
            }                   
        </style>        
        <?php
        
        // Get the product description
        $product_description = get_the_content(null, false, $post_id);

        // Get the Vimeo video ID from the custom field
        // $vimeo_video_id = get_field('vimeo', $post_id);
        

        if ($vimeo_video_id && $vimeo_video_id != 'No Video Info') {
            $vimeo_embed_url = "https://player.vimeo.com/video/{$vimeo_video_id}";
            $reproduce = '<iframe src="' . $vimeo_embed_url . '" style="width: 100%; height: 300px; border: none;" allowfullscreen></iframe>';
            $class="hasvideo";
        } else {
            $class="novideo";
        }

        ?>
        <div class="media-content-subsection <?php echo $class; ?>">
            <div class="content-holder">
                <?php echo apply_filters('the_content', wp_kses_post( $product_description )); ?>
            </div>
            <?php if ($vimeo_video_id != 'No Video Info') { ?>
            <div class="image-holder">
                <?php echo $reproduce; ?>
            </div>
            <?php } ?>
        </div>
        <?php       
    }
}
