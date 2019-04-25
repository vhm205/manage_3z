<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?php echo $_SESSION['BASE_URL']; ?>">3Z.com</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $_SESSION['BASE_URL']; ?>manage.php">Quản lý</a>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Admin</a>
        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
          <a class="dropdown-item" href="<?php echo $_SESSION['BASE_URL']; ?>admin/insert_product.php">Thêm sản phẩm</a>
          <a class="dropdown-item" href="<?php echo $_SESSION['BASE_URL']; ?>admin/list_product.php">Danh sách sản phẩm</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo $_SESSION['BASE_URL']; ?>admin/reports.php">Báo cáo</a>
        </div>
      </li>
    </ul>
      <?php if(isset($_SESSION['USERNAME'])) { ?>
        <div class="nav-item dropdown mr-5">
          <a class="nav-link dropdown-toggle text-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            Welcome <?php echo $_SESSION['USERNAME']; ?>
          </a>
          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
            <a class="dropdown-item" href="<?php echo $_SESSION['BASE_URL']; ?>logout.php" >Logout</a>
          </div>
        </div>
      <?php } ?>
  </div>
</nav>