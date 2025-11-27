<?php
  session_start();
  
  if(!isset($_SESSION['pending_order'])){
    header('Location: index.php');
    exit;
  }
  
  $order = $_SESSION['pending_order'];
  
  // Generate QR data (in real app, this would be actual payment QR)
  $qr_data = "HOTEL_PAYMENT|" . $order['order_id'] . "|" . $order['amount'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thanh toán QR Code</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(135deg, #00a651 0%, #007f3d 100%);
      min-height: 100vh;
    }
    
    .container {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
    }
    
    /* Header */
    .header {
      background: white;
      border-radius: 15px;
      padding: 25px;
      margin-bottom: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    
    .back-btn {
      color: #00a651;
      font-size: 24px;
      cursor: pointer;
      margin-bottom: 15px;
      display: inline-block;
    }
    
    .header-title {
      font-size: 24px;
      color: #00a651;
      font-weight: 700;
      margin-bottom: 10px;
    }
    
    .amount-display {
      font-size: 32px;
      color: #007f3d;
      font-weight: 800;
      margin: 15px 0;
    }
    
    .order-info {
      font-size: 13px;
      color: #666;
      margin-top: 10px;
    }
    
    /* QR Section */
    .qr-section {
      background: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      text-align: center;
    }
    
    .qr-title {
      font-size: 18px;
      font-weight: 700;
      color: #333;
      margin-bottom: 10px;
    }
    
    .qr-subtitle {
      font-size: 14px;
      color: #666;
      margin-bottom: 25px;
    }
    
    .qr-container {
      background: white;
      padding: 25px;
      border-radius: 15px;
      border: 3px solid #00a651;
      display: inline-block;
      margin-bottom: 20px;
      box-shadow: 0 5px 20px rgba(0, 166, 81, 0.2);
    }
    
    .qr-code {
      width: 250px;
      height: 250px;
      background: 
        linear-gradient(45deg, #f0f0f0 25%, transparent 25%),
        linear-gradient(-45deg, #f0f0f0 25%, transparent 25%),
        linear-gradient(45deg, transparent 75%, #f0f0f0 75%),
        linear-gradient(-45deg, transparent 75%, #f0f0f0 75%);
      background-size: 20px 20px;
      background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      position: relative;
    }
    
    .qr-icon {
      font-size: 80px;
      color: #00a651;
    }
    
    .supported-apps {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin: 25px 0;
      flex-wrap: wrap;
    }
    
    .app-icon {
      width: 50px;
      height: 50px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      color: white;
      font-weight: bold;
      box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }
    
    .app-icon.momo {
      background: linear-gradient(135deg, #a50064, #d82d8b);
    }
    
    .app-icon.zalopay {
      background: linear-gradient(135deg, #0068ff, #00a7ff);
    }
    
    .app-icon.viettelpay {
      background: linear-gradient(135deg, #e03a3a, #ff6b6b);
    }
    
    .app-icon.vnpay {
      background: linear-gradient(135deg, #0057a5, #007bff);
    }
    
    .app-icon.shopeepay {
      background: linear-gradient(135deg, #ee4d2d, #ff6347);
    }
    
    .instructions {
      text-align: left;
      background: #f8f9fa;
      padding: 20px;
      border-radius: 10px;
      margin-top: 20px;
    }
    
    .instruction-title {
      font-size: 15px;
      font-weight: 700;
      color: #333;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    .instruction-step {
      display: flex;
      align-items: flex-start;
      margin-bottom: 12px;
      font-size: 14px;
      color: #555;
    }
    
    .step-number {
      min-width: 25px;
      height: 25px;
      background: #00a651;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 12px;
      margin-right: 10px;
    }
    
    .countdown {
      font-size: 16px;
      color: #00a651;
      font-weight: 700;
      margin-top: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }
    
    .countdown-time {
      font-size: 20px;
      color: #e03a3a;
    }
    
    .btn-cancel {
      width: 100%;
      padding: 15px;
      background: white;
      color: #666;
      border: 2px solid #e0e0e0;
      border-radius: 10px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      margin-top: 15px;
      transition: all 0.3s;
    }
    
    .btn-cancel:hover {
      border-color: #00a651;
      color: #00a651;
    }
    
    .status-waiting {
      background: #fff3cd;
      color: #856404;
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 14px;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }
    
    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }
    
    .pulse {
      animation: pulse 1.5s infinite;
    }
    
    /* Loading overlay */
    .loading-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.9);
      z-index: 9999;
      align-items: center;
      justify-content: center;
    }
    
    .loading-content {
      text-align: center;
      color: white;
    }
    
    .spinner {
      border: 4px solid rgba(255,255,255,0.3);
      border-top: 4px solid white;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 1s linear infinite;
      margin: 0 auto 20px;
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="header">
      <i class="fas fa-arrow-left back-btn" onclick="window.location.href='payment_demo.php'"></i>
      <div class="header-title">Thanh toán QR Code</div>
      <div class="amount-display"><?php echo number_format($order['amount']); ?>đ</div>
      <div class="order-info">
        Mã đơn: <?php echo $order['order_id']; ?> • <?php echo $order['name']; ?>
      </div>
    </div>
    
    <div class="qr-section">
      <div class="status-waiting pulse">
        <i class="fas fa-clock"></i>
        Đang chờ thanh toán
      </div>
      
      <div class="qr-title">Quét mã QR để thanh toán</div>
      <div class="qr-subtitle">Sử dụng ứng dụng Ngân hàng hoặc Ví điện tử</div>
      
      <div class="qr-container">
        <div class="qr-code">
          <i class="fas fa-qrcode qr-icon"></i>
        </div>
      </div>
      
      <div class="countdown">
        <i class="fas fa-hourglass-half"></i>
        Mã QR hết hạn sau: <span class="countdown-time" id="countdown">10:00</span>
      </div>
      
      <div style="text-align: center; margin: 20px 0;">
        <p style="font-size: 13px; color: #666; margin-bottom: 10px;">Hỗ trợ thanh toán qua:</p>
      </div>
      <div class="supported-apps">
            <div class="app-icon momo"><i class="fab fa-cc-apple-pay"></i></div>
            <div class="app-icon zalopay"><i class="fas fa-wallet"></i></div>
            <div class="app-icon viettelpay"><i class="fas fa-mobile-alt"></i></div>
            <div class="app-icon vnpay"><i class="fas fa-credit-card"></i></div>
            <div class="app-icon shopeepay"><i class="fas fa-shopping-bag"></i></div>
        </div>

      <div class="instructions">
        <div class="instruction-title">
          <i class="fas fa-info-circle"></i>
          Hướng dẫn thanh toán
        </div>
        <div class="instruction-step">
          <div class="step-number">1</div>
          <div>Mở ứng dụng Ngân hàng hoặc Ví điện tử</div>
        </div>
        <div class="instruction-step">
          <div class="step-number">2</div>
          <div>Chọn chức năng Quét mã QR</div>
        </div>
        <div class="instruction-step">
          <div class="step-number">3</div>
          <div>Quét mã QR trên màn hình này</div>
        </div>
        <div class="instruction-step">
          <div class="step-number">4</div>
          <div>Xác nhận thông tin và hoàn tất thanh toán</div>
        </div>
      </div>
      
      <button class="btn-cancel" onclick="window.location.href='payment_demo.php'">
        <i class="fas fa-arrow-left"></i> Chọn phương thức khác
      </button>
    </div>
  </div>
  
  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
      <div class="spinner"></div>
      <h3>Đã nhận thanh toán!</h3>
      <p>Đang xử lý giao dịch...</p>
    </div>
  </div>
  
  <script>
    // Countdown timer
    let timeLeft = 600; // 10 minutes
    
    function updateCountdown() {
      const minutes = Math.floor(timeLeft / 60);
      const seconds = timeLeft % 60;
      document.getElementById('countdown').textContent = 
        `${minutes}:${seconds.toString().padStart(2, '0')}`;
      
      if (timeLeft <= 0) {
        alert('Mã QR đã hết hạn. Vui lòng thử lại.');
        window.location.href = 'momo_payment.php';
        return;
      }
      
      timeLeft--;
    }
    
    setInterval(updateCountdown, 1000);
    
    // Simulate payment detection after random time (5-15 seconds)
    const paymentDelay = Math.random() * 10000 + 5000;
    
    setTimeout(() => {
      document.getElementById('loadingOverlay').style.display = 'flex';
      
      setTimeout(() => {
        const isSuccess = Math.random() > 0.1;
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'payment_callback.php';
        
        const statusInput = document.createElement('input');
        statusInput.type = 'hidden';
        statusInput.name = 'status';
        statusInput.value = isSuccess ? 'success' : 'failed';
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = 'method';
        methodInput.value = 'qr';
        
        form.appendChild(statusInput);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
      }, 1500);
    }, paymentDelay);
  </script>
</body>
</html>