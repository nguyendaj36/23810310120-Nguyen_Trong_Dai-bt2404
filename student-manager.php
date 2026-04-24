<?php
/**
 * Plugin Name: Student Manager
 * Description: Plugin quản lý sinh viên với Custom Post Type và Shortcode.
 * Version: 1.0
 * Author: Your Name
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Thoát nếu truy cập trực tiếp
}

// Nạp các file xử lý
require_once plugin_dir_path( __FILE__ ) . 'includes/class-student-cpt.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-student-meta-box.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-student-shortcode.php';

// Nạp CSS cho frontend
function sm_enqueue_assets() {
    wp_enqueue_style( 'sm-style', plugin_dir_url( __FILE__ ) . 'assets/style.css' );
}
add_action( 'wp_enqueue_scripts', 'sm_enqueue_assets' );