<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function sm_student_list_shortcode() {
    // Sử dụng Output Buffering để tránh lỗi hiển thị sai vị trí
    ob_start();

    // Truy vấn tất cả bài viết thuộc CPT 'sinh_vien'
    $args = array(
        'post_type'      => 'sinh_vien',
        'posts_per_page' => -1, // Lấy tất cả
        'post_status'    => 'publish'
    );
    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        echo '<table class="sm-student-table">';
        echo '<thead><tr>';
        echo '<th>STT</th>';
        echo '<th>MSSV</th>';
        echo '<th>Họ tên</th>';
        echo '<th>Lớp</th>';
        echo '<th>Ngày sinh</th>';
        echo '</tr></thead>';
        echo '<tbody>';

        $stt = 1;
        while ( $query->have_posts() ) {
            $query->the_post();
            
            // Lấy meta data
            $mssv = get_post_meta( get_the_ID(), '_sm_mssv', true );
            $lop = get_post_meta( get_the_ID(), '_sm_lop', true );
            $ngay_sinh = get_post_meta( get_the_ID(), '_sm_ngay_sinh', true );

            // Nếu ngày sinh có dữ liệu, format lại cho đẹp (tuỳ chọn)
            $formatted_date = !empty($ngay_sinh) ? date('d/m/Y', strtotime($ngay_sinh)) : '';

            echo '<tr>';
            echo '<td>' . $stt++ . '</td>';
            echo '<td>' . esc_html( $mssv ) . '</td>';
            echo '<td>' . esc_html( get_the_title() ) . '</td>';
            echo '<td>' . esc_html( $lop ) . '</td>';
            echo '<td>' . esc_html( $formatted_date ) . '</td>';
            echo '</tr>';
        }
        
        echo '</tbody></table>';
        wp_reset_postdata(); // Đặt lại dữ liệu post
    } else {
        echo '<p>Hiện tại chưa có sinh viên nào trong hệ thống.</p>';
    }

    return ob_get_clean();
}
add_shortcode( 'danh_sach_sinh_vien', 'sm_student_list_shortcode' );