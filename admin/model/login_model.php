<?php
require_once 'config/database.php';

function checkLogin_model($user, $pass){
    $data = array();
    $conn = connection();
    $sql  = "SELECT * FROM admin AS a WHERE a.username = :username AND a.password = :password LIMIT 1";
    $stmt = $conn->prepare($sql);
    if($stmt){
      $stmt->bindParam(":username",$user,PDO::PARAM_STR);
      $stmt->bindParam(":password",$pass,PDO::PARAM_STR);
      if($stmt->execute()){
        if($stmt->rowCount() > 0 ) {
          $data = $stmt->fetch(PDO::FETCH_ASSOC);
        }
      }
      $stmt->closeCursor();
    }
    disconnection($conn);
    return $data;
}

 ?>
