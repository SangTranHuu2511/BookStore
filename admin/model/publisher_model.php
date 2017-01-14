<?php
require_once '../config/database.php';

function add_info_publisher_model($name, $phone, $addresss, $logo){
  $conn = connection();
  $checkFlag = FALSE;
  $create_time  = date('Y-m-d H:i:s');
  $update_time  = "";
  $sql  = "INSERT INTO   nhaxuatban(TenNXB, SDTNXB, DiaChiNXB, logo_NXB, create_time, update_time) VALUES(:TenNXB, :SDTNXB, :DiaChiNXB, :logo_NXB, :create_time, :update_time);";
  $stmt = $conn->prepare($sql);
  if($stmt)
  {
    $stmt->bindParam(':TenNXB',$name,PDO::PARAM_STR);
    $stmt->bindParam(':SDTNXB',$phone,PDO::PARAM_STR);
    $stmt->bindParam(':DiaChiNXB',$addresss,PDO::PARAM_STR);
    $stmt->bindParam(':logo_NXB',$logo,PDO::PARAM_STR);
    $stmt->bindParam(':create_time',$create_time,PDO::PARAM_STR);
    $stmt->bindParam(':update_time',$update_time,PDO::PARAM_STR);
    if($stmt->execute())
    {
      $checkFlag = TRUE;
    }
    $stmt->closeCursor();
  }
  disconnection($conn);
  return $checkFlag;
}

function checkExitsUsername($checkName)
{
  $flag = TRUE;
  $con = connection();
  $sql = "SELECT TenNXB FROM nhaxuatban AS a WHERE a.TenNXB = :name ";
  $stm = $con->prepare($sql);
  if ($stm) {
    $stm->bindParam(":name",$checkName,PDO::PARAM_STR);
    if ($stm->execute()) {
      if ($stm->rowCount() > 0 ) {
        $flag = FALSE;
      }
    }
    $stm->closeCursor();
  }
  disconnection($con);
  return $flag;

}

function getAllDataAutocomplte(){
  $data = array();
  $conn = connection();
  $sql  = "SELECT * FROM  nhaxuatban AS a";
  $stmt = $conn->prepare($sql);
  if($stmt){
    if($stmt->execute()){
      if($stmt->rowCount() > 0){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $icon = PATH_IMG_PUBLISHER . $row['logo_NXB'];
          $data[] = array("value"=>"?sk=publisher&m=edit&id={$row['id_nxb']}","label"=>$row['TenNXB'],"icon"=>$icon);
        }
      }
    }
    $stmt->closeCursor();
  }
  disconnection($conn);
  return $data;
}

function getAllDataPublisher($keyword = ""){
  $data = array();
  $conn = connection();
  $key  = "%".$keyword."%";
  $sql  = "SELECT * FROM  nhaxuatban AS a WHERE a.TenNXB LIKE :key OR a.SDTNXB LIKE :key OR a.DiaChiNXB LIKE :key";
  $stmt = $conn->prepare($sql);
  if($stmt){
    $stmt->bindParam(":key",$key,PDO::PARAM_STR);
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
function getDataInfoPublisher($id){
  $data = array();
  $conn = connection();
  $sql  = "SELECT * FROM  nhaxuatban AS a WHERE a.id_nxb = :id";
  $stmt = $conn->prepare($sql);
  if($stmt){
    $stmt->bindParam(":id",$id,PDO::PARAM_INT);
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

function updateDataPublisher_model($name, $phone, $addresss, $strLogoNXB,$id_nxb){
  $flag = FALSE;
  $conn = connection();
  $update_time = date("Y-m-d H:i:s");
  $sql  = "UPDATE nhaxuatban AS a SET a.TenNXB = :TenNXB, a.SDTNXB = :SDTNXB, a.DiaChiNXB = :DiaChiNXB, a.logo_NXB = :logo_NXB, a.update_time = :update_time WHERE a.id_nxb = :id_nxb";
  $stmt = $conn->prepare($sql);
  if($stmt){
    $stmt->bindParam(':id_nxb',$id_nxb,PDO::PARAM_INT);
    $stmt->bindParam(':TenNXB',$name,PDO::PARAM_STR);
    $stmt->bindParam(':SDTNXB',$phone,PDO::PARAM_STR);
    $stmt->bindParam(':DiaChiNXB',$addresss,PDO::PARAM_STR);
    $stmt->bindParam(':logo_NXB',$strLogoNXB,PDO::PARAM_STR);
    $stmt->bindParam(':update_time',$update_time,PDO::PARAM_STR);
    if($stmt->execute())
    {
      $flag = TRUE;
    }
    $stmt->closeCursor();
  }
  disconnection($conn);
  return $flag;
}

function deleDataPublisher_model($id){
  $flag = FALSE;
  $conn = connection();
  $sql  = "DELETE FROM nhaxuatban WHERE id_nxb = :id_nxb";
  $stmt = $conn->prepare($sql);
  if($stmt){
    $stmt->bindParam(':id_nxb',$id,PDO::PARAM_INT);
    if($stmt->execute())
    {
      $flag = TRUE;
    }
    $stmt->closeCursor();
  }
  disconnection($conn);
  return $flag;
}

function getDataPublisherByPage($start, $limit, $keyword = ""){
  $data = array();
  $key  = "%".$keyword."%";
  $conn = connection();
  $sql  = "SELECT * FROM nhaxuatban AS a WHERE a.TenNXB LIKE :key OR a.SDTNXB LIKE :key OR a.DiaChiNXB LIKE :key ORDER BY a.create_time DESC LIMIT :start, :limmit";
  $stmt = $conn->prepare($sql);
  if($stmt){
    $stmt->bindParam(':start',$start,PDO::PARAM_INT);
    $stmt->bindParam(':limmit',$limit,PDO::PARAM_INT);
    $stmt->bindParam(':key',$key,PDO::PARAM_STR);
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
?>