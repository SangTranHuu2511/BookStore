<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../public/css/animate.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="../public/css/style2.css">
    <script src="../public/js/jquery-1.12.0.min.js"></script>
</head>
<body>
    <div class="container">
            <div class="login-box animated fadeInUp" style="max-width:340px">
                <div class="row" style="padding: 5px;">
                    <?php if(isset($_SESSION['errValidate'])): ?> 
                        <ul>
                        <?php foreach($_SESSION['errValidate'] as $key=>$value): ?>
                            <?php if(!empty($value)): ?>
                                <li><?php echo $value; ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </ul>
                        <?php unset($_SESSION['errValidate']);?>
                    <?php endif; ?>
                </div>
                <?php if(isset($_GET['mess']) && $_GET['mess'] == 'false'): ?>
                    <div class="row">
                        <?php echo "Tài khoản người dùng không tồn tại"; ?>
                    </div>
                <?php endif; ?>
                <form action="index.php" method="POST" >
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
                </form>
            </div>
    </div>
</body>
</html>
