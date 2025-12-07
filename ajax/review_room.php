<?php 
    // 1. Kết nối Database
    // Dùng ../ để lùi ra ngoài folder 'ajax', đi vào 'admin/inc'
    require('../admin/inc/db_config.php');
    require('../admin/inc/essentials.php');

    // Cấu hình múi giờ và khởi động Session
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    session_start();

    // 2. Kiểm tra đăng nhập
    if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
        echo 0; 
        exit;
    }

    // 3. Xử lý dữ liệu
    if(isset($_POST['review_form']))
    {
        // Lọc dữ liệu đầu vào
        $frm_data = filteration($_POST);

        // Tạo câu lệnh INSERT đánh giá
        $ins_query = "INSERT INTO `rating_review` (`booking_id`, `room_id`, `user_id`, `rating`, `review`) 
                      VALUES (?,?,?,?,?)";
        
        $ins_values = [
            $frm_data['booking_id'], 
            $frm_data['room_id'], 
            $_SESSION['uId'], 
            $frm_data['rating'], 
            $frm_data['review']
        ];

        // Thực thi INSERT
        $ins_res = insert($ins_query, $ins_values, 'iiiis');

        // Nếu INSERT thành công -> UPDATE trạng thái đơn hàng
        if($ins_res == 1){
            $upd_query = "UPDATE `booking_order` SET `rate_review`=? WHERE `booking_id`=? AND `user_id`=?";
            $upd_values = [1, $frm_data['booking_id'], $_SESSION['uId']];
            
            $upd_res = update($upd_query, $upd_values, 'iii');
            
            echo $upd_res; // Trả về 1 (Thành công)
        }
        else {
            echo 0; // Thất bại
        }
    }
?>