<?php 

  require('../inc/db_config.php');
  require('../inc/essentials.php');
  adminLogin();

  if(isset($_POST['get_bookings']))
  {
    $frm_data = filteration($_POST);

    $query = "SELECT bo.*, bd.* FROM `booking_order` bo
      INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
      WHERE (bo.order_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?) 
      AND (bo.booking_status=? AND bo.refund=?) ORDER BY bo.booking_id DESC";

    $res = select($query,["%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%","cancelled",0],'sssss');
    
    $i=1;
    $table_data = "";

    if(mysqli_num_rows($res)==0){
      echo"<b>No Data Found!</b>";
      exit;
    }

    while($data = mysqli_fetch_assoc($res))
    {
      $date = date("d-m-Y",strtotime($data['datentime']));
      $checkin = date("d-m-Y",strtotime($data['check_in']));
      $checkout = date("d-m-Y",strtotime($data['check_out']));

      $table_data .="
        <tr>
          <td>$i</td>
          <td>
            <span class='badge bg-primary'>
              Order ID: $data[order_id]
            </span>
            <br>
            <b>Name:</b> $data[user_name]
            <br>
            <b>Phone No:</b> $data[phonenum]
          </td>
          <td>
            <b>Room:</b> $data[room_name]
            <br>
            <b>Check-in:</b> $checkin
            <br>
            <b>Check-out:</b> $checkout
            <br>
            <b>Date:</b> $date
          </td>
          <td>
            <b>$data[trans_amt] VNĐ</b> 
          </td>
          <td>
            <button type='button' onclick='refund_booking($data[booking_id])' class='btn btn-success btn-sm fw-bold shadow-none'>
              <i class='bi bi-cash-stack'></i> Hoàn tiền
            </button>
          </td>
        </tr>
      ";

      $i++;
    }

    echo $table_data;
  }

  if(isset($_POST['refund_booking']))
  {
    $frm_data = filteration($_POST);

    $query_info = "SELECT bo.order_id, bo.trans_amt, uc.email, uc.name 
      FROM `booking_order` bo
      INNER JOIN `user_cred` uc ON bo.user_id = uc.id 
      WHERE bo.booking_id = ?";
      
    $res_info = select($query_info, [$frm_data['booking_id']], 'i');
    
    if(mysqli_num_rows($res_info) > 0)
    {
        $row = mysqli_fetch_assoc($res_info);
        
        $query = "UPDATE `booking_order` SET `refund`=? WHERE `booking_id`=?";
        $values = [1, $frm_data['booking_id']];
        $res = update($query, $values, 'ii');

        if($res)
        {
            $subject = "Thong Bao Hoan Tien / Refund Notification";
            
            $message = "
                <h3>Xin chào $row[name],</h3>
                <p>Chúng tôi đã thực hiện hoàn tiền cho đơn đặt phòng của bạn.</p>
                <p><b>Mã đơn hàng:</b> $row[order_id]</p>
                <p><b>Số tiền đã hoàn:</b> ".number_format($row['trans_amt'])." VNĐ</p>
                <p>Tiền sẽ về tài khoản của bạn trong vòng 3-5 ngày làm việc tùy thuộc vào ngân hàng.</p>
                <br>
                <p>Cảm ơn bạn đã quan tâm đến Chốn Homestay!</p>
            ";

            send_mail($row['email'], $subject, $message);

            echo 1; 
        }
        else
        {
            echo 0; 
        }
    }
    else
    {
        echo 0; 
    }
  }
?>