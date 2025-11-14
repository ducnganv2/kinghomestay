<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
  <?php require('inc/links.php'); ?>
  <link rel="icon" type="image/png" href="images/logohm.png">
  <title><?php echo $settings_r['site_title'] ?> - Trang chủ</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      overflow-x: hidden;
    }

    /* Hero Carousel Section */
    .hero-carousel {
      position: relative;
      height: 85vh;
      min-height: 500px;
    }

    .swiper-hero {
      width: 100%;
      height: 100%;
    }

    .swiper-hero .swiper-slide {
      position: relative;
      overflow: hidden;
    }

    .swiper-hero .swiper-slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.5));
      z-index: 1;
    }

    .hero-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      color: white;
      z-index: 2;
      width: 90%;
      max-width: 900px;
    }

    .hero-title {
      font-size: 3.5rem;
      font-weight: bold;
      margin-bottom: 20px;
      text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
      letter-spacing: 2px;
    }

    .hero-subtitle {
      margin-bottom: 35px;
      text-shadow: 1px 1px 5px rgba(0,0,0,0.5);
    }

    .hero-btn {
      display: inline-block;
      padding: 16px 45px;
      background: #c9a961;
      color: white;
      text-decoration: none;
      font-size: 1.1rem;
      font-weight: 600;
      border-radius: 5px;
      transition: all 0.3s;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .hero-btn:hover {
      background: #b8944d;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(201, 169, 97, 0.4);
      color: white;
    }

    /* Booking Bar */
    .booking-bar {
      background: white;
      box-shadow: 0 -5px 20px rgba(0,0,0,0.1);
      padding: 25px;
      margin-top: -50px;
      position: relative;
      z-index: 3;
      border-radius: 10px;
      max-width: 1200px;
      margin-left: auto;
      margin-right: auto;
    }

    .booking-form {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 15px;
      align-items: end;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      color: #333;
      font-weight: 600;
      font-size: 0.9rem;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 1rem;
    }

    .booking-btn {
      padding: 12px 30px;
      background: #c9a961;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      text-transform: uppercase;
    }

    .booking-btn:hover {
      background: #b8944d;
      transform: translateY(-2px);
    }

    /* Section Styles */
    .section {
      padding: 80px 20px;
    }

    .section-dark {
      background: #f8f9fa;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
    }

    .section-header {
      text-align: center;
      margin-bottom: 60px;
    }

    .section-title {
      font-size: 2.8rem;
      color: #2c3e50;
      margin-bottom: 15px;
      font-weight: bold;
      position: relative;
      display: inline-block;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: #c9a961;
    }

    .section-subtitle {
      font-size: 1.2rem;
      color: #666;
      margin-top: 20px;
    }

    /* Rooms Grid */
    .rooms-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 30px;
      align-items: stretch;
    }

    .room-card {
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
      transition: all 0.3s;
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .room-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .room-image {
      width: 100%;
      height: 250px;
      object-fit: cover;
      flex-shrink: 0;
    }

    .room-info {
      padding: 25px;
      display: flex;
      flex-direction: column;
      flex: 1;
    }

    .room-title {
      font-size: 1.6rem;
      color: #2c3e50;
      margin-bottom: 12px;
      font-weight: bold;
    }

    .room-features {
      display: flex;
      gap: 15px;
      margin: 15px 0;
      color: #666;
      font-size: 0.95rem;
    }

    .room-feature {
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .room-desc {
      color: #666;
      line-height: 1.6;
      margin: 15px 0;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .room-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 15px;
      border-top: 1px solid #eee;
      margin-top: auto;
    }

    .room-price {
      font-size: 1.8rem;
      color: #c9a961;
      font-weight: bold;
    }

    .room-price span {
      font-size: 0.9rem;
      color: #999;
      font-weight: normal;
    }

    .room-btn {
      padding: 10px 25px;
      background: #c9a961;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: all 0.3s;
      font-weight: 600;
    }

    .room-btn:hover {
      background: #b8944d;
      color: white;
    }

    /* Facilities Section */
    .facilities-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
      align-items: stretch;
    }

    .facility-card {
      text-align: center;
      padding: 35px 20px;
      background: white;
      border-radius: 10px;
      transition: all 0.3s;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100%;
    }

    .facility-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .facility-icon {
      width: 70px;
      height: 70px;
      margin: 0 auto 20px;
    }

    .facility-icon img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .facility-title {
      font-size: 1.3rem;
      color: #2c3e50;
      margin-bottom: 12px;
      font-weight: bold;
    }

    /* About Section */
    .about-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 50px;
      align-items: center;
    }

    .about-text h3 {
      font-size: 2rem;
      color: #2c3e50;
      margin-bottom: 20px;
      font-weight: bold;
    }

    .about-text p {
      color: #666;
      line-height: 1.8;
      margin-bottom: 15px;
    }

    .about-image {
      width: 100%;
      height: 400px;
      border-radius: 10px;
      object-fit: cover;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    /* Stats Section */
    .stats-section {
      background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
      padding: 60px 20px;
      color: white;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 40px;
      text-align: center;
    }

    .stat-number {
      font-size: 3rem;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .stat-label {
      font-size: 1.1rem;
      opacity: 0.9;
    }

    /* CTA Section */
    .cta-section {
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('images/carousel/bg1.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      padding: 100px 20px;
      text-align: center;
      color: white;
    }

    .cta-title {
      font-size: 3rem;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .cta-subtitle {
      font-size: 1.3rem;
      margin-bottom: 40px;
    }

    .cta-btn-group {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .cta-btn-primary {
      padding: 16px 45px;
      background: #c9a961;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-size: 1.1rem;
      font-weight: 600;
      transition: all 0.3s;
      text-transform: uppercase;
    }

    .cta-btn-primary:hover {
      background: #b8944d;
      transform: translateY(-2px);
      color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2rem;
      }

      .hero-subtitle {
        font-size: 1.1rem;
      }

      .section-title {
        font-size: 2rem;
      }

      .about-content {
        grid-template-columns: 1fr;
      }

      .booking-form {
        grid-template-columns: 1fr;
      }

      .rooms-grid {
        grid-template-columns: 1fr;
      }

      .facilities-grid {
        grid-template-columns: 1fr;
      }

      .stat-number {
        font-size: 2rem;
      }

      .cta-title {
        font-size: 2rem;
      }
    }

    @media (max-width: 1024px) and (min-width: 769px) {
      .rooms-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .facilities-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }
  </style>
</head>
<body>

  <?php require('inc/header.php'); ?>

  <!-- Hero Carousel Section -->
  <section class="hero-carousel">
    <div class="swiper swiper-hero">
      <div class="swiper-wrapper">
        <?php 
          while($carousel = mysqli_fetch_assoc($carousel_res)) {
            $image_path = CAROUSEL_IMG_PATH . $carousel['image'];
            echo <<<SLIDE
              <div class="swiper-slide">
                <img src="{$image_path}" alt="Hero Image">
                <div class="hero-overlay"></div>
              </div>
            SLIDE;
          }
        ?>
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
    
    <div class="hero-content">
      <h1 class="hero-title"><?php echo $settings_r['site_title']; ?></h1>
      <p class="hero-subtitle"><?php echo $settings_r['site_about']; ?></p>
      <a href="#rooms" class="hero-btn">Khám Phá Phòng</a>
    </div>
  </section>

  <!-- Booking Bar -->
  <div class="container">
    <div class="booking-bar">
      <form class="booking-form" action="rooms.php" method="GET">
        <div class="form-group">
          <label>Nhận phòng</label>
          <input type="date" name="checkin" required>
        </div>
        <div class="form-group">
          <label>Trả phòng</label>
          <input type="date" name="checkout" required>
        </div>
        <div class="form-group">
          <label>Người lớn</label>
          <select name="adult">
            <option value="1">1</option>
            <option value="2" selected>2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div>
        <div class="form-group">
          <label>Trẻ em</label>
          <select name="children">
            <option value="0" selected>0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="booking-btn">Tìm Phòng</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Rooms Section -->
  <section class="section" id="rooms">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Phòng & Căn Hộ</h2>
        <p class="section-subtitle">Khám phá không gian nghỉ dưỡng lý tưởng của chúng tôi</p>
      </div>

      <div class="rooms-grid">
        <?php 
          while($room = mysqli_fetch_assoc($rooms_res)) {
            // Lấy ảnh thumbnail của phòng
            $room_thumb_q = "SELECT * FROM `room_images` WHERE `room_id`='{$room['id']}' AND `thumb`='1'";
            $room_thumb_res = mysqli_query($con, $room_thumb_q);
            $room_thumb = mysqli_fetch_assoc($room_thumb_res);
            $thumb_path = ROOMS_IMG_PATH . $room_thumb['image'];

            // Format giá
            $price = number_format($room['price'], 0, ',', '.');

            echo <<<ROOM
              <div class="room-card">
                <img src="{$thumb_path}" alt="{$room['name']}" class="room-image">
                <div class="room-info">
                  <h3 class="room-title">{$room['name']}</h3>
                  <div class="room-features">
                    <div class="room-feature">
                      <i class="bi bi-people"></i>
                      <span>{$room['adult']} người lớn</span>
                    </div>
                    <div class="room-feature">
                      <i class="bi bi-arrows-angle-expand"></i>
                      <span>{$room['area']}m²</span>
                    </div>
                  </div>
                  <p class="room-desc">{$room['description']}</p>
                  <div class="room-footer">
                    <div class="room-price">
                      {$price}₫ <span>/đêm</span>
                    </div>
                    <a href="room_details.php?id={$room['id']}" class="room-btn">Chi Tiết</a>
                  </div>
                </div>
              </div>
            ROOM;
          }
        ?>
      </div>
      </div>

      <div style="text-align: center; margin-top: 50px;">
        <a href="rooms.php" class="hero-btn">Xem Tất Cả Phòng</a>
      </div>
    </div>
  </section>

  <!-- Facilities Section -->
  <section class="section section-dark">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Tiện Nghi & Dịch Vụ</h2>
        <p class="section-subtitle">Trải nghiệm đầy đủ tiện nghi hiện đại</p>
      </div>

      <div class="facilities-grid">
        <?php 
          while($facility = mysqli_fetch_assoc($facilities_res)) {
            $icon_path = FACILITIES_IMG_PATH . $facility['icon'];
            echo <<<FACILITY
              <div class="facility-card">
                <div class="facility-icon">
                  <img src="{$icon_path}" alt="{$facility['name']}">
                </div>
                <h3 class="facility-title">{$facility['name']}</h3>
              </div>
            FACILITY;
          }
        ?>
      </div>

      <div style="text-align: center; margin-top: 50px;">
        <a href="facilities.php" class="hero-btn">Xem Thêm Tiện Nghi</a>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="stats-section">
    <div class="container">
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number">1000+</div>
          <div class="stat-label">Khách Hàng Hài Lòng</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">50+</div>
          <div class="stat-label">Phòng Hiện Đại</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">24/7</div>
          <div class="stat-label">Hỗ Trợ Tận Tình</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">5★</div>
          <div class="stat-label">Đánh Giá Trung Bình</div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta-section">
    <div class="container">
      <h2 class="cta-title">Đặt Phòng Ngay Hôm Nay</h2>
      <p class="cta-subtitle">Nhận ưu đãi đặc biệt khi đặt phòng trực tuyến</p>
      <div class="cta-btn-group">
        <a href="rooms.php" class="cta-btn-primary">Đặt Phòng Ngay</a>
        <a href="contact.php" class="cta-btn-primary">Liên Hệ Chúng Tôi</a>
      </div>
    </div>
  </section>

  <?php require('inc/footer.php'); ?>

  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script>
    // Hero Carousel
    var heroSwiper = new Swiper(".swiper-hero", {
      loop: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      effect: 'fade',
      fadeEffect: {
        crossFade: true
      }
    });

    // Set minimum date for check-in to today
    const today = new Date().toISOString().split('T')[0];
    document.querySelector('input[name="checkin"]').setAttribute('min', today);
    
    // Set minimum date for check-out based on check-in
    document.querySelector('input[name="checkin"]').addEventListener('change', function() {
      const checkinDate = new Date(this.value);
      checkinDate.setDate(checkinDate.getDate() + 1);
      const minCheckout = checkinDate.toISOString().split('T')[0];
      document.querySelector('input[name="checkout"]').setAttribute('min', minCheckout);
    });
  </script>
</body>
</html>