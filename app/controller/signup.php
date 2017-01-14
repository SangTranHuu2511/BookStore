<?php
require_once 'app/model/signup_model.php';

$method = isset($_GET['m']) ? $_GET['m'] : 'index';
switch ($method) {
  case 'index':
    singupView();
    break;
  case 'register':
    register();
    break;
  case 'active':
    activeMember();
  break;
}

function singupView(){

  if(isset($_SESSION['errors'])){
    unset($_SESSION['errors']);
  }

  $mess = isset($_GET['mess']) ? $_GET['mess'] : '';

  $dialog = ($mess == 'success') ? 'ĐK thành công, vui lòng vào email KH TK' : ( $mess == 'fail' ? 'ĐK Không thành công' : '' );

  require_once 'app/view/signup/index_view.php';
}

function validate_data($username,$pass,$email,$fullname,$address,$phone){
  $errors = array();
  $errors['username'] = (empty($username)) ? 'Errors Username' : '';
  $errors['password'] = (empty($pass) OR strlen($pass) < 8) ? 'Errors Password' : '';
  $checkEmail = filter_var($email , FILTER_VALIDATE_EMAIL);
  $errors['email'] = ($checkEmail == TRUE) ? '' : 'Errors Email';
  $errors['fullname'] = (empty($fullname)) ? 'Errors Fullname' : '';
  $errors['address'] = (empty($address)) ? 'Errors Address' : '';
  $checkPhone = preg_match('/^[0][9]\d{8}$|^[0][1]\d{9}$/',$phone);
  $errors['phone'] = ($checkPhone == TRUE) ? '' : 'Errors Phone ';

  return $errors;

}

function register(){
  if(isset($_POST['btnSubmit'])){
    $username = isset($_POST['txtTenDangNhap']) ? $_POST['txtTenDangNhap'] : '';
    $username = strip_tags($username);

    $pass = isset($_POST['txtMatKhau']) ? $_POST['txtMatKhau'] : '';
    $pass = strip_tags($pass);

    $email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : '';
    $email = strip_tags($email);

    $fullname = isset($_POST['txtHoTen']) ? $_POST['txtHoTen'] : '';
    $fullname = strip_tags($fullname);

    $address = isset($_POST['txtAddress']) ? $_POST['txtAddress'] : '';
    $address = strip_tags($address);

    $phone = isset($_POST['txtPhone']) ? $_POST['txtPhone'] : '';
    $phone = strip_tags($phone);

    $checkData = validate_data($username,$pass,$email,$fullname,$address,$phone);
    $flag = TRUE;
    foreach ($checkData as $key => $value) {
      if(!empty($value)){
        $flag = FALSE;
        break;
      }
    }

    if($flag){
      if(isset($_SESSION['errors'])){
        unset($_SESSION['errors']);
      }
      $authenkey = encode(date('Y-m-d H:i:s',strtotime("+3days")));

      $add = add_member_model($username,md5($pass),$email,$fullname,$address,$phone,$authenkey);
      if($add > 0){
        $id = encode($add);
        $subject = "Active Your Account";
        $link = 'localhost:8080/bookstore/?cn=signup&m=active&id='.$id.'&au='.$authenkey;
        $send = xl_sendmail($email, $subject, $link);
        if($send){
          header("Location:?cn=signup&m=index&mess=success");
        }
        else{
          header("Location:?cn=signup&m=index&mess=fail");
        }
      }else{
        header("Location:?cn=signup&m=index&mess=fail");
      }
    }
    else{
      $_SESSION['errors'] = $checkData;
      header("Location:?cn=signup&m=index");
    }
  }
}

function activeMember(){
  $idMember = isset($_GET['id']) ? $_GET['id'] : '';
  $authenkey = isset($_GET['au']) ? $_GET['au'] : '';
  $mess = '';

  $id_decode = decode($idMember);
  $id_decode = is_numeric($id_decode) ? $id_decode : 0;
  $check = get_info_user($id_decode);
  if(!empty($check)){
    if($authenkey == $check['authen_key']){
      $today = date("Y-m-d H:i:s");
      $au    = decode($authenkey);
      if(strtotime($today) > strtotime($au)){
        $mess = "Mã kích hoạt đã hết hạn";
      }
      else{
        if($check['Trang_thai'] != 1){
          $active = active_account_user($id_decode);
          if($active){
            $mess = "Kích hoạt thành công, bạn có thể đăng nhập vào website";
          }else{
            $mess = "Kích hoạt không thành công !";
          }
        }
        else{
          $mess = " TK đã được kích hoạt";
        }
      }
    }else{
      $mess = "Mã kích hoạt không đúng";
    }
  }
  else{
    $mess = "Mã kích hoạt không đúng";
  }

  require_once 'app/view/signup/active_view.php';
}

?>