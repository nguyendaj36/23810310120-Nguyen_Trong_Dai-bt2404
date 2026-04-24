<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function sm_register_student_cpt() {
    $labels = array(
        'name'               => 'Sinh viên',
        'singular_name'      => 'Sinh viên',
        'menu_name'          => 'Sinh viên',
        'add_new'            => 'Thêm Sinh viên mới',
        'add_new_item'       => 'Thêm Sinh viên',
        'edit_item'          => 'Sửa Sinh viên',
        'new_item'           => 'Sinh viên mới',
        'view_item'          => 'Xem Sinh viên',
        'search_items'       => 'Tìm kiếm Sinh viên',
        'not_found'          => 'Không tìm thấy sinh viên nào',
        'not_found_in_trash' => 'Không có sinh viên trong thùng rác',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'menu_icon'           => 'dashicons-welcome-learn-more',
        'supports'            => array( 'title', 'editor' ), // Hỗ trợ Tiêu đề và Nội dung
    );

    register_post_type( 'sinh_vien', $args );
}
add_action( 'init', 'sm_register_student_cpt' );