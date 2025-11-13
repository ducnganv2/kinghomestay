<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container-fluid px-lg-4">
    <!-- Logo ở giữa trên mobile, trái trên desktop -->
    <a class="navbar-brand d-flex align-items-center fw-bold fs-3 h-font order-lg-1" href="index.php">
      <img src="images/logohm.png" alt="Logo" width="50" height="50" class="me-2">
      <span class="d-none d-lg-inline"><?php echo $settings_r['site_title'] ?></span>
    <!-- User menu/buttons bên phải -->
    <div class="d-flex align-items-center order-lg-3 ms-auto">
      <?php 
        if(isset($_SESSION['login']) && $_SESSION['login']==true)
        {
          $path = USERS_IMG_PATH;
          echo<<<data
            <div class="dropdown">
              <button class="btn btn-light shadow-none d-flex align-items-center dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="$path$_SESSION[uPic]" style="width: 35px; height: 35px;" class="rounded-circle me-2">
                <span class="d-none d-md-inline">$_SESSION[uName]</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end shadow">
                <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person me-2"></i>Hồ sơ cá nhân</a></li>
                <li><a class="dropdown-item" href="bookings.php"><i class="bi bi-calendar-check me-2"></i>Lịch sử đặt phòng</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Đăng xuất</a></li>
              </ul>
            </div>
          data;
        }
        else
        {
          echo<<<data
            <button type="button" class="btn btn-outline-dark shadow-none me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
              <i class="bi bi-box-arrow-in-right me-1"></i>
              <span class="d-none d-sm-inline">Đăng nhập</span>
            </button>
            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
              <i class="bi bi-person-plus me-1"></i>
              <span class="d-none d-sm-inline">Đăng ký</span>
            </button>
          data;
        }
      ?>
      
      <!-- Toggle button cho mobile -->
      <button class="navbar-toggler ms-2 shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>

    <!-- Navigation menu ở giữa -->
    <div class="collapse navbar-collapse order-lg-2" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link px-3" href="index.php">
            <i class="bi bi-house-door me-1"></i>Trang chủ
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="rooms.php">
            <i class="bi bi-door-open me-1"></i>Danh sách phòng
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="facilities.php">
            <i class="bi bi-star me-1"></i>Tiện ích
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="contact.php">
            <i class="bi bi-envelope me-1"></i>Liên hệ
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="about.php">
            <i class="bi bi-info-circle me-1"></i>Về chúng tôi
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- CSS tùy chỉnh -->
<style>
  #nav-bar {
    padding: 0.75rem 0;
    transition: all 0.3s ease;
  }

  .navbar-brand {
    font-size: 1.5rem;
    transition: transform 0.3s ease;
  }

  .navbar-brand:hover {
    transform: scale(1.05);
  }

  .nav-link {
    font-weight: 500;
    position: relative;
    transition: color 0.3s ease;
  }

  .nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background-color: #212529;
    transition: all 0.3s ease;
    transform: translateX(-50%);
  }

  .nav-link:hover::after,
  .nav-link.active::after {
    width: 80%;
  }

  .nav-link:hover {
    color: #212529 !important;
  }

  .dropdown-menu {
    border: none;
    margin-top: 0.5rem;
  }

  .dropdown-item {
    padding: 0.75rem 1.25rem;
    transition: all 0.2s ease;
  }

  .dropdown-item:hover {
    background-color: #f8f9fa;
    padding-left: 1.5rem;
  }

  @media (max-width: 991px) {
    .navbar-nav {
      padding: 1rem 0;
    }
    
    .nav-link {
      padding: 0.75rem 1rem !important;
    }
  }
</style>

<!-- Modals giữ nguyên như cũ -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="login-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-circle fs-3 me-2"></i> Đăng nhập
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Email / Số điện thoại</label>
            <input type="text" name="email_mob" required class="form-control shadow-none">
          </div>
          <div class="mb-4">
            <label class="form-label">Mật khẩu</label>
            <input type="password" name="pass" required class="form-control shadow-none">
          </div>
          <div class="d-flex align-items-center justify-content-between mb-2">
            <button type="submit" class="btn btn-dark shadow-none">Tiếp tục</button>
            <button type="button" class="btn text-secondary text-decoration-none shadow-none p-0" data-bs-toggle="modal" data-bs-target="#forgotModal" data-bs-dismiss="modal">
              Bạn quên mật khẩu?
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="register-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-lines-fill fs-3 me-2"></i> Đăng ký
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Tên</label>
                <input name="name" type="text" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Số điện thoại</label>
                <input name="phonenum" type="number" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Ảnh đại diện</label>
                <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none">
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Địa chỉ</label>
                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Mã định danh</label>
                <input name="pincode" type="number" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Sinh nhật</label>
                <input name="dob" type="date" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Mật khẩu</label>
                <input name="pass" type="password" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Xác nhận lại mật khẩu</label>
                <input name="cpass" type="password" class="form-control shadow-none" required>
              </div>
            </div>
          </div>
          <div class="text-center my-1">
            <button type="submit" class="btn btn-dark shadow-none">Đăng ký</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="forgot-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-circle fs-3 me-2"></i> Quên mật khẩu
          </h5>
        </div>
        <div class="modal-body">
          <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
            Ghi chú: Liên kết sẽ được gửi tới địa chỉ email của bạn để tạo lại mật khẩu!
          </span>
          <div class="mb-4">
            <label class="form-label">Email</label>
            <input type="email" name="email" required class="form-control shadow-none">
          </div>
          <div class="mb-2 text-end">
            <button type="button" class="btn shadow-none p-0 me-2" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
              Huỷ
            </button>
            <button type="submit" class="btn btn-dark shadow-none">Gửi</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>