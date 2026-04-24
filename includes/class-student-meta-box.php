<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// 1. Khởi tạo Meta Box
function sm_add_student_meta_boxes() {
    add_meta_box(
        'sm_student_info',
        'Thông tin chi tiết Sinh viên',
        'sm_render_student_meta_box',
        'sinh_vien',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'sm_add_student_meta_boxes' );

// 2. Giao diện nhập liệu trong màn hình thêm/sửa
function sm_render_student_meta_box( $post ) {
    // Tạo Nonce để bảo mật
    wp_nonce_field( 'sm_save_student_data', 'sm_student_nonce' );

    // Lấy dữ liệu cũ nếu có
    $mssv = get_post_meta( $post->ID, '_sm_mssv', true );
    $lop = get_post_meta( $post->ID, '_sm_lop', true );
    $ngay_sinh = get_post_meta( $post->ID, '_sm_ngay_sinh', true );

    ?>
    <p>
        <label for="sm_mssv"><strong>Mã số sinh viên (MSSV):</strong></label><br>
        <input type="text" id="sm_mssv" name="sm_mssv" value="<?php echo esc_attr( $mssv ); ?>" style="width: 100%;" />
    </p>
    <p>
        <label for="sm_lop"><strong>Lớp/Chuyên ngành:</strong></label><br>
        <select id="sm_lop" name="sm_lop" style="width: 100%;">
            <option value="CNTT" <?php selected( $lop, 'CNTT' ); ?>>Công nghệ thông tin</option>
            <option value="Kinh tế" <?php selected( $lop, 'Kinh tế' ); ?>>Kinh tế</option>
            <option value="Marketing" <?php selected( $lop, 'Marketing' ); ?>>Marketing</option>
        </select>
    </p>
    <p>
        <label for="sm_ngay_sinh"><strong>Ngày sinh:</strong></label><br>
        <input type="date" id="sm_ngay_sinh" name="sm_ngay_sinh" value="<?php echo esc_attr( $ngay_sinh ); ?>" style="width: 100%;" />
    </p>
    <?php
}

// 3. Xử lý lưu dữ liệu (Bảo mật & Sanitize)
function sm_save_student_meta_box_data( $post_id ) {
    // Kiểm tra Nonce
    if ( ! isset( $_POST['sm_student_nonce'] ) || ! wp_verify_nonce( $_POST['sm_student_nonce'], 'sm_save_student_data' ) ) {
        return;
    }
    // Bỏ qua nếu đang autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Kiểm tra quyền
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Sanitize và Lưu dữ liệu
    if ( isset( $_POST['sm_mssv'] ) ) {
        update_post_meta( $post_id, '_sm_mssv', sanitize_text_field( $_POST['sm_mssv'] ) );
    }
    if ( isset( $_POST['sm_lop'] ) ) {
        update_post_meta( $post_id, '_sm_lop', sanitize_text_field( $_POST['sm_lop'] ) );
    }
    if ( isset( $_POST['sm_ngay_sinh'] ) ) {
        update_post_meta( $post_id, '_sm_ngay_sinh', sanitize_text_field( $_POST['sm_ngay_sinh'] ) );
    }
}
add_action( 'save_post', 'sm_save_student_meta_box_data' );