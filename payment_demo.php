<?php
  session_start();
  
  if(!isset($_SESSION['pending_order'])){
    header('Location: index.php');
    exit;
  }
  
  $order = $_SESSION['pending_order'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thanh toán MoMo</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
      background: #f5f5f5;
    }
    
    /* Header MoMo */
    .momo-header {
      background: linear-gradient(90deg, #a50064 0%, #d82d8b 100%);
      color: white;
      padding: 15px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .momo-header h1 {
      font-size: 20px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .momo-logo {
      width: 35px;
      height: 35px;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: #a50064;
    }
    
    /* Container */
    .container {
      max-width: 480px;
      margin: 0 auto;
      background: white;
      min-height: 100vh;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    
    /* Merchant Info */
    .merchant-info {
      padding: 20px;
      border-bottom: 8px solid #f5f5f5;
    }
    
    .merchant-name {
      font-size: 18px;
      font-weight: 600;
      color: #333;
      margin-bottom: 5px;
    }
    
    .order-code {
      font-size: 13px;
      color: #888;
    }
    
    /* Amount Section */
    .amount-section {
      padding: 25px 20px;
      text-align: center;
      background: #fff;
      border-bottom: 8px solid #f5f5f5;
    }
    
    .amount-label {
      font-size: 14px;
      color: #666;
      margin-bottom: 8px;
    }
    
    .amount-value {
      font-size: 36px;
      font-weight: 700;
      color: #a50064;
      margin-bottom: 5px;
    }
    
    /* Payment Methods */
    .payment-methods {
      padding: 0;
    }
    
    .method-header {
      padding: 15px 20px;
      background: #f9f9f9;
      font-size: 13px;
      color: #666;
      font-weight: 600;
      text-transform: uppercase;
    }
    
    .method-item {
      display: flex;
      align-items: center;
      padding: 18px 20px;
      border-bottom: 1px solid #f0f0f0;
      cursor: pointer;
      transition: background 0.3s;
      position: relative;
    }
    
    .method-item:hover {
      background: #fafafa;
    }
    
    .method-item.selected {
      background: #fff5f9;
      border-left: 3px solid #a50064;
    }
    
    .method-icon {
      width: 45px;
      height: 45px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      margin-right: 15px;
      border-radius: 8px;
      background: #f5f5f5;
    }
    
    .method-icon.momo {
      background: linear-gradient(135deg, #a50064 0%, #d82d8b 100%);
      color: white;
    }
    
    .method-icon.visa {
      background: #1a1f71;
      color: white;
      font-size: 18px;
      font-weight: bold;
    }
    
    .method-icon.atm {
      background: #0066cc;
      color: white;
    }
    
    .method-info {
      flex: 1;
    }
    
    .method-name {
      font-size: 15px;
      font-weight: 600;
      color: #333;
      margin-bottom: 3px;
    }
    
    .method-desc {
      font-size: 12px;
      color: #999;
    }
    
    .method-radio {
      width: 20px;
      height: 20px;
      border: 2px solid #ddd;
      border-radius: 50%;
      position: relative;
    }
    
    .method-item.selected .method-radio {
      border-color: #a50064;
    }
    
    .method-item.selected .method-radio::after {
      content: '';
      position: absolute;
      width: 12px;
      height: 12px;
      background: #a50064;
      border-radius: 50%;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
    
    /* Payment Button */
    .payment-actions {
      padding: 20px;
      background: white;
      position: fixed;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 100%;
      max-width: 480px;
      box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
    }
    
    .btn-pay {
      width: 100%;
      padding: 16px;
      background: linear-gradient(90deg, #a50064 0%, #d82d8b 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.2s;
      box-shadow: 0 4px 15px rgba(165, 0, 100, 0.3);
    }
    
    .btn-pay:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(165, 0, 100, 0.4);
    }
    
    .btn-pay:active {
      transform: translateY(0);
    }
    
    .btn-pay:disabled {
      background: #ccc;
      cursor: not-allowed;
      box-shadow: none;
    }
    
    
    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }
    
    /* Order Details */
    .order-details {
      padding: 20px;
      border-bottom: 8px solid #f5f5f5;
    }
    
    .detail-row {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      font-size: 14px;
    }
    
    .detail-label {
      color: #666;
    }
    
    .detail-value {
      color: #333;
      font-weight: 500;
    }
    
    /* Loading overlay */
    .loading-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.8);
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
    <!-- Header -->
    <div class="momo-header">
      <h1>
        <div class="momo-logo">M</div>
        Thanh toán MoMo
      </h1>
      <i class="fas fa-times" style="font-size: 24px; cursor: pointer;" onclick="window.location.href='rooms.php'"></i>
    </div>
    
    <!-- Merchant Info -->
    <div class="merchant-info">
      <div class="merchant-name">🏨 <?php echo $_SESSION['room']['name'] ?? 'Hotel Booking'; ?></div>
      <div class="order-code">Mã đơn hàng: <?php echo $order['order_id']; ?></div>
    </div>
    
    <!-- Amount -->
    <div class="amount-section">
      <div class="amount-label">Số tiền thanh toán</div>
      <div class="amount-value"><?php echo number_format($order['amount']); ?>đ</div>
    </div>
    
    <!-- Order Details -->
    <div class="order-details">
      <div class="detail-row">
        <span class="detail-label">Khách hàng</span>
        <span class="detail-value"><?php echo $order['name']; ?></span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Số điện thoại</span>
        <span class="detail-value"><?php echo $order['phonenum']; ?></span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Check-in</span>
        <span class="detail-value"><?php echo date('d/m/Y', strtotime($order['checkin'])); ?></span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Check-out</span>
        <span class="detail-value"><?php echo date('d/m/Y', strtotime($order['checkout'])); ?></span>
      </div>
    </div>
    
    <!-- Payment Methods -->
    <div class="payment-methods">
      <div class="method-header">Chọn phương thức thanh toán</div>
      
      <div class="method-item selected" onclick="selectMethod(this)" data-method="momo">
        <div class="method-icon momo">
          <i class="fas fa-wallet"></i>
        </div>
        <div class="method-info">
          <div class="method-name">Ví MoMo</div>
          <div class="method-desc">Thanh toán qua ví điện tử MoMo</div>
        </div>
        <div class="method-radio"></div>
      </div>
      
      <div class="method-item" onclick="selectMethod(this)" data-method="visa">
        <div class="method-icon visa">
          VISA
        </div>
        <div class="method-info">
          <div class="method-name">Thẻ quốc tế Visa, Master, JCB</div>
          <div class="method-desc">Thanh toán bằng thẻ quốc tế</div>
        </div>
        <div class="method-radio"></div>
      </div>
      
      <div class="method-item" onclick="selectMethod(this)" data-method="atm">
        <div class="method-icon atm">
          <i class="fas fa-credit-card"></i>
        </div>
        <div class="method-info">
          <div class="method-name">Thẻ ATM nội địa</div>
          <div class="method-desc">Thẻ ATM có internet banking</div>
        </div>
        <div class="method-radio"></div>
      </div>
      
      <div class="method-item" onclick="selectMethod(this)" data-method="qr">
        <div class="method-icon" style="background: #00a651; color: white;">
          <i class="fas fa-qrcode"></i>
        </div>
        <div class="method-info">
          <div class="method-name">Quét mã QR</div>
          <div class="method-desc">Quét mã QR để thanh toán</div>
        </div>
        <div class="method-radio"></div>
      </div>
    </div>
    
    <div style="height: 100px;"></div>
    
    <!-- Payment Actions -->
    <div class="payment-actions">
      <button class="btn-pay" onclick="processPayment()">
        <i class="fas fa-lock"></i> Xác nhận thanh toán
      </button>
    </div>
  </div>
  
  <!-- Loading Overlay -->
  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
      <div class="spinner"></div>
      <h3>Đang xử lý thanh toán...</h3>
      <p>Vui lòng không tắt trình duyệt</p>
    </div>
  </div>
  
  <script>
    let selectedMethod = 'momo';
    
    function selectMethod(element) {
      // Remove selected class from all
      document.querySelectorAll('.method-item').forEach(item => {
        item.classList.remove('selected');
      });
      
      // Add selected class to clicked item
      element.classList.add('selected');
      selectedMethod = element.dataset.method;
    }
    
    function processPayment() {
      // Redirect to appropriate payment page based on selected method
      const paymentPages = {
        'momo': 'momo_payment.php', // Stay on current page
        'visa': 'visa_payment.php',
        'atm': 'atm_payment.php',
        'qr': 'qr_payment.php'
      };
      
      if (selectedMethod === 'momo') {
        // For MoMo wallet, process payment directly
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
          methodInput.value = selectedMethod;
          
          form.appendChild(statusInput);
          form.appendChild(methodInput);
          document.body.appendChild(form);
          form.submit();
        }, 2000);
      } else {
        // For other methods, redirect to their specific pages
        window.location.href = paymentPages[selectedMethod];
      }
    }
  </script>
</body>
</html>