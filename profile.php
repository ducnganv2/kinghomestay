<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <link rel="icon" type="image/png" href="images/logohm.png">
  <title><?php echo $settings_r['site_title'] ?> - Hồ sơ cá nhân</title>
</head>
<body class="bg-light">

  <?php 
    require('inc/header.php'); 
    if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
      redirect('index.php');
    }
    $u_exist = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1",[$_SESSION['uId']],'s');
    if(mysqli_num_rows($u_exist)==0){
      redirect('index.php');
    }
    $u_fetch = mysqli_fetch_assoc($u_exist);
  ?>

  <div class="container">
    <div class="row">

      <div class="col-12 my-5 px-4">
        <h2 class="fw-bold">Thông tin của tôi</h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none">Trang chủ</a>
          <span class="text-secondary"> > </span>
          <a href="#" class="text-secondary text-decoration-none">Hồ sơ cá nhân</a>
        </div>
      </div>
      
      <div class="col-12 mb-5 px-4">
        <div class="bg-white p-3 p-md-4 rounded shadow-sm">
          <form id="info-form">
            <h5 class="mb-3 fw-bold">Thông tin cơ bản</h5>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Tên</label>
                <input name="name" type="text" value="<?php echo $u_fetch['name'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Số điện thoại</label>
                <input name="phonenum" type="number" value="<?php echo $u_fetch['phonenum'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Ngày tháng năm sinh</label>
                <input name="dob" type="date" value="<?php echo $u_fetch['dob'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Mã định danh</label>
                <input name="pincode" type="number" value="<?php echo $u_fetch['pincode'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-8 mb-4">
                <label class="form-label">Địa chỉ</label>
                <textarea name="address" class="form-control shadow-none" rows="1" required><?php echo $u_fetch['address'] ?></textarea>
              </div>
            </div>
            <button type="submit" class="btn text-white custom-bg shadow-none">Lưu thay đổi</button>
          </form>
        </div>
      </div>

      <div class="col-md-4 mb-5 px-4">
        <div class="bg-white p-3 p-md-4 rounded shadow-sm">
          <form id="profile-form">
            <h5 class="mb-3 fw-bold">Ảnh đại diện</h5>
            <img src="<?php echo USERS_IMG_PATH.$u_fetch['profile'] ?>" class="rounded-circle img-fluid mb-3">

            <label class="form-label">Cập nhật ảnh mới</label>
            <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="mb-4 form-control shadow-none" required>

            <button type="submit" class="btn text-white custom-bg shadow-none">Lưu thay đổi</button>
          </form>
        </div>
      </div>


      <div class="col-md-8 mb-5 px-4">
        <div class="bg-white p-3 p-md-4 rounded shadow-sm">
          <form id="pass-form">
            <h5 class="mb-3 fw-bold">Đổi mật khẩu</h5>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Mật khẩu mới</label>
                <input name="new_pass" type="password" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-4">
                <label class="form-label">Xác nhận mật khẩu mới</label>
                <input name="confirm_pass" type="password" class="form-control shadow-none" required>
              </div>
            </div>
            <button type="submit" class="btn text-white custom-bg shadow-none">Lưu thay đổi</button>
          </form>
        </div>
      </div>


    </div>
  </div>


  <?php require('inc/footer.php'); ?>

  <script>

    let info_form = document.getElementById('info-form');

    info_form.addEventListener('submit',function(e){
      e.preventDefault();

      let data = new FormData();
      data.append('info_form','');
      data.append('name',info_form.elements['name'].value);
      data.append('phonenum',info_form.elements['phonenum'].value);
      data.append('address',info_form.elements['address'].value);
      data.append('pincode',info_form.elements['pincode'].value);
      data.append('dob',info_form.elements['dob'].value);

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/profile.php",true);

      xhr.onload = function(){
        if(this.responseText == 'phone_already'){
          alert('error',"Số điện thoại này dã được đăng ký!");
        }
        else if(this.responseText == 0){
          alert('error',"Không có thay đổi ghi nhận!");
        }
        else{
          alert('success','Cập nhật thành công!');
        }
      }

      xhr.send(data);

    });

    
    let profile_form = document.getElementById('profile-form');

    profile_form.addEventListener('submit',function(e){
      e.preventDefault();

      let data = new FormData();
      data.append('profile_form','');
      data.append('profile',profile_form.elements['profile'].files[0]);

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/profile.php",true);

      xhr.onload = function()
      {
        if(this.responseText == 'inv_img'){
          alert('error',"Chỉ hỗ trợ định dạng JPG, WEBP & PNG!");
        }
        else if(this.responseText == 'upd_failed'){
          alert('error',"Tải hình ảnh thất bại!");
        }
        else if(this.responseText == 0){
          alert('error',"Cập nhật thất bại!");
        }
        else{
          window.location.href=window.location.pathname;
        }
      }

      xhr.send(data);
    });


    let pass_form = document.getElementById('pass-form');

    pass_form.addEventListener('submit',function(e){
      e.preventDefault();

      let new_pass = pass_form.elements['new_pass'].value;
      let confirm_pass = pass_form.elements['confirm_pass'].value;

      if(new_pass!=confirm_pass){
        alert('error','Mật khẩu không trùng khớp!');
        return false;
      }


      let data = new FormData();
      data.append('pass_form','');
      data.append('new_pass',new_pass);
      data.append('confirm_pass',confirm_pass);

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/profile.php",true);

      xhr.onload = function()
      {
        if(this.responseText == 'mismatch'){
          alert('error',"Mật khẩu không trùng khớp!");
        }
        else if(this.responseText == 0){
          alert('error',"Cập nhật thất bại!");
        }
        else{
          alert('success','Cập nhật thành công!');
          pass_form.reset();
        }
      }

      xhr.send(data);
    });

  </script>


</body>
</html>