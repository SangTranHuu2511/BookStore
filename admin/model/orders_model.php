<?php  
	require_once '../config/database.php';

	function get_all_orders_model(){
		$conn = connection();
		$data = array();
		$status = 0;
		$sql = "SELECT a.id_hd,a.id_sach, a.TenKH,a.SDT,a.Email,a.DiaChi,a.GhiChu,a.SoLuong,a.ThanhTien,a.create_time,b.HinhAnh,b.id,b.TenSach FROM donhang AS a INNER JOIN sach AS b ON a.id_sach=b.id WHERE a.TrangThai = :status ORDER BY create_time DESC ";
		$stm=$conn->prepare($sql);
		if($stm){
			$stm->bindParam(':status',$status);
			if($stm->execute()){
				if($stm->rowCount() > 0){
					$data = $stm->fetchALL(PDO::FETCH_ASSOC);
				}
			}
			$stm->closeCursor();
		}
		disconnection($conn);
		$orderBook = array();
		foreach ($data as $key => $value) {
			$orderBook[$value['id_sach']]['imgBook'] = $value['HinhAnh'];
			$orderBook[$value['id_sach']]['nameBook'] = $value['TenSach'];
			$orderBook[$value['id_sach']]['list'][] = $value;			
		}
		return $orderBook;	

	}
	function update_orders_model($id){
		$conn = connection();
		$flag = FALSE;
		$status = 1;
		$sql = "UPDATE donhang AS a SET a.TrangThai = :trangthai WHERE a.id_hd = :id";
		$stm = $conn->prepare($sql);
		if($stm){
			$stm->bindParam(':trangthai',$status,PDO::PARAM_INT);
			$stm->bindParam(':id',$id,PDO::PARAM_INT);
		}
		if($stm->execute()){
			$flag = TRUE;
		} 
		$stm->closeCursor();
		disconnection($conn);
		return $flag;

	}
	function delete_orders_model($id){
		$conn = connection();
		$flag = FALSE;
		$sql = "DELETE FROM donhang WHERE id_hd=:id";
		$stm=$conn->prepare($sql);
		if($stm){
			$stm->bindParam('id',$id,PDO::PARAM_INT);
			if($stm->execute()){
				$flag = TRUE;
			}
			$stm->closeCursor();
		}
		disconnection($conn);
		return $flag;


	}
	function saveOrder($id){
		$conn = connection();
		$flag = FALSE;
		$create_time = date('Y-m-d H:i:s');
		$update_time = '';

		$sql = "INSERT INTO chitiethoadon(id_dh,create_time,update_time) VALUES(:id_hd,:create_time,:update_time)";
		$stm = $conn->prepare($sql);
		if($stm){
			$stm->bindParam(':id_hd',$id,PDO::PARAM_INT);
			$stm->bindParam(':create_time',$create_time,PDO::PARAM_STR);
			$stm->bindParam(':update_time',$update_time,PDO::PARAM_STR);
			if($stm->execute()){
				$flag = TRUE;
			}
			$stm->closeCursor();

		}
		disconnection($conn);
		return $flag;
	}

?>