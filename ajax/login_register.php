<?php 
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['register'])) {
    $data = filteration($_POST);

    // Match password and confirm password field
    if($data['pass'] != $data['cpass']) {
        echo 'pass_mismatch';
        exit;
    }

    // Check if user already exists
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email` = ? OR `phonenum` = ? LIMIT 1", [$data['email'], $data['phonenum']], "ss");
    if(mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit;
    }

    // upload user image to server

    $img = '';
    if(!empty($_FILES['profile']['name'])){
        
        $img = uploadUserImage($_FILES['profile']);
            if($img == 'inv_img'){
            echo 'inv_img';
            exit;
        }
            else if($img == 'upd_failed'){
            echo 'upd_failed';
            exit;
    }
}
    else{
        $img = 'avt.jpg';
    }
    // Insert user information into the database
    $query = "INSERT INTO `user_cred` (`name`, `email`, `phonenum`, `address`, `pincode`, `dob`,`profile`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $values = [$data['name'], $data['email'], $data['phonenum'], $data['address'], $data['pincode'], $data['dob'], $img, $data['pass']];
   
    if(insert($query, $values, 'ssssssss')) {
        echo '1';
    } else {
        echo 'ins_failed';
    }
    exit;
}

if(isset($_POST['login'])) {
    $data = filteration($_POST);

    // Check if user exists
    $query = "SELECT * FROM `user_cred` WHERE `email` = ? OR `phonenum` = ? LIMIT 1";
    $values = [$data['email_mob'], $data['email_mob']];
    $res = select($query, $values, "ss");

    if(mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        
        // Verify password
        if($data['pass'] == $row['password']) {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['uId'] = $row['id'];
            $_SESSION['uName'] = $row['name'];
            $_SESSION['uPic'] = $row['profile'];
            echo 'login_success';
        } else {
            echo 'invalid_password';
        }
    } else {
        echo 'invalid_email_mob';
    }
    exit;
}
?>