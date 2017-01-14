<?php
function vaidate_data($username, $password){
  $errors = array();
  $errors['user'] = (empty($username) OR strlen($username) < 3) ? "Tài khoản cần lớn hơn 3 ký tự" : '';

  $errors['pass'] = (empty($password) OR strlen($password) < 5) ? "Mật khẩu cần lớn hơn 5 ký tự" : '';

  return $errors;
}

if(isset($_POST['btnSubmit'])){
  $username = isset($_POST['txtTenDangNhap']) ? $_POST['txtTenDangNhap'] : '';
  $username = strip_tags($username);

  $password = isset($_POST['txtMatKhau']) ? $_POST['txtMatKhau'] : '';
  $password = strip_tags($password);

  $checkData = vaidate_data($username, $password);
  $checkFlag = TRUE;
  foreach ($checkData as $key => $val) {
    if(!empty($val)){//Truong hop xay ra loi validate
      $checkFlag = FALSE;
      $_SESSION['errValidate'] = $checkData;  
      break;
    }
  }
  if($checkFlag){
    $login = checkLogin_model($username,md5($password));
    if(!empty($login)){
      $_SESSION['username']   = $login['username'];
      $_SESSION['emailAdmin'] = $login['email'];
      $_SESSION['role_admin'] = $login['role_admin'];
      $_SESSION['status']     = $login['status'];
      header("Location:controller/home.php");
    }else{
      header("Location:index.php?mess=false");
    }
  }
  else{
    //Truong hop xay ra loi validate.
    //header("Location:index.php?mess=errValidate");

  }
}
?>
