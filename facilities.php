<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <link rel="icon" type="image/png" href="images/logohm.png">
  <title><?php echo $settings_r['site_title'] ?> - Tiện ích</title>
  <style>
    .pop:hover{
      border-top-color: var(--teal) !important;
      transform: scale(1.03);
      transition: all 0.3s;
    }
    
    .facility-card {
      height: 100%;
      display: flex;
      flex-direction: column;
    }
    
    .facility-icon-box {
      background: linear-gradient(135deg, rgba(13,202,240,0.1) 0%, rgba(13,202,240,0.05) 100%);
      padding: 30px;
      text-align: center;
      border-radius: 10px;
      margin-bottom: 20px;
    }
    
    .facility-icon-box img {
      width: 70px;
      height: 70px;
      object-fit: contain;
    }
    
    .facility-title {
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 15px;
      color: #2c3e50;
    }
    
    .facility-description {
      color: #6c757d;
      line-height: 1.7;
      font-size: 0.95rem;
    }
  </style>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">TIỆN ÍCH</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
    Dù không có phòng gym hay bể bơi, King Homestay vẫn ghi điểm với du khách nhờ vào dịch vụ tận tình và các tiện ích như WiFi miễn phí, lễ tân 24/7 và dịch vụ cho thuê xe đạp. 
    <br>Khu vực lounge và sân vườn nhỏ xinh là nơi lý tưởng để thư giãn, đọc sách hoặc thưởng thức một tách cà phê sáng.
    </p>
  </div>

  <div class="container">
    <div class="row">
      <?php 
        $res = selectAll('facilities');
        $path = FACILITIES_IMG_PATH;

        while($row = mysqli_fetch_assoc($res)){
          echo<<<data
            <div class="col-lg-4 col-md-6 mb-5 px-4">
              <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop facility-card">
                <div class="facility-icon-box">
                  <img src="$path$row[icon]" alt="$row[name]">
                </div>
                <h5 class="facility-title">$row[name]</h5>
                <p class="facility-description">$row[description]</p>
              </div>
            </div>
          data;
        }
      ?>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>

</body>
</html>