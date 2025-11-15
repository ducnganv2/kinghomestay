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
    :root {
      --primary-color: #6366f1;
      --success-color: #10b981;
      --danger-color: #ef4444;
      --warning-color: #f59e0b;
      --info-color: #3b82f6;
      --dark-color: #1f2937;
    }

    body {
      background: #f8f9fc;
    }

    .stats-card {
      border-radius: 15px;
      border: none;
      box-shadow: 0 5px 20px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
      overflow: hidden;
      position: relative;
      height: 100%;
    }

    .stats-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .stats-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: var(--color);
    }

    .stats-card.card-primary::before {
      background: var(--primary-color);
    }

    .stats-card.card-success::before {
      background: var(--success-color);
    }

    .stats-card.card-danger::before {
      background: var(--danger-color);
    }

    .stats-card.card-warning::before {
      background: var(--warning-color);
    }

    .stats-card.card-info::before {
      background: var(--info-color);
    }

    .stats-card .card-body {
      padding: 1.5rem;
    }

    .stats-icon {
      width: 60px;
      height: 60px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      color: white;
      background: var(--color);
      margin-bottom: 15px;
    }

    .stats-icon.icon-primary {
      background: var(--primary-color);
    }

    .stats-icon.icon-success {
      background: var(--success-color);
    }

    .stats-icon.icon-danger {
      background: var(--danger-color);
    }

    .stats-icon.icon-warning {
      background: var(--warning-color);
    }

    .stats-icon.icon-info {
      background: var(--info-color);
    }

    .stats-value {
      font-size: 2rem;
      font-weight: 700;
      color: #2c3e50;
      margin: 0;
    }

    .stats-label {
      font-size: 0.875rem;
      color: #6c757d;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-weight: 600;
    }

    .stats-change {
      font-size: 0.875rem;
      font-weight: 600;
      margin-top: 8px;
    }

    .stats-change.positive {
      color: #10b981;
    }

    .stats-change.negative {
      color: #ef4444;
    }

    .chart-container {
      background: white;
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.08);
      margin-bottom: 30px;
    }

    .chart-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 2px solid #f0f0f0;
    }

    .chart-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #2c3e50;
      margin: 0;
    }

    .filter-select {
      border-radius: 8px;
      border: 2px solid #e9ecef;
      padding: 8px 15px;
      font-size: 0.875rem;
      font-weight: 600;
      color: #495057;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .filter-select:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
    }

    .page-header {
      background: white;
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.08);
      margin-bottom: 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .page-title {
      font-size: 1.75rem;
      font-weight: 700;
      color: #2c3e50;
      margin: 0;
    }

    .shutdown-badge {
      background: var(--danger-color);
      color: white;
      padding: 10px 20px;
      border-radius: 25px;
      font-weight: 600;
      font-size: 0.875rem;
      box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .section-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #2c3e50;
      margin-bottom: 20px;
      padding-left: 15px;
      border-left: 4px solid var(--primary-color);
    }

    .quick-action-card {
      background: white;
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
      cursor: pointer;
      text-decoration: none;
      display: block;
      height: 100%;
    }

    .quick-action-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.12);
      text-decoration: none;
    }

    .action-icon {
      width: 50px;
      height: 50px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      color: white;
      margin-bottom: 15px;
    }

    .action-title {
      font-size: 0.875rem;
      color: #6c757d;
      margin-bottom: 5px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-weight: 600;
    }

    .action-value {
      font-size: 1.75rem;
      font-weight: 700;
      color: #2c3e50;
    }

    @media (max-width: 768px) {
      .stats-value {
        font-size: 1.5rem;
      }
      
      .chart-container {
        padding: 15px;
      }
      
      .page-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
      }
    }
  </style>
</head>
<body class="bg-light">

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
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        
        <!-- Page Header -->
        <div class="page-header">
          <h1 class="page-title">📊 Dashboard Overview</h1>
          <?php 
            if($is_shutdown['shutdown']){
              echo '<span class="shutdown-badge">🔒 Shutdown Mode Active</span>';
            }
          ?>
        </div>

        <!-- Quick Actions -->
        <h5 class="section-title">Quick Actions</h5>
        <div class="row mb-4">
          <div class="col-md-3 col-sm-6 mb-4">
            <a href="new_bookings.php" class="quick-action-card">
              <div class="action-icon icon-success">
                <i class="bi bi-calendar-check"></i>
              </div>
              <div class="action-title">Lượt đặt phòng mới</div>
              <div class="action-value"><?php echo $current_bookings['new_bookings'] ?></div>
              <div class="stats-change positive">
                <i class="bi bi-arrow-up"></i> +12% so với tuần trước
              </div>
            </a>
          </div>
          <div class="col-md-3 col-sm-6 mb-4">
            <a href="refund_bookings.php" class="quick-action-card">
              <div class="action-icon icon-warning">
                <i class="bi bi-cash-coin"></i>
              </div>
              <div class="action-title">Lượt hoàn tiền</div>
              <div class="action-value"><?php echo $current_bookings['refund_bookings'] ?></div>
              <div class="stats-change negative">
                <i class="bi bi-arrow-down"></i> -5% so với tuần trước
              </div>
            </a>
          </div>
          <div class="col-md-3 col-sm-6 mb-4">
            <a href="user_queries.php" class="quick-action-card">
              <div class="action-icon icon-info">
                <i class="bi bi-chat-dots"></i>
              </div>
              <div class="action-title">Số tin nhắn</div>
              <div class="action-value"><?php echo $unread_queries['count'] ?></div>
              <div class="stats-change positive">
                <i class="bi bi-arrow-up"></i> +8% so với tuần trước
              </div>
            </a>
          </div>
          <div class="col-md-3 col-sm-6 mb-4">
            <a href="rate_review.php" class="quick-action-card">
              <div class="action-icon icon-warning">
                <i class="bi bi-star"></i>
              </div>
              <div class="action-title">Lượt đánh giá</div>
              <div class="action-value"><?php echo $unread_reviews['count'] ?></div>
              <div class="stats-change positive">
                <i class="bi bi-arrow-up"></i> +15% so với tuần trước
              </div>
            </a>
          </div>
        </div>

        <!-- Booking Analytics Chart -->
        <h5 class="section-title">📈 Booking Analytics</h5>
        <div class="chart-container">
          <div class="chart-header">
            <h5 class="chart-title">Thống kê đặt phòng</h5>
            <select class="filter-select" onchange="booking_analytics(this.value)">
              <option value="1">30 ngày qua</option>
              <option value="2">90 ngày qua</option>
              <option value="3">1 năm qua</option>
              <option value="4">Toàn bộ thời gian</option>
            </select>
          </div>
          <div class="row mb-3">
            <div class="col-md-4 mb-3">
              <div class="stats-card gradient-primary">
                <div class="card-body">
                  <div class="stats-icon icon-primary">
                    <i class="bi bi-graph-up"></i>
                  </div>
                  <p class="stats-label">Total Bookings</p>
                  <h2 class="stats-value" id="total_bookings">0</h2>
                  <p class="text-muted mb-0" id="total_amt" style="font-size: 1rem; font-weight: 600;">0 VND</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="stats-card gradient-success">
                <div class="card-body">
                  <div class="stats-icon icon-success">
                    <i class="bi bi-check-circle"></i>
                  </div>
                  <p class="stats-label">Active Bookings</p>
                  <h2 class="stats-value" id="active_bookings">0</h2>
                  <p class="text-muted mb-0" id="active_amt" style="font-size: 1rem; font-weight: 600;">0 VND</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="stats-card gradient-danger">
                <div class="card-body">
                  <div class="stats-icon icon-danger">
                    <i class="bi bi-x-circle"></i>
                  </div>
                  <p class="stats-label">Cancelled Bookings</p>
                  <h2 class="stats-value" id="cancelled_bookings">0</h2>
                  <p class="text-muted mb-0" id="cancelled_amt" style="font-size: 1rem; font-weight: 600;">0 VND</p>
                </div>
              </div>
            </div>
          </div>
          <canvas id="bookingChart" height="80"></canvas>
        </div>

        <!-- User Analytics Chart -->
        <h5 class="section-title">👥 User, Queries & Reviews Analytics</h5>
        <div class="chart-container">
          <div class="chart-header">
            <h5 class="chart-title">Thống kê người dùng và tương tác</h5>
            <select class="filter-select" onchange="user_analytics(this.value)">
              <option value="1">30 ngày qua</option>
              <option value="2">90 ngày qua</option>
              <option value="3">1 năm qua</option>
              <option value="4">Toàn bộ thời gian</option>
            </select>
          </div>
          <div class="row mb-3">
            <div class="col-md-4 mb-3">
              <div class="stats-card card-success">
                <div class="card-body">
                  <div class="stats-icon icon-success">
                    <i class="bi bi-person-plus"></i>
                  </div>
                  <p class="stats-label">New Registration</p>
                  <h2 class="stats-value" id="total_new_reg">0</h2>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="stats-card card-info">
                <div class="card-body">
                  <div class="stats-icon icon-info">
                    <i class="bi bi-chat-left-text"></i>
                  </div>
                  <p class="stats-label">Queries</p>
                  <h2 class="stats-value" id="total_queries">0</h2>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="stats-card card-warning">
                <div class="card-body">
                  <div class="stats-icon icon-warning">
                    <i class="bi bi-star-fill"></i>
                  </div>
                  <p class="stats-label">Reviews</p>
                  <h2 class="stats-value" id="total_reviews">0</h2>
                </div>
              </div>
            </div>
          </div>
          <canvas id="userChart" height="80"></canvas>
        </div>
  
        <!-- Current Users Stats -->
        <h5 class="section-title">👤 User Statistics</h5>
        <div class="row mb-4">
          <div class="col-md-3 col-sm-6 mb-3">
            <div class="stats-card card-info">
              <div class="card-body text-center">
                <div class="stats-icon icon-info mx-auto">
                  <i class="bi bi-people"></i>
                </div>
                <p class="stats-label">Total Users</p>
                <h2 class="stats-value"><?php echo $current_users['total'] ?></h2>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 mb-3">
            <div class="stats-card card-success">
              <div class="card-body text-center">
                <div class="stats-icon icon-success mx-auto">
                  <i class="bi bi-check-circle"></i>
                </div>
                <p class="stats-label">Active Users</p>
                <h2 class="stats-value"><?php echo $current_users['active'] ?></h2>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 mb-3">
            <div class="stats-card card-warning">
              <div class="card-body text-center">
                <div class="stats-icon icon-warning mx-auto">
                  <i class="bi bi-pause-circle"></i>
                </div>
                <p class="stats-label">Inactive Users</p>
                <h2 class="stats-value"><?php echo $current_users['inactive'] ?></h2>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 mb-3">
            <div class="stats-card card-danger">
              <div class="card-body text-center">
                <div class="stats-icon icon-danger mx-auto">
                  <i class="bi bi-exclamation-circle"></i>
                </div>
                <p class="stats-label">Unverified Users</p>
                <h2 class="stats-value"><?php echo $current_users['unverified'] ?></h2>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  
  <?php require('inc/scripts.php'); ?>
  <script src="scripts/dashboard.js"></script>
  <script>
    // Initialize Charts
    let bookingChart, userChart;

    // Booking Chart
    const bookingCtx = document.getElementById('bookingChart').getContext('2d');
    bookingChart = new Chart(bookingCtx, {
      type: 'line',
      data: {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
        datasets: [{
          label: 'Total Bookings',
          data: [65, 78, 90, 81],
          borderColor: '#6366f1',
          backgroundColor: '#e0e7ff',
          tension: 0.4,
          fill: true
        }, {
          label: 'Active Bookings',
          data: [45, 62, 75, 68],
          borderColor: '#10b981',
          backgroundColor: '#d1fae5',
          tension: 0.4,
          fill: true
        }, {
          label: 'Cancelled',
          data: [20, 16, 15, 13],
          borderColor: '#ef4444',
          backgroundColor: '#fee2e2',
          tension: 0.4,
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            display: true,
            position: 'top',
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(0, 0, 0, 0.05)'
            }
          },
          x: {
            grid: {
              display: false
            }
          }
        }
      }
    });

    // User Chart
    const userCtx = document.getElementById('userChart').getContext('2d');
    userChart = new Chart(userCtx, {
      type: 'bar',
      data: {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
        datasets: [{
          label: 'New Registrations',
          data: [12, 19, 15, 22],
          backgroundColor: '#10b981',
        }, {
          label: 'Queries',
          data: [25, 32, 28, 35],
          backgroundColor: '#3b82f6',
        }, {
          label: 'Reviews',
          data: [18, 24, 21, 28],
          backgroundColor: '#f59e0b',
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            display: true,
            position: 'top',
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(0, 0, 0, 0.05)'
            }
          },
          x: {
            grid: {
              display: false
            }
          }
        }
      }
    });
  </script>
</body>
</html>