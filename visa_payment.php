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
  <title>Thanh toán thẻ quốc tế</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(135deg, #1a1f71 0%, #0d47a1 100%);
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
      color: #1a1f71;
      font-size: 24px;
      cursor: pointer;
      margin-bottom: 15px;
      display: inline-block;
    }
    
    .header-title {
      font-size: 24px;
      color: #1a1f71;
      font-weight: 700;
      margin-bottom: 10px;
    }
    
    .amount-display {
      font-size: 32px;
      color: #0d47a1;
      font-weight: 800;
      margin: 15px 0;
    }
    
    .order-info {
      font-size: 13px;
      color: #666;
      margin-top: 10px;
    }
    
    /* Card Form */
    .card-form {
      background: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    
    .card-brands {
      display: flex;
      gap: 15px;
      margin-bottom: 25px;
      justify-content: center;
    }
    
    .card-brand {
      width: 60px;
      height: 40px;
      background: #f5f5f5;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 14px;
      color: #666;
      border: 2px solid transparent;
      transition: all 0.3s;
    }
    
    .card-brand.visa {
      background: #1a1f71;
      color: white;
    }
    
    .card-brand.master {
      background: linear-gradient(90deg, #eb001b 50%, #f79e1b 50%);
      color: white;
    }
    
    .card-brand.jcb {
      background: linear-gradient(135deg, #0e4c96, #1c8d3a, #d62231);
      color: white;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-label {
      display: block;
      font-size: 13px;
      color: #666;
      margin-bottom: 8px;
      font-weight: 600;
    }
    
    .form-input {
      width: 100%;
      padding: 15px;
      border: 2px solid #e0e0e0;
      border-radius: 10px;
      font-size: 16px;
      transition: all 0.3s;
      font-family: monospace;
    }
    
    .form-input:focus {
      outline: none;
      border-color: #1a1f71;
      box-shadow: 0 0 0 3px rgba(26, 31, 113, 0.1);
    }
    
    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
    }
    
    .card-icon {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
      font-size: 20px;
    }
    
    .input-wrapper {
      position: relative;
    }
    
    .btn-submit {
      width: 100%;
      padding: 18px;
      background: linear-gradient(90deg, #1a1f71 0%, #0d47a1 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 18px;
      font-weight: 700;
      cursor: pointer;
      margin-top: 10px;
      transition: transform 0.2s;
      box-shadow: 0 5px 20px rgba(26, 31, 113, 0.4);
    }
    
    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(26, 31, 113, 0.5);
    }
    
    .btn-submit:active {
      transform: translateY(0);
    }
    
    .security-note {
      text-align: center;
      margin-top: 20px;
      font-size: 12px;
      color: rgba(255,255,255,0.8);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
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
      <div class="header-title">Thanh toán thẻ quốc tế</div>
      <div class="amount-display"><?php echo number_format($order['amount']); ?>đ</div>
      <div class="order-info">
        Mã đơn: <?php echo $order['order_id']; ?> • <?php echo $order['name']; ?>
      </div>
    </div>
    
    <div class="card-form">
      <div class="card-brands">
        <div class="card-brand visa">VISA</div>
        <div class="card-brand master">MC</div>
        <div class="card-brand jcb">JCB</div>
      </div>
      
      <form id="cardForm" onsubmit="processPayment(event)">
        <div class="form-group">
          <label class="form-label">Số thẻ</label>
          <div class="input-wrapper">
            <input type="text" class="form-input" placeholder="1234 5678 9012 3456" 
                   maxlength="19" id="cardNumber" required>
            <i class="fas fa-credit-card card-icon"></i>
          </div>
        </div>
        
        <div class="form-group">
          <label class="form-label">Tên chủ thẻ</label>
          <input type="text" class="form-input" placeholder="NGUYEN VAN A" 
                 style="text-transform: uppercase;" required>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Ngày hết hạn</label>
            <input type="text" class="form-input" placeholder="MM/YY" 
                   maxlength="5" id="expiry" required>
          </div>
          
          <div class="form-group">
            <label class="form-label">CVV</label>
            <input type="text" class="form-input" placeholder="123" 
                   maxlength="3" id="cvv" required>
          </div>
        </div>
        
        <button type="submit" class="btn-submit">
          <i class="fas fa-lock"></i> Thanh toán ngay
        </button>
      </form>
    </div>
    
    <div class="security-note">
      <i class="fas fa-shield-alt"></i>
      Giao dịch được bảo mật bởi SSL 256-bit
    </div>
  </div>
  
  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
      <div class="spinner"></div>
      <h3>Đang xử lý thanh toán...</h3>
      <p>Đang xác thực thông tin thẻ</p>
    </div>
  </div>
  
  <script>
    // Format card number
    document.getElementById('cardNumber').addEventListener('input', function(e) {
      let value = e.target.value.replace(/\s/g, '');
      let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
      e.target.value = formattedValue;
    });
    
    // Format expiry date
    document.getElementById('expiry').addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, '');
      if (value.length >= 2) {
        value = value.substring(0, 2) + '/' + value.substring(2, 4);
      }
      e.target.value = value;
    });
    
    // Only numbers for CVV
    document.getElementById('cvv').addEventListener('input', function(e) {
      e.target.value = e.target.value.replace(/\D/g, '');
    });
    
    function processPayment(e) {
      e.preventDefault();
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
        methodInput.value = 'visa';
        
        form.appendChild(statusInput);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
      }, 2500);
    }
  </script>
</body>
</html>