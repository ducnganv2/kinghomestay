<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link  rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
  <?php require('inc/links.php'); ?>
  <link rel="icon" type="image/png" href="images/logohm.png">
  <title><?php echo $settings_r['site_title'] ?> - Về chúng tôi</title>
  <style>
    .box{
      border-top-color: var(--teal) !important;
    }
    
    .logo-container {
      text-align: center;
      margin-bottom: 40px;
    }
    
    .logo-container img {
      max-width: 200px;
      height: auto;
      border-radius: 50%;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      transition: transform 0.3s ease;
    }
    
    .logo-container img:hover {
      transform: scale(1.05);
    }
    
    .brand-name {
      font-size: 2.5rem;
      font-weight: bold;
      color: var(--teal);
      margin-top: 20px;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }
    
    .intro-text {
      font-size: 1.2rem;
      line-height: 1.8;
      color: #555;
      text-align: justify;
      margin-bottom: 30px;
    }
    
    .feature-card {
      background: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      height: 100%;
    }
    
    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }
    
    .feature-icon {
      margin-bottom: 20px;
    }
    
    .feature-icon img {
      width: 80px;
      height: 80px;
      transition: transform 0.3s ease;
    }
    
    .feature-card:hover .feature-icon img {
      transform: scale(1.1);
    }
    
    .feature-title {
      font-size: 1.5rem;
      font-weight: bold;
      color: #333;
      margin-bottom: 15px;
    }
    
    .feature-desc {
      color: #666;
      line-height: 1.6;
    }
    
    .mission-vision {
      background: white;
      border-radius: 15px;
      padding: 40px;
      margin-top: 50px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .section-title {
      color: var(--teal);
      font-size: 1.8rem;
      font-weight: bold;
      margin-bottom: 20px;
      position: relative;
      padding-bottom: 10px;
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 3px;
      background: var(--teal);
    }
  </style>
</head>
<body class="bg-light">

  <?php require('inc/header.php');?>

  <div class="container my-5">
    <!-- Logo và Brand Name -->
    <div class="logo-container">
      <img src="images/logohm.png" alt="KingHomestay Logo">
      <h1 class="brand-name">KING HOMESTAY & COFFEE</h1>
    </div>

    <!-- Giới thiệu chính -->
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="intro-text">
          <?php 
            while($intro = mysqli_fetch_assoc($intro_q)) {
              echo "<p>{$intro['content']}</p>";
            }
          ?>
        </div>
      </div>
    </div>

    <!-- Các tính năng nổi bật -->
    <div class="row mt-5 g-4">
      <?php 
        while($feature = mysqli_fetch_assoc($feature_q)) 
        {
          echo <<<feature
            <div class="col-lg-6 col-md-6">
              <div class="feature-card">
                <div class="feature-icon">
                  <img src="images/about/{$feature['icon']}" alt="{$feature['title']}">
                </div>
                <h3 class="feature-title">{$feature['title']}</h3>
                <p class="feature-desc">{$feature['content']}</p>
              </div>
            </div>
          feature;
        }
      ?>
    </div>

    <!-- Sứ mệnh và Tầm nhìn -->
    <div class="mission-vision">
      <div class="row">
        <div class="col-lg-6">
          <h3 class="section-title"><?php echo ($mission['title']); ?></h3>
          <p><?php echo $mission['content']; ?></p>
        </div>
        <div class="col-lg-6">
          <h3 class="section-title"><?php echo ($vision['title']); ?></h3>
          <p><?php echo $vision['content']; ?></p>
        </div>
      </div>
    </div>

    <!-- Các giá trị cốt lõi -->
    <div class="row mt-5">
      <div class="col-12">
        <h3 class="section-title text-center mb-4">GIÁ TRỊ CỐT LÕI</h3>
      </div>
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/sec.svg" width="70px">
          <h4 class="mt-3">AN TOÀN</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/repo.svg" width="70px">
          <h4 class="mt-3">UY TÍN</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/quality.svg" width="70px">
          <h4 class="mt-3">CHẤT LƯỢNG</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/tt.svg" width="70px">
          <h4 class="mt-3">TẬN TÂM</h4>
        </div>
      </div>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>

  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 40,
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 3,
        },
      }
    });
  </script>
</body>
</html>