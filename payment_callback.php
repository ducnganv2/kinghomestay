<?php 
  require('admin/inc/db_config.php');
  require('admin/inc/essentials.php');

  session_start();

  if(!isset($_SESSION['pending_order'])){
    redirect('index.php');
  }

  $order = $_SESSION['pending_order'];
  $status = $_POST['status'];

  if($status == 'success'){
    // Lưu vào database
    $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`, `order_id`, `booking_status`) 
               VALUES (?,?,?,?,?,'booked')";

    insert($query1, [
      $order['user_id'],
      $order['room_id'],
      $order['checkin'],
      $order['checkout'],
      $order['order_id']
    ], 'iisss');
    
    $booking_id = mysqli_insert_id($con);

    $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`,
      `user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";

    insert($query2, [
      $booking_id,
      $_SESSION['room']['name'],
      $_SESSION['room']['price'],
      $order['amount'],
      $order['name'],
      $order['phonenum'],
      $order['address']
    ], 'issssss');

    // Xóa session
    unset($_SESSION['pending_order']);
    
    alert('success', 'Thanh toán thành công!');
    redirect('bookings.php');
    
  } else {
    // Thanh toán thất bại
    unset($_SESSION['pending_order']);
    alert('error', 'Thanh toán thất bại!');
    redirect('rooms.php');
  }
?>