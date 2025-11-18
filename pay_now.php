<?php 
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  require('admin/inc/db_config.php');
  require('admin/inc/essentials.php');

  session_start();

  if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
    redirect('index.php');
  }

  if(isset($_POST['pay_now']))
  {
    $ORDER_ID = 'ORD_'.$_SESSION['uId'].random_int(11111,9999999);    
    $CUST_ID = $_SESSION['uId'];
    $TXN_AMOUNT = $_SESSION['room']['payment'];
    
    // Lưu thông tin vào session để dùng sau
    $_SESSION['pending_order'] = [
      'order_id' => $ORDER_ID,
      'user_id' => $CUST_ID,
      'room_id' => $_SESSION['room']['id'],
      'amount' => $TXN_AMOUNT,
      'checkin' => filteration($_POST)['checkin'],
      'checkout' => filteration($_POST)['checkout'],
      'name' => filteration($_POST)['name'],
      'phonenum' => filteration($_POST)['phonenum'],
      'address' => filteration($_POST)['address']
    ];
    
    // Redirect đến trang demo thanh toán
    redirect('payment_demo.php');
  }
?>