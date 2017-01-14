<?php
require_once '../config/database.php';

function add_book_model($nameBook, $author, $publisher, $typeBook, $imgBook, $qtyBook, $costBook, $pageBook){
  $flag = FALSE;
  $conn = connection();
  $status      = 1;
  $SoLuotXem   = 0;
  $create_time = date("Y-m-d H:i:s");
  $date_time   = "";
  $sql  = "INSERT INTO sach(TenSach, id_nxb, id_tg, status, HinhAnh, GiaCu, GiaMoi, id_loai, SoLuong, SoTrang, SoLuotXem, create_time, date_time) VALUES(:TenSach, :id_nxb, :id_tg, :status, :HinhAnh, :GiaCu, :GiaMoi, :id_loai, :SoLuong, :SoTrang, :SoLuotXem, :create_time, :date_time);";
  $stmt = $conn->prepare($sql);
  if($stmt){
    $stmt->bindParam(':TenSach',$nameBook,PDO::PARAM_STR);
    $stmt->bindParam(':id_nxb',$publisher,PDO::PARAM_INT);
    $stmt->bindParam(':id_tg',$author,PDO::PARAM_INT);
    $stmt->bindParam(':status',$status,PDO::PARAM_INT);
    $stmt->bindParam(':HinhAnh',$imgBook,PDO::PARAM_STR);
    $stmt->bindParam(':GiaCu',$costBook,PDO::PARAM_INT);
    $stmt->bindParam(':GiaMoi',$GiaMoi,PDO::PARAM_INT);
    $stmt->bindParam(':id_loai',$typeBook,PDO::PARAM_INT);
    $stmt->bindParam(':SoLuong',$qtyBook,PDO::PARAM_INT);
    $stmt->bindParam(':SoTrang',$pageBook,PDO::PARAM_INT);
    $stmt->bindParam(':SoLuotXem',$SoLuotXem,PDO::PARAM_INT);
    $stmt->bindParam(':create_time',$create_time,PDO::PARAM_INT);
    $stmt->bindParam(':date_time',$date_time,PDO::PARAM_INT);
    if($stmt->execute()){
      $flag = TRUE;
    }
    $stmt->closeCursor();
  }
  disconnection($conn);
  return $flag;
}

function get_all_data_author_model(){
  $data = array();
  $conn = connection();
  $sql  = "SELECT * FROM tacgia";
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

function get_all_data_publisher_model(){
  $data = array();
  $conn = connection();
  $sql  = "SELECT * FROM nhaxuatban";
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

function get_all_data_typebook_model(){
  $data = array();
  $conn = connection();
  $sql  = "SELECT * FROM loaisach";
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

function get_all_data_book(){
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

function get_info_data_book($id){
  $data = array();
  $conn = connection();
  $sql  = "SELECT a.id, a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong,a.status, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai,d.TenLoai FROM sach AS a INNER JOIN  nhaxuatban AS b ON a.id_nxb = b.id_nxb INNER JOIN tacgia AS c ON a.id_tg = c.id_tg INNER JOIN loaisach AS d ON a.id_loai = d.id_loai WHERE a.id = :id ORDER BY a.create_time DESC LIMIT 1; ";
  $stmt = $conn->prepare($sql);
  if($stmt){
    $stmt->bindParam(':id',$id,PDO::PARAM_STR);
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
function update_info_book($idbook, $namebook, $author, $publisher,  $typebook, $realImgBook, $qtyBook, $costBook, $newCostBook,$slcStatus, $pageBook){
  $flag = FALSE;
  $conn = connection();
  $update_time = date("Y-m-d H:i:s");
  $sql  = "UPDATE sach AS a SET a.TenSach = :TenSach, a.id_nxb = :id_nxb, a.id_tg = :id_tg, a.status = :status, a.HinhAnh = :HinhAnh,a.GiaCu =:GiaCu, a.GiaMoi = :GiaMoi  ,a.id_loai = :id_loai, a.SoLuong = :SoLuong, a.SoTrang = :SoTrang, a.date_time = :date_time WHERE a.id = :id";
  $stmt = $conn->prepare($sql);
  if($stmt){
    $stmt->bindParam(':id',$idbook,PDO::PARAM_INT);
    $stmt->bindParam(':TenSach',$namebook,PDO::PARAM_STR);
    $stmt->bindParam(':id_nxb',$publisher,PDO::PARAM_INT);
    $stmt->bindParam(':id_tg',$author,PDO::PARAM_INT);
    $stmt->bindParam(':status',$slcStatus,PDO::PARAM_INT);
    $stmt->bindParam(':HinhAnh',$realImgBook,PDO::PARAM_INT);
    $stmt->bindParam(':GiaCu',$costBook,PDO::PARAM_STR);
    $stmt->bindParam(':GiaMoi',$newCostBook,PDO::PARAM_STR);
    $stmt->bindParam(':id_loai',$typebook,PDO::PARAM_INT);
    $stmt->bindParam(':SoLuong',$qtyBook,PDO::PARAM_INT);
    $stmt->bindParam(':SoTrang',$pageBook,PDO::PARAM_INT);
    $stmt->bindParam(':date_time',$update_time,PDO::PARAM_STR);
    if($stmt->execute())
    {
      $flag = TRUE;
    }
    $stmt->closeCursor();
  }
  disconnection($conn);
  return $flag;
}

?>