<?php
require_once 'app/config/database.php';

function add_member_model($username,$pass,$email,$fullname,$address,$phone,$authenkey){
  $flag = 0;
  $role = 0;
  $status = 0;
  $create_time = date('Y-m-d H:i:s');
  $update_time = '';

  $conn = connection();
  $sql  = "INSERT INTO taikhoan(TenDangNhap,MatKhau,TenHienThi,DiaChi ,SDT, Email,Quyen,Trang_thai,authen_key,create_time,update_time) VALUES(:TenDangNhap, :MatKhau, :TenHienThi, :DiaChi ,:SDT, :Email, :Quyen, :Trang_thai, :authen_key, :create_time, :update_time);";
  $stmt = $conn->prepare($sql);
  if($stmt){
    $stmt->bindParam(':TenDangNhap',$username,PDO::PARAM_STR);
    $stmt->bindParam(':MatKhau',$pass,PDO::PARAM_STR);
    $stmt->bindParam(':TenHienThi',$fullname,PDO::PARAM_STR);
    $stmt->bindParam(':DiaChi',$address,PDO::PARAM_STR);
    $stmt->bindParam(':SDT',$phone,PDO::PARAM_STR);
    $stmt->bindParam(':Email',$email,PDO::PARAM_STR);
    $stmt->bindParam(':Quyen',$role,PDO::PARAM_INT);
    $stmt->bindParam(':Trang_thai',$status,PDO::PARAM_INT);
    $stmt->bindParam(':authen_key',$authenkey,PDO::PARAM_STR);
    $stmt->bindParam(':create_time',$create_time,PDO::PARAM_STR);
    $stmt->bindParam(':update_time',$update_time,PDO::PARAM_STR);
    if($stmt->execute()){
      $flag = $conn->lastInsertId();
    }
    $stmt->closeCursor();
  }
  disconnection($conn);
  return $flag;
}

function get_info_user($id){
  $data = array();
  $conn = connection();
  $sql  = "SELECT * FROM taikhoan AS a WHERE a.id_tk = :id";
  $stmt = $conn->prepare($sql);
  if($stmt){
    $stmt->bindParam(':id',$id,PDO::PARAM_INT);
    if($stmt->execute()){
      if($stmt->rowCount() > 0){
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    }
    $stmt->closeCursor();
  }
  disconnection($conn);
  return $data;
}

function active_account_user($id){
  $flag = FALSE;
  $conn = connection();
  $status = 1;
  $sql  = "UPDATE taikhoan SET Trang_thai = :status WHERE id_tk = :id ;";
  $stmt = $conn->prepare($sql);
  if($stmt){
    $stmt->bindParam(':status',$status,PDO::PARAM_INT);
    $stmt->bindParam(':id',$id,PDO::PARAM_INT);
    if($stmt->execute()){
      $flag = TRUE;
    }
    $stmt->closeCursor();
  }
  return $flag;
}


 ?>