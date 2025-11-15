<?php
  require('inc/essentials.php');
  require('inc/db_config.php');
  adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang Quản Lý</title>
  <?php require('inc/links.php'); ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <style>
 
    body {
      background-color: #f8f9fa; 
    }

    
    .stat-card-link {
      text-decoration: none;
    }
    
    .simple-stat-card {
      border: 1px solid #e9ecef;
      border-left: 4px solid #0d6efd;
      border-radius: 0.375rem; 
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .simple-stat-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .border-left-green { border-left-color: #198754; }
    .border-left-yellow { border-left-color: #ffc107; }
    .border-left-info { border-left-color: #0dcaf0; }
    .border-left-red { border-left-color: #dc3545; }
    .border-left-secondary { border-left-color: #6c757d; }

    .stat-icon {
      font-size: 2.5rem; 
      opacity: 0.6;
    }

    .page-title {
      font-weight: 600;
    }

    .chart-container {
      position: relative;
      height: 300px;
      width: 100%;
    }
  </style>
</head>
<body>

  <?php 
    require('inc/header.php'); 
    
    $is_shutdown = mysqli_fetch_assoc(mysqli_query($con,"SELECT `shutdown` FROM `settings`"));

    $current_bookings = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
      COUNT(CASE WHEN booking_status='booked' AND arrival=0 THEN 1 END) AS `new_bookings`,
      COUNT(CASE WHEN booking_status='cancelled' AND refund=0 THEN 1 END) AS `refund_bookings`
      FROM `booking_order`"));

    $unread_queries = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count`
      FROM `user_queries` WHERE `seen`=0"));

    $unread_reviews = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count`
      FROM `rating_review` WHERE `seen`=0"));
    
    $current_users = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
      COUNT(id) AS `total`,
      COUNT(CASE WHEN `status`=1 THEN 1 END) AS `active`,
      COUNT(CASE WHEN `status`=0 THEN 1 END) AS `inactive`,
      COUNT(CASE WHEN `is_verified`=0 THEN 1 END) AS `unverified`
      FROM `user_cred`")); 
  ?>

  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h1 class="page-title">Dashboard</h1>
          <?php 
            if($is_shutdown['shutdown']){
              echo '<span class="badge bg-danger fs-6 rounded-pill">🔒 Chế độ bảo trì</span>';
            }
          ?>
        </div>

        <h5 class="mb-3 fw-bold">Tổng quan nhanh</h5>
        <div class="row g-4 mb-4">
          
          <div class="col-xl-3 col-md-6">
            <a href="new_bookings.php" class="stat-card-link">
              <div class="card simple-stat-card border-left-green">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h6 class="text-muted text-uppercase mb-2">Đặt phòng mới</h6>
                      <h2 class="fw-bold mb-0"><?php echo $current_bookings['new_bookings'] ?></h2>
                    </div>
                    <i class="bi bi-calendar-check stat-icon text-success"></i>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <div class="col-xl-3 col-md-6">
            <a href="refund_bookings.php" class="stat-card-link">
              <div class="card simple-stat-card border-left-yellow">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h6 class="text-muted text-uppercase mb-2">Hoàn tiền</h6>
                      <h2 class="fw-bold mb-0"><?php echo $current_bookings['refund_bookings'] ?></h2>
                    </div>
                    <i class="bi bi-cash-coin stat-icon text-warning"></i>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <div class="col-xl-3 col-md-6">
            <a href="user_queries.php" class="stat-card-link">
              <div class="card simple-stat-card border-left-info">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h6 class="text-muted text-uppercase mb-2">Tin nhắn</h6>
                      <h2 class="fw-bold mb-0"><?php echo $unread_queries['count'] ?></h2>
                    </div>
                    <i class="bi bi-chat-dots stat-icon text-info"></i>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <div class="col-xl-3 col-md-6">
            <a href="rate_review.php" class="stat-card-link">
              <div class="card simple-stat-card border-left-secondary">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h6 class="text-muted text-uppercase mb-2">Đánh giá</h6>
                      <h2 class="fw-bold mb-0"><?php echo $unread_reviews['count'] ?></h2>
                    </div>
                    <i class="bi bi-star stat-icon text-secondary"></i>
                  </div>
                </div>
              </div>
            </a>
          </div>

        </div> <h5 class="mb-3 fw-bold">Thống kê</h5>
        <div class="row g-4 mb-4">
          
          <div class="col-lg-7">
            <div class="card shadow-sm h-100">
              <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Phân tích đặt phòng</h6>
                <select class="form-select form-select-sm w-auto" onchange="booking_analytics(this.value)">
                  <option value="1">30 ngày qua</option>
                  <option value="2">90 ngày qua</option>
                  <option value="3">1 năm qua</option>
                  <option value="4">Toàn bộ thời gian</option>
                </select>
              </div>
              <div class="card-body">
                <div class="chart-container">
                  <canvas id="bookingChart"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="card shadow-sm h-100">
              <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Tương tác người dùng</h6>
                <select class="form-select form-select-sm w-auto" onchange="user_analytics(this.value)">
                  <option value="1">30 ngày qua</option>
                  <option value="2">90 ngày qua</option>
                  <option value="3">1 năm qua</option>
                  <option value="4">Toàn bộ thời gian</option>
                </select>
              </div>
              <div class="card-body">
                <div class="chart-container">
                  <canvas id="userChart"></canvas>
                </div>
              </div>
            </div>
          </div>

        </div> <h5 class="mb-3 fw-bold">Quản lý người dùng</h5>
        <div class="row g-4">
          
          <div class="col-xl-3 col-md-6">
            <div class="card simple-stat-card border-left-secondary">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="text-muted text-uppercase mb-2">Tổng người dùng</h6>
                    <h2 class="fw-bold mb-0"><?php echo $current_users['total'] ?></h2>
                  </div>
                  <i class="bi bi-people stat-icon text-secondary"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6">
            <div class="card simple-stat-card border-left-green">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="text-muted text-uppercase mb-2">Đang hoạt động</h6>
                    <h2 class="fw-bold mb-0"><?php echo $current_users['active'] ?></h2>
                  </div>
                  <i class="bi bi-check-circle stat-icon text-success"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6">
            <div class="card simple-stat-card border-left-yellow">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="text-muted text-uppercase mb-2">Không hoạt động</h6>
                    <h2 class="fw-bold mb-0"><?php echo $current_users['inactive'] ?></h2>
                  </div>
                  <i class="bi bi-pause-circle stat-icon text-warning"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6">
            <div class="card simple-stat-card border-left-red">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="text-muted text-uppercase mb-2">Chưa xác thực</h6>
                    <h2 class="fw-bold mb-0"><?php echo $current_users['unverified'] ?></h2>
                  </div>
                  <i class="bi bi-exclamation-circle stat-icon text-danger"></i>
                </div>
              </div>
            </div>
          </div>

        </div> </div>
    </div>
  </div>
  
  <?php require('inc/scripts.php'); ?>
  <script src="scripts/dashboard.js"></script>
  <script>
    let bookingChart, userChart;

    const bookingCtx = document.getElementById('bookingChart').getContext('2d');
    bookingChart = new Chart(bookingCtx, {
      type: 'line',
      data: {
        labels: ['Tuần 1', 'Tuần 2', 'Tuần 3', 'Tuần 4'],
        datasets: [{
          label: 'Tổng đặt phòng',
          data: [65, 78, 90, 81],
          borderColor: '#4299e1',
          backgroundColor: 'rgba(66, 153, 225, 0.1)',
          tension: 0.4,
          fill: true,
          borderWidth: 2
        }, {
          label: 'Đang hoạt động',
          data: [45, 62, 75, 68],
          borderColor: '#48bb78',
          backgroundColor: 'rgba(72, 187, 120, 0.1)',
          tension: 0.4,
          fill: true,
          borderWidth: 2
        }, {
          label: 'Đã hủy',
          data: [20, 16, 15, 13],
          borderColor: '#f56565',
          backgroundColor: 'rgba(245, 101, 101, 0.1)',
          tension: 0.4,
          fill: true,
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false, 
        plugins: {
          legend: { display: true, position: 'top' }
        },
        scales: {
          y: { beginAtZero: true },
          x: { grid: { display: false } }
        }
      }
    });

    // User Chart
    const userCtx = document.getElementById('userChart').getContext('2d');
    userChart = new Chart(userCtx, {
      type: 'bar',
      data: {
        labels: ['Tuần 1', 'Tuần 2', 'Tuần 3', 'Tuần 4'],
        datasets: [{
          label: 'Đăng ký mới',
          data: [12, 19, 15, 22],
          backgroundColor: '#48bb78',
        }, {
          label: 'Tin nhắn',
          data: [25, 32, 28, 35],
          backgroundColor: '#4299e1',
        }, {
          label: 'Đánh giá',
          data: [18, 24, 21, 28],
          backgroundColor: '#ed8936',
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false, 
        plugins: {
          legend: { display: true, position: 'top' }
        },
        scales: {
          y: { beginAtZero: true },
          x: { grid: { display: false } }
        }
      }
    });
  </script>
