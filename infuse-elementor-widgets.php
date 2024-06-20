<?php
/**
 * Plugin Name: Infuse Elementor Widgets
 * Description: Infuse Elementor widgets for testimonial slider.
 * Version: 1.2
 * Author: Reza Kohan
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function infuse_elementor_init() {
    // Check if Elementor is active and loaded
    if ( did_action( 'elementor/loaded' ) ) {
        // Include the widget file
        require_once( __DIR__ . '/widgets/testimonial-slider.php' );
        
        // Register the widget
        add_action( 'elementor/widgets/register', 'register_custom_elementor_widgets' );
        
        // Enqueue scripts and styles
        add_action( 'wp_enqueue_scripts', 'enqueue_custom_elementor_widgets_assets' );
    }
}

add_action( 'plugins_loaded', 'infuse_elementor_init' );

function register_custom_elementor_widgets( $widgets_manager ) {
    $widgets_manager->register( new \Elementor_Testimonial_Slider_Widget() );
}

function enqueue_custom_elementor_widgets_assets() {
    wp_enqueue_style( 'infuse-elementor-widgets', plugins_url( 'css/infuse-elementor-widgets.css', __FILE__ ) );
    wp_enqueue_script( 'infuse-elementor-widgets', plugins_url( 'js/infuse-elementor-widgets.js', __FILE__ ), array( 'jquery' ), false, true );
}
