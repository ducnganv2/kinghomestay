<?php
  require('inc/essentials.php');
  adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang quản lý - Trình chiếu</title>
  <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="mb-4">Hình ảnh trình chiếu</h3>

        <!-- Carousel section -->
        <div class="card border-0 shadow-lg mb-4">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
              <h5 class="card-title m-0 fw-bold">Danh sách Hình ảnh Trình chiếu</h5>
              <button type="button" class="btn btn-primary shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#carousel-s">
                <i class="bi bi-plus-lg"></i> Thêm Hình ảnh
              </button>
            </div>
            
            <div class="row g-3" id="carousel-data">
              <div class="col-12">
                <p class="text-muted fst-italic">Các hình ảnh trình chiếu sẽ được tải và hiển thị ở đây. Kích thước khuyến nghị: 1000x400px.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form id="carousel_s_form">
              <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                  <h5 class="modal-title"><i class="bi bi-image"></i> Tải lên Hình ảnh Trình chiếu</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Chọn Ảnh</label>
                    <input type="file" name="carousel_picture" id="carousel_picture_inp" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-sm" required>
                    <div id="fileHelp" class="form-text">Chỉ chấp nhận các định dạng: JPG, PNG, WEBP, JPEG.</div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" onclick="carousel_picture_inp.value=''" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Huỷ</button>
                  <button type="submit" class="btn custom-bg text-white shadow-none">Tải lên</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <?php require('inc/scripts.php'); ?>
  <script src="scripts/carousel.js"></script>

</body>
</html>