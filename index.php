<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link  rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
  <?php require('inc/links.php'); ?>
  <link rel="icon" type="image/png" href="images/logohm.png">
  <title><?php echo $settings_r['site_title'] ?> - Trang chủ</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      background: #faf9f7;
      color: #333;
      overflow-x: hidden;
    }

    /* Hero Banner */
    .hero-banner {
      position: relative;
      height: 90vh;
      background: url('images/banner.jpg') center/cover no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: white;
    }

    .hero-overlay {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.45);
    }

    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 700px;
    }

    .hero-content h1 {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 15px;
    }

    .hero-content p {
      font-size: 1.2rem;
      margin-bottom: 25px;
      line-height: 1.6;
    }

    .btn-main {
      background: #b9975b;
      color: white;
      text-decoration: none;
      padding: 12px 35px;
      border-radius: 25px;
      font-weight: 600;
      transition: all 0.3s;
    }

    .btn-main:hover {
      background: #a58247;
    }

    /* Booking Bar */
    .booking-bar {
      background: white;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
      padding: 20px;
      max-width: 900px;
      margin: -50px auto 60px;
      display: flex;
      gap: 10px;
      border-radius: 10px;
      z-index: 10;
      position: relative;
    }

    .booking-bar input, .booking-bar select {
      flex: 1;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 1rem;
    }

    .booking-bar button {
      background: #b9975b;
      color: white;
      border: none;
      padding: 12px 30px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 600;
    }

    .booking-bar button:hover {
      background: #a58247;
    }

    /* Section Titles */
    .section-title {
      text-align: center;
      font-size: 2.3rem;
      margin: 80px 0 50px;
      color: #333;
      font-weight: 700;
    }

    /* Services Section */
    .services {
      display: flex;
      flex-direction: column;
      gap: 60px;
      padding: 0 20px;
      max-width: 1200px;
      margin: auto;
    }

    .service-item {
      display: flex;
      align-items: center;
      gap: 40px;
    }

    .service-item.reverse {
      flex-direction: row-reverse;
    }

    .service-item img {
      width: 50%;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .service-text {
      width: 50%;
    }

    .service-text h2 {
      color: #b9975b;
      font-size: 1.8rem;
      margin-bottom: 15px;
    }

    .service-text p {
      color: #555;
      line-height: 1.6;
    }

    /* Rooms */
    .rooms-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      max-width: 1200px;
      margin: auto;
      padding: 0 20px 80px;
    }

    .room-card {
      background: white;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transition: transform 0.3s;
    }

    .room-card:hover {
      transform: translateY(-5px);
    }

    .room-card img {
      width: 100%;
      height: 250px;
      object-fit: cover;
    }

    .room-info {
      padding: 25px;
    }

    .room-info h3 {
      font-size: 1.4rem;
      color: #333;
      margin-bottom: 10px;
      font-weight: 700;
    }

    .room-info p {
      color: #666;
      margin-bottom: 15px;
      line-height: 1.6;
    }

    .room-info a {
      background: #b9975b;
      color: white;
      padding: 10px 25px;
      border-radius: 25px;
      text-decoration: none;
      font-weight: 600;
    }

    /* CTA */
    .cta-section {
      background: linear-gradient(135deg, #b9975b 0%, #a58247 100%);
      color: white;
      text-align: center;
      padding: 80px 20px;
    }

    .cta-section h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
    }

    .cta-section p {
      font-size: 1.2rem;
      margin-bottom: 30px;
    }

    @media (max-width: 992px) {
      .service-item {
        flex-direction: column;
      }
      .service-item.reverse {
        flex-direction: column;
      }
      .service-item img, .service-text {
        width: 100%;
      }
      .booking-bar {
        flex-direction: column;
      }
    }

  </style>
</head>
<body>

  <?php require('inc/header.php');?>

  <!-- HERO -->
  <section class="hero-banner">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1>King Homestay & Coffee</h1>
      <p>Không gian nghỉ dưỡng lý tưởng - Trải nghiệm như ở nhà</p>
      <a href="#rooms" class="btn-main">Khám Phá Ngay</a>
    </div>
  </section>

  <!-- Booking Bar -->
  <section class="booking-bar">
    <input type="date" placeholder="Ngày đến">
    <input type="date" placeholder="Ngày đi">
    <select>
      <option>1 người</option>
      <option>2 người</option>
      <option>Gia đình</option>
    </select>
    <button>Tìm Phòng</button>
  </section>

  <!-- Services -->
  <h2 class="section-title" id="services">Dịch Vụ Của Chúng Tôi</h2>
  <section class="services">
    <div class="service-item">
      <img src="images/about/sec.svg" alt="An toàn & bảo mật">
      <div class="service-text">
        <h2>An Toàn & Bảo Mật</h2>
        <p>Hệ thống an ninh hiện đại 24/7 đảm bảo sự an toàn tuyệt đối cho quý khách.</p>
      </div>
    </div>

    <div class="service-item reverse">
      <img src="images/about/quality.svg" alt="Chất lượng cao">
      <div class="service-text">
        <h2>Chất Lượng Cao</h2>
        <p>Phòng ốc tiện nghi, sạch sẽ, hiện đại mang lại cảm giác thoải mái nhất.</p>
      </div>
    </div>

    <div class="service-item">
      <img src="images/about/tt.svg" alt="Phục vụ tận tâm">
      <div class="service-text">
        <h2>Phục Vụ Tận Tâm</h2>
        <p>Đội ngũ nhân viên chuyên nghiệp, thân thiện và tận tâm phục vụ quý khách.</p>
      </div>
    </div>
  </section>

  <!-- Rooms -->
  <h2 class="section-title" id="rooms">Phòng Của Chúng Tôi</h2>
  <div class="rooms-grid">
    <div class="room-card">
      <img src="images/rooms/img1.jpg" alt="Phòng Deluxe">
      <div class="room-info">
        <h3>Phòng Deluxe</h3>
        <p>Không gian sang trọng, tiện nghi hiện đại, view đẹp.</p>
        <a href="#">Xem Chi Tiết</a>
      </div>
    </div>

    <div class="room-card">
      <img src="images/rooms/img2.jpg" alt="Phòng Suite">
      <div class="room-info">
        <h3>Phòng Suite</h3>
        <p>Phù hợp cho gia đình hoặc nhóm bạn, rộng rãi và thoải mái.</p>
        <a href="#">Xem Chi Tiết</a>
      </div>
    </div>

    <div class="room-card">
      <img src="images/rooms/img3.jpg" alt="Phòng Standard">
      <div class="room-info">
        <h3>Phòng Standard</h3>
        <p>Giá cả hợp lý, tiện nghi đầy đủ, đáp ứng mọi nhu cầu.</p>
        <a href="#">Xem Chi Tiết</a>
      </div>
    </div>
  </div>

  <!-- CTA -->
  <section class="cta-section">
    <h2>Đặt Phòng Ngay Hôm Nay</h2>
    <p>Nhận ưu đãi đặc biệt khi đặt phòng trực tuyến</p>
    <a href="#rooms" class="btn-main">Đặt Phòngg</a>
  </section>

  <?php require('inc/footer.php');?>

</body>
</html>
