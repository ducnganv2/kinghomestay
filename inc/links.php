<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="css/common.css">

<?php
session_start();

require('admin/inc/db_config.php');
require('admin/inc/essentials.php');

// Truy vấn cho about page
$intro_q = mysqli_query($con, "SELECT * FROM about_us WHERE section='intro' AND status=1 ORDER BY display_order");
$feature_q = mysqli_query($con, "SELECT * FROM about_us WHERE section='feature' AND status=1 ORDER BY display_order");
$mission_q = mysqli_query($con, "SELECT * FROM about_us WHERE section='mission' AND status=1 LIMIT 1");
$mission = mysqli_fetch_assoc($mission_q);
$vision_q = mysqli_query($con, "SELECT * FROM about_us WHERE section='vision' AND status=1 LIMIT 1");
$vision = mysqli_fetch_assoc($vision_q);

// Truy vấn chung cho tất cả trang
$contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
$settings_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
$contact_r = mysqli_fetch_assoc(select($contact_q,$values,'i'));
$settings_r = mysqli_fetch_assoc(select($settings_q,$values,'i'));

// Truy vấn cho index page
$carousel_q = "SELECT * FROM `carousel` ORDER BY `sr_no` LIMIT 5";
$carousel_res = mysqli_query($con, $carousel_q);

$rooms_q = "SELECT * FROM `rooms` WHERE `status`=1 AND `removed`=0 ORDER BY `id` DESC LIMIT 6";
$rooms_res = mysqli_query($con, $rooms_q);

$facilities_q = "SELECT * FROM `facilities` ORDER BY `id` LIMIT 6";
$facilities_res = mysqli_query($con, $facilities_q);

// Kiểm tra shutdown
if($settings_r['shutdown']){
  echo<<<alertbar
    <div class='bg-danger text-center p-2 fw-bold'>
      <i class="bi bi-exclamation-triangle-fill"></i>
      Tạm thời không hỗ trợ đặt phòng!
    </div>
  alertbar;
}
?>