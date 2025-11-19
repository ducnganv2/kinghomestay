<?php 

 require('../admin/inc/db_config.php');
 require('../admin/inc/essentials.php');

 session_start();

 if(isset($_POST['check_availability']))
 {
  $frm_data = filteration($_POST);
  $status = "";
  $result = "";

//check in and out validations


 $today_date = new DateTime(date("Y-m-d"));
 $checkin_date = new DateTime($frm_data['check_in']);
 $checkout_date = new DateTime($frm_data['check_out']);

 if($checkin_date == $checkout_date){
  $status = 'check_in_out_equal';
  $result = json_encode(["status"=>$status]);
 }
 else if($checkout_date < $checkin_date){
  $status = 'check_out_earlier';
  $result = json_encode(["status"=>$status]);
 }
 else if($checkin_date < $today_date){
  $status = 'check_in_earlier';
  $result = json_encode(["status"=>$status]);
 }

//check booking availability if status is blank else return the error
 if($status!=''){
  echo $result;
 }
 else{
 
  $rq_result = select("SELECT `quantity` FROM `rooms` WHERE `id`=?",[$_SESSION['room']['id']],'i');
  $rq_fetch = mysqli_fetch_assoc($rq_result);
  $room_quantity = $rq_fetch['quantity'];

  $tb_query = "SELECT `check_in`, `check_out` FROM `booking_order`
   WHERE booking_status=? AND room_id=?
   AND check_out > ? AND check_in < ?";
  $values = ['booked',$_SESSION['room']['id'],$frm_data['check_in'],$frm_data['check_out']];
  $tb_res = select($tb_query,$values,'siss');
  $total_bookings = mysqli_num_rows($tb_res);
  
  
 if($total_bookings >= $room_quantity){
 
  if ($total_bookings > 0) {
  
   mysqli_data_seek($tb_res, 0);
   
   
   $booked_data = mysqli_fetch_assoc($tb_res);
   
   $check_in_booked = date('d/m/Y', strtotime($booked_data['check_in']));
   $check_out_booked = date('d/m/Y', strtotime($booked_data['check_out']));
   $status = 'fully_booked_overlap';
   $message = "Phòng đã có khách đặt từ ngày $check_in_booked đến ngày $check_out_booked!";
   $result = json_encode(['status'=>$status, 'message'=>$message]);
  } else {
   
   $status = 'unavailable';
   $result = json_encode(['status'=>$status]);
  }
  echo $result;
  exit;
 }
  

  $count_days = date_diff($checkin_date,$checkout_date)->days;
  $payment = $_SESSION['room']['price'] * $count_days;
  $_SESSION['room']['payment'] = $payment;
  $_SESSION['room']['available'] = true;
  
  $result = json_encode(["status"=>'available', "days"=>$count_days, "payment"=> $payment]);
  echo $result;
 }
 }

?>