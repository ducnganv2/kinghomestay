<!-- Footer chính -->
<footer class="footer-section bg-dark text-white">
  <div class="container py-5">
    <div class="row g-4">
      <!-- Cột 1: Về chúng tôi -->
      <div class="col-lg-4 col-md-6">
        <div class="footer-brand mb-3">
          <img src="images/logohm.png" alt="Logo" width="60" height="60" class="mb-3">
          <h3 class="h-font fw-bold fs-4 text-white"><?php echo $settings_r['site_title'] ?></h3>
        </div>
        <p class="text-light mb-3">
          <?php echo $settings_r['site_about'] ?>
        </p>
        <div class="social-links">
          <h6 class="fw-bold mb-3">Kết nối với chúng tôi</h6>
          <div class="d-flex gap-3">
            <?php 
              if($contact_r['tw']!=''){
                echo<<<data
                  <a href="$contact_r[tw]" class="social-icon" target="_blank" rel="noopener">
                    <i class="bi bi-twitter"></i>
                  </a>
                data;
              }
            ?>
            <a href="<?php echo $contact_r['fb'] ?>" class="social-icon" target="_blank" rel="noopener">
              <i class="bi bi-facebook"></i>
            </a>
            <a href="<?php echo $contact_r['insta'] ?>" class="social-icon" target="_blank" rel="noopener">
              <i class="bi bi-instagram"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Cột 2: Liên kết nhanh -->
      <div class="col-lg-2 col-md-6">
        <h5 class="fw-bold mb-4 text-white">Liên kết</h5>
        <ul class="footer-links list-unstyled">
          <li><a href="index.php"><i class="bi bi-chevron-right me-2"></i>Trang chủ</a></li>
          <li><a href="rooms.php"><i class="bi bi-chevron-right me-2"></i>Danh sách phòng</a></li>
          <li><a href="facilities.php"><i class="bi bi-chevron-right me-2"></i>Tiện ích</a></li>
          <li><a href="contact.php"><i class="bi bi-chevron-right me-2"></i>Liên hệ</a></li>
          <li><a href="about.php"><i class="bi bi-chevron-right me-2"></i>Về chúng tôi</a></li>
        </ul>
      </div>

      <!-- Cột 3: Thông tin liên hệ -->
      <div class="col-lg-3 col-md-6">
        <h5 class="fw-bold mb-4 text-white">Liên hệ</h5>
        <ul class="list-unstyled contact-info">
          <li class="mb-3">
            <i class="bi bi-geo-alt-fill me-2"></i>
            <span><?php echo $contact_r['address'] ?? 'Địa chỉ homestay' ?></span>
          </li>
          <li class="mb-3">
            <i class="bi bi-telephone-fill me-2"></i>
            <a href="tel:<?php echo $contact_r['pn1'] ?? '' ?>" class="text-light text-decoration-none">
              +<?php echo $contact_r['pn1'] ?? 'Số điện thoại' ?>
            </a>
          </li>
          <li class="mb-3">
            <i class="bi bi-envelope-fill me-2"></i>
            <a href="mailto:<?php echo $contact_r['email'] ?? '' ?>" class="text-light text-decoration-none">
              <?php echo $contact_r['email'] ?? 'Email liên hệ' ?>
            </a>
          </li>
        </ul>
      </div>

      <!-- Cột 4: Giờ làm việc -->
      <div class="col-lg-3 col-md-6">
        <h5 class="fw-bold mb-4 text-white">Giờ làm việc</h5>
        <ul class="list-unstyled">
          <li class="mb-2"><i class="bi bi-clock me-2"></i>Thứ 2 - Thứ 6: 8:00 - 22:00</li>
          <li class="mb-2"><i class="bi bi-clock me-2"></i>Thứ 7 - CN: 9:00 - 23:00</li>
          <li class="mt-3">
            <button class="btn btn-outline-light btn-sm">
              <i class="bi bi-calendar-check me-2"></i>Đặt phòng ngay
            </button>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Copyright bar -->
  <div class="footer-bottom py-3 border-top border-secondary">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
          <p class="mb-0 text-light">
            © <?php echo date("Y"); ?> <strong><?php echo $settings_r['site_title'] ?></strong>. All rights reserved.
          </p>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <p class="mb-0 text-light">
            <a href="#" class="text-light text-decoration-none me-3">Chính sách bảo mật</a>
            <a href="#" class="text-light text-decoration-none">Điều khoản sử dụng</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- CSS tùy chỉnh cho footer -->
<style>
  .footer-section {
    position: relative;
    overflow: hidden;
  }

  .footer-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #fff, #6c757d, #fff);
  }

  .footer-brand h3 {
    margin-bottom: 0;
  }

  .social-icon {
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
    border-radius: 50%;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 1.1rem;
  }

  .social-icon:hover {
    background-color: #fff;
    color: #212529;
    transform: translateY(-3px);
  }

  .footer-links li {
    margin-bottom: 0.75rem;
  }

  .footer-links a {
    color: #d1d1d1;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
  }

  .footer-links a:hover {
    color: #fff;
    padding-left: 5px;
  }

  .footer-links i {
    font-size: 0.8rem;
    transition: transform 0.3s ease;
  }

  .footer-links a:hover i {
    transform: translateX(3px);
  }

  .contact-info li {
    color: #d1d1d1;
    line-height: 1.6;
  }

  .contact-info i {
    color: #fff;
    font-size: 1.1rem;
  }

  .footer-bottom {
    background-color: rgba(0, 0, 0, 0.2);
  }

  .btn-outline-light:hover {
    transform: scale(1.05);
  }

  @media (max-width: 768px) {
    .footer-section .col-md-6 {
      text-align: center !important;
    }
  }
</style>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>

  function alert(type,msg,position='body')
  {
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `
      <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert">
        <strong class="me-3">${msg}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;

    if(position=='body'){
      document.body.append(element);
      element.classList.add('custom-alert');
    }
    else{
      document.getElementById(position).appendChild(element);
    }
    setTimeout(remAlert, 3000);
  }

  function remAlert(){
    document.getElementsByClassName('alert')[0].remove();
  }

  function setActive()
  {
    let navbar = document.getElementById('nav-bar');
    let a_tags = navbar.getElementsByTagName('a');

    for(i=0; i<a_tags.length; i++)
    {
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];

      if(document.location.href.indexOf(file_name) >= 0){
        a_tags[i].classList.add('active');
      }
    }
  }

  let register_form = document.getElementById('register-form');

  register_form.addEventListener('submit', (e)=>{
    e.preventDefault();

    let data = new FormData();

    data.append('name',register_form.elements['name'].value);
    data.append('email',register_form.elements['email'].value);
    data.append('phonenum',register_form.elements['phonenum'].value);
    data.append('address',register_form.elements['address'].value);
    data.append('pincode',register_form.elements['pincode'].value);
    data.append('dob',register_form.elements['dob'].value);
    data.append('pass',register_form.elements['pass'].value);
    data.append('cpass',register_form.elements['cpass'].value);
    data.append('profile',register_form.elements['profile'].files[0]);
    data.append('register','');

    var myModal = document.getElementById('registerModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload = function(){
      if(this.responseText == 'pass_mismatch'){
        alert('error',"Mật khẩu không trùng khớp!");
      }
      else if(this.responseText == 'email_already'){
        alert('error',"Email đã được đăng ký!");
      }
      else if(this.responseText == 'phone_already'){
        alert('error',"Số điện thoại đã được đăng ký!");
      }
      else if(this.responseText == 'inv_img'){
        alert('error',"Chỉ hỗ trợ định dạng JPG, WEBP & PNG!");
      }
      else if(this.responseText == 'upd_failed'){
        alert('error',"Tải lên hình ảnh thất bại!");
      }
      else if(this.responseText == 'mail_failed'){
        alert('error',"Hệ thống đang bảo trì, không thể gửi email xác nhận!");
      }
      else if(this.responseText == 'ins_failed'){
        alert('error',"Đăng ký thất bại! Hệ thống đang bảo trì!");
      }
      else{
        alert('success',"Đăng ký thành công!");
        register_form.reset();
      }
    }

    xhr.send(data);
  });

  let login_form = document.getElementById('login-form');

  login_form.addEventListener('submit', function(e) {
    e.preventDefault();
    let data = new FormData(this);
    data.append('login', '');

    fetch('ajax/login_register.php', {
        method: 'POST',
        body: data
    }).then(response => response.text()).then(result => {
        if(result === 'login_success') {
            alert('success', 'Đăng nhập thành công!');
            setTimeout(() => {
              window.location.href = 'index.php';
            }, 1000);
        } else {
            alert('error', 'Email/Số điện thoại hoặc mật khẩu không đúng!');
        }
    });
  });

  // Scroll to top button
  window.addEventListener('scroll', function() {
    if (window.pageYOffset > 300) {
      if(!document.querySelector('.back-to-top')) {
        let btn = document.createElement('button');
        btn.className = 'back-to-top';
        btn.innerHTML = '<i class="bi bi-arrow-up"></i>';
        btn.onclick = () => window.scrollTo({top: 0, behavior: 'smooth'});
        document.body.appendChild(btn);
      }
    } else {
      let btn = document.querySelector('.back-to-top');
      if(btn) btn.remove();
    }
  });

  setActive();

</script>

<style>
  .custom-alert {
    position: fixed;
    top: 80px;
    right: 25px;
    z-index: 9999;
    min-width: 300px;
    animation: slideInRight 0.3s ease;
  }

  @keyframes slideInRight {
    from {
      transform: translateX(400px);
      opacity: 0;
    }
    to {
      transform: translateX(0);
      opacity: 1;
    }
  }

  .back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background-color: #212529;
    color: white;
    border: none;
    border-radius: 50%;
    font-size: 1.2rem;
    cursor: pointer;
    z-index: 999;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
    animation: fadeIn 0.3s ease;
  }

  .back-to-top:hover {
    background-color: #fff;
    color: #212529;
    transform: translateY(-5px);
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: scale(0);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }
</style>