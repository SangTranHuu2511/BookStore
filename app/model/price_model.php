<?php  
	require_once 'app/config/database.php';
	function get_list_all_book_by_price($idPrice){
		switch ($idPrice){
		    case 1:
		    {
		      $minPrice = 0;
		      $maxPrice = 500000;
		      break;
		    }
		    case 2:
		    {
		      $minPrice = 500000;
		      $maxPrice = 1000000;
		      break;
		    }
		    case 3:
		    {
		      $minPrice = 1000000;
		      $maxPrice = 10000000;
		      break;
		    }
  		}
  
		$conn = connection();
		$data = array();
		$sql = "SELECT a.id,a.TenSach,a.id_nxb,a.id_tg,a.HinhAnh,a.GiaMoi,a.GiaCu,a.id_loai,a.SoLuotXem,b.TenLoai,c.TenTG,d.TenNXB FROM sach AS a INNER JOIN loaisach AS b ON a.id_loai = b.id_loai INNER JOIN tacgia AS c ON a.id_tg = c.id_tg INNER JOIN nhaxuatban AS d ON a.id_nxb = d.id_nxb WHERE a.GiaCu BETWEEN :minPrice AND :maxPrice";

		$stm = $conn->prepare($sql);
		if($stm){
		 	$stm->bindParam(':minPrice',$minPrice,PDO::PARAM_INT);
		    $stm->bindParam(':maxPrice',$maxPrice,PDO::PARAM_INT);
		    if($stm->execute()){
		      if($stm->rowCount() > 0){
		        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
		      }
		    }
		    $stm->closeCursor();

		}
		disconnection($conn);
		return $data;
	}

?>