<?php 

  require('../inc/db_config.php');
  require('../inc/essentials.php');
  adminLogin();


  if(isset($_POST['add_image']))
  {
    $img_r = uploadImage($_FILES['picture'],CAROUSEL_FOLDER);

    if($img_r == 'inv_img'){
      echo $img_r;
    }
    else if($img_r == 'inv_size'){
      echo $img_r;
    }
    else if($img_r == 'upd_failed'){
      echo $img_r;
    }
    else{
      $q = "INSERT INTO `carousel`(`image`) VALUES (?)";
      $values = [$img_r];
      $res = insert($q,$values,'s');
      echo $res;
    }
  }

if(isset($_POST['get_carousel']))
{
    $res = selectAll('carousel');
    $path = CAROUSEL_IMG_PATH; // đảm bảo hằng này là URL tới folder ảnh, ví dụ: /uploads/carousel/

    // Bắt đầu table + header
    $data = "
      <div class='table-responsive'>
      <table class='table table-bordered text-center align-middle'>
        <thead class='table-dark'>
          <tr>
            <th style='width:70%'>Ảnh</th>
            <th style='width:30%'>Hành động</th>
          </tr>
        </thead>
        <tbody>
    ";

    // Rows
    while($row = mysqli_fetch_assoc($res))
    {
        $image = $path . $row['image'];
        $sr_no = $row['sr_no'];

        $data .= "
          <tr>
            <td>
              <img src='$image' class='img-fluid rounded' style='max-height:150px; object-fit:cover;'>
            </td>
            <td>
              <button type='button' onclick='rem_image($sr_no)' class='btn btn-danger btn-sm shadow-none'>
                <i class='bi bi-trash'></i> Xoá ảnh
              </button>
            </td>
          </tr>
        ";
    }

    // Close tbody + table
    $data .= "
        </tbody>
      </table>
      </div>
    ";

    echo $data;
}


  if(isset($_POST['rem_image']))
  {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_image']];

    $pre_q = "SELECT * FROM `carousel` WHERE `sr_no`=?";
    $res = select($pre_q,$values,'i');
    $img = mysqli_fetch_assoc($res);

    if(deleteImage($img['image'],CAROUSEL_FOLDER)){
      $q = "DELETE FROM `carousel` WHERE `sr_no`=?";
      $res = delete($q,$values,'i');
      echo $res;
    }
    else{
      echo 0;
    }

  }

?>