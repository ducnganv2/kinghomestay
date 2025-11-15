<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <link rel="icon" type="image/png" href="images/logohm.png">
  <title><?php echo $settings_r['site_title'] ?> - Coffee Menu</title>
  <style>
    .coffee-card {
      background: white;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      height: 100%;
    }
    
    .coffee-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }
    
    .coffee-img {
    width: 100%;
    height: 250px;
    object-fit: contain;  
    object-position: center;  
    background: #f8f9fa;  
    }       
    
    .coffee-body {
      padding: 20px;
    }
    
    .coffee-name {
      font-size: 1.3rem;
      font-weight: bold;
      color: #333;
      margin-bottom: 10px;
    }
    
    .coffee-price {
      font-size: 1.5rem;
      color: var(--teal);
      font-weight: bold;
      margin-bottom: 10px;
    }
    
    .coffee-desc {
      color: #666;
      font-size: 0.95rem;
      line-height: 1.6;
    }
    
    .special-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      background: #ff6b6b;
      color: white;
      padding: 5px 15px;
      border-radius: 20px;
      font-weight: bold;
      font-size: 0.85rem;
    }
    
    .category-filter {
      margin-bottom: 30px;
    }
    
    .category-btn {
      margin: 5px;
      padding: 10px 25px;
      border: 2px solid var(--teal);
      background: white;
      color: var(--teal);
      border-radius: 25px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .category-btn:hover,
    .category-btn.active {
      background: var(--teal);
      color: white;
    }
  </style>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">COFFEE MENU</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
      Thưởng thức những ly cà phê thơm ngon tại Coffee Shop của King Homestay
    </p>
  </div>

  <div class="container">
    <!-- Category Filter -->
    <div class="category-filter text-center">
      <button class="category-btn active" onclick="filterCategory('all')">Tất cả</button>
      <button class="category-btn" onclick="filterCategory('coffee')">Coffee</button>
      <button class="category-btn" onclick="filterCategory('tea')">Trà</button>
      <button class="category-btn" onclick="filterCategory('milk tea')">Trà sữa</button>
      <button class="category-btn" onclick="filterCategory('matcha')">Matcha</button>
      <button class="category-btn" onclick="filterCategory('dessert')">Bánh ngọt</button>
    </div>

    <!-- Coffee Menu Grid -->
    <div class="row g-4 mb-5" id="coffee-menu">
      <?php 
        $coffee_q = mysqli_query($con, "SELECT * FROM coffee WHERE status=1 ORDER BY display_order");
        
        while($coffee = mysqli_fetch_assoc($coffee_q)) 
        {
          $special_badge = $coffee['is_special'] ? '<div class="special-badge">HOT</div>' : '';
          $price_formatted = number_format($coffee['price'], 0, ',', '.') . 'đ';
          
          echo <<<menu
            <div class="col-lg-3 col-md-4 col-sm-6 coffee-item" data-category="{$coffee['category']}">
              <div class="coffee-card position-relative">
                $special_badge
                <img src="images/coffee/{$coffee['image']}" class="coffee-img" alt="{$coffee['name']}">
                <div class="coffee-body">
                  <h5 class="coffee-name">{$coffee['name']}</h5>
                  <div class="coffee-price">$price_formatted</div>
                  <p class="coffee-desc">{$coffee['description']}</p>
                </div>
              </div>
            </div>
          menu;
        }
      ?>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>

  <script>
    function filterCategory(category) {
      const items = document.querySelectorAll('.coffee-item');
      const buttons = document.querySelectorAll('.category-btn');
      
      // Update button active state
      buttons.forEach(btn => btn.classList.remove('active'));
      event.target.classList.add('active');
      
      // Filter items
      items.forEach(item => {
        if (category === 'all' || item.dataset.category === category) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    }
  </script>
</body>
</html>