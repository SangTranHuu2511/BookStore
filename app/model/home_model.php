<?php
require_once 'app/config/database.php';

function get_list_all_book_model(){
  $data = array();
  $conn = connection();
  $sql  = "SELECT a.id, a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai,d.TenLoai FROM sach AS a INNER JOIN  nhaxuatban AS b ON a.id_nxb = b.id_nxb INNER JOIN tacgia AS c ON a.id_tg = c.id_tg INNER JOIN loaisach AS d ON a.id_loai = d.id_loai ORDER BY a.create_time DESC;";
  $stmt = $conn->prepare($sql);
  if($stmt){
    if($stmt->execute()){
      if($stmt->rowCount() > 0){
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
    }
    $stmt->closeCursor();
  }
  disconnection($conn);
  return $data;
}

function get_info_data_book_by_id($id){
  $data = array();
  $conn = connection();
  $sql  = "SELECT a.id, a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai,d.TenLoai FROM sach AS a INNER JOIN  nhaxuatban AS b ON a.id_nxb = b.id_nxb INNER JOIN tacgia AS c ON a.id_tg = c.id_tg INNER JOIN loaisach AS d ON a.id_loai = d.id_loai WHERE a.id = :id LIMIT 1;";
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

function get_type_book($id,$idbook){
  $data = array();
  $conn = connection();
  $sql  = "SELECT a.id, a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai,d.TenLoai FROM sach AS a INNER JOIN  nhaxuatban AS b ON a.id_nxb = b.id_nxb INNER JOIN tacgia AS c ON a.id_tg = c.id_tg INNER JOIN loaisach AS d ON a.id_loai = d.id_loai WHERE a.id_loai = :id AND a.id <> :idBook LIMIT 0,10;";
  $stmt = $conn->prepare($sql);
  if($stmt){
    $stmt->bindParam(':id',$id,PDO::PARAM_INT);
    $stmt->bindParam(':idBook',$idbook,PDO::PARAM_INT);
    if($stmt->execute()){
      if($stmt->rowCount() > 0){
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
    }
    $stmt->closeCursor();
  }
  disconnection($conn);
  return $data;
}

function insert_order_customer($idBook,$fullname,$phone,$address,$email,$note,$qty,$money){
    $conn=connection();
    $data=array();
    $flag = FALSE;
    $status = 0;
    $create_time = date("Y-m-d H:i:s");
    $updatetime = '';
    $sql="INSERT INTO donhang(id_sach,TenKH,SDT,Email,DiaChi,GhiChu,SoLuong,ThanhTien,TrangThai,create_time,update_time) VALUES(:id_sach, :TenKH, :SDT, :Email, :DiaChi, :GhiChu, :SoLuong, :ThanhTien, :TrangThai, :create_time, :update_time) ";
    $stmt = $conn->prepare($sql);
       if ($stmt) {
      $stmt->bindParam(":id_sach",$idBook,PDO::PARAM_STR);
      $stmt->bindParam(":TenKH",$fullname,PDO::PARAM_STR);
      $stmt->bindParam(":SDT",$phone,PDO::PARAM_STR);
      $stmt->bindParam(":Email",$email,PDO::PARAM_STR);
      $stmt->bindParam(":DiaChi",$address,PDO::PARAM_STR);
      $stmt->bindParam(":GhiChu",$note,PDO::PARAM_STR);
      $stmt->bindParam(":SoLuong",$qty,PDO::PARAM_STR);
      $stmt->bindParam(":ThanhTien",$money,PDO::PARAM_STR);
      $stmt->bindParam(":TrangThai",$status,PDO::PARAM_STR);
      $stmt->bindParam(":create_time",$create_time,PDO::PARAM_STR);
      $stmt->bindParam(":update_time",$updatetime,PDO::PARAM_STR);
      if ($stmt->execute()) {
        $flag = TRUE;
      }
      $stmt->closeCursor();
    }
  
    disconnection($conn);
    return $flag;
}

function update_views_model($id,$view = 0){
    $view++;
    $conn = connection();
    $flag = FALSE;
    
    $sql = "UPDATE sach AS a SET a.SoLuotXem=:view WHERE a.id=:id";
    
    $stm = $conn->prepare($sql);
    if($stm){
      $stm->bindParam(':view',$view,PDO::PARAM_INT);
      $stm->bindParam(':id',$id,PDO::PARAM_INT);
      if($stm->execute()){
        $flag = TRUE;
      }
      $stm->closeCursor();
    }
    disconnection($conn);
    return $flag;
}



  
?>