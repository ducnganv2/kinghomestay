<?php 
    session_start();

    require('../admin/inc/db_config.php'); 
    require('../admin/inc/essentials.php'); 

    date_default_timezone_set("Asia/Ho_Chi_Minh");
    
    if(!isset($_SESSION['uId'])){
        echo 'no_login';
        exit;
    }

    if(isset($_POST['info_form']))
    {
        $frm_data = filteration($_POST);
        
        // Kiểm tra số điện thoại có trùng với người khác không
        $u_exist = select("SELECT * FROM `user_cred` WHERE `phonenum`=? AND `id`!=? LIMIT 1",
            [$frm_data['phonenum'], $_SESSION['uId']],"ss");

        if(mysqli_num_rows($u_exist) != 0){
            echo 'phone_already';
            exit;
        }

        $query = "UPDATE `user_cred` SET `name`=?, `address`=?, `phonenum`=?, `pincode`=?, `dob`=? WHERE `id`=?";
        $values = [$frm_data['name'], $frm_data['address'], $frm_data['phonenum'], $frm_data['pincode'], $frm_data['dob'], $_SESSION['uId']];
        
        if(update($query, $values, 'ssssss')){
            echo 1; 
        }
        else{
            echo 0; 
        }
    }

    if(isset($_POST['profile_form']))
    {
        $img_r = uploadImage($_FILES['profile'], USERS_FOLDER); 

        if($img_r == 'inv_img'){
            echo 'inv_img'; 
        }
        else if($img_r == 'upd_failed'){
            echo 'upd_failed'; 
        }
        else{
            $u_exist = select("SELECT `profile` FROM `user_cred` WHERE `id`=? LIMIT 1",[$_SESSION['uId']],"s");
            $u_fetch = mysqli_fetch_assoc($u_exist);

            // Xóa ảnh cũ
            deleteImage($u_fetch['profile'], USERS_FOLDER);

            $query = "UPDATE `user_cred` SET `profile`=? WHERE `id`=?";
            $values = [$img_r, $_SESSION['uId']];
            
            if(update($query, $values, 'ss')){
                echo 1;
            }
            else{
                echo 0;
            }
        }
    }

    if(isset($_POST['pass_form']))
    {
        $frm_data = filteration($_POST);

        if($frm_data['new_pass'] != $frm_data['confirm_pass']){
            echo 'mismatch';
            exit;
        }

        // SỬA 2: Mã hóa mật khẩu (Khuyến nghị). 
        // Nếu hệ thống cũ của bạn không dùng mã hóa, hãy xóa dòng password_hash và dùng dòng dưới.
        // $enc_pass = password_hash($frm_data['new_pass'], PASSWORD_BCRYPT); 
        
        // Giữ nguyên như code cũ của bạn (cảnh báo: kém bảo mật):
        $enc_pass = $frm_data['new_pass'];

        $query = "UPDATE `user_cred` SET `password`=? WHERE `id`=?";
        $values = [$enc_pass, $_SESSION['uId']];

        if(update($query, $values, 'ss')){
            echo 1;
        }
        else{
            echo 0;
        }
    }
?>