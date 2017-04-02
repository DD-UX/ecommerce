<?php
if (!is_admin()){
    
    // Register general styles and scripts.
    add_action( 'wp_enqueue_scripts', 'assets_handler', 100 );

    // Enqueue Styles and Scripts
    function assets_handler() {
        // Swiper
        wp_register_script( 'swiper-jquery', get_theme_root_uri().'/Divi-Child-Theme/js/swiper.jquery.js');

        // WooCommerce Ajax add to cart  
        wp_register_script( 'wc-ajax-callback', get_theme_root_uri().'/Divi-Child-Theme/js/wc-ajax-callback.js');

        // Script
        wp_register_script( 'scripts', get_theme_root_uri().'/Divi-Child-Theme/js/scripts.js');


        // Call elements
        wp_enqueue_script( 'swiper-jquery' );
        wp_enqueue_script( 'scripts' );
        wp_enqueue_script( 'wc-ajax-callback' );
    }
    
    // Register WooCommerce styles
    add_action( 'wp_enqueue_scripts', 'enqueue_style_after_wc', 100 );
    function enqueue_style_after_wc(){
        $deps = class_exists( 'WooCommerce' ) ? array( 'woocommerce-layout', 'woocommerce-smallscreen', 'woocommerce-general' ) : array();
        
        wp_enqueue_style( 'woocommerce-rewrite', get_theme_root_uri().'/Divi-Child-Theme/css/woocommerce-rewrite.css', $deps, '1.0' );
    }
}