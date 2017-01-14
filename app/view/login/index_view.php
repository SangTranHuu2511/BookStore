<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="public/css/animate.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="public/css/style2.css">
    <script src="public/js/jquery-1.12.0.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="login-box animated fadeInUp" style="max-width:340px">
      <div class="row">
          <ul>
              <?php if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) :  ?>
                <?php foreach ($_SESSION['errors'] as $key => $value):
                
                ?>
              <?php if(!empty($value)): ?>
                <li><?php echo $value; ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
            <?php endif; ?>
          </ul>
      </div>
      <div class="row">
        <?php if(isset($_SESSION['error'])): ?>
          <li><?php echo $_SESSION['error']; ?></li>
      <?php endif; ?>
      </div>
      <form action="?cn=login&m=logins" method="POST" >
        <div class="box-header">
          <h2>Đăng nhập</h2>
        </div>
        <label for="username">Tên đăng nhập</label>
        <br/>
        <input type="text" name="txtTenDangNhap" id="username">
        <br/>
        <label for="password">Mật khẩu</label>
        <br/>
        <input type="password" name="txtMatKhau" id="password">
        <br/>
        <input type="submit" name="btnSubmit" value="Đăng nhập"/>
        <input type="reset" name="btnReset" value="reset"/>
        <br/>
        <a href="register.php" title="">Đăng ký</a>
        <span>|</span>
        <a href="index.php" title="">Trang chủ</a>
      </form>
    </div>
  </div>
</body>
</html>