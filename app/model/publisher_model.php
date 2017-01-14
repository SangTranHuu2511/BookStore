<?php  
	require_once 'app/config/database.php';
	function get_all_book_by_publisher($idPB){
		$conn = connection();
		$data = array();
		$sql = "SELECT a.id,a.TenSach,a.id_nxb,a.id_tg,a.HinhAnh,a.GiaMoi,a.GiaCu,a.id_loai,a.SoLuotXem,b.TenLoai,c.TenTG,d.TenNXB FROM sach AS a INNER JOIN loaisach AS b ON a.id_loai = b.id_loai INNER JOIN tacgia AS c ON a.id_tg = c.id_tg INNER JOIN nhaxuatban AS d ON a.id_nxb = d.id_nxb WHERE a.id_nxb = :idPB";

		$stm = $conn->prepare($sql);
		if($stm){
		 	$stm->bindParam(':idPB',$idPB,PDO::PARAM_INT);
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