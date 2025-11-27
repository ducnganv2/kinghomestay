<?php
  session_start();
  
  if(!isset($_SESSION['pending_order'])){
    header('Location: index.php');
    exit;
  }
  
  $order = $_SESSION['pending_order'];
  
  // Danh sách ngân hàng
  $banks = [
    ['code' => 'vcb', 'name' => 'Vietcombank', 'color' => '#007FC6'],
    ['code' => 'tcb', 'name' => 'Techcombank', 'color' => '#009b4d'],
    ['code' => 'bidv', 'name' => 'BIDV', 'color' => '#004B8D'],
    ['code' => 'vtb', 'name' => 'VietinBank', 'color' => '#DA251C'],
    ['code' => 'agb', 'name' => 'Agribank', 'color' => '#007f3d'],
    ['code' => 'mb', 'name' => 'MBBank', 'color' => '#0066b2'],
    ['code' => 'acb', 'name' => 'ACB', 'color' => '#008846'],
    ['code' => 'vpb', 'name' => 'VPBank', 'color' => '#00935f'],
    ['code' => 'tpb', 'name' => 'TPBank', 'color' => '#7f007f'],
    ['code' => 'scb', 'name' => 'Sacombank', 'color' => '#004e98'],
  ];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thanh toán ATM nội địa</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(135deg, #0066cc 0%, #004e98 100%);
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
      color: #0066cc;
      font-size: 24px;
      cursor: pointer;
      margin-bottom: 15px;
      display: inline-block;
    }
    
    .header-title {
      font-size: 24px;
      color: #0066cc;
      font-weight: 700;
      margin-bottom: 10px;
    }
    
    .amount-display {
      font-size: 32px;
      color: #004e98;
      font-weight: 800;
      margin: 15px 0;
    }
    
    .order-info {
      font-size: 13px;
      color: #666;
      margin-top: 10px;
    }
    
    /* Bank Selection */
    .bank-section {
      background: white;
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      margin-bottom: 20px;
    }
    
    .section-title {
      font-size: 16px;
      font-weight: 700;
      color: #333;
      margin-bottom: 15px;
    }
    
    .search-box {
      position: relative;
      margin-bottom: 15px;
    }
    
    .search-input {
      width: 100%;
      padding: 12px 40px 12px 15px;
      border: 2px solid #e0e0e0;
      border-radius: 10px;
      font-size: 15px;
      transition: all 0.3s;
    }
    
    .search-input:focus {
      outline: none;
      border-color: #0066cc;
    }
    
    .search-icon {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
    }
    
    .bank-list {
      max-height: 300px;
      overflow-y: auto;
    }
    
    .bank-item {
      display: flex;
      align-items: center;
      padding: 15px;
      border: 2px solid #f0f0f0;
      border-radius: 10px;
      margin-bottom: 10px;
      cursor: pointer;
      transition: all 0.3s;
    }
    
    .bank-item:hover {
      border-color: #0066cc;
      background: #f8f9ff;
    }
    
    .bank-item.selected {
      border-color: #0066cc;
      background: #e6f2ff;
    }
    
    .bank-logo {
      width: 50px;
      height: 50px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: white;
      margin-right: 15px;
      font-size: 14px;
    }
    
    .bank-name {
      flex: 1;
      font-weight: 600;
      color: #333;
    }
    
    .bank-radio {
      width: 20px;
      height: 20px;
      border: 2px solid #ddd;
      border-radius: 50%;
      position: relative;
    }
    
    .bank-item.selected .bank-radio {
      border-color: #0066cc;
    }
    
    .bank-item.selected .bank-radio::after {
      content: '';
      position: absolute;
      width: 12px;
      height: 12px;
      background: #0066cc;
      border-radius: 50%;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
    
    .btn-continue {
      width: 100%;
      padding: 18px;
      background: linear-gradient(90deg, #0066cc 0%, #004e98 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 18px;
      font-weight: 700;
      cursor: pointer;
      transition: transform 0.2s;
      box-shadow: 0 5px 20px rgba(0, 102, 204, 0.4);
    }
    
    .btn-continue:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0, 102, 204, 0.5);
    }
    
    .btn-continue:active {
      transform: translateY(0);
    }
    
    .btn-continue:disabled {
      background: #ccc;
      cursor: not-allowed;
      box-shadow: none;
    }
    
    
    .security-note {
      text-align: center;
      margin-top: 15px;
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
      <div class="header-title">Thanh toán ATM nội địa</div>
      <div class="amount-display"><?php echo number_format($order['amount']); ?>đ</div>
      <div class="order-info">
        Mã đơn: <?php echo $order['order_id']; ?> • <?php echo $order['name']; ?>
      </div>
    </div>
    
    <div class="bank-section">
      <div class="section-title">Chọn ngân hàng</div>
      
      <div class="search-box">
        <input type="text" class="search-input" placeholder="Tìm kiếm ngân hàng..." id="searchBank">
        <i class="fas fa-search search-icon"></i>
      </div>
      
      <div class="bank-list" id="bankList">
        <?php foreach($banks as $bank): ?>
        <div class="bank-item" onclick="selectBank(this)" data-bank="<?php echo $bank['code']; ?>">
          <div class="bank-logo" style="background: <?php echo $bank['color']; ?>">
            <?php echo strtoupper(substr($bank['code'], 0, 3)); ?>
          </div>
          <div class="bank-name"><?php echo $bank['name']; ?></div>
          <div class="bank-radio"></div>
        </div>
        <?php endforeach; ?>
      </div>
      
      <button class="btn-continue" id="btnContinue" onclick="processPayment()" disabled>
        <i class="fas fa-arrow-right"></i> Tiếp tục
      </button>
      
      <div class="security-note">
        <i class="fas fa-shield-alt"></i>
        Bạn sẽ được chuyển đến trang Internet Banking
      </div>
    </div>
  </div>
  
  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
      <div class="spinner"></div>
      <h3>Đang chuyển hướng...</h3>
      <p>Chuyển đến trang thanh toán ngân hàng</p>
    </div>
  </div>
  
  <script>
    let selectedBankCode = null;
    
    function selectBank(element) {
      document.querySelectorAll('.bank-item').forEach(item => {
        item.classList.remove('selected');
      });
      
      element.classList.add('selected');
      selectedBankCode = element.dataset.bank;
      document.getElementById('btnContinue').disabled = false;
    }
    
    // Search functionality
    document.getElementById('searchBank').addEventListener('input', function(e) {
      const searchTerm = e.target.value.toLowerCase();
      const bankItems = document.querySelectorAll('.bank-item');
      
      bankItems.forEach(item => {
        const bankName = item.querySelector('.bank-name').textContent.toLowerCase();
        if (bankName.includes(searchTerm)) {
          item.style.display = 'flex';
        } else {
          item.style.display = 'none';
        }
      });
    });
    
    function processPayment() {
      if (!selectedBankCode) return;
      
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
        methodInput.value = 'atm';
        
        const bankInput = document.createElement('input');
        bankInput.type = 'hidden';
        bankInput.name = 'bank';
        bankInput.value = selectedBankCode;
        
        form.appendChild(statusInput);
        form.appendChild(methodInput);
        form.appendChild(bankInput);
        document.body.appendChild(form);
        form.submit();
      }, 2000);
    }
  </script>
</body>
</html>